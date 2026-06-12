<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Model\Studente;
use Model\Materiale;
use UI\viewAdmin;

class AdminController {

    /**
     * Verifica che l'utente sia un amministratore autenticato.
     *
     * Se la sessione non contiene 'admin', viene restituito un 404
     * identico a quello del FrontController, così da non rivelare
     * l'esistenza dell'area riservata.
     *
     * @return void
     */
    private function verificaAccessoAdmin(): void {
        $session = Session::getInstance(); 
        $view = new viewAdmin();
        
        if ($session->getSessionElement('admin') === null) {
            $view->mostra404();
            exit;
        }
    }

    /**
     * Mostra la dashboard admin con la lista di tutti i materiali segnalati.
     * URL: /Studyroom-platform/index.php/admin/dashboard
     *
     * @return void
     */
    public function dashboard(): void {
        $this->verificaAccessoAdmin();
        
        $pm   = PersistentManager::getInstance();
        $view = new viewAdmin();
        
        $segnalazioni = $pm->trovaSegnalazioniAdmin(0, 10);
        
        $view->mostraDashboardAdmin($segnalazioni);
    }

    /**
     * Mostra i dettagli di un materiale segnalato per la gestione.
     * URL: /Studyroom-platform/index.php/admin/gestisciSegnalazione/{id}
     *
     * @param int $id ID del materiale segnalato
     * @return void
     */
    public function gestisciSegnalazione(int $id): void {
        $this->verificaAccessoAdmin();
        
        $pm   = PersistentManager::getInstance();
        $view = new viewAdmin();
        
        $dati = $pm->gestisciSegnalazioneMaterialeAdmin($id);
        
        $view->mostraGestisciSegnalazione($dati);
    }

    /**
     * Esegue l'azione dell'admin:
     * - accetta segnalazione (rimuove solo la segnalazione)
     * - banna l'utente
     * - elimina il materiale (e tutte le segnalazioni collegate)
     *
     * URL: /Studyroom-platform/index.php/admin/eseguiAzione (POST)
     *
     * Nota: per eliminare tutte le segnalazioni relative a un materiale
     * si usa un metodo dedicato nel PersistentManager, evitando un loop
     * findBy() + delete() che sarebbe meno efficiente.
     *
     * @return void
     */
    public function eseguiAzione(): void {
        $this->verificaAccessoAdmin();
        
        $view   = new viewAdmin();
        $valore = $view->getDatiSegnalazione();
        
        $idMaterialeSegnalato = $valore['idMaterialeSegnalato'];
        $bottonePremuto       = $valore['bottonePremuto'];
        $idUtente             = $valore['idUtente'];

        try {
            $pm = PersistentManager::getInstance();

            // ACCETTA SEGNALAZIONE → elimina solo la segnalazione
            if ($bottonePremuto === 'accetta') {
                $pm->eliminaSegnalazioniAdmin($idMaterialeSegnalato);
                $view->mostraSuccesso();

            // BAN UTENTE
            } elseif ($bottonePremuto === 'banUtente') {
                $utente = $pm->find(Studente::class, $idUtente);
                
                if ($utente === null) {
                    throw new \RuntimeException("Studente con ID $idUtente non trovato.");
                }

                $utente->setIsBanned(true);
                $pm->update();
                $view->mostraSuccesso();

            // RIFIUTA SEGNALAZIONE → elimina materiale + segnalazioni
            } else {
                
                $materiale = $pm->find(Materiale::class, $idMaterialeSegnalato);
                
                if ($materiale === null) {
                    throw new \RuntimeException("Materiale con ID $idMaterialeSegnalato non trovato.");
                }
                
                $pm->eliminaSegnalazioniAdmin($idMaterialeSegnalato);
                $pm->delete($materiale);
                
                $view->mostraSuccesso();
            }

        } catch (\Exception $e) {
            $view->mostraErrore("Errore imprevisto: " . $e->getMessage());
        }
    }


     /**
     * Calcola offset, limit e numero totale di pagine.
     * @param string $class
     * @param int $page
     * @param array $extraCriteria
     * @return array
     */
    private function paginazione(string $class, int $page, array $extraCriteria = []) : array {
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
    // criteri extra (es. utente per "Caricati")
    $criteria = array_merge($criteria, $extraCriteria);
    $totaleMateriali = $pm->countAll($class, $criteria);
    $totPage = $totaleMateriali > 0 ? (int)ceil($totaleMateriali / $limit) : 1;
    return [
        'offset'  => $offset,
        'limit'   => $limit,
        'totPage' => $totPage,
    ];
    }
}
