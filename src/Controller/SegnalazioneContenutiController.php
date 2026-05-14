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

        // Istanzio la view
        $view = new ViewSegnalazioni();
        
        // Ottengo i dati
        $idMateriale = $view->getIdMateriale();
        $motivo      = $view->getMotivo();

        // Recupero l'id utente segnalante dalla sessione
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Validazione
        if(empty($idUtente)) {
            throw new InvalidArgumentException("Utente non autenticato.");
        }

        // Controllo lunghezza motivazione 
        if (strlen($motivo) > 255) {
            throw new InvalidArgumentException("La motivazione non può superare i 255 caratteri.");
        }

        try {

            // Istanzio il PM
            $pm = PersistentManager::getInstance();

            // Verificare: uno studente può segnalare un materiale una sola volta
            $risultati = $pm->findBy(Segnalazione::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            $segnalazioneEsistente = $risultati[0] ?? null;

            if($segnalazioneEsistente === null) {
            
                // Recupero le entity
                $materiale = $pm->find(Materiale::class,$idMateriale);

                $studente = $pm->find(Studente::class,$idUtente);

                $admin = $pm->findOneBy(Amministratore::class,[$idAdmin => 1]);

                // creazione Segnalazione
                $segnalazione = new Segnalazione($motivo, $studente, $materiale, $admin);

                // Salvo nel DB
                $pm->save($segnalazione);

                $view->mostraConfermaSegnalazione();
            }

        } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante la segnalazione: "    . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: "    . $e->getMessage());
        }
        
    }
}