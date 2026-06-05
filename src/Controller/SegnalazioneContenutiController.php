<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;

use UI\ViewSegnalazione;

use Model\Segnalazione;
use Model\Studente;
use Model\Materiale;
use Model\Amministratore;

use PDOException;
use RuntimeException;
use InvalidArgumentException;

class SegnalazioneContenutiController {

    /**
     * Inserisce una segnalazione effettuata dallo studente
     * @return void
     */
    public function inserisciSegnalazione() : void {
        $view = new ViewSegnalazioni();
        $idMateriale = $view->getIdMateriale();
        $motivo      = $view->getMotivo();
        $idUtente = Session::getInstance()->getIdUtenteLoggato();
        if(empty($idUtente)) {
            throw new InvalidArgumentException("Utente non loggato");
        } 
        if (strlen($motivo) > 255) {
            throw new InvalidArgumentException("Il motivo della segnalazione non può superare i 255 caratteri.");
        }
        try {
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class,$idUtente);
            if($studente->getIsBanned() === true || $studente->getIsVerificato() === false) {
                throw new RuntimeException("Utente non verificato");
            }
            $risultati = $pm->findBy(Segnalazione::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $segnalazioneEsistente = $risultati[0] ?? null;
            if($segnalazioneEsistente === null) {
                $materiale = $pm->find(Materiale::class,$idMateriale);
                $studente = $pm->find(Studente::class,$idUtente);
                $admin = $pm->findOneBy(Amministratore::class,[$idAdmin => 1]);
                $segnalazione = new Segnalazione($motivo, $studente, $materiale, $admin);
                $pm->save($segnalazione);
                $view->mostraConfermaSegnalazione();
            } else {
                throw new RuntimeException("Hai già segnalato questo materiale");
            }
        } catch (PDOException $e) {
            $view->mostraErrore("Errore durante l'inserimento della segnalazione");
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore durante l'inserimento della segnalazione" . $e->getMessage());
        }
    }
}