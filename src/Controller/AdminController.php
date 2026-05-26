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

class AdminController {

    public function mostraSegnalazione() : void {
        $view = new ViewSegnalazione();
        $idMateriale = $view->getDatiSegnalazione();
        $dati = $pm->gestisciSegnalazioneMaterialeAdmin($idMateriale);
        $view->mostraSegnalazione($dati);
    }


    /**
     * Gestisce le segnalazioni accettate, rifiutate e ban dell'utente
     * @return void
     */
    public function GestisciSegnalazione() : void {
        $view = new ViewModerazioneContenuti();
        $valore = $view->getDatiSegnalazione();
        $idMaterialeSegnalato = $valore['idMaterialeSegnalato'];
        try {
            $pm = PersistentManager::getInstance();
            if($valore['bottonePremuto'] === "accetta"){
                $pm->eliminaSegnalazioniAdmin($idMaterialeSegnalato);
                $view->mostraSuccesso('Segnalazione accettata correttamente');
            }elseif($valore['bottonePremuto'] === "banUtente"){
                $utente = $pm->find(Utente::class, $idUtente);
                $stato = $utente->setIsBanned(true);
                $pm->update($utente);
                $view->mostraSuccesso('Utente bannato correttamente');
            }else{
                $pm->delete($idMateriale);
                $pm->eliminaSegnalazioniAdmin($idMaterialeSegnalato);
                $view->mostraSuccesso('Materiale rimosso correttamente');
            }
        }catch (\Exception $e) {
            $view->mostraErrore("Errore imprevisto: " . $e->getMessage());
        }   
    }
}