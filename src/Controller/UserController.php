<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\viewUser;
use Model\Studente;
use Model\Amministratore;
use Model\File;
use UI\viewAdmin;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class UserController {

    public function __construct() {
        // Costruttore vuoto – previsto per eventuali inizializzazioni future
    }

    /**
     * Mostra la form di login.
     */
    public function login() : void {
        $view = new viewUser();
        $view->mostraFormLogin();
    }

    /**
     * Mostra la form di registrazione.
     */
    public function registrazione() : void {
        $view = new viewUser();
        $view->mostraFormRegistrazione();
    }

    /**
     * Mostra la form per il recupero password.
     */
    public function recuperoPassword() : void {
        $view = new viewUser();
        $view->mostraFormRecuperoPassword();
    }
    
    /**
     * Gestisce la registrazione di un nuovo studente:
     * - validazione dati
     * - controllo unicità email/username
     * - hashing password
     * - generazione token verifica email
     * - salvataggio nel DB
     * - invio email di conferma
     */
    public function effettuaRegistrazione(){
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
        }    
        elseif (!empty($pm->findOneBy(Studente::class, ['username' => $d['username']]))) {
            throw new \Exception("Username già registrato.");
        }
        $passwordHash = password_hash($d['password'], PASSWORD_BCRYPT);
        $studente = new Studente( $d['nome'], $d['cognome'], $d['email'], $passwordHash, $d['username']);
        $token = bin2hex(random_bytes(32));
        $studente->setValidationToken($token);
        $scadenzaToken = (new \DateTime('now', new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M')); // Token valido per 10 minuti
        $studente->setValidationTokenTime($scadenzaToken);
        $pm->save($studente);
        $view->mostraVerificaEmail($studente->getEmail());
        ob_flush();
        flush();
        $this->inviaEmailVerifica($studente, $token);
        $session->setSessionElement('studente', $studente->getId());
    } catch (\Exception $e) {
        $view->mostraFormErrore("Errore durante la registrazione: " . $e->getMessage());
    }
}

    /**
     * Gestisce il login di studente o amministratore:
     * - validazione input
     * - verifica credenziali
     * - controllo stato account
     * - gestione sessione
     */
    public function effettuaLogin() {
        $view = new viewUser();
        try {
            $session = Session::getInstance();
            $pm = PersistentManager::getInstance();
            $datiLogin = $view->getDatiLogin();
            if (empty($datiLogin['email'])) throw new \Exception("L'email è obbligatoria.");
            if (empty($datiLogin['password'])) throw new \Exception("La password è obbligatoria.");
            $studente = $pm->findOneBy(Studente::class, ['email' => $datiLogin['email'] ]);
            $admin = $pm->findOneBy(Amministratore::class, ['email' => $datiLogin['email']]);
            if ($studente === null && $admin === null) {
                throw new \Exception("Credenziali non corrette."); // Lancia un'eccezione per indicare che le credenziali non sono corrette
            }
            // login Admin
            if ($admin !== null) {
                if (!password_verify($datiLogin['password'], $admin->getPassword())) {
                    throw new \Exception("Credenziali non corrette.");
                }
                $session->setSessionElement('admin', $admin->getId());
                $viewAdmin = new viewAdmin();
                $viewAdmin->mostraDashboardAdmin($pm->trovaSegnalazioniAdmin(0,10));
                return; // Login admin completato: non proseguire con i controlli dello studente
            }
            // login Studente
            if (!password_verify($datiLogin['password'], $studente->getPassword())) {
                throw new \Exception("Credenziali non corrette."); // Lancia un'ecezione per indicare che le credenziali non sono corrette
            }
            if (!$studente->getIsVerified()) {
                throw new \Exception("Devi verificare la tua email prima di accedere."); // Lancia un'ecezione per indicare che l'email non è verificata
            }
            if ($studente->getIsBanned()) {
                throw new \Exception("Il tuo account è stato sospeso, contatta l'amministratore per maggiori informazioni."); // Lancia un'ecezione per indicare che l'account è sospeso
            }
            $this->rememberMe($datiLogin['email'], $datiLogin['remember']);
            $session->setSessionElement('studente', $studente->getId());
            $base64 = $studente->getImmagineProfilo() ? $studente->getImmagineProfilo()->getBase64($studente) : null;
            $view->mostraHome($studente->getUsername(), $base64);
        }
        catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante il login dell'utente: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante il login dell'utente: " . $e->getMessage());
        }
    }

    /**
     * Esegue il logout dell'utente e distrugge la sessione.
     */
    public function logout() : void {
        $session = Session::getInstance();
        $idStudente = $session->getSessionElement('studente');
        if ($idStudente !== null){
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudente);
            if ($studente !== null && $studente->getRememberToken() !== null) {
                $studente->setRememberToken(null);
                $studente->setRememberTokenTime(null);
                $pm->update($studente);
                setcookie('remember_me', '', time() - 3600, "/", "", true, true); // Rimuove il cookie
            }
        }
         elseif ($session->getSessionElement('admin') !== null) {
            $session->unsetSessionElement('admin');
            $session->destroySession();
        }
        $session->unsetSessionElement('studente');
        $session->destroySession(); // Distrugge la sessione, effettivamente facendo il logout
        $view = new viewUser();
        $view->mostraHome(null, null); // Dopo il logout, mostra la home page non loggata
    }
    
    /**
     * Verifica l'email tramite token:
     * - controllo validità token
     * - controllo scadenza
     * - attivazione account
     */
    public function verificaEmail(string $token) : void {
        try {
            $view = new viewUser();
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class, ['validationToken' => $token]); // Cerco lo studente nel DB per token
            if ($studente === null) {
                $view->mostraFormTokenNonValido(); // Mostra la form che informa l'utente che il token non è valido
                return; // Termina l'esecuzione della funzione
            }
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome')); // Ottieni la data e ora attuale
            if ($studente->getValidationTokenTime() === null || $now > $studente->getValidationTokenTime()) {
                $pm->delete($studente); // Elimina lo studente dal database se il token è scaduto
                $view->mostraFormTokenScaduto(); // Mostra la form che informa l'utente che il token è scaduto
                return; // Termina l'esecuzione della funzione
            }
            $studente->setValidationToken(null); // Rimuovi il token dallo studente
            $studente->setValidationTokenTime(null); // Rimuovi la scadenza del token
            $studente->setIsVerified(true); // Imposta l'email come verificata
            $pm->update($studente); // Salva le modifiche al database
        } catch (PDOException $e) {
           $view->mostraFormErorre("Errore durante la verifica dell'email: " . $e->getMessage());
        }
    }
 
    public function cercaRecensioniUtente() : void {
        $view = new viewUser();
        $pm = PersistentManager::getInstance();

        $page = $view->getDatiPaginazione(); // Ottieni la pagina corrente
        $page = max(1, $page); // Assicurati che la pagina sia almeno 1
        $limit = 10; // Numero di elementi per pagina
        $offset = $this->paginazione($page, $limit); // Calcola l'offset per la query
        
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        
        $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, $offset, $limit);
        $numeroRecensioni = $pm->count(Recensione::class, ['Studente' => $idStudenteLoggato]);
        $pagineTotali = ceil($numeroRecensioni / $limit);
        
        $view->mostraRecensioniUtente($recensioni, $pagineTotali, $page);
    }

    /**
     * Mostra il profilo dello studente loggato.
     */
    public function profiloStudente() : void {
        try{
        $view = new viewUser();
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $pm = PersistentManager::getInstance();
        
        $idStudenteLoggato = $session->getSessionElement('studente');  
        $studente = $pm->find(Studente::class, $idStudenteLoggato); // Trova lo studente loggato
        
        $view->mostraProfiloStudente([
            'nome' => $studente->getNome(),
            'cognome' => $studente->getCognome(),
            'email' => $studente->getEmail(),
            'username' => $studente->getUsername(),
            'foto' => $studente->getImmagineProfilo()->getBase64($studente)
        ]); // Mostra il profilo dello studente con i suoi dati,
        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la visualizzazione del profilo: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante la visualizzazione del profilo: " . $e->getMessage());
        }
    }

    /**
     * Mostra la form per modificare il profilo dello studente.
     */
    public function modificaProfiloStudente() : void {
       try{
        $view = new viewUser();
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $pm = PersistentManager::getInstance();
        
        $idStudenteLoggato = $session->getSessionElement('studente');
        $studente = $pm->find(Studente::class, $idStudenteLoggato); // Trova lo studente loggato
        
        $view->mostraModificaProfilo([
            "nome" => $studente->getNome(),
            "cognome" => $studente->getCognome(),
            "username" => $studente->getUsername(),
            "foto" => $studente->getImmagineProfilo()->getBase64($studente)
        ]);

        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante la modifica del profilo: " . $e->getMessage());
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la modifica del profilo: " . $e->getMessage());
        }
    }

    /**
     * Aggiorna i dati del profilo studente:
     * - nome, cognome, username
     * - immagine profilo (se caricata)
     */
    public function aggiornaProfiloStudente() : void {
        $view = new viewUser();
        
        try {
            $session = Session::getInstance();
            $pm = PersistentManager::getInstance();

            $id = $session->getSessionElement('studente');

            if ($id === null) {
                $view->mostraFormErrore("Devi effettuare l'accesso per modificare il profilo.");
                return;
            }
            
            $studente = $pm->find(Studente::class, $id);
            
            if ($studente === null) {
                $view->mostraFormErrore("Utente non trovato.");
                exit;
            }
            
            $dati = $view->getDatiModificaProfilo();
            
            // Aggiorna i campi testuali solo se valorizzati, altrimenti mantieni quelli attuali
            if (!empty($dati['nome']))     { $studente->setNome($dati['nome']); }
            if (!empty($dati['cognome']))  { $studente->setCognome($dati['cognome']); }
            if (!empty($dati['username'])) { $studente->setUsername($dati['username']); }
            
            // Aggiorna la foto profilo solo se è stato caricato un nuovo file senza errori
            $immagine = $dati['immagine'];
            
            if (!empty($immagine[1]) && (int)$immagine[2] === UPLOAD_ERR_OK) {
                $contenuto   = file_get_contents($immagine[1]);
                $dimensione  = (float)($immagine[3] / (1024 * 1024)); // dimensione in MB
                $mimeType    = $immagine[4];
                
                $studente->setImmagineProfilo(new File($contenuto, $mimeType, $dimensione));
            }
            
            $pm->update($studente);
            
            $view->mostraFormSuccesso("Profilo aggiornato con successo.");
        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante l'aggiornamento del profilo: " . $e->getMessage());
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante l'aggiornamento del profilo: " . $e->getMessage());
        }
    }
    
    /**
     * Invia email di verifica registrazione.
     */
    public function inviaEmailVerifica(studente $studente, string $token): void {
        try {
            require __DIR__ . '/../../config/mailer-bootstrap.php';
            $mail->addAddress ($studente->getEmail());
            $mail->Subject = 'Conferma la tua registrazione a StudyRoom';
            $link = "https://Studyroom-platform.test/User/verificaEmail/" . $token;
            $mail->Body =
              "Ciao {$studente->getNome()},\n\n" .
              "Per confermare la tua registrazione a StudyRoom, clicca sul link seguente:\n\n" .
              $link . "\n\n" .
              "Il link sarà valido per 10 minuti.\n\nGrazie!";
              $mail->send();
        } catch (Exception $e) {
            echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
        }
    }

    /**
     * Gestisce la richiesta di recupero password:
     * - verifica email
     * - genera token
     * - invia email con link di reset
     */
    public function effettuaRecuperoPassword(): void {
        $view = new viewUser();
        try {
            $pm = PersistentManager::getInstance();
            $email = $view->getEmailRecuperoPassword();
            if (empty($email)) {
                throw new Exception("Inserisci un indirizzo email.");
            }
            $studente = $pm->findOneBy(
                Studente::class,
            [   'email' => $email]
            );
            if ($studente === null) {
               throw new Exception("Nessun account trovato con questa email.");
            }
            $token = bin2hex(random_bytes(32));
            $studente->setResetToken($token);
            $scadenzaToken = (new \DateTime('now',new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M'));
            $studente->setResetTokenTime($scadenzaToken);
            $pm->update();
            // Invio l'email PRIMA di confermare all'utente: se fallisce
            // l'eccezione viene propagata e l'utente vede un errore reale.
            $this->inviaEmailRecuperoPassword($studente, $token);
            $view->mostraVerificaEmail($email);
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante il recupero password: " . $e->getMessage());
        }
    }

    /**
     * Invia email con link per reimpostare la password.
     * In caso di fallimento dell'invio lancia un'eccezione, così il chiamante
     * può mostrare un errore invece di confermare un'operazione non riuscita.
     */
    public function inviaEmailRecuperoPassword(Studente $studente, string $token): void {
        require __DIR__ . '/../../config/mailer-bootstrap.php';
        $mail->addAddress($studente->getEmail());
        $mail->Subject ='Recupero password StudyRoom';
        $link ="https://Studyroom-platform.test/User/reimpostaPassword/" . $token;
        $nome = $studente->getNome();
        $mail->Body =
            "Ciao {$nome},\n\n" .
            "Hai richiesto il recupero della password.\n\n" .
            "Clicca sul seguente link:\n\n" .
            $link .
            "\n\n" .
            "Il link è valido per 10 minuti.\n\n" .
            "Se non hai richiesto tu il recupero password, ignora questa email.\n\n" .
            "Grazie!";
        if (!$mail->send()) {
            throw new Exception("Invio email non riuscito: " . $mail->ErrorInfo);
        }
    }

    /**
     * Mostra la form per impostare una nuova password tramite token.
     */
    public function reimpostaPassword(string $token): void {
        try {
            $view = new viewUser();
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class,['resetToken' => $token]);
            if ($studente === null) {
                throw new Exception("Link di recupero non valido.");
            }
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome'));
            if ($studente->getResetTokenTime() === null || $now > $studente->getResetTokenTime()) {
                throw new Exception("Il link di recupero è scaduto.");
            }
            $view->mostraFormReimpostaPassword($token);
        }catch (Exception $e) {
            $view->mostraFormErrore("Errore: " . $e->getMessage());
         }
    }

    /**
     * Salva la nuova password:
     * - validazione input
     * - verifica token
     * - aggiornamento password
     * - invalidazione token
     */
    public function salvaNuovaPassword(): void{
    $view = new viewUser();
        try {
            $pm = PersistentManager::getInstance();
            $d = $view->getDatiNuovaPassword();
            $token   = $d['token'];
            $pass    = $d['password'];
            $confirm = $d['confirm'];
            if (empty($token)) {
                throw new Exception("Token mancante.");
            }
            if (empty($pass) || empty($confirm)) {
                throw new Exception("Compila tutti i campi.");
            }
            if ($pass !== $confirm) {
                throw new Exception("Le password non coincidono.");
            }
            if (strlen($pass) < 8) {
                throw new Exception("La password deve contenere almeno 8 caratteri.");
            }
            $studente = $pm->findOneBy(Studente::class,['resetToken' => $token]);
            if ($studente === null) {
                throw new Exception("Link non valido.");
            }
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome'));
            if ($studente->getResetTokenTime() === null || $now > $studente->getResetTokenTime()) {
                throw new Exception("Il link è scaduto.");
            }
            $passwordHash = password_hash($pass, PASSWORD_BCRYPT);
            $studente->setPassword($passwordHash);
            $studente->setResetToken(null);
            $studente->setResetTokenTime(null);
            $pm->update();
            $view->mostraFormSuccesso("Password reimpostata con successo.");
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore: " . $e->getMessage());
        }
    }

    private function rememberMe(string $email, ?bool $remember): void {
        if($remember !== true) {
            return; // L'utente non ha selezionato "Remember Me", quindi non facciamo nulla
        }
        $pm = PersistentManager::getInstance();
        $studente = $pm->findOneBy(Studente::class, ['email' => $email]);
        if ($studente === null) {
            return;
        }
        $token = bin2hex(random_bytes(32));
        setcookie('remember_me', $token, time() + (60 * 60 * 24 * 30), "/", "", true, true); // Cookie valido per 30 giorni
        $hashToken = hash('sha256', $token);
        $studente->setRememberToken($hashToken);
        $studente->setRememberTokenTime((new \DateTime('now', new \DateTimeZone('Europe/Rome')))->modify('+30 days'));// Scadenza token in linea con il cookie
        $pm->update($studente);
    }
}