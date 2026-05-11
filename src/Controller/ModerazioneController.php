<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;

use UI\ViewSegnalazione;

use Model\Segnalazione;
use Model\Studente;
use Model\Materiale;
use Model\Amministratore;

use PDOException;
use RuntimeException;
use InvalidArgumentException;

class ModerazioneController {

    
    public function mostraSegnalazioni() : void {
    
        $view = new ViewModerazioneContenuti();

        try {

            $pm = PersistentManager::getInstance();

            // Recupero tutte le segnalazioni
            $segnalazioni = $pm->findAll(Segnalazione::class);

          
                // Recupero tutti i materiali segnalati
                $materialiSegnalati = $pm->trovaMaterialiSegnalati();

                // Mostra le segnalazioni
                $view->mostraMaterialiSegnalati($materialiSegnalati);

           
            }catch (\Exception $e) {
            throw new RuntimeException("Errore recupero segnalazioni: " . $e->getMessage());
        }
    }

    public function GestisciSegnalazione() : void {

        $view = new ViewModerazioneContenuti();
        $valore = $view->getDatiSegnalazione();

        try {
        
            if($valore == "accetta"){
                $pm->Rimuovi($idSegnalazione);
            }elseif($valore == "banUtente"){
                $utente = $pm->find(Utente::class, $idUtente);
                $stato = $utente->setStato(true);
                $pm->update($utente);
            }
            $pm = PersistentManager::getInstance();
            // Elimino il materiale segnalato
            $pm->Remove($idMateriale);
        }catch (\Exception $e) {
            throw new RuntimeException("Errore recupero segnalazioni: " . $e->getMessage());
        }   
    }
}