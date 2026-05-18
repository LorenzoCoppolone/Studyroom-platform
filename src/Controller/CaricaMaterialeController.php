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
     * @throws InvalidArgumentException Se l'utente non è loggato.
     */
    public function avviaCaricamento(): void
    {
        // 1. Solo gli utenti loggati possono caricare materiale
        $idUtente = Session::getInstance()->getIdUtenteLoggato();
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Devi essere loggato per caricare materiale.");
        }

        // 2. Carico i dati per popolare i menu a tendina del form
        $pm    = PersistentManager::getInstance();
        $corsi = $pm->findAll(CorsoDiLaurea::class);
        $insegnamenti = $pm->findAll(Insegnamento::class);
        
        // 3. Mostro il form tramite la view
        $view = new ViewCaricaMateriale();
        $view->mostraFormCaricamento($corsi, $insegnamenti);
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
     */
    public function caricaMateriale(): void
    {
        // 1. Istanzio la view
        $view = new ViewCaricaMateriale();

        // 2. Recupero tutti i dati del form dalla UI (lei legge $_POST e $_FILES)
        $tipologia      = $view->getTipologia();       // "appunto" | "esame"
        $fileCaricato   = $view->getFile();            // array $_FILES['file']
        $idCdl          = $view->getIdCorsoDiLaurea(); // int
        $idInsegnamento = $view->getIdInsegnamento();  // int
        $titolo         = $view->getTitolo();          // string
        $tag            = $view->getTag();             // string|null
        $tac            = $view->getTac();             // bool

        // 3. ID studente loggato da Foundation\Session
        $idUtente = Session::getInstance()->getIdUtenteLoggato();

        // Utente loggato
        if (empty($idUtente)) {
            throw new InvalidArgumentException("Devi essere loggato per caricare materiale.");
        }

        // T&C obbligatori — l'utente deve aver spuntato la checkbox
        if (!$tac) {
            throw new InvalidArgumentException("Devi accettare i Termini e Condizioni per procedere.");
        }

        // Tipologia
        if (!in_array($tipologia, ['appunto', 'esame'], true)) {
            throw new InvalidArgumentException("Tipologia non valida. Scegli 'appunto' o 'esame'.");
        }

        // Titolo
        if (empty(trim($titolo))) {
            throw new InvalidArgumentException("Il titolo è obbligatorio.");
        }
        if (mb_strlen($titolo) > 255) {
            throw new InvalidArgumentException("Il titolo non può superare i 255 caratteri.");
        }

        // Tag obbligatorio solo per gli appunti
        if ($tipologia === 'appunto' && empty($tag)) {
            throw new InvalidArgumentException("Il tag è obbligatorio per gli appunti.");
        }

        // Corso di laurea e insegnamento
        if (empty($idCdl) || !is_int($idCdl) || $idCdl <= 0) {
            throw new InvalidArgumentException("Corso di laurea non valido.");
        }
        if (empty($idInsegnamento) || !is_int($idInsegnamento) || $idInsegnamento <= 0) {
            throw new InvalidArgumentException("Insegnamento non valido.");
        }

        // Validazione file: deve esistere, essere PDF e max 2MB
        if (empty($fileCaricato) || $fileCaricato['error'] !== 0) {
            throw new InvalidArgumentException("Errore durante il caricamento del file.");
        }
        if ($fileCaricato['size'] > 2 * 1024 * 1024) {
            throw new InvalidArgumentException("Il file supera il limite di 2MB.");
        }
        // mime_content_type legge il contenuto reale del file (sicuro contro spoofing)
        if (mime_content_type($fileCaricato['tyepe']) !== 'application/pdf') {
            throw new InvalidArgumentException("Sono accettati solo file in formato PDF.");
        }

        // RECUPERO OGGETTI DAL DB E PERSISTENZA
        try {
            $pm = PersistentManager::getInstance();

            // Recupero oggetto Studente tramite find()
            $studente = $pm->find(Studente::class, $idUtente);
            if ($studente === null) {
                throw new InvalidArgumentException("Studente non trovato.");
            }

            // Recupero CorsoDiLaurea tramite find()
            $corsoDiLaurea = $pm->find(CorsoDiLaurea::class, $idCdl);
            if ($corsoDiLaurea === null) {
                throw new InvalidArgumentException("Corso di laurea non trovato.");
            }

            // Recupero Insegnamento tramite find()
            $insegnamento = $pm->find(Insegnamento::class, $idInsegnamento);
            if ($insegnamento === null) {
                throw new InvalidArgumentException("Insegnamento non trovato.");
            }

            // Creo entità File con il percorso del file caricato
            $file = new File($contenutoFile, $mimeTypeFile, $dimensioneFile);

            // Creo Appunto o Esame in base alla tipologia scelta
            if ($tipologia === 'appunto') {
                // Converto la stringa tag nell'enum Tag
                $tagEnum = Tag::tryFrom(strtolower($tag));
                if ($tagEnum === null) {
                    throw new InvalidArgumentException("Tag '$tag' non valido.");
                }
                $materiale = new Appunto(
                    $titolo,
                    $file,
                    $insegnamento,
                    $studente,
                    $tagEnum
                );
            } else {
                // Per l'esame il tag non viene passato
                $materiale = new Esame(
                    $titolo,
                    $file,
                    $insegnamento,
                    $studente
                );
            }

            // Persisto tramite save() di Doctrine
            $pm->save($materiale);

            // 6. Mostra la schermata di conferma 
            $view->mostraConferma($materiale);

        } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante il caricamento: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }
}