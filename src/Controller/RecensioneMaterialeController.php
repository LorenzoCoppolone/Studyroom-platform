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
        $voto        = $view->getVoto();
        $commento    = $view->getCommento();

        // Recupero l'Id Utente dalla Session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Utente non autenticato.");
        }

        /** 
        *if (($commento->size)>255) {
        *    throw new InvalidArgumentException("Il commento non puo' superare i di 255 caratteri!")
        *}
        */
        // Logica di inserimento
        try {
            $pm = PersistentManager::getIstance();

            // Verificare: uno studente può recensire un materiale una sola volta
            $recensioneEsistente = $pm->trovaRecensionePerUtenteEMateriale($idUtente, $idMateriale);

            if($recensioneEsistente !== null) {
                throw new InvalidArgumentException("Hai già recensito questo materiale.");
            }

            // creo la recensione
            $pm->creaRecensione($idUtente, $idMateriale, $voto, $commento);

            // Mostro la conferma
            $view->mostraPopUpRecensione();

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
            throw new InvalidArgumentException("Utente non autenticato.");
        }
        
        // Logica di eliminazione
        try {
            $pm = PersistentManager::getIstance();

            // Trovo la recensione
            $recensione = $pm->findRecensione($idUtente, $idMateriale);

            // Eliminazione
            $pm->eliminaRecensione($recensione);

            // Mostro la conferma all'utente
            $view->mostraPopUpConferma();

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante l'eliminazione della recensione': " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

}