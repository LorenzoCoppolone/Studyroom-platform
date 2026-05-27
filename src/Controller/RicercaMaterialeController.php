<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Foundation\Services\AnteprimaPdfService;
use UI\ViewRicercaMateriale;
use PDOException;
use RuntimeException;
use InvalidArgumentException;


class RicercaMaterialeController
{
    // MODALITÀ 1 — Ricerca per titolo

    /**
     * Cerca materiali per titolo e mostra i risultati.
     *
     * @throws InvalidArgumentException Se il titolo è vuoto o troppo corto.
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function cerca(): void 
    {
    $view = new ViewRicercaMateriale();
    $titolo = trim($view->getTitolo());
    $page = $view->getPage() ?? 1; // Ottieni la pagina corrente, default 1 se non specificata
    $limit = 10; // Numero di risultati per pagina
    $offset = this->paginazione($page, $limit); // Calcola l'offset per la query
    if ($titolo === '') {
        $view->mostraFormErrore("Il termine di ricerca non può essere vuoto.");
        return;
    }
    if (mb_strlen($titolo) < 1) {
        $view->mostraFormErrore("Il termine di ricerca deve essere di almeno 1 carattere.");
        return;
    }
    try {
        $pm = PersistentManager::getInstance();
        $materiali = $pm->cercaMateriale($titolo, $offset, $limit);
        Session::getInstance()->setSessionElement('ricerca_titolo', $titolo);
        Session::getInstance()->setSessionElement('ricerca_filtri', []);
        $view->mostraMateriali($materiali, $page); // Passo anche la pagina corrente per attivare la paginazione

    } catch (PDOException $e) {
        throw new RuntimeException("Errore DB durante la ricerca: " . $e->getMessage());
    }
}

    /**
     * Mostra i materiali più popolari (media valutazione più alta).
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function richiediMaterialiPopolari(): void
    {
        // 1. Nessun input dall'utente: i materiali popolari si recuperano
        try {
            $view = new ViewRicercaMateriale();
            $page = $view->getPage() ?? 1;
            $limit = 10;
            $offset = this->paginazione($page, $limit);
            $pm        = PersistentManager::getInstance();
            $materiali = $pm->getMaterialiPopolari($offset, $limit);
            Session::getInstance()->setSessionElement('ricerca_titolo', '');
            Session::getInstance()->setSessionElement('ricerca_filtri', []);
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
     * @throws InvalidArgumentException Se si verifica un errore di validazione.
     */
   public function filtraMateriale(): void
{
    try {
    $view = new ViewRicercaMateriale();
    $titolo = Session::getInstance()->getSessionElement('ricerca_titolo') ?? ''; // Titolo salvato in sessione dalla ricerca iniziale
    $nuoviFiltri = $view->getDatiFiltro(); // Filtri inviati dalla UI
    $page = $view->getPage() ?? 1; // Pagina corrente, default 1
    $limit = 10; // Numero di risultati per pagina
    $offset = this->paginazione($page, $limit);
    $filtriAttuali = Session::getInstance()->getSessionElement('ricerca_filtri') ?? []; // Recupero i filtri già presenti in sessione
    // Sovrascrivo i filtri della sessione con quelli nuovi
    foreach ($nuoviFiltri as $chiave => $valore) {
        if ($valore === null || $valore === '') {
            unset($filtriAttuali[$chiave]);
        } else {
            $filtriAttuali[$chiave] = $valore;
        }
    }
    if (($filtriAttuali['tipologia'] ?? null) === 'esame') {
        unset($filtriAttuali['tag']);
    }
    $tipologieValide = ['appunto', 'esame'];
    if (isset($filtriAttuali['tipologia']) &&
        !in_array($filtriAttuali['tipologia'], $tipologieValide, true)) {
        unset($filtriAttuali['tipologia']);
    }
    Session::getInstance()->setSessionElement('ricerca_filtri', $filtriAttuali);
        $pm = PersistentManager::getInstance();
        $materiali = $pm->cercaMateriale($titolo, $offset, $limit,
            $filtriAttuali['tipologia']       ?? null,
            $filtriAttuali['corso_di_laurea'] ?? null,
            $filtriAttuali['insegnamento']    ?? null,
            $filtriAttuali['tag']             ?? null
        );
        $view->mostraMateriali($materiali, $page); // Passo anche la pagina corrente per mantenere la paginazione attiva
    } catch (PDOException $e) {
        $view->mostraFormErrore("Errore DB durante l'applicazione dei filtri: " . $e->getMessage());
    } catch (\Exception $e) {
        $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
    }
}
    /**
     * Mostra i materiali associati al profilo dello studente loggato (recensioni, preferiti, download, materiale).
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function cercaPreferitiStudente() : void {
        try{
        $view = new ViewRicercaMateriale();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $limit = 10; // Numero di elementi per pagina
        $offset = this->paginazione($page, $limit); // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, $offset, $limit);
        $numeroPreferiti = $pm->count(Preferito::class, ['Studente' => $idStudenteLoggato]);
        $pagineTotali = ceil($numeroPreferiti / $limit);
        $view->mostraMateriali($preferiti, $pagineTotali, $page);
    }     catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function cercaDownloadStudente() : void {
        try{
        $view = new ViewRicercaMateriale();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $limit = 10; // Numero di elementi per pagina
        $offset = this->paginazione($page, $limit); // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, $offset, $limit);
        $numeroDownload = $pm->count(Download::class, ['Studente' => $idStudenteLoggato]);
        $pagineTotali = ceil($numeroDownload / $limit);
        $view->mostraMateriali($download, $pagineTotali, $page);
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function cercaMaterialiPopolariStudente() : void {
        try{
        $view = new ViewRicercaMateriale();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $limit = 10; // Numero di elementi per pagina
        $offset = this->paginazione($page, $limit); // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $materialiPopolari = $pm->MaterialiPopolariUtente($idStudenteLoggato, $offset, $limit);
        $numeroMaterialiPopolari = $pm->count(Materiale::class, ['Studente' => $idStudenteLoggato]);
        $pagineTotali = ceil($numeroMaterialiPopolari / $limit);
        $view->mostraMateriali($materialiPopolari, $pagineTotali, $page);
    } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function paginazione(int $page, int $limit) : int {
        $page = max(1, $page); // Assicurati che la pagina sia almeno 1
        $offset = ($page - 1) * $limit; // Calcola l'offset per la query
        return $offset;
    }
}