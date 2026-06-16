<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Model\Studente;
use Model\Materiale;
use Model\Segnalazione;
use UI\ViewAdmin;

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
        $view = new ViewAdmin();
        
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
        $view = new ViewAdmin();
        try{
        $this->verificaAccessoAdmin();
        $pm   = PersistentManager::getInstance();
        $page = $view->getPage() ?? 1;
        $arrayPaginazione = $this->paginazione(Segnalazione::class, $page);
        $segnalazioni = $pm->trovaSegnalazioniAdmin($arrayPaginazione['offset'], $arrayPaginazione['limit']);
        $url = '/Admin/dashboard';
        $view->mostraDashboardAdmin($segnalazioni, $page, $arrayPaginazione['totPage'], $url);
        } catch (\Exception $e) {
            $view->mostraErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i dettagli di un materiale segnalato per la gestione.
     * URL: /Studyroom-platform/admin/gestisciSegnalazione/{id}
     *
     * @param int $id ID del materiale segnalato
     * @return void
     */
    public function gestisciSegnalazione(int $id): void {
        $this->verificaAccessoAdmin();
        
        $pm   = PersistentManager::getInstance();
        $view = new ViewAdmin();
        
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
        
        $view   = new ViewAdmin();
        $valore = $view->getDatiSegnalazione();
        
        $idMaterialeSegnalato = $valore['idMaterialeSegnalato'];
        $bottonePremuto       = $valore['bottonePremuto'];
        $idUtente             = $valore['idUtente'];

        try {
            if (!\Foundation\Csrf::check($_POST['csrf_token'] ?? null)) {
                throw new \Exception("Richiesta non valida.");
            }
            $pm = PersistentManager::getInstance();

            // ACCETTA SEGNALAZIONE → elimina solo la segnalazione
            if (strtolower($bottonePremuto) === 'accetta') {
                $pm->eliminaSegnalazioniAdmin($idMaterialeSegnalato);
                $view->mostraSuccesso();

            // BAN UTENTE
            } elseif (strtolower($bottonePremuto) === 'banUtente') {
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
    $criteria = [];
    $totaleMateriali = $pm->countAll($class, $criteria);
    $totPage = $totaleMateriali > 0 ? (int)ceil($totaleMateriali / $limit) : 1;
    return [
        'offset'  => $offset,
        'limit'   => $limit,
        'totPage' => $totPage,
    ];
    }
}
