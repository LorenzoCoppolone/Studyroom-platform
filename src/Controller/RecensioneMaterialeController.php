<?php

namespace Controller;
 
use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewRecensioneMateriale;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
 
/**
 * Gestisce l'inserimento, la modifica e l'eliminazione di una recensione
 */
class recensioneMaterialeController {

    public function inserisciRecensioneController() : void {

        // Istanzio la view
        $view = new ViewRecensioneMateriale();

        // Recupero i dati di input
        $idMateriale = $view->getIdMateriale();
        $voto        = (float) $view->getVoto();
        $commento    = $view->getCommento();

        // Recupero l'Id Utente dalla Session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Utente non loggato.");
        }

        if (strlen($commento) > 255) {
            throw new InvalidArgumentException("Il commento non può superare i 255 caratteri.");
        }
        
        // Logica di inserimento
        try {
            $pm = PersistentManager::getIstance();

            // Verificare: uno studente può recensire un materiale una sola volta
            $risultati = $pm->findBy(Recensione::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $recensioneEsistente = $risultati[0] ?? null;

            if($recensioneEsistente === null) {

                $materiale = $pm->find(Materiale::class, $idMateriale);
                $studente = $pm->find(Studente::class, $idUtente);

                // Creo la nuova recensione
                $nuovaRecensione = new Recensione(0, $voto, $commento, $studente, $materiale);

                // Salvo la recensione nel DB
                $pm->save($nuovaRecensione);

                // Mostro la conferma
                $view->mostraPopUpRecensione();
            }

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante l'inserimento della recensione': " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function eliminaRecensione() : void {

        // Istanzio la view
        $view = new ViewRecensioneMateriale();

        // Recupero i dati di input
        $idMateriale = $view->getIdMateriale();

        // Recupero l'Id Utente dalla Session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Utente non loggato.");
        }
        
        // Logica di eliminazione
        try {
            $pm = PersistentManager::getIstance();

            // Trovo la recensione
            $risultati = $pm->findBy(Recensione::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $recensioneSelezionato = $risultati[0] ?? null;

            // Eliminazione
            $pm->delete($recensioneSelezionato);

            // Mostro la conferma all'utente
            $view->mostraPopUpConferma();

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante l'eliminazione della recensione': " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

}