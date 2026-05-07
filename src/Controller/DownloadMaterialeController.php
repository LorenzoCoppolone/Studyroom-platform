<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewDownloadMateriale;
use PDOException;
use RuntimeException;
use InvalidArgumentException;

/**
 * Gestisce il download di un materiale 
 */
class DowloadMaterialeController {

    // Esegue il download del materiale
    public function eseguiDownload() : void {

        // Istanzio la view
        $view = new ViewDownloadMateriale();

        // Ottengo l'id del materiale 
        $idMateriale = $view->getIdMateriale();

        // Recupero l'id utente dalla Session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($utente)) {
            throw new InvalidArguementException("Utente non loggato!");
        }

        // Logica download
        try {
            $pm        = PersistentManager::getInstance();
            $materiale = $pm->trovaMaterialePerId($idMateriale);

            // Controlo se l'utente ha gia effetuato il download di quel materiale
            $downloadEsistente = $pm->trovaDownloadPerUtenteEMateriale($idUtente, $idMateriale);

            if ($downloadEsistente === null) {
                // Prima volta: creo il record e incremento il contatore
                $pm->creaDownload($idUtente, $idMateriale);
            }
            $view->serviFile($materiale->getFile());
            $view->mostraPopUpDownload();

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante la gestione dei preferiti: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }

    }

}