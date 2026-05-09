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
    public function richiediSegnalazioni() : void {
    
        $view = new ViewModerazioneContenuti();

        try {

            $pm = PersistentManager::getInstance();

            // Recupero tutte le segnalazioni
            $segnalazioni = $pm->findAll(Segnalazione::class);

            // Recupero tutti gli utenti segnalati
            $utentiSegnalati = $pm->trovaUtentiSegnalati();

            $view->mostraUtentiSegnalati($utentiSegnalati);
        } catch (\Exception $e) {
            throw new RuntimeException("Errore recupero segnalazioni: " . $e->getMessage());
        }
    }

}   