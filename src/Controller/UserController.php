<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
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
    
    /**
     * Funzione per gestire la registrazione di un nuovo studente,
     *  con validazione dei dati inseriti, controllo dell'unicità dell'email, hashing della password
     * e salvataggio dello studente nel database,
     * e invio dell'email di verifica
      * @return void
     */
    public function registrazioneStudente(){
    try {
        $session = Session::getInstance();
        $view = new viewUser();
        $pm = PersistentManager::getInstance();
        $d = $view->getDatiRegistrazione();
        if (empty($d['nome']) || empty($d['cognome']) || empty($d['username']) || empty($d['email']) || empty($d['password'])) {
            throw new \Exception("Tutti i campi sono obbligatori.");
        }
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@student\.univaq\.it$/', $d['email'])) {
            throw new \Exception("Devi usare la tua email universitaria.");
        }
        if (!empty($pm->findOneBy(Studente::class, ['email' => $d['email']]))) {
            throw new \Exception("Email già registrata.");
        }elseif (!empty($pm->findOneBy(Studente::class, ['username' => $d['username']]))) {
            throw new \Exception("Username già registrato.");
        }
        $passwordHash = password_hash($d['password'], PASSWORD_DEFAULT);
        $studente = new Studente( $d['nome'], $d['cognome'], $d['email'], $passwordHash, $d['username']);
        $token = bin2hex(random_bytes(32));
        $studente->setToken($token);
        $scadenzaToken = (new \DateTime('now', new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M')); // Token valido per 10 minuti
        $studente->setValidazioneToken($scadenzaToken);
        $pm->save($studente);
        $view->mostraVerificaEmail($studente->getEmail());
        if(function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request(); // Termina la risposta HTTP per l'utente, ma continua a eseguire il codice PHP
        }
        $this->inviaEmailVerifica($studente, $token);
        $session->setSessionElement('studente', $studente->getId());
    } catch (\Exception $e) {
        $view->mostraFormErrore("Errore durante la registrazione: " . $e->getMessage());
    }
    }




    /**
     * Funzione per gestire il login di uno studente,
     *  con validazione dei dati inseriti,
     *  controllo dell'esistenza dello studente,
     *  verifica della password e gestione della sessione
     * @return void
     */
    public function loginUtente() {
        try {
            $base64 = null; // Inizializza la variabile $base64 ovvero l'immagine di default o null se non c'è un'immagine di profilo
            $session = Session::getInstance();
            $view = new viewUser();
            $datiLogin = $view->getDatiLogin();
            $pm = PersistentManager::getInstance();
            if (empty($datiLogin['email'])) throw new \Exception("L'email è obbligatoria.");
            if (empty($datiLogin['password'])) throw new \Exception("La password è obbligatoria.");
            $studente = $pm->findOneBy(Studente::class, ['email' => $datiLogin['email'] ]);
            $admin = $pm->findOneBy(Amministratore::class, ['email' => $datiLogin['email']]);
            if ($studente === null && $admin === null) {
                $view->mostraFormLogin(); // Mostra di nuovo la form di login
                throw new \Exception("Credenziali non corrette."); // Lancia un'ecezione per indicare che le credenziali non sono corrette
                return; // Termina l'esecuzione della funzione
            }
            if($admin !== null && password_verify($datiLogin['password'], $admin->getPassword())){
                $session->setSessionElement('admin', $admin->getId());
                $viewAdmin = new viewAdmin();
                $viewAdmin->mostraDashboardAdmin($pm->trovaSegnalazioniAdmin(0,10));
                return;
            }
            if(!$studente->getIsVerified()) {
                $view->mostraFormErrore("L'email non è stata verificata, controlla la tua email o riprova a registrarti"); // Mostra di nuovo la form di login
                return; // Termina l'esecuzione della funzione
            }elseif($studente->getIsBanned()) {
                $view->mostraFormErrore("Il tuo account è stato bannato, contatta l'assistenza per maggiori informazioni"); // Mostra di nuovo la form di login
                return; // Termina l'esecuzione della funzione
            }
            if (!password_verify($datiLogin['password'], $studente->getPassword())) {
                throw new \Exception("Credenziali non corrette."); // Lancia un'ecezione per indicare che le credenziali non sono corrette
                return; // Termina l'esecuzione della funzione
            }else {
                $session->setSessionElement('studente', $studente->getId());
                $file = $studente->getImmagineProfilo();
            }
            if ($file && $file->getContenutoFile() !== null) {
                $contenuto = $file->getContenutoFile();
            if (is_resource($contenuto)) {
                $contenuto = stream_get_contents($contenuto);
                $base64 = 'data:' . $file->getMimeTypeFile() . ';base64,' . base64_encode($contenuto);
            }
            }
            $view->mostraHome($studente->getUsername(), $base64);
        }        
        catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante il login dell'utente: ");
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante il login dell'utente: ");
        }
    }

    public function logoutStudente() : void {
        $session = Session::getInstance();
        $session->unsetSessionElement();
        $session->destroySession(); // Distrugge la sessione, effettivamente facendo il logout
        $view = new viewUser();
        $view->mostraHome(); // Dopo il logout, mostra la home page non loggata
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
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome')); // Ottieni la data e ora attuale

            if ($now > $studente->getValidazioneToken() || $studente->getToken() === null) {
                $pm->delete($studente); // Elimina lo studente dal database se il token è scaduto
                $view->mostraFormTokenScaduto(); // Mostra la form che informa l'utente che il token è scaduto
                return; // Termina l'esecuzione della funzione
            }

            $studente->setToken(null); // Rimuovi il token dallo studente
            $studente->setValidazioneToken(null); // Rimuovi la scadenza del token
            $studente->setIsVerified(true); // Imposta l'email come verificata
            $pm->update($studente); // Salva le modifiche al database
            $view->mostraConvalidaEmail(); // Mostra la form di conferma che l'email è stata verificata con successo

        } catch (PDOException $e) {
           $view->mostraFormErorre("Errore durante la verifica dell'email: " . $e->getMessage());
        
        } catch (Exception $e) {
            $view->mostraFormErorre("Errore durante la verifica dell'email: " . $e->getMessage());
        }
    }

    public function cercaRecensioniUtente() : void {
        $view = new viewUser();
        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $page = max(1, $page); // Assicurati che la pagina sia almeno 1
        $limit = 10; // Numero di elementi per pagina
        $offset = $this->paginazione($page, $limit); // Calcola l'offset per la query
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, $offset, $limit);
        $numeroRecensioni = $pm->count(Recensione::class, ['Studente' => $idStudenteLoggato]);
        $pagineTotali = ceil($numeroRecensioni / $limit);
        $view->mostraRecensioniUtente($recensioni, $pagineTotali, $page);
    }

    /**
     * Funzione per mostrare il profilo dell'utente, 
     * con le sue recensioni, preferiti, download e materiale caricato, 
     * con paginazione
     */
    public function profiloStudente() : void {
        try{
        $view = new viewUser();
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $pm = PersistentManager::getInstance();
        $studente = $pm->findOneById(Studente::class, $idStudenteLoggato);
        $view->mostraModificaProfilo($studente->getNome(), 
        $studente->getCognome(), 
        $studente->getEmail(), 
        $studente->getUsername(), 
        $studente->getImmagineProfilo()?? null);
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la visualizzazione del profilo: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante la visualizzazione del profilo: " . $e->getMessage());
        }
    }

    public function modificaProfiloStudente() : void {
        $view = new viewUser();
        $modifiche = $view->getDatiModifiche(); // Ottieni i dati delle modifiche da apportare al profilo, se presenti
         try {
            $pm = PersistentManager::getInstance();
            $session = Session::getInstance();
            $idStudenteLoggato = $session->getSessionElement('studente');
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
            $view->mostraFormSuccessoProfilo();
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante la modifica del profilo: " . $e->getMessage());
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la modifica del profilo: " . $e->getMessage());
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
            require __DIR__ . '/../../config/mailer-bootstrap.php';
            $studenteEmail = $studente->getEmail();
            $mail->addAddress($studenteEmail); // Aggiungi il destinatario
            $mail->Subject = 'Conferma la tua registrazione a StudyRoom';
            $mail->Body    = "Ciao {$studente->getNome()},\n\nPer confermare la tua registrazione a StudyRoom, clicca sul link seguente:\n\n" .
                              "http://localhost/Studyroom-platform/verificaEmail.php?token=".$token."\n\n" .
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
    public function isLogged() : bool {
        $session = Session::getInstance();
        return $session->getSessionElement('studente') !== null;
    }
}