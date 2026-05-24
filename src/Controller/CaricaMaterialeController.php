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
        if (!isLogged()) {
            throw new InvalidArgumentException("Devi essere loggato per caricare materiale.");
            return;
        }
        $pm    = PersistentManager::getInstance();
        $corsi = $pm->findAll(CorsoDiLaurea::class);
        $insegnamenti = $pm->findAll(Insegnamento::class);
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
        $view = new ViewCaricaMateriale();
        $tipologia      = $view->getTipologia();       // "appunto" | "esame"
        $fileCaricato   = $view->getFile();            // array $_FILES['file']
        $idCdl          = $view->getIdCorsoDiLaurea(); // int
        $idInsegnamento = $view->getIdInsegnamento();  // int
        $titolo         = $view->getTitolo();          // string
        $tag            = $view->getTag();             // string|null
        $tac            = $view->getTac();             // bool
        $idUtente = Session::getInstance()->getIdUtenteLoggato();
        $contenutoFile = file_get_contents($fileCaricato['tmp_name']);
        $mimeTypeFile = mime_content_type($fileCaricato['type']);
        $dimensioneFile = $fileCaricato['size'];
        try {
            $this->validaDatiCaricamento($tipologia, $titolo, $tag, $idCdl, $idInsegnamento, $tac, $filecaricato);
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idUtente);
            if ($studente === null) {
                throw new InvalidArgumentException("Studente non trovato.");
            }
            $corsoDiLaurea = $pm->find(CorsoDiLaurea::class, $idCdl);
            if ($corsoDiLaurea === null) {
                throw new InvalidArgumentException("Corso di laurea non trovato.");
            }
            $insegnamento = $pm->find(Insegnamento::class, $idInsegnamento);
            if ($insegnamento === null) {
                throw new InvalidArgumentException("Insegnamento non trovato.");
            }
            $file = new File($mimeTypeFile,$dimensioneFile,$contenutoFile);
            if ($tipologia === 'appunto') {
                $tagEnum = Tag::tryFrom(strtolower($tag));
                if ($tagEnum === null) {
                    throw new InvalidArgumentException("Tag '$tag' non valido.");
                }
                $materiale = new Appunto($titolo, $file, $insegnamento, $studente, $tagEnum);
            } else {
                $materiale = new Esame($titolo, $file, $insegnamento, $studente);
            }
            $pm->save($materiale);
            $view->mostraFormSuccesso("Materiale caricato con successo!");
        } catch (PDOException $e) {
           $view->mostraErrore("Errore durante il caricamento: " . $e->getMessage());
        } catch (\Exception $e) {
            $view->mostraErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    private function validaDatiCaricamento(string $tipologia, string $titolo, ?string $tag, int $idCdl, int $idInsegnamento, bool $tac, array $fileCaricato): void
    {
        if (!$tac) {
            throw new InvalidArgumentException("Devi accettare i Termini e Condizioni per procedere.");
        }
        if (!in_array($tipologia, ['appunto', 'esame'], true) || empty($tipologia) || !is_string($tipologia)) {
            throw new InvalidArgumentException("Tipologia non valida. Scegli 'appunto' o 'esame'.");
        }
        if (empty(trim($titolo))) {
            throw new InvalidArgumentException("Il titolo è obbligatorio.");
        }
        if (mb_strlen($titolo) > 255) {
            throw new InvalidArgumentException("Il titolo non può superare i 255 caratteri.");
        }
        if ($tipologia === 'appunto' && (empty($tag) || !is_string($tag))) {
            throw new InvalidArgumentException("Il tag è obbligatorio per gli appunti.");
        }
        if (empty($idCdl) || !is_int($idCdl) || $idCdl <= 0) {
            throw new InvalidArgumentException("Corso di laurea non valido.");
        }
        if (empty($idInsegnamento) || !is_int($idInsegnamento) || $idInsegnamento <= 0) {
            throw new InvalidArgumentException("Insegnamento non valido.");
        }
        if (empty($contenutoFile) || $fileCaricato['error'] !== 0) {
            throw new InvalidArgumentException("Errore durante il caricamento del file.");
        }
        if ($fileCaricato['size'] > 2 * 1024 * 1024) {
            throw new InvalidArgumentException("Il file supera il limite di 2MB.");
        }
        if (mime_content_type($fileCaricato['type']) !== 'application/pdf') {
            throw new InvalidArgumentException("Sono accettati solo file in formato PDF.");
        }
    }
}