<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Model\Studente;
use Model\Materiale;
use UI\viewAdmin;

class AdminController {

    /**
     * Mostra la dashboard admin con la lista di tutti i materiali segnalati.
     * URL: /Studyroom-platform/index.php/admin/dashboard
     */
    public function dashboard(): void {
        $pm   = PersistentManager::getInstance();
        $view = new viewAdmin();
        $segnalazioni = $pm->trovaSegnalazioniAdmin(0, 10);
        $view->mostraDashboardAdmin($segnalazioni);
    }

    /**
     * Mostra i dettagli di un materiale segnalato per la gestione.
     * URL: /Studyroom-platform/index.php/admin/gestisciSegnalazione/{id}
     * @param int $id ID del materiale segnalato
     */
    public function gestisciSegnalazione(int $id): void {
        $pm   = PersistentManager::getInstance();
        $view = new viewAdmin();
        $dati = $pm->gestisciSegnalazioneMaterialeAdmin($id);

        $view->mostraGestisciSegnalazione($dati);
    }

    /**
     * Esegue l'azione dell'admin: accetta segnalazione, rifiuta (elimina materiale) o banna l'utente.
     * URL: /Studyroom-platform/index.php/admin/eseguiAzione (POST)
     * per eliminare tutte le segnalazioni relative ad un materiale , avremmo potuto fare un findBy() + delete () Loop su tutte le segnalazioni ma andremo a perdere in prestazioni 
     */
    public function eseguiAzione(): void {
        $view   = new viewAdmin();
        $valore = $view->getDatiSegnalazione();
        $idMaterialeSegnalato = $valore['idMaterialeSegnalato'];
        $bottonePremuto       = $valore['bottonePremuto'];
        $idUtente             = $valore['idUtente'];

        try {
            $pm = PersistentManager::getInstance();

            if ($bottonePremuto === 'accetta') {
                $pm->eliminaSegnalazioniAdmin($idMaterialeSegnalato);
                $view->mostraSuccesso();

            } elseif ($bottonePremuto === 'banUtente') {
                $utente = $pm->find(Studente::class, $idUtente);
                if ($utente === null) {
                    throw new \RuntimeException("Studente con ID $idUtente non trovato.");
                }
                $utente->setIsBanned(true);
                $pm->update();
                $view->mostraSuccesso();

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
}
