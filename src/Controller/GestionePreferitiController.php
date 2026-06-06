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
        
        // ID materiale selezionato
        $idMateriale = $view->getIdmateriale();
        
        // ID utente loggato
        $idUtente = Session::getInstance()->getIdUtenteLoggato();
        
        // Validazione
        if (empty($idUtente)) {
            $view->mostraFormErrore("Utente non loggato!");
        }
        if (empty($idMateriale)) {
            $view->mostraFormErrore("ID materiale mancante!");
        }

        try {
            $pm = PersistentManager::getInstance();
            
            $risultati = $pm->findBy(Preferito::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            
            $preferito = $risultati[0] ?? null;
            
            if ($preferito !== null) {
                
                $pm->delete($preferito);
                
                $view->mostraFormSuccesso("Materiale rimosso dai preferiti!");
            
            } else {
                
                $studente = $pm->find(Studente::class, $idUtente);
                $materiale = $pm->find(Materiale::class, $idMateriale);
                $nuovoPreferito = new Preferito($studente, $materiale);
                
                $pm->save($nuovoPreferito);
                
                $view->mostraFormSuccesso("Materiale aggiunto ai preferiti!");
            }
        
        } catch(PDOException $e) {
           $view->mostraFormErrore("Errore durante la gestione dei preferiti: ");
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: ");
        }
    }
}