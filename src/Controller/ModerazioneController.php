<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;

use UI\ViewSegnalazione;

use Model\Segnalazione;
use Model\Studente;
use Model\Materiale;
use Model\Amministratore;
use UI\viewModerazioneContenuti;
use PDOException;
use RuntimeException;
use InvalidArgumentException;

class ModerazioneController {


    //Dashboard Admin

    public function dashboardAdmin() : array {
        $view = new viewModerazioneContenuti();
            $pm = PersistentManager::getInstance();
            $segnalazioni = $pm->trovaSegnalazioniAdmin(0,10);
            $view->mostraDashboardAdmin($segnalazioni);
            return $segnalazioni;
    }

    /**
     * Mostra le segnalazioni
     * @return void
     */
    public function mostraSegnalazioni() : void {
        $view = new ViewModerazioneContenuti();
        try {
            $pm = PersistentManager::getInstance();
            $segnalazioni = $pm->findAll(Segnalazione::class);
            $materialiSegnalati = $pm->trovaMaterialiSegnalati();
            $view->mostraMaterialiSegnalati($materialiSegnalati);
            }catch (\Exception $e) {
            $view->mostraErrore("Errore imprevisto!");
            }catch (PDOException $e) {
            $view->mostraErrore("Errore durante il recupero segnalazioni: ");
            }
    }

    /**
     * Gestisce le segnalazioni accettate, rifiutate e ban dell'utente
     * @return void
     */
    public function GestisciSegnalazione() : void {
        $view = new ViewModerazioneContenuti();
        $valore = $view->getDatiSegnalazione();
        try {
            if($valore == "accetta"){
                $pm->Rimuovi($idSegnalazione);
            }elseif($valore == "banUtente"){
                $utente = $pm->find(Utente::class, $idUtente);
                $stato = $utente->setIsBanned(true);
                $pm->update($utente);
            }
            $pm = PersistentManager::getInstance();
            $pm->Remove($idMateriale);
        }catch (\Exception $e) {
            throw new RuntimeException("Errore recupero segnalazioni: " . $e->getMessage());
        }   
    }
}