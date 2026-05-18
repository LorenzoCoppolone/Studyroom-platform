<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Foundation\Services\AnteprimaPdfService;
use UI\ViewRicercaMateriale;
use PDOException;
use RuntimeException;
use InvalidArgumentException;

/**
 * RicercaMaterialeController
 *
 * Gestisce la ricerca e il filtraggio dei materiali didattici.
 * Flusso: UI → Controller → Foundation → Controller → UI
 *
 * MODALITÀ 1 — Ricerca per titolo (SSD: ricerca("testo") → elencoMateriale())
 *   cercaMaterialePerTitoloController()
 *
 * MODALITÀ 2 — Materiali popolari + filtri + ordinamento
 *   richiediMaterialeController()    SSD: richiediMateriale() → elencoMaterialiPopolari()
 *   filtraMaterialeController()      SSD: inserisciFiltri()   → risultatiAggiornati()
 *   ordinaMaterialeController()      SSD: ordinamento()       → risultatiAggiornati()
 *
 * NOTA ARCHITETTURALE:
 * - I dati inseriti dall'utente (titolo, filtri, criterio) vengono letti dalla UI.
 * - Il titolo viene salvato in Foundation\Session dopo la prima ricerca,
 *   così filtra e ordina possono recuperarlo senza che l'utente lo reinserisca.
 *   FIX: si usa Session::getInstance() e NON $_SESSION direttamente
 *   (che violerebbe l'architettura a strati — $_SESSION è Foundation).
 *
 * NOTA SU AnteprimaPdfService:
 * La generazione delle anteprime è delegata a un Service di Foundation.
 * Il controller la invoca ma non ne gestisce la logica interna.
 */
class RicercaMaterialeController
{
    // MODALITÀ 1 — Ricerca per titolo

