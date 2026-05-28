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
        $segnalazioni = $pm->trovaSegnalazioniAdmin(0, 100);
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
        $dati     = $pm->gestisciSegnalazioneMaterialeAdmin($id);
        $fileRow  = $pm->getFileMaterialeAdmin($id);
        $mimeType = $fileRow['mimeType'] ?? null;

        $view->mostraGestisciSegnalazione($dati, $mimeType);
    }

    /**
     * Serve il contenuto binario del file di un materiale direttamente al browser.
     * URL: /Studyroom-platform/index.php/admin/serviFile/{id}
     * @param int $id ID del materiale
     */
    /**
     * Serve il contenuto binario del file via DBAL (evita l'hydration ORM).
     * URL: /Studyroom-platform/index.php/admin/serviFile/{id}
     * @param int $id ID del materiale
     */
    public function serviFile(int $id): void {
        $pm      = PersistentManager::getInstance();
        $fileRow = $pm->getFileMaterialeAdmin($id);

        if ($fileRow === null) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $mimeType  = $fileRow['mimeType'] ?: 'application/octet-stream';
        $contenuto = $fileRow['contenuto'];
        if (is_resource($contenuto)) {
            $contenuto = stream_get_contents($contenuto);
        }

        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: inline');
        echo $contenuto;
        exit;
    }

    /**
     * Esegue l'azione dell'admin: accetta segnalazione, rifiuta (elimina materiale) o banna l'utente.
     * URL: /Studyroom-platform/index.php/admin/eseguiAzione (POST)
     */
    public function eseguiAzione(): void {
        $view   = new viewModerazioneContenuti();
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
