<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\viewDownloadMateriale;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
use Model\Download;
use Model\Materiale;
use Model\Studente;
/**
 * Gestisce il download di un materiale 
 */
class DowloadMaterialeController {

    /**
     * Esegue il download di un materiale
     * @return void
     */
    public function eseguiDownload() : void {

        // Istanzio la view
        $view = new viewDownloadMateriale();

        // Ottengo l'id del materiale 
        $idMateriale = $view->getIdMateriale();

        // Recupero l'id utente dalla Session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($utente)) {
            throw new InvalidArgumentException("Utente non loggato!");
        }

        // Logica download
        try {
            $pm = PersistentManager::getInstance();

            // Controlo se l'utente ha gia effetuato il download di quel materiale
            $risultati = $pm->findBy(Download::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $downloadEsistente = $risultati[0] ?? null;

            if ($downloadEsistente === null) {
                // Prima volta: creo il record 
                $materiale = $pm->find(Materiale::class, $idMateriale);
                $studente = $pm->find(Studente::class, $idUtente);

                // Creo il nuovo oggetto 
                $nuovoDownload = new Download($materiale, $studente);

                // Salvo l'oggetto nel DB
                $pm->save($nuovoDownload);
            }
            $view->mostraFormSuccesso("Download effettuato con successo!");
        } catch(PDOException $e) {
            throw new RuntimeException("Errore durante il download: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }
}