    /**
     * Cerca materiali per titolo e mostra i risultati.
     *
     * @throws InvalidArgumentException Se il titolo è vuoto o troppo corto.
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function cercaMaterialePerTitolo(): void
    {
        // 1. Istanzio la view
        $view = new ViewRicercaMateriale();

        // 2. Il titolo viene dalla UI 
        $titolo = $view->getTitolo();

        // 3. Validazione
        if (empty(trim($titolo))) {
            throw new InvalidArgumentException("Inserisci un termine di ricerca.");
        }
        if (mb_strlen($titolo) < 1) {
            throw new InvalidArgumentException("Il termine di ricerca deve essere di almeno 1 caratteri.");
        }

        // 4. Ricerca e generazione anteprime
        try {
            $pm        = PersistentManager::getInstance();
            $materiali = $pm->cercaMateriale($titolo, 0, 10);

            // Genero le anteprime PDF per ogni materiale trovato
            $materiali = $this->generaAnteprime($materiali);

            // 5. Salvo il titolo in Foundation\Session così filtraMateriale
            //    e ordinaMateriale possono recuperarlo nelle chiamate successive.
            Session::getInstance()->set('ricerca_titolo', $titolo);

            // 6. Mostro i risultati nella view
            $view->mostraMateriali($materiali);

        } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante la ricerca: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

    // MODALITÀ 2 — Materiali popolari + filtri + ordinamento

    /**
     * Mostra i materiali più popolari (media valutazione più alta).
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function richiediMateriale(): void
    {
        // 1. Nessun input dall'utente: i materiali popolari si recuperano
        try {
            $pm        = PersistentManager::getInstance();

            // Da comunicare ai colleghi: serve PM::getMaterialiPerMediaValutazione(limit)
            // ordina per mediaValutazione DESC e restituisce i primi N
            $materiali = $pm->getMaterialiPerMediaValutazione(30);

            $materiali = $this->generaAnteprime($materiali);

            // 2. Salvo nella sessione che siamo in Modalità 2 senza filtri attivi
            //    così filtra e ordina sanno da dove ripartire
            Session::getInstance()->set('ricerca_titolo', '');
            Session::getInstance()->set('ricerca_filtri', []);

            $view = new ViewRicercaMateriale();
            $view->mostraMateriali($materiali);

        } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante il recupero dei materiali: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Applica i filtri ai risultati della ricerca corrente.
     * Il titolo viene recuperato dalla sessione (impostato da cercaMateriale
     * o richiediMateriale), i filtri vengono letti dalla UI.
     *
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function filtraMateriale(): void
    {
        // 1. Istanzio la view
        $view = new ViewRicercaMateriale();

        // 2. Il titolo viene dalla sessione (Foundation\Session)
        $titolo = Session::getInstance()->get('ricerca_titolo') ?? '';

        // 3. I filtri vengono dalla UI 
        $dati = $view->getDatiFiltro();

        // 4. Logica di business: se tipologia = "esame" il tag non è applicabile
        if (($dati['tipologia'] ?? null) === 'esame') {
            $dati['tag'] = null;
        }

        // 5. Validazione whitelist sulla tipologia
        $tipologieValide = ['appunto', 'esame', null];
        if (!in_array($dati['tipologia'] ?? null, $tipologieValide, true)) {
            $dati['tipologia'] = null;
        }

        // 6. Salvo i filtri attivi in sessione così ordinaMateriale li conosce
        Session::getInstance()->set('ricerca_filtri', $dati);

        // 7. Interrogo il PM con titolo + filtri
        try {
            $pm        = PersistentManager::getInstance();

            // Da comunicare ai colleghi: serve PM::cercaMaterialeConFiltri()
            // che gestisce i null come "filtro non applicato" nel WHERE
            $materiali = $pm->cercaMateriale(
                $titolo,
                0,  // offset (paginazione futura)
                20,  // limit
                $dati['tipologia']        ?? null,
                $dati['corso_di_laurea']  ?? null,
                $dati['insegnamento']     ?? null,
                $dati['tag']              ?? null,
                
            );

            $materiali = $this->generaAnteprime($materiali);

            $view->mostraMateriali($materiali);

        } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante il filtraggio: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Ordina i risultati correnti secondo un criterio scelto dall'utente.
     * Titolo e filtri vengono recuperati dalla sessione.
     *
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function ordinaMateriale(): void
    {
        // 1. Istanzio la view
        $view = new ViewRicercaMateriale();

        // 2. Il criterio di ordinamento viene dalla UI
        $criterio = $view->getCriterioOrdinamento();

        // 3. Validazione whitelist — solo i criteri previsti dal SSD
        $criteriValidi = ['numDownload', 'mediaValutazione'];
        if (!in_array($criterio, $criteriValidi, true)) {
            $criterio = 'mediaValutazione'; // fallback sicuro
        }

        // 4. Titolo e filtri vengono dalla sessione (impostati dai controller precedenti)
        $titolo = Session::getInstance()->get('ricerca_titolo') ?? '';
        $filtri = Session::getInstance()->get('ricerca_filtri') ?? [];

        // 5. Rieseguo la query con lo stesso titolo+filtri ma con l'ordinamento scelto
        try {
            $pm        = PersistentManager::getInstance();

            // Da comunicare ai colleghi: cercaMaterialeConFiltri accetta anche
            // il criterio di ordinamento come ultimo parametro
            $materiali = $pm->cercaMateriale(
                $titolo,
                0,
                20,
                $filtri['tipologia']        ?? null,
                $filtri['corso_di_laurea']  ?? null,
                $filtri['insegnamento']     ?? null,
                $filtri['tag']              ?? null,
                $criterio   // ← criterio di ordinamento
            );

            $materiali = $this->generaAnteprime($materiali);

            $view->mostraMateriali($materiali);

        } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante l'ordinamento: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

    // METODI PRIVATI
    /**
     * Genera le anteprime PDF per ogni materiale nell'array.
     * FIX: la logica era duplicata inline in ogni metodo — estratta qui.
     * Il service è di Foundation e si occupa della conversione binaria.
     *
     * @param array $materiali Array di materiali con campo 'contenuto' (blob)
     * @return array Array con 'contenuto' e 'MimeType' sostituiti dall'anteprima
     */
    private function generaAnteprime(array $materiali): array
    {
        $service = AnteprimaPdfService::getInstance();
        foreach ($materiali as &$row) {
            $binario          = stream_get_contents($row['contenuto']);
            $anteprima        = $service->generaAnteprima($binario);
            $row['contenuto'] = $anteprima['contenuto'];
            $row['mimeType']  = $anteprima['mimeType'];
        }
        return $materiali;
    }
}