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
 * GestionePreferitiController
 *
 * Gestisce l'aggiunta e la rimozione di un materiale dai preferiti.
 * La UI mostra il pop-up corretto in base al risultato.
 */
class GestionePreferitiController {

    /**
     * Gestisce l'aggiunta o la rimozione di un materiale dai preferiti.
     *
     * @return void
     * @throws InvalidArgumentException Se l'utente non è loggato o l'ID materiale manca.
     */
    public function gestionePreferitoController(): void {
        $view = new ViewPreferiti(); 
        $idMateriale = $view->getIdMateriale();
        $session = Session::getInstance();
        $idUtente = $session->getSessionElement('studente');
        try {
            if (empty($idUtente)) {
                throw new InvalidArgumentException("Utente non loggato!");
            }
            if(empty($idMateriale)) {
                throw new InvalidArgumentException("ID materiale mancante!");
            }
            $idMateriale = $view->getIdMateriale();
            $session = Session::getInstance();
            $idUtente = $session->getSessionElement('studente');
            $pm = PersistentManager::getInstance();
            $risultati = $pm->findBy(Preferito::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $preferito = $risultati[0] ?? null;
            if ($preferito !== null) {
                $pm->delete($preferito);
                $view->mostraPopUpRimosso();
            } else {
                $studente = $pm->find(Studente::class, $idUtente);
                $materiale = $pm->find(Materiale::class, $idMateriale);
                $nuovoPreferito = new Preferito($studente, $materiale);
                $pm->save($nuovoPreferito);
                $view->mostraPopUpAggiunto();
            }
        } catch(PDOException $e) {
           $view->mostraFormErrore("Errore durante la gestione dei preferiti: ");
        } catch (\Exception $e) {
           $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }
}