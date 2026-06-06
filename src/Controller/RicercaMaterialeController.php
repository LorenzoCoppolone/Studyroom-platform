<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Foundation\Services\AnteprimaPdfService;
use UI\ViewRicercaMateriale;
use Model\Materiale;
use Model\Preferito;
use Model\Download;
use Model\Studente;
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
    try {
    $view = new ViewRicercaMateriale();
    $titolo = trim($view->getTitolo());
    $page = $view->getPage() ?? 1; // Ottieni la pagina corrente, default 1 se non specificata
    $arrayPaginazione = $this->paginazione(Materiale::class, $page); // Calcola l'offset per la query
    if ($titolo === '') {
      throw new InvalidArgumentException("Il termine di ricerca non può essere vuoto.");
    }
    $pm = PersistentManager::getInstance();
    $materiali = $pm->cercaMateriale($titolo, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
    $session = Session::getInstance();
    $session->setSessionElement('ricerca_titolo', $titolo);
    $session->setSessionElement('ricerca_filtri', []);
    $id = $session->getSessionElement('studente');
    $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
    $insegnamenti = $pm->trovaInsegnamenti();
    $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
    if($id !== null) {
        $studente = $pm->find(Studente::class, $id);
        $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
    } else {
        $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
    }
    } catch (PDOException $e) {
        $view->mostraFormErrore("Errore DB durante la ricerca: " . $e->getMessage());
    }catch (InvalidArgumentException $e) {
        $view->mostraFormErrore("Errore di validazione: " . $e->getMessage());
    } catch (\Exception $e) {
        $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
    }
}

    /**
     * Mostra i materiali più popolari (media valutazione più alta).
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     */
    public function popolari(): void
    {
        // 1. Nessun input dall'utente: i materiali popolari si recuperano
        try {
            $view = new ViewRicercaMateriale();
            $page = $view->getPage() ?? 1;
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            $pm        = PersistentManager::getInstance();
            $materiali = $pm->getMaterialiPopolari($arrayPaginazione['offset'], $arrayPaginazione['limit']);
            $session = Session::getInstance();
            $session->setSessionElement('ricerca_titolo', '');
            $session->setSessionElement('ricerca_filtri', []);
            $id = $session->getSessionElement('studente');
            $studente = $pm->find(Studente::class, $id);
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            if($studente !== null) {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
            }
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore DB durante il recupero dei materiali: " . $e->getMessage());
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
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
   public function filtra(): void
{
    try {
    $view = new ViewRicercaMateriale();
    $titolo = Session::getInstance()->getSessionElement('ricerca_titolo') ?? ''; // Titolo salvato in sessione dalla ricerca iniziale
    $nuoviFiltri = $view->getDatiFiltro(); // Filtri inviati dalla UI
    $page = $view->getPage() ?? 1; // Pagina corrente, default 1
    $arrayPaginazione = $this->paginazione(Materiale::class, $page);
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
            $filtriAttuali['tipologia']       ?? null , $filtriAttuali['corso_di_laurea'] ?? null,
            $filtriAttuali['insegnamento']    ?? null , $filtriAttuali['tag']             ?? null
        );
        $session = Session::getInstance();
        $id = $session->getSessionElement('studente');
        $corsiDiLaurea = $pm->cercaCorsiDiLaurea();
        $insegnamenti = $pm->cercaInsegnamenti();
        $studente = $pm->find(Studente::class, $id);
        if($studente !== null) {
            $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtriAttuali);
        } else {
            $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $arrayPaginazione['totPage'], $filtriAttuali);
        }
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
    public function preferiti() : void {
        try{
        $view = new ViewRicercaMateriale();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $arrayPaginazione = $this->paginazione(Preferito::class, $page); // calcolo dei parametri di paginazione
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $studente = $pm->find(Studente::class, $idStudenteLoggato);
        $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
        $insegnamenti = $pm->trovaInsegnamenti();
        $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
        $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
        $view->mostraMateriali($preferiti, $arrayPaginazione['totPage'], $page, $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
    }     catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function download() : void {
        try{
        $view = new ViewRicercaMateriale();
        $page = $view->getPage(); // Ottieni la pagina corrente
        $arrayPaginazione = $this->paginazione(Download::class, $page); // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $studente = $pm->find(Studente::class, $idStudenteLoggato);
        $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
        $insegnamenti = $pm->trovaInsegnamenti();
        $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
        $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
        $view->mostraMateriali($download, $arrayPaginazione['totPage'], $page, $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $page);
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function popolariUtente() : void {
        try{
        $view = new ViewRicercaMateriale();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $arrayPaginazione = $this->paginazione(Materiale::class, $page); // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $studente = $pm->find(Studente::class, $idStudenteLoggato);
        $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
        $insegnamenti = $pm->trovaInsegnamenti();
        $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
        $materialiPopolari = $pm->MaterialiPopolariUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
        $view->mostraMateriali($materialiPopolari, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
    } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function paginazione(string $class, int $page) : array {
        $page = max(1, $page); // Assicurati che la pagina sia almeno 1
        $limit = 10; // Numero di risultati per pagina
        $offset = ($page - 1) * $limit; // Calcola l'offset per la query
        $pm = PersistentManager::getInstance();
        $session = Session::getInstance();
        $titolo = $session->getSessionElement('ricerca_titolo') ?? '';
        if($titolo === '') {
        $view = new ViewRicercaMateriale();
            if($view->getDatiFiltro() === []){
                $totaleMateriali = $pm->countAll($class, ['titolo' => '%' . $view->getTitolo() . '%']);
            } else {
                $filtri = $view->getDatiFiltro();
                $totaleMateriali = $pm->countAll($class, [
                'titolo' => '%' . $view->getTitolo() . '%',
                'tipologia' => $filtri['tipologia'] ?? null,
                'corso_di_laurea' => $filtri['corso_di_laurea'] ?? null,
                'insegnamento' => $filtri['insegnamento'] ?? null,
                'tag' => $filtri['tag'] ?? null
                ]);
            }
        } else {
            if($session->getSessionElement('ricerca_filtri') === []) {
                $totaleMateriali = $pm->countAll($class, ['titolo' => '%' . $titolo . '%']);
            } else {
                $filtri = $session->getSessionElement('ricerca_filtri');
                $totaleMateriali = $pm->countAll($class, [
                    'titolo' => '%' . $titolo . '%',
                    'tipologia' => $filtri['tipologia'] ?? null,
                    'corso_di_laurea' => $filtri['corso_di_laurea'] ?? null,
                    'insegnamento' => $filtri['insegnamento'] ?? null,
                    'tag' => $filtri['tag'] ?? null
                ]);
            }
        }
        $totPage = ceil($totaleMateriali / $limit);
    return [
        'offset' =>$offset,
        'limit' => $limit,
        'totPage' => $totPage
    ];
    }
}