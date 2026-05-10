<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Model\Preferito;
use Model\Materiale;
use Model\Studente;
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

    public function GestionePreferitoController(): void {

        // Istanzio la view
        $view = new ViewPreferiti();

        // Chiedo alla view l'ID del materiale su cui l'utente ha cliccato 
        $idMateriale = $view->getIdmateriale();

        // Recupero l'Id Utente dalla session
        //$idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if (empty($idUtente)) {
            throw new RuntimeException("Utente non loggato!");
        }

        // Interrogo la foundation e gestisco il toggle
        try {
            // Ottengo l'istanza del PersistentManager
            $pm = PersistentManager::getInstance();

            // Controllo se il preferito esiste gia per questo utente+materiale
            $risultati = $pm->findBy(Preferito::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $preferito = $risultati[0] ?? null;

            if ($preferito !== null) {
                // Il materiale era già nei preferiti → lo rimuovo
                $pm->delete($preferito);
                $view->mostraPopUpRimosso();
            } else {
                // Il materiale non era nei preferiti → lo aggiungo
                // Recupero i due oggetti
                $studente = $pm->find(Studente::class, $idUtente);
                $materiale = $pm->find(Materiale::class, $idMateriale);

                // Costruisco l'oggetto da inserire
                $nuovoPreferito = new Preferito($studente, $materiale);

                // Slavo l'oggetto creato
                $pm->save($nuovoPreferito);
                $view->mostraPopUpAggiunto();
            }

        } catch(PDOException $e) {
            throw new RuntimeException("Errore DB durante la gestione dei preferiti: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }

    }

}