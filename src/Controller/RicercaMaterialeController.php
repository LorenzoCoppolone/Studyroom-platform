<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewRicercaMateriale;
use Model\Materiale;
use Model\Preferito;
use Model\Download;
use Model\Studente;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
use Exception;

/**
 * RicercaMaterialeController
 *
 * Gestisce:
 * - ricerca per titolo
 * - ricerca per filtri
 * - materiali popolari
 * - preferiti utente
 * - download utente
 * - materiali popolari per utente
 * - paginazione
 */
class RicercaMaterialeController
{
    // MODALITÀ 1 — Ricerca per titolo

    /**
     * Ricerca materiali per titolo.
     *
     * @throws InvalidArgumentException Se il titolo è vuoto.
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function cerca(): void {
        $view = new ViewRicercaMateriale();
        try {
            
            $titolo = trim($view->getTitolo());
            $page = $view->getPage() ?? 1; // Ottieni la pagina corrente, default 1 se non specificata
            if ($titolo === '') {
                throw new InvalidArgumentException("Il termine di ricerca non può essere vuoto.");
            }
            $session = Session::getInstance();
            $session->setSessionElement('ricerca_titolo', $titolo);
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            $pm = PersistentManager::getInstance();
            $materiali = $pm->cercaMateriale($titolo, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
            $id = $session->getSessionElement('studente');
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $view->getDatiFiltro();
            if($id !== null) {
                $studente = $pm->find(Studente::class, $id);
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
            }
    
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: ");
    
        }catch (InvalidArgumentException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore durante la ricerca: ");
        }
    }

    public function dettagli(?int $id_materiale = 0): void {
            $view = new ViewRicercaMateriale();
        try {

            $pm = PersistentManager::getInstance();
            $materiale = $pm->trovaMateriale($id_materiale);
            // La query usa funzioni di aggregazione senza GROUP BY: restituisce sempre una
            // riga, con idMateriale = null quando il materiale non esiste. Intercetto qui
            // il caso "non trovato" e mostro la pagina di errore 404.
            if ($materiale === null || empty($materiale['idMateriale'])) {
                $view->mostraMaterialeNonTrovato();
                return;
            }
            // Il PDF non viene più inlineato qui: è servito a parte dall'endpoint pdf().
            $session = Session::getInstance();
            $id = $session->getSessionElement('studente');
            if ($id !== null) {
                 $studente = $pm->find(Studente::class, $id);
                 $username = $studente->getUsername();
                 $immagineProfilo = $studente->getImmagineProfilo()->getBase64($studente);
            }
            else {
                    $username = null;
                    $immagineProfilo = null;
                 }
            
            // Verifico se il materiale è già tra i preferiti dell'utente loggato.
            $preferito = false;
            if ($id !== null) {
                $preferito = $pm->findOneBy(Preferito::class, [
                    'studente'  => $id,
                    'materiale' => $id_materiale
                ]) !== null;
            }
            // Flash message (toast di esito) impostato dalle azioni preferiti/recensione/segnalazione.
            // Lo leggo e lo consumo subito, così appare una sola volta.
            $flash = $session->getSessionElement('flash');
            $session->unsetSessionElement('flash');
            $view->mostraDettagliMateriale($materiale, $username, $immagineProfilo, $preferito, $flash);
        }catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: ");
        }catch (\Exception $e) {
            $view->mostraFormErrore("Errore durante la ricerca: ");
        }
    }

    /**
     * Restituisce il contenuto binario del PDF di un materiale, servito inline.
     * Usato come sorgente dell'iframe nella pagina di dettaglio: evita di inlineare
     * il PDF in base64 nell'HTML (i data: URI grandi non vengono renderizzati dai browser).
     *
     * @param int $id_materiale
     * @return void
     */
    public function pdf(?int $id_materiale = 0): void {
        $view = new ViewRicercaMateriale();
        try {

            $pm = PersistentManager::getInstance();
            $materiale = $pm->trovaMateriale($id_materiale);
            $contenuto = $materiale['contenutoFile'] ?? null;
            if (is_resource($contenuto)) {
                rewind($contenuto);
                $contenuto = stream_get_contents($contenuto);
            }
            $view->mostraPdf($contenuto, $materiale['mimeTypeFile'] ?? null, $id_materiale);
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante il recupero del PDF:");
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: ");
        }
    }

    /**
     * Mostra i materiali più popolari.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function popolari(): void{
        $view = new ViewRicercaMateriale();
        try {
            $studente = null;
            $page = $view->getPage() ?? 1;
            $session = Session::getInstance();
            if($session->getSessionElement('ricerca_titolo') !== "") {
                $session->unsetSessionElement('ricerca_titolo');
            }
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            $pm        = PersistentManager::getInstance();
            $materiali = $pm->trovaMaterialiPopolari($arrayPaginazione['offset'], $arrayPaginazione['limit']);
            $id = $session->getSessionElement('studente');
            $session->unsetSessionElement('ricerca_titolo');
            if(isset($id)){
                $studente = $pm->find(Studente::class, $id);
            }
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $view->getDatiFiltro();            
            if($studente !== null) {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
            
            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
            }
        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante il recupero dei materiali: ");
    
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: ");
        }
    }

    /**
     * Applica i filtri alla ricerca corrente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function filtra(): void {
        $view = new ViewRicercaMateriale();
        try {
            
            $session = Session::getInstance();
            $titolo = $session->getSessionElement('ricerca_titolo') ?? '';
            $filtri = $view->getDatiFiltro(); // Filtri inviati dalla UI
            $page = $view->getPage() ?? 1; // Pagina corrente, default 1
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            if (($filtri['tipologia'] ?? null) === 'esame') {
                unset($filtri['tag']);
            }
            $tipologieValide = ['appunto', 'esame'];
            if (isset($filtri['tipologia']) && !in_array($filtri['tipologia'], $tipologieValide, true)) {
                unset($filtri['tipologia']);
            }
            $pm = PersistentManager::getInstance();
            $materiali = $pm->cercaMateriale(
                $titolo,
                $arrayPaginazione['offset'],
                $arrayPaginazione['limit'],
                $filtri['insegnamento']         ?? '',
                $filtri['tipologia']            ?? '',
                $filtri['corso_di_laurea']      ?? '',
                $filtri['tag']                  ?? '',
                $filtri['criterio_ordinamento'] ?? ''
            );
            $id = $session->getSessionElement('studente');
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $studente = $id !== null ? $pm->find(Studente::class, $id) : null;
            if($studente !== null) {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
            }
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante l'applicazione dei filtri: " );
    
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i materiali preferiti dell’utente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function preferiti() : void {
        $view = new ViewRicercaMateriale();
        try{
            
            $page = $view->getPage() ?? 1; 
        
            $arrayPaginazione = $this->paginazione(Preferito::class, $page); 
        
            $session = Session::getInstance(); 
            $idStudenteLoggato = $session->getSessionElement('studente');
        
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
        
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
            
            $view->mostraMateriali($preferiti, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: ");
        
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: ");
        }
    }

    /**
     * Mostra i download dell’utente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function download() : void {
        $view = new ViewRicercaMateriale();
        try{
            $page = $view->getPage() ?? 1; // Ottieni la pagina corrente
        
            $arrayPaginazione = $this->paginazione(Download::class, $page); 
            
            $session = Session::getInstance();
            $idStudenteLoggato = $session->getSessionElement('studente');
            
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
            
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            
            $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
        
            $view->mostraMateriali(
                $download,
                $page,
                $arrayPaginazione['totPage'],
                $studente->getUsername(),
                $studente->getImmagineProfilo()->getBase64($studente),
                $corsiDiLaurea,
                $insegnamenti,
                $filtri
            );

        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i materiali popolari per l’utente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function popolariUtente() : void {
        $view = new ViewRicercaMateriale();
        try{
            
            $page = $view->getPage() ?? 1; // Ottieni la pagina corrente
            $session = Session::getInstance(); // Ottieni l'istanza della sessione
            $idStudenteLoggato = $session->getSessionElement('studente');
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
            $arrayPaginazione = $this->paginazione(Materiale::class, $page, ['utente' => $idStudenteLoggato]); // Calcola l'offset per la query
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            $materialiPopolari = $pm->MaterialiPopolariUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
            $view->mostraMateriali($materialiPopolari, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri, $arrayPaginazione['urlBasePagina']);
    
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: ");
        
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: ");
        }
    }

    /**
     * Calcola offset, limit e numero totale di pagine.
     *
     * @param string $class
     * @param int $page
     * @param array $extraCriteria
     * @return array
     */
    public function paginazione(string $class, int $page, array $extraCriteria = []) : array {
    $page  = max(1, $page);
    $limit = 10;
    $offset = ($page - 1) * $limit;
    $pm      = PersistentManager::getInstance();
    $session = Session::getInstance();
    $titolo = $session->getSessionElement('ricerca_titolo') ?? '';
    $criteria = [];
    // titolo
    if ($titolo === '') {
        $view = new ViewRicercaMateriale();
        $titoloView = $view->getTitolo() ?? '';
        if ($titoloView !== '') {
            $criteria['titolo'] = '%' . $titoloView . '%';
        }
        $filtri = $view->getDatiFiltro();
    } else {
        $criteria['titolo'] = '%' . $titolo . '%';
        $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
    }
    // filtri opzionali
    if (!empty($filtri)) {
        if (!empty($filtri['tipologia'])) {
            $criteria['tipologia'] = $filtri['tipologia'];
        }
        if (!empty($filtri['corso_di_laurea'])) {
            // countAll si aspetta 'corso'
            $criteria['corso'] = $filtri['corso_di_laurea'];
        }
        if (!empty($filtri['insegnamento'])) {
            $criteria['insegnamento'] = $filtri['insegnamento'];
        }
        // 'tag' al momento in countAll non è gestito: o lo aggiungi lì, o lo togli qui
    }
    // Costruzione URL base con tutti i filtri attivi
    $params = $filtri;
    // Rimuovo il parametro page se presente
    unset($params['page']);
    // Ricostruisco la query string
    $queryString = http_build_query($params);
    // URL base (controller + metodo attuale)
    $urlBasePagina = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'];
    // Rimuovo eventuale ?page=... residuo
    $urlBasePagina = preg_replace('/(\?|&)page=\d+/', '', $urlBasePagina);
    // Se ci sono altri parametri GET, li aggiungo
    if (!empty($queryString)) {
        $urlBasePagina .= '?' . $queryString;
    }

    // criteri extra (es. utente per "Caricati")
    $criteria = array_merge($criteria, $extraCriteria);
    $totaleMateriali = $pm->countAll($class, $criteria);
    $totPage = $totaleMateriali > 0 ? (int)ceil($totaleMateriali / $limit) : 1;
    return [
        'offset'  => $offset,
        'limit'   => $limit,
        'totPage' => $totPage,
        'urlBasePagina' => $urlBasePagina
    ];
    }

}