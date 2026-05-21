<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session\Session;
use UI\viewUser;
use Model\Studente;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class UserController {

    public function __construct() {
        // Costruttore vuoto, se necessario puoi aggiungere inizializzazioni qui
    }

    public function mostraFormLogin() : void {
        $view = new viewUser();
        $view->mostraFormLogin();
    }


    public function mostraFormRegistrazione() : void {
        $view = new viewUser();
        $view->mostraFormRegistrazione();
    }


    public function modificaProfilo() : void {
        $view = new viewUser();
        $modifiche = $view->getDatiModifiche(); // Ottieni i dati delle modifiche da apportare al profilo, se presenti
         try {
            $pm = PersistentManager::getInstance();
            $session = Session::getInstance();
            $idStudenteLoggato = $session->getSessionElement('idStudenteLoggato');
            $studente = $pm->findOneById(Studente::class, $idStudenteLoggato);
            if ($studente === null) {
                $view->mostraFormErrore("Utente non trovato");
                return;
            }
            $studente->setNome($modifiche['nome']?? $studente->getNome());
            $studente->setCognome($modifiche['cognome']?? $studente->getCognome());
            $studente->setEmail($modifiche['email']?? $studente->getEmail());
            $studente->setUsername($modifiche['username']?? $studente->getUsername());
            $studente->setPassword($modifiche['password']?? $studente->getPassword());
            $immagine = new File($modifiche['immagine'][0], $modifiche['immagine'][1], $modifiche['immagine'][2], $modifiche['immagine'][3], $modifiche['immagine'][4]);
            $studente->setImmagineProfilo($immagine ?? $studente->getImmagineProfilo());
            $pm->update($studente);
            $view->mostraModificaProfilo($studente->getNome(), $studente->getCognome(), $studente->getEmail(), $studente->getUsername(), $studente->getImmagineProfilo());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante la modifica del profilo: " . $e->getMessage());
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la modifica del profilo: " . $e->getMessage());
        }
    }

    
    /**
     * Funzione per gestire la registrazione di un nuovo studente,
     *  con validazione dei dati inseriti, controllo dell'unicità dell'email, hashing della password
     * e salvataggio dello studente nel database,
     * e invio dell'email di verifica
      * @return void
     */
    public function registrazioneStudente() {
         try {
            $session = Session::getInstance();
            $view = new viewUser();
            $datiRegistrazione = $view->getDatiRegistrazione();
            $pm = PersistentManager::getInstance();
            // Controllo che tutti i campi  siano stati compilati
            if (empty($datiRegistrazione['nome']))     throw new \Exception("Il nome è obbligatorio.");
            if (empty($datiRegistrazione['cognome']))  throw new \Exception("Il cognome è obbligatorio.");
            if (empty($datiRegistrazione['username']))    throw new \Exception("L'username è obbligatorio.");
            if (empty($datiRegistrazione['email'])) throw new \Exception("L'email è obbligatoria.");
            if (empty($datiRegistrazione['password'])) throw new \Exception("La password è obbligatoria.");
            // Validazione email
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@student\.univaq\.it$/', $datiRegistrazione['email'])) {
                 throw new \Exception("Devi usare la tua email universitaria (@student.univaq.it).");
            }
            $studenteEsistente = $pm->findOneBy(Studente::class, [
                'email' => $datiRegistrazione['email']
            ]);
            if ($studenteEsistente !== null) {
                throw new \Exception("Email già registrata.");
            }
            $passwordHash = password_hash($datiRegistrazione['password'], PASSWORD_BCRYPT); // Hash della password
            $studente = new Studente($datiRegistrazione['nome'], $datiRegistrazione['cognome'],
            $datiRegistrazione['email'] ,$passwordHash, $datiRegistrazione['username']);
            $token = bin2hex(random_bytes(63)); // Genera un token casuale
            $studente->setToken($token); // Salva il token nello studente
            $studente->setValidazioneToken(time() + 10*60); // Imposta la scadenza del token a 10 minuti
            $pm->save($studente); // Salva lo studente nel database
            $this->inviaEmailVerifica($studente, $token); // Invia l'email di verifica con il token
            $view->mostraVerificaEmail(); // Mostra la form con scritto "controlla la tua email", con la relativa email
            $studenteRegistrato = $pm->findOneBy(Studente::class, [
                'email' => $datiRegistrazione['email']
            ]); // Recupera lo studente appena registrato per ottenere il suo ID
            $session->setSessionElement('studente',$studenteRegistrato->getId()); // Salva l'ID dello studente nella sessione per eventuali usi futuri

        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la registrazione: ");
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante la registrazione: " . $e->getMessage());
        }


    }

     // Funzione per gestire il login dell'utente ( manca la parte relativa alla gestione della sessione e al reindirizzamento alla home page dopo il login )
    public function loginStudente() {
        try {
            $session = Session::getInstance(); // Ottieni l'istanza della sessione
             // Istanzio la view e mi faccio restituire la form di registrazione
            $view = new viewUser();
            $datiLogin = $view->getDatiLogin();
            // Istanzio il PersistentManager
            $pm = PersistentManager::getInstance();
            // Controllo che tutti i campi  siano stati compilati
            if (empty($datiLogin['email'])) throw new \Exception("L'email è obbligatoria.");
            if (empty($datiLogin['password'])) throw new \Exception("La password è obbligatoria.");
            // Cerco lo studente nel DB per email
            $studente = $pm->findOneBy(Studente::class, [
                'email' => $datiLogin['email']
            ]); // Cerco lo studente nel DB per email, posso farlo perché l'email nel nostro sistema è univoca.
            if(!$studente->getIsVerified()) {
                $view->mostraFormErrore("L'email non è stata verificata, controlla la tua email o riprova a registrarti"); // Mostra di nuovo la form di login
                return; // Termina l'esecuzione della funzione
            }
            // Verifico che lo studente esista
            if ($studente === null) {
                $view->mostraFormLogin(); // Mostra di nuovo la form di login
                throw new \Exception("Credenziali non corrette."); // Lancia un'ecezione per indicare che le credenziali non sono corrette
                return; // Termina l'esecuzione della funzione
            }
            // Verifico la password
            if (!password_verify($datiLogin['password'], $studente->getPassword())) {
                $view->mostraFormLogin(); // Mostra di nuovo la form di login
                throw new \Exception("Credenziali non corrette."); // Lancia un'ecezione per indicare che le credenziali non sono corrette
                return; // Termina l'esecuzione della funzione
            }else {
                $session->setSessionElement('idStudenteLoggato', $studente->getId()); // Login riuscito, salva l'ID dello studente nella sessione
                $view->mostraHomeLoggato($studente->getUsername(), $studente->getImmagineProfilo()); // Mostra la home page per l'utente loggato, passando username ed email per personalizzare la pagina
            }
        } catch (PDOException $e) {
            // Errore lato DB
            $view->mostraFormErrore("Errore durante il login dell'utente: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            $view->mostraFormErrore("Errore durante il login dell'utente: " . $e->getMessage());
        }
    }

    public function logoutStudente() : void {
        $session = Session::getInstance();
        $session->destroySession(); // Distrugge la sessione, effettivamente facendo il logout
        $view = new viewUser();
        $view->mostraHome(); // Dopo il logout, mostra la form di login
    }
    
    /**
     * Funzione per gestire la verifica dell'email tramite token 
     * @return void
     */
    public function verificaEmail() : void {

        try {
            $view = new viewUser();
            $token = $view->getTokenEmail(); // Ottieni il token dalla query string
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class, [
                'token' => $token
            ]); // Cerco lo studente nel DB per token

            if ($studente === null) {
                $view->mostraFormTokenNonValido(); // Mostra la form che informa l'utente che il token non è valido
                return; // Termina l'esecuzione della funzione
            }
            if (time() > $studente->getValidazioneToken() || $studente->getToken() === null) {
                $pm->delete($studente); // Elimina lo studente dal database se il token è scaduto
                $view->mostraFormTokenScaduto(); // Mostra la form che informa l'utente che il token è scaduto
                return; // Termina l'esecuzione della funzione
            }

            $studente->setToken(null); // Rimuovi il token dallo studente
            $studente->setValidazioneToken(null); // Rimuovi la scadenza del token
            $studente->setIsEmailVerified(true); // Imposta l'email come verificata
            $pm->update($studente); // Salva le modifiche al database
            $view->mostraConvalidaEmail(); // Mostra la form di conferma che l'email è stata verificata con successo

        } catch (PDOException $e) {
           $view->mostraFormErorre("Errore durante la verifica dell'email: " . $e->getMessage());
        
        } catch (Exception $e) {
            $view->mostraFormErorre("Errore durante la verifica dell'email: " . $e->getMessage());
        }
    }

    /**
     * Funzione per mostrare il profilo dell'utente, 
     * con le sue recensioni, preferiti, download e materiale caricato, 
     * con paginazione
     */
    public function profiloStudente() : void {
        try{
        $view = new viewUser();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $modifiche = $view->getDatiModifiche(); // Ottieni le modifiche da apportare al profilo, se presenti
        $page = max(1, $page); // Assicurati che la pagina sia almeno 1
        $limit = 10; // Numero di elementi per pagina
        $offset = ($page - 1) * $limit; // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('idStudenteLoggato');
        $view =  new viewUser();
        $pm = PersistentManager::getInstance();
        $bottone = strtolower($view->getBottoneCliccato());

        // recupero ciò che mi serve per la view, a seconda del bottone cliccato, e mostro la view corrispondente
         if($bottone === "modifica"){
            $studente = $pm->findOneById(Studente::class, $idStudenteLoggato);
            $view->mostraModificaProfilo($studente->getNome(), $studente->getCognome(), $studente->getEmail(), $studente->getUsername(), $studente->getImmagineProfilo());
        }elseif($bottone === "recensioni"){
            $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, $offset, $limit);
            $numeroRecensioni = $pm->count(Recensione::class, ['Studente' => $idStudenteLoggato]);
            $pagineTotali = ceil($numeroRecensioni / $limit);
            $view->mostraRecensioniStudente($recensioni, $pagineTotali);
        }elseif($bottone === "preferiti"){
            $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, $offset, $limit);
            $numeroPreferiti = $pm->count(Preferito::class, ['Studente' => $idStudenteLoggato]);
            $pagineTotali = ceil($numeroPreferiti / $limit);
            $view->mostraPreferitiStudente($preferiti, $pagineTotali);
        }elseif($bottone === "download"){

            $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, $offset, $limit);
            $numeroDownload = $pm->count(Download::class, ['Studente' => $idStudenteLoggato]);
            $pagineTotali = ceil($numeroDownload / $limit);
            $view->mostraDownloadStudente($download, $pagineTotali);
        }elseif($bottone === "materiale"){
            $materiale = $pm->MaterialiPopolariUtente($idStudenteLoggato, $offset, $limit);
            $numeroMateriali = $pm->count(Materiale::class, ['Studente' => $idStudenteLoggato]);
            $pagineTotali = ceil($numeroMateriali / $limit);
            $view->mostraMaterialiStudente($materiale, $pagineTotali);
        }
    }     catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Funzione per inviare l'email di verifica al momento della registrazione, con il token di conferma email
     * @param studente $studente, 
     * @param string $token
     * @return void
     */
    public function inviaEmailVerifica(studente $studente, string $token) {
       
        try {
            $mail = require __DIR__ . '/../config/mailer-bootstrap.php'; // Carica PHPMailer 
            $studenteEmail = $studente->getEmail();
            $mail->addAddress($studenteEmail); // Aggiungi il destinatario
            $mail->Subject = 'Conferma la tua registrazione a StudyRoom';
            $mail->Body    = "Ciao {$studente->getNome()},\n\nPer confermare la tua registrazione a StudyRoom, clicca sul link seguente:\n\n" .
                              "http://localhost/Studyroom-platform/verificaEmail.php?token={$token}\n\n" .
                              "Il link sarà valido per 10 minuti.\n\nGrazie!";
            $mail->send();
        } catch (Exception $e) {
            echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
        }
    }

    /**
     * Funzione per controllare se l'utente sia loggato, 
     * da usare in tutte le pagine che richiedono l'autenticazione, 
     * per verificare se l'utente è loggato, altrimenti reindirizzarlo alla pagina di login
      * @return bool
     */
    public function isUtenteLoggato() : bool {
        $session = Session::getInstance();
        return $session->getSessionElement('idStudenteLoggato') !== null;
    }


    /**
     * Funzione per controllare se l'utente loggato è bannato,
     * da usare in tutte le pagine che richiedono l'autenticazione, 
     * per verificare se l'utente loggato è bannato, altrimenti reindirizzarlo alla pagina di login
      * @return bool
     */
    public function isUtenteBannato() : bool {
        $session = Session::getInstance();
        $idStudenteLoggato = $session->getSessionElement('idStudenteLoggato');
        if ($idStudenteLoggato === null) {
            return false; // Se l'utente non è loggato, non è bannato
        }
        $pm = PersistentManager::getInstance();
        $studente = $pm->findOneById(Studente::class, $idStudenteLoggato);
        return $studente->getIsBanned(); // Restituisce true se lo studente è bannato, altrimenti false
    }

    /**
     * Funzione per controllare se l'utente loggato ha verificato la propria email,
     * da usare in tutte le pagine che richiedono l'autenticazione, 
     * per verificare se l'utente loggato ha verificato la propria email, 
     * altrimenti reindirizzarlo alla pagina di login
     * @return bool
     */
    public function isUtenteVerificato() : bool {
        $session = Session::getInstance();
        $idStudenteLoggato = $session->getSessionElement('idStudenteLoggato');
        if ($idStudenteLoggato === null) {
            return false; // Se l'utente non è loggato, non è verificato
        }
        $pm = PersistentManager::getInstance();
        $studente = $pm->findOneById(Studente::class, $idStudenteLoggato);
        return $studente->getIsVerified(); // Restituisce true se lo studente è verificato, altrimenti false
    }

}

