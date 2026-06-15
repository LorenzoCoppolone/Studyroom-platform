<?php

namespace Controller;
 
use UI\ViewRecensioneMateriale;
use Foundation\Session;
use Foundation\Persistent\PersistentManager;
use Model\Recensione;
use Model\Materiale;
use Model\Studente;
use PDOException;
use InvalidArgumentException;
 
/**
 * recensioneMaterialeController
 *
 * Gestisce l'inserimento e l'eliminazione delle recensioni
 * effettuate dagli studenti sui materiali.
 */
class recensioneMaterialeController {

    /**
     * Inserisce una recensione effettuata dallo studente.
     *
     * @return void
     */
    public function inserisciRecensione() : void {
        
        $view = new ViewRecensioneMateriale();
        
        try {
        $idMateriale = $view->getIdMateriale();
        $voto        = (float) $view->getVoto();
        $commento    = $view->getCommento();
        $idUtente = Session::getInstance()->getSessionElement('studente');
        // Validazione utente
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Utente non loggato.");
        }

        // Validazione commento
        if (strlen($commento) > 255) {
            $this->mostraEsito($view, $idMateriale,'errore', 'Il commento non può superare i 255 caratteri!');
            return;
        }
        
            $pm = PersistentManager::getInstance();

            // Controllo se esiste già una recensione dello stesso studente
            $risultati = $pm->findBy(Recensione::class, [
                'studente'  => $idUtente,
                'materiale' => $idMateriale
            ]);
            
            $recensioneEsistente = $risultati[0] ?? null;

            if($recensioneEsistente === null) {

                $materiale = $pm->find(Materiale::class, $idMateriale);
                $studente = $pm->find(Studente::class, $idUtente);

                $nuovaRecensione = new Recensione($voto, $commento, $studente, $materiale);

                $pm->save($nuovaRecensione);

                $this->mostraEsito($view, $idMateriale,'successo', 'Recensione inviata con successo!');
            } else {
                $this->mostraEsito($view, $idMateriale,'errore', 'Hai già recensito questo materiale.');
            }

        } catch(PDOException $e) {
            $view->mostraFormErrore("Errore imprevisto.");
        } catch (\Exception $e) {
            $view->mostraFormErrore('Errore imprevisto.');
        }
    }

    /**
     * Mostra la schermata con tutte le recensioni di un materiale.
     * Raggiunta cliccando sul numero di recensioni nella pagina di dettaglio.
     *
     * @param int|null $idMateriale ID del materiale di cui mostrare le recensioni.
     * @return void
     */
    public function recensioni(?int $idMateriale = 0) : void {
        $view = new ViewRecensioneMateriale();
        try {
            $pm = PersistentManager::getInstance();

            $page   = max(1, $view->getPagina() ?? 1);
            $limit  = 10;
            $offset = ($page - 1) * $limit;

            $recensioni       = $pm->trovaRecensioniPerMateriale($idMateriale, $offset, $limit);
            $numeroRecensioni = $pm->countAll(Recensione::class, ['materiale' => $idMateriale]);
            $totPage          = $numeroRecensioni > 0 ? (int)ceil($numeroRecensioni / $limit) : 1;

            // Dati per la navbar (utente loggato), opzionali.
            $idStudente = Session::getInstance()->getSessionElement('studente');
            $username = null;
            $base64   = null;
            if ($idStudente !== null) {
                $studente = $pm->find(Studente::class, $idStudente);
                $username = $studente?->getUsername();
                $base64   = $studente?->getImmagineProfilo()?->getBase64($studente);
            }

            $view->mostraRecensioniMateriale($recensioni, $totPage, $page, $idMateriale, $username, $base64);

        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore imprevisto.");
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto.");
        }
    }

    /**
     * Imposta il flash message in sessione e reindirizza alla pagina del materiale,
     * dove verrà mostrato il toast di esito (pattern PRG). La sessione è gestita qui,
     * nel controller; il redirect (header) è demandato alla view.
     *
     * @param ViewRecensioneMateriale $view View che esegue il redirect.
     * @param int $idMateriale Materiale a cui tornare.
     * @param string $tipo 'successo' oppure 'errore'.
     * @param string $testo Messaggio del toast.
     * @return void
     */
    private function mostraEsito(ViewRecensioneMateriale $view, int $idMateriale, string $tipo, string $testo): void {
        Session::getInstance()->setSessionElement('flash', ['tipo' => $tipo, 'testo' => $testo]);
        $view->redirectMateriale($idMateriale);
    }
}