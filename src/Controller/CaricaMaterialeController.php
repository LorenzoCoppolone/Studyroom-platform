<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewCaricaMateriale;
use Model\Appunto;
use Model\Esame;
use Model\Studente;
use Model\Materiale;
use Model\CorsoDiLaurea;
use Model\Insegnamento;
use Model\File;
use Model\Tag;
use PDOException;
use RuntimeException;
use InvalidArgumentException;


class CaricaMaterialeController
{
    /**
     * Mostra il form di caricamento materiale.
     * 
     * @throws InvalidArgumentException Se l'utente non è loggato.
     * @return void
     */
    public function carica(): void{
        $view = new ViewCaricaMateriale();
       
        try{
            $session = Session::getInstance();
            $idStudente = $session->getSessionElement('studente');
            
            if ($idStudente === null) {
                throw new InvalidArgumentException("Utente non loggato");
            }
            $pm    = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudente);
            if($studente->getIsVerified() === false) {
                throw new InvalidArgumentException("Utente non verificato");
            }
            if($studente->getIsBanned() === true) {
                throw new InvalidArgumentException("Utente bannato");
            }
            $corsi = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $view->mostraFormCaricaMateriale($corsi, $insegnamenti, $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente));
        }catch (\Exception $e) {
        $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Riceve i dati del form, valida tutto, costruisce le entità e le persiste.
     *
     * Dati attesi dalla UI:
     *   - tipologia   : "appunto" | "esame"
     *   - file        : file caricato ($_FILES)
     *   - cdl         : ID del corso di laurea scelto
     *   - insegnamento: ID dell'insegnamento scelto
     *   - titolo      : titolo del materiale
     *   - tag         : tag (obbligatorio solo per appunti)
     *   - tac         : bool, true se l'utente ha spuntato la checkbox T&C
     *
     * @throws InvalidArgumentException Se i dati non sono validi o T&C non accettati.
     * @throws RuntimeException Se si verifica un errore DB o imprevisto.
     * @return void
     */
    public function salva(): void {
        
        $view = new ViewCaricaMateriale();
    
        // Lettura dati dalla view
        $tipologia      = $view->getTipologia();
        $fileCaricato   = $view->getFile();
        $idCdl          = $view->getIdCorsoDiLaurea();
        $idInsegnamento = $view->getIdInsegnamento();
        $titolo         = $view->getTitolo();
        $tag            = $view->getTag();
        $tac            = $view->getTac();
        $session        = Session::getInstance();
        $idUtente       = $session->getSessionElement('studente');
        
        try {
            // VALIDAZIONE
            $this->validaDatiCaricamento(
                $tipologia,
                $titolo,
                $tag,
                $idCdl,
                $idInsegnamento,
                $tac,
                $fileCaricato
            );

            // LETTURA FILE
            $contenutoFile  = file_get_contents($fileCaricato['tmp_name']);
            $mimeTypeFile   = mime_content_type($fileCaricato['tmp_name']);
            $dimensioneFile = (float) $fileCaricato['size'];
            $pm = PersistentManager::getInstance();
            // STUDENTE
            $studente = $pm->find(Studente::class, $idUtente);
            if ($studente === null) {
                $view->mostraFormErrore("Utente non trovato.");
                exit;
            }

            // CORSO DI LAUREA
            $corsoDiLaurea = $pm->find(CorsoDiLaurea::class, $idCdl);
            if ($corsoDiLaurea === null) {
                $view->mostraFormErrore("Corso di laurea non trovato.");
                exit;
            }   

            // INSEGNAMENTO
            $insegnamento = $pm->find(Insegnamento::class, $idInsegnamento);
            if ($insegnamento === null) {
                $view->mostraFormErrore("Insegnamento non trovato.");
                exit;
            }
        
            // COSTRUZIONE FILE
            $file = new File($contenutoFile, $mimeTypeFile, $dimensioneFile);
            
            // COSTRUZIONE MATERIALE
            if ($tipologia === 'appunto') {
                $tagEnum = Tag::tryFrom(strtoupper(trim($tag)));
                if ($tagEnum === null) {
                    $view->mostraFormErrore("Tag '$tag' non valido.");
                    exit;
                }
            
                $materiale = new Appunto($titolo, $file, $insegnamento, $studente, $tagEnum);
            
            } else {
                $materiale = new Esame($titolo, $file, $insegnamento, $studente);
            }

            // SALVATAGGIO
            $pm->save($materiale);
        
            $view->mostraFormSuccesso("Materiale caricato con successo!");

        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante il caricamento: " . $e->getMessage());
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Valida i dati del caricamento materiale.
     *
     * @param string $tipologia
     * @param string $titolo
     * @param string|null $tag
     * @param int $idCdl
     * @param int $idInsegnamento
     * @param bool $tac
     * @param array $fileCaricato
     *
     * @throws InvalidArgumentException Se uno dei dati non è valido.
     * @return void
     */
    private function validaDatiCaricamento(
        string $tipologia,
        string $titolo,
        ?string $tag,
        string $idCdl,
        int $idInsegnamento,
        bool $tac,
        array $fileCaricato
    ) : void {

        if ($tac !== true) {
            throw new InvalidArgumentException("Devi accettare i Termini e Condizioni per procedere.");
        }

        if (!in_array($tipologia, ['appunto', 'esame'], true)) {
            throw new InvalidArgumentException("Tipologia non valida.");
        }

        if (empty(trim($titolo))) {
            throw new InvalidArgumentException("Il titolo è obbligatorio.");
        }

        if ($tipologia === 'appunto' && empty($tag)) {
            throw new InvalidArgumentException("Il tag è obbligatorio per gli appunti.");
        }

        if (!isset($idCdl)) {
            throw new InvalidArgumentException("Corso di laurea non valido.");
        }

        if ($idInsegnamento <= 0) {
            throw new InvalidArgumentException("Insegnamento non valido.");
        }

        // VALIDAZIONE FILE
        if (!isset($fileCaricato['error']) || $fileCaricato['error'] !== UPLOAD_ERR_OK) {
            throw new InvalidArgumentException("Errore durante il caricamento del file.");
        }

        if (!is_uploaded_file($fileCaricato['tmp_name'])) {
            throw new InvalidArgumentException("File non caricato correttamente.");
        }

        if ($fileCaricato['size'] > 2 * 1024 * 1024) {
            throw new InvalidArgumentException("Il file supera il limite di 2MB.");
        }

        if (mime_content_type($fileCaricato['tmp_name']) !== 'application/pdf') {
            throw new InvalidArgumentException("Sono accettati solo file PDF.");
        }
    }
}