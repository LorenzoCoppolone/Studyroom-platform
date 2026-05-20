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



    // Funzione per gestire la registrazione di un nuovo utente ( manca la parte relativa ai token  di conferma email )
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
            $view->mostraFormEmail(); // Mostra la form con scritto "controlla la tua email"
            $studenteRegistrato = $pm->findOneBy(Studente::class, [
                'email' => $datiRegistrazione['email']
            ]); // Recupera lo studente appena registrato per ottenere il suo ID
            $session->setSessionElement('studente',$studenteRegistrato->getId()); // Salva l'ID dello studente nella sessione per eventuali usi futuri

        } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante la registrazione dell'utente: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
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

            // Verifico che lo studente esista
            if ($studente === null) {
                throw new \Exception("Credenziali non corrette.");
            }
            // Verifico la password
            if (!password_verify($datiLogin['password'], $studente->getPassword())) {
                throw new \Exception("Credenziali non corrette.");
            }else {
                $session->setSessionElement('idStudenteLoggato', $studente->getId()); // Login riuscito, salva l'ID dello studente nella sessione
                $view->mostraHomeLoggato(); // Mostra la home page per l'utente loggato, vediamo come implementarla.
            }
        } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante il login dell'utente: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
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
                throw new \Exception("Token non valido.");
            }
            if (time() > $studente->getValidazioneToken()) {
                throw new \Exception("Il token è scaduto.");
            }
            $studente->setToken(null); // Rimuovi il token dallo studente
            $studente->setValidazioneToken(null); // Rimuovi la scadenza del token
            $pm->update($studente); // Salva le modifiche al database
            $view->mostraFormConvalidaEmail(); // Mostra la form di conferma che l'email è stata verificata con successo

        } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante la verifica dell'email: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }
    // Funzione per visualizzare il profilo dello studente ( manca la parte relativa alla gestione della sessione e al recupero dei dati dello studente loggato )
    public function profiloStudente() : void {

        try{

        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('idStudenteLoggato');
        // Istanzio la view
        $view =  new viewUser();

        // Ottengo l'istanza del PersistentManager
        $pm = PersistentManager::getInstance();

        // Recupero il bottone premuto dalla view
        $bottone = strtolower($view->getBottoneCliccato());
        
        //ANDRANNO RECUPERATI ANCHE OFFSET E LIMITE SE VENGONO GESTITI SERVER SIDE?
        
        // recupero ciò che mi serve per la view, a seconda del bottone premuto
         if($bottone === "modifica"){

            // Manca implementazione

        }elseif($bottone === "recensioni"){

            $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, 0, 10);

            // Mostra le recensioni
            $view->mostraRecensioniStudente($recensioni);

        }elseif($bottone === "preferiti"){

            $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, 0, 10);

            // Mostra i preferiti
            $view->mostraPreferitiStudente($preferiti);

        }elseif($bottone === "download"){

            $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, 0, 10);

            // Mostra i download
            $view->mostraDownloadStudente($download);

        }elseif($bottone === "materiale"){
            $materiale = $pm->MaterialiPopolariUtente($idStudenteLoggato, 0, 10);

            // Mostra i materiali dello studente ordinandoli dal piu' popolare
            $view->mostraMaterialiStudente($materiale);
        }

    } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }

    }


    private function inviaEmailVerifica(studente $studente, string $token) {
       
        try {
            $mail = require __DIR__ . '/../config/mailer-bootstrap.php'; // Carica PHPMailer 
            $studenteEmail = $studente->getEmail();
            $mail->addAddress($studenteEmail); // Aggiungi il destinatario
            $mail->Subject = 'Conferma la tua registrazione a StudyRoom';
            $mail->Body    = "Ciao {$studente->getNome()},\n\nPer confermare la tua registrazione a StudyRoom, clicca sul link seguente:\n\n" .
                              "http://localhost/Studyroom-platform/confirm_email.php?token={$token}\n\n" .
                              "Il link sarà valido per 10 minuti.\n\nGrazie!";
            $mail->send();
        } catch (Exception $e) {
            // Log dell'errore o gestione dell'errore di invio email
            error_log("Errore nell'invio dell'email di verifica: {$mail->ErrorInfo}");
        }
    }

}

