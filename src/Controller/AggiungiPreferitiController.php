<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewPreferiti;
use PDOException;
use RuntimeException;
use InvalidArgumentException;

/**
 * AggiungiPreferitiController
 * Esegue l'aggiunta e la rimozione di un materiale dai preferiti.
 * La UI mostra il pop-up corretto in base al risultato.
 */
class AggiungiPreferitiController {

    public function togglePreferitoController(): void {

        // Istanzio la view
        $view = new ViewPreferiti();

        // Chiedo alla view l'ID del materiale su cui l'utente ha cliccato 
        $idMateriale = $view->getIdmateriale();

        // Recupero l'Id Utente dalla session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($utente)) {
            throw new InvalidArguementException("Utente non loggato!");
        }

        // Interrogo la foundation e gestisco il toggle
        try {
            // Ottengo l'istanza del PersistentManager
            $pm = PersistentManager::getInstance();

            // Controllo se il preferito esiste gia per questo utente+materiale
            $preferito = $pm->trovaPreferitoPerUtenteEMateriale($idUtente, $idMateriale);

            if ($preferito !== null) {
                // Il materiale era già nei preferiti → lo rimuovo
                $pm->rimuoviPreferito($preferito);
                $view->mostraPopUpRimosso();
            } else {
                // Il materiale non era nei preferiti → lo aggiungo
                $pm->aggiungiPreferito($idUtente, $idMateriale);
                $view->mostraPopUpAggiunto();
            }

        } catch(PDOExcception $e) {
            throw new RuntimeException("Errore DB durante la gestione dei preferiti: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }

    }

}