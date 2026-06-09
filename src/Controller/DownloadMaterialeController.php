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
     * Esegue il download di un materiale.
     *
     * @return void
     * @throws InvalidArgumentException Se l'utente non è loggato.
     * @throws RuntimeException Se si verificano errori durante il processo.
     */
    public function eseguiDownload() : void {

        $view = new viewDownloadMateriale();

        // ID materiale richiesto
        $idMateriale = $view->getIdMateriale();

        // ID utente loggato
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione utente
        if (empty($utente)) {
            throw new InvalidArgumentException("Utente non loggato!");
        }

        try {
            $pm = PersistentManager::getInstance();

            // Controllo se l'utente ha già scaricato questo materiale
            $risultati = $pm->findBy(Download::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);

            $downloadEsistente = $risultati[0] ?? null;

            // Se è la prima volta, registro il download
            if ($downloadEsistente === null) {

                $materiale = $pm->find(Materiale::class, $idMateriale);
                $studente = $pm->find(Studente::class, $idUtente);

                $nuovoDownload = new Download($materiale, $studente);

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