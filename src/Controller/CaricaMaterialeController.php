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
        $view = new ViewCaricaMateriale();
        try{
        $session = Session::getInstance();
        $idStudente = $session->getSessionElement('studente');
        if ($idStudente === null) {
            throw new InvalidArgumentException("Utente non loggato");
        }
        $pm    = PersistentManager::getInstance();
        $corsi = $pm->getCorsiDiLaureaAsArray(CorsoDiLaurea::class);
        $insegnamenti = $pm->getInsegnamentiAsArray(Insegnamento::class);
        $view = new ViewCaricaMateriale();
        $view->mostraFormCaricamento($corsi, $insegnamenti);
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
     */
    public function carica(): void
{
    $view = new ViewCaricaMateriale();

    $tipologia      = $view->getTipologia();
    $fileCaricato   = $view->getFile();
    $idCdl          = $view->getIdCorsoDiLaurea();
    $idInsegnamento = $view->getIdInsegnamento();
    $titolo         = $view->getTitolo();
    $tag            = $view->getTag();
    $tac            = $view->getTac();
    $idUtente       = Session::getInstance()->getIdUtenteLoggato();

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
        $dimensioneFile = $fileCaricato['size'];

        $pm = PersistentManager::getInstance();

        $studente = $pm->find(Studente::class, $idUtente);
        if ($studente === null) {
            $view->mostraErrore("Utente non trovato.");
            return;
        }

        $corsoDiLaurea = $pm->find(CorsoDiLaurea::class, $idCdl);
        if ($corsoDiLaurea === null) {
            $view->mostraErrore("Corso di laurea non trovato.");
            return;
        }

        $insegnamento = $pm->find(Insegnamento::class, $idInsegnamento);
        if ($insegnamento === null) {
            $view->mostraErrore("Insegnamento non trovato.");
            return;
        }
        $file = new File($mimeTypeFile, $dimensioneFile, $contenutoFile);
        if ($tipologia === 'appunto') {
            $tagEnum = Tag::tryFrom(strtolower($tag));
            if ($tagEnum === null) {
                $view->mostraErrore("Tag '$tag' non valido.");
                return;
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


   private function validaDatiCaricamento(
    string $tipologia,
    string $titolo,
    ?string $tag,
    int $idCdl,
    int $idInsegnamento,
    bool $tac,
    array $fileCaricato
): void {

    if (!$tac) {
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

    if ($idCdl <= 0) {
        throw new InvalidArgumentException("Corso di laurea non valido.");
    }

    if ($idInsegnamento <= 0) {
        throw new InvalidArgumentException("Insegnamento non valido.");
    }

    // --- VALIDAZIONE FILE ---

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