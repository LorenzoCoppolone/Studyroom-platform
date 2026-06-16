<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Model\Preferito;
use Model\Materiale;
use Model\Studente;
use UI\ViewPreferiti;
use PDOException;
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
            if (!\Foundation\Csrf::check($_POST['csrf_token'] ?? null)) {
                throw new InvalidArgumentException("Richiesta non valida.");
            }
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
                $this->mostraEsito($view, $idMateriale,'successo', 'Materiale rimosso dai preferiti!');
            } else {
                $studente = $pm->find(Studente::class, $idUtente);
                $materiale = $pm->find(Materiale::class, $idMateriale);
                $nuovoPreferito = new Preferito($studente, $materiale);
                $pm->save($nuovoPreferito);
                $this->mostraEsito($view, $idMateriale,'successo', 'Materiale aggiunto ai preferiti!');
            }
        } catch (InvalidArgumentException $e) {
           // Contesto mancante (utente non loggato / id assente): pagina di errore intera.
           $view->mostraFormErrore($e->getMessage());
        } catch(PDOException $e) {
           $this->mostraEsito($view, $idMateriale,'errore', 'Errore durante la gestione dei preferiti.');
        } catch (\Exception $e) {
           $this->mostraEsito($view, $idMateriale,'errore', 'Errore imprevisto.');
        }
    }

    /**
     * Imposta il flash message in sessione e reindirizza alla pagina del materiale,
     * dove verrà mostrato il toast di esito (pattern PRG). La sessione è gestita qui,
     * nel controller; il redirect (header) è demandato alla view.
     *
     * @param ViewPreferiti $view View che esegue il redirect.
     * @param int $idMateriale Materiale a cui tornare.
     * @param string $tipo 'successo' oppure 'errore'.
     * @param string $testo Messaggio del toast.
     * @return void
     */
    private function mostraEsito(ViewPreferiti $view, int $idMateriale, string $tipo, string $testo): void {
        Session::getInstance()->setSessionElement('flash', ['tipo' => $tipo, 'testo' => $testo]);
        $view->redirectMateriale($idMateriale);
    }
}