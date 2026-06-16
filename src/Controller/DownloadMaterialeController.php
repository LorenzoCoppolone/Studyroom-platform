<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewDownloadMateriale;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
use Model\Download;
use Model\Materiale;
use Model\Studente;

/**
 * Gestisce il download di un materiale 
 */
class DownloadMaterialeController {

    /**
     * Esegue il download di un materiale.
     *
     * @return void
     * @throws InvalidArgumentException Se l'utente non è loggato.
     * @throws RuntimeException Se si verificano errori durante il processo.
     */
    public function eseguiDownload(int $idMateriale) : void {
    $view = new ViewDownloadMateriale();
    try {
        $session = Session::getInstance();
        $idUtente = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Utente non loggato!");
        }
        $downloadEsistente = $pm->findBy(Download::class, [
            'studente'  => $idUtente,
            'materiale' => $idMateriale
        ]);
        $materiale = $pm->find(Materiale::class, $idMateriale);
        $studente = $pm->find(Studente::class, $idUtente);
        if ($materiale === null) {
            throw new InvalidArgumentException("Materiale non trovato.");
        }
        if (empty($downloadEsistente) && $studente !== null){
            $nuovoDownload = new Download($studente, $materiale);
            $pm->save($nuovoDownload);
        }
        $contenuto = $materiale->getFile()->getContenutoFile();
        if(is_resource($contenuto)) {
            rewind($contenuto);
            $contenuto = stream_get_contents($contenuto);
        }
        $view->effettuaDownload(
            $materiale->getFile()->getMimeTypeFile(),
            $materiale->getFile()->getDimensioneFile(),
            $contenuto,
            $materiale->getIdMateriale()
        );
    } catch(PDOException $e) {
        $view->mostraFormErrore("Errore DB durante il download del materiale: " . $e->getMessage());
    } catch (\Exception $e) {
        $view->mostraFormErrore("Errore durante il download del materiale: " . $e->getMessage());
    }
}

}