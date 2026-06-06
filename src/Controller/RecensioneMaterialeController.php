<?php

namespace Controller;
 
use UI\ViewRecensioneMateriale;
use Foundation\Session;
use Foundation\Persistent\PersistentManager;
use Model\Recensione;
use Model\Materiale;
use Model\Studente;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
 
/**
 * recensioneMaterialeController
 *
 * Gestisce l'inserimento e l'eliminazione delle recensioni
 * effettuate dagli studenti sui materiali.
 */
class recensioneMaterialeController {

    /**
     * Inserisce una recensione effettuata dallo studente.
     *
     * @return void
     */
    public function inserisciRecensioneController() : void {
        
        $view = new ViewRecensioneMateriale();
        $idMateriale = $view->getIdMateriale();
        $voto        = (float) $view->getVoto();
        $commento    = $view->getCommento();
        $idUtente = Session::getInstance()->getIdUtenteLoggato();
        
        // Validazione utente
        if (empty($idUtente)) {
            $view->mostraFormErrore('Utente non loggato!');
            return;
        }

        // Validazione commento
        if (strlen($commento) > 255) {
            $view->mostraFormErrore('Il commento non può superare i 255 caratteri!');
            return;
        }
        
        try {
            $pm = PersistentManager::getIstance();

            // Controllo se esiste già una recensione dello stesso studente
            $risultati = $pm->findBy(Recensione::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            
            $recensioneEsistente = $risultati[0] ?? null;

            if($recensioneEsistente === null) {

                $materiale = $pm->find(Materiale::class, $idMateriale);
                $studente = $pm->find(Studente::class, $idUtente);

                $nuovaRecensione = new Recensione(0, $voto, $commento, $studente, $materiale);

                $pm->save($nuovaRecensione);

                $view->mostraPopUpRecensione();
            }

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante l'inserimento della recensione': " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Elimina una recensione effettuata dallo studente.
     *
     * @return void
     */
    public function eliminaRecensione() : void {

   
        $view = new ViewRecensioneMateriale();
        $idMateriale = $view->getIdMateriale();
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione utente
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Utente non loggato.");
        }
        
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

            // Conferma
            $view->mostraPopUpConferma();

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante l'eliminazione della recensione': " . $e->getMessage());
        
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }
}