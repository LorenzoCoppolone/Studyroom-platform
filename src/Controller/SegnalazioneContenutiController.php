<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewSegnalazioni;
use Model\Segnalazione;
use Model\Studente;
use Model\Materiale;
use Model\Amministratore;
use PDOException;
use RuntimeException;
use InvalidArgumentException;

/**
 * SegnalazioneContenutiController
 *
 * Gestisce l'inserimento di una segnalazione effettuata dallo studente
 * su un materiale pubblicato.
 */
class SegnalazioneContenutiController {

    /**
     * Inserisce una segnalazione effettuata dallo studente.
     *
     * @throws InvalidArgumentException Se l'utente non è loggato o i dati non sono validi.
     * @throws RuntimeException Se si verifica un errore applicativo o DB.
     * @return void
     */
    public function inserisciSegnalazione() : void {
        
        $view = new ViewSegnalazioni();
        $idMateriale = $view->getIdMateriale();
        try {
            $motivo      = $view->getMotivo();
            $session     = Session::getInstance();
            $idUtente    = $session->getSessionElement('studente');
            if(empty($idUtente)) {
                throw new InvalidArgumentException("Utente non loggato");
            } 
            if (strlen($motivo) > 255) {
                throw new InvalidArgumentException("Il motivo della segnalazione non può superare i 255 caratteri.");
            }
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class,$idUtente);
            if($studente->getIsBanned() === true || $studente->getIsVerified() === false) {
                throw new RuntimeException("Utente non verificato");
            }
            $risultati = $pm->findBy(Segnalazione::class, [
                'segnalante'  => $idUtente,
                'materialeSegnalato' => $idMateriale
            ]);
            $segnalazioneEsistente = $risultati[0] ?? null;
            if($segnalazioneEsistente === null) {
                $materiale = $pm->find(Materiale::class,$idMateriale);
                $studente = $pm->find(Studente::class,$idUtente);
                // Assegna la segnalazione al primo amministratore disponibile,
                // senza dipendere da un ID fisso che potrebbe non esistere.
                $admin = $pm->findOneBy(Amministratore::class, []);
                if ($admin === null) {
                    throw new RuntimeException("Nessun amministratore disponibile per gestire la segnalazione.");
                }
                $segnalazione = new Segnalazione($motivo, $studente, $materiale, $admin);
                $pm->save($segnalazione);
                $this->mostraEsito($view, $idMateriale,'successo', 'Segnalazione inviata con successo!');
            } else {
                $this->mostraEsito($view, $idMateriale,'errore', 'Hai già segnalato questo materiale.');
            }
        } catch (InvalidArgumentException $e) {
            // Contesto mancante (utente non loggato / motivo troppo lungo): pagina di errore intera.
            $view->mostraFormErrore($e->getMessage());
        } catch (PDOException $e) {
            $this->mostraEsito($view, $idMateriale,'errore', "Errore durante l'inserimento della segnalazione.");
        } catch (RuntimeException $e) {
            $this->mostraEsito($view, $idMateriale,'errore', $e->getMessage());
        } catch (\Exception $e) {
            $this->mostraEsito($view, $idMateriale,'errore', $e->getMessage());
        }
    }

    /**
     * Imposta il flash message in sessione e reindirizza alla pagina del materiale,
     * dove verrà mostrato il toast di esito (pattern PRG). La sessione è gestita qui,
     * nel controller; il redirect (header) è demandato alla view.
     *
     * @param ViewSegnalazioni $view View che esegue il redirect.
     * @param int $idMateriale Materiale a cui tornare.
     * @param string $tipo 'successo' oppure 'errore'.
     * @param string $testo Messaggio del toast.
     * @return void
     */
    private function mostraEsito(ViewSegnalazioni $view, int $idMateriale, string $tipo, string $testo): void {
        Session::getInstance()->setSessionElement('flash', ['tipo' => $tipo, 'testo' => $testo]);
        $view->redirectMateriale($idMateriale);
    }
}