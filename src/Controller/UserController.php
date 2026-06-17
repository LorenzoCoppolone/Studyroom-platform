<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use UI\ViewUser;
use Model\Studente;
use Model\Amministratore;
use Model\File;
use Model\Recensione;
use Controller\AdminController;
use UI\ViewAdmin;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class UserController {

    public function __construct() {
        // Costruttore vuoto – previsto per eventuali inizializzazioni future
    }

    /**
     * Limita la frequenza di un'azione sensibile (login, recupero password)
     * per la sessione corrente, contro brute force e abuso.
     * @param string $chiave Identificatore dell'azione in sessione.
     * @param int $maxTentativi Numero massimo di tentativi nella finestra.
     * @param int $finestraSecondi Durata della finestra temporale in secondi.
     * @throws Exception Se il numero di tentativi consentiti è superato.
     */
    private function applicaRateLimit(string $chiave, int $maxTentativi, int $finestraSecondi): void {
        Session::getInstance(); // assicura che la sessione sia avviata
        $ora = time();
        $tentativi = Session::getSessionElement($chiave) ?? [];
        // Mantieni solo i tentativi ancora dentro la finestra temporale.
        $tentativi = array_values(array_filter($tentativi, fn($t) => ($ora - $t) < $finestraSecondi));
        if (count($tentativi) >= $maxTentativi) {
            throw new Exception("Troppi tentativi. Riprova più tardi.");
        }
        $tentativi[] = $ora;
        Session::setSessionElement($chiave, $tentativi);
    }

    /**
     * Mostra la form di login.
     */
    public function login() : void {
        $view = new ViewUser();
        $view->mostraFormLogin();
    }

    /**
     * Mostra la form di registrazione.
     */
    public function registrazione() : void {
        $view = new ViewUser();
        $view->mostraFormRegistrazione();
    }

    /**
     * Mostra la form per il recupero password.
     */
    public function recuperoPassword() : void {
        $view = new ViewUser();
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
    $view = new ViewUser();
    try {
        $pm = PersistentManager::getInstance();
        $d = $view->getDatiRegistrazione();
        $studenteRegistrato = $pm->findoneby(Studente::class, ['email' => $d['email']]);
        if($studenteRegistrato !== null && $studenteRegistrato->getIsVerified() === false){
            $token = bin2hex(random_bytes(32));
            $studenteRegistrato->setValidationToken($token);
            $studenteRegistrato->setValidationTokenTime((new \DateTime('now', new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M')));
            $pm->update($studenteRegistrato);
            $view->mostraVerificaEmail($studenteRegistrato->getEmail());
            ob_flush();
            flush();
            $this->inviaEmailVerifica($studenteRegistrato, $token);
            return;
        }
        if (empty($d['nome']) || empty($d['cognome']) || empty($d['username']) || empty($d['email']) || empty($d['password'])) {
            throw new \Exception("Tutti i campi sono obbligatori.");
        }
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@student\.univaq\.it$/', $d['email']) && !preg_match('/^[a-zA-Z0-9._%+-]+@univaq\.it$/', $d['email'])) {
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
        // Nessuna sessione qui: l'utente deve prima verificare l'email e poi
        // effettuare il login. Impostare 'studente' ora aggirerebbe la verifica.

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
        $view = new ViewUser();
        try {
            $session = Session::getInstance();            $this->applicaRateLimit('rl_login', 5, 300); // max 5 tentativi / 5 minuti
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
                session_regenerate_id(true); // previene la session fixation
                $session->setSessionElement('admin', $admin->getId());
                $view->redirectAdmin();
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
            session_regenerate_id(true); // previene la session fixation
            $this->rememberMe($datiLogin['email'], $datiLogin['remember']);
            $session->setSessionElement('studente', $studente->getId());
            $view->redirectHome();
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
        $view = new ViewUser();
        $idStudente = $session->getSessionElement('studente');
        if ($idStudente !== null){
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudente);
            if ($studente !== null && $studente->getRememberToken() !== null) {
                $studente->setRememberToken(null);
                $studente->setRememberTokenTime(null);
                $pm->update();
                setcookie('remember_me', '', time() - 3600, "/", "", $this->richiestaSicura(), true); // Rimuove il cookie
            }
        }
         elseif ($session->getSessionElement('admin') !== null) {
            $session->unsetSessionElement('admin');
            $session->destroySession();
            $view->redirectHome(); // Dopo il logout, mostra la home page non loggata
            exit;
            
        }
        $session->unsetSessionElement('studente');
        $session->destroySession(); // Distrugge la sessione, effettivamente facendo il logout
        $view->redirectHome(); // Dopo il logout, mostra la home page non loggata
    }
    
    /**
     * Verifica l'email tramite token:
     * - controllo validità token
     * - controllo scadenza
     * - attivazione account
     */
    public function verificaEmail(string $token) : void {
        $view = new ViewUser();
        try {
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class, ['validationToken' => $token]); // Cerco lo studente nel DB per token
            if ($studente === null) {
               throw new \Exception("Link di verifica non valido.");
            }
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome')); // Ottieni la data e ora attuale
            if ($studente->getValidationTokenTime() === null || $now > $studente->getValidationTokenTime()) {
                $pm->delete($studente); // Elimina lo studente dal database se il token è scaduto
                throw new \Exception("Link di verifica scaduto.");
            }
            $studente->setValidationToken(null); // Rimuovi il token dallo studente
            $studente->setValidationTokenTime(null); // Rimuovi la scadenza del token
            $studente->setIsVerified(true); // Imposta l'email come verificata
            $pm->update(); // Salva le modifiche al database
            $view->mostraConvalidaEmail();
        } catch (PDOException $e) {
           $view->mostraFormErrore("Errore durante la verifica dell'email: " . $e->getMessage());
        } catch (Exception $e) {
           $view->mostraFormErrore("Errore durante la verifica dell'email: " . $e->getMessage());
        }
    }
 
    public function cercaRecensioniUtente() : void {
        $view = new ViewUser();
        $pm = PersistentManager::getInstance();
        $page = $view->getDatiPaginazione() ?? 1; // Ottieni la pagina corrente
        $arrayPaginazione = $this->paginazione(Recensione::class, $page);
        $offset = $arrayPaginazione['offset'];
        $limit  = $arrayPaginazione['limit'];
        $totPage = $arrayPaginazione['totPage'];
        $session = Session::getInstance(); // Ottieni l'istanza della sessione
        $idStudenteLoggato = $session->getSessionElement('studente');
        $studente = $pm->find(Studente::class, $idStudenteLoggato); // Serve per la navbar (username + foto)
        $username = $studente?->getUsername();
        $base64 = $studente?->getImmagineProfilo()?->getBase64($studente);
        $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, $offset, $limit);
        $view->mostraRecensioniUtente($recensioni, $totPage, $page, $username, $base64);
    }

    /**
     * Mostra il profilo dello studente loggato.
     */
    public function profiloStudente() : void {
        $view = new ViewUser();
        try{
       
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
        $view = new ViewUser();
       try{
        
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
        $view = new ViewUser();
        
        try {
            $session = Session::getInstance();            $pm = PersistentManager::getInstance();

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
            $view = new ViewUser();
            $domain = $view->getDomain();
            $link = $domain . "/User/verificaEmail/" . $token;
            $mail->Body =
              "Ciao {$studente->getNome()},\n\n" .
              "Per confermare la tua registrazione a StudyRoom, clicca sul link seguente:\n\n" .
              $link . "\n\n" .
              "Il link rimane valido per 10 minuti.\n\nGrazie!";
              if(!$mail->send()) throw new Exception("Invio email non riuscito: " . $mail->ErrorInfo);
              return;
        } catch (Exception $e) {
            // La pagina di verifica è già stata inviata all'utente: non esponiamo
            // i dettagli SMTP, ma logghiamo l'errore per la diagnosi lato server.
            error_log("Invio email di verifica fallito: " . ($mail->ErrorInfo ?? $e->getMessage()));
        }
    }

    /**
     * Reinvia l'email di verifica (link "Invia di nuovo" nella pagina di verifica).
     * Rigenera il token e lo invia all'indirizzo passato in query string.
     */
    public function reinviaEmailVerifica(): void {
        $view = new ViewUser();
        try {
            $email = trim($_GET['email'] ?? '');
            if ($email === '') {
                throw new Exception("Email mancante.");
            }
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class, ['email' => $email]);
            // Rigenera e reinvia solo se l'utente esiste e non è già verificato.
            if ($studente !== null && $studente->getIsVerified() === false) {
                $token = bin2hex(random_bytes(32));
                $studente->setValidationToken($token);
                $studente->setValidationTokenTime(
                    (new \DateTime('now', new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M'))
                );
                $pm->update();
                $view->mostraVerificaEmail($email);
                ob_flush();
                flush();
                $this->inviaEmailVerifica($studente, $token);
                return;
            }
            // Non riveliamo se l'email esiste o è già verificata: mostriamo comunque la pagina.
            $view->mostraVerificaEmail($email);
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore durante il reinvio dell'email: " . $e->getMessage());
        }
    }

    /**
     * Gestisce la richiesta di recupero password:
     * - verifica email
     * - genera token
     * - invia email con link di reset
     */
    public function effettuaRecuperoPassword(): void {
        $view = new ViewUser();
        try {            $this->applicaRateLimit('rl_recupero', 3, 3600); // max 3 richieste / ora
            $pm = PersistentManager::getInstance();
            $email = $view->getEmail();
            if (empty($email)) {
                throw new Exception("Inserisci un indirizzo email.");
            }
            $studente = $pm->findOneBy(Studente::class, ['email' => $email]);
            // Non riveliamo se l'email è registrata: inviamo il link solo se
            // l'account esiste, ma mostriamo sempre la stessa pagina di conferma.
            if ($studente !== null) {
                $token = bin2hex(random_bytes(32));
                $studente->setValidationToken($token);
                $scadenzaToken = (new \DateTime('now',new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M'));
                $studente->setValidationTokenTime($scadenzaToken);
                $pm->update();
                $view->mostraVerificaEmail($email);
                ob_flush();
                flush();
                $this->inviaEmailRecuperoPassword($studente, $token);
                return;
            }
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
        $view = new ViewUser();
        $domain = $view->getDomain();
        $link = $domain . "/User/reimpostaPassword/" . $token;
        $nome = $studente->getNome();
        $mail->Body =
            "Ciao {$nome},\n\n" .
            "Hai richiesto il recupero della password.\n\n" .
            "Clicca sul seguente link:\n\n" .
            $link .
            "\n\n" .
            "Il link rimane valido per 10 minuti.\n\n" .
            "Se non hai richiesto tu il recupero password, ignora questa email.\n\n" .
            "Grazie!";
        if (!$mail->send()) {
            throw new Exception("Invio email non riuscito: " . $mail->ErrorInfo);
        }
        return;
    }

    /**
     * Mostra la form per impostare una nuova password tramite token.
     */
    public function reimpostaPassword(string $token): void {
        $view = new ViewUser();
        try {
            
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class,['validationToken' => $token]);
            if ($studente === null) {
                throw new Exception("Link di recupero non valido.");
            }
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome'));
            if ($studente->getValidationTokenTime() === null || $now > $studente->getValidationTokenTime()) {
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
    $view = new ViewUser();
        try {            $pm = PersistentManager::getInstance();
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
            $studente = $pm->findOneBy(Studente::class,['validationToken' => $token]);
            if ($studente === null) {
                throw new Exception("Link non valido.");
            }
            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome'));
            if ($studente->getValidationTokenTime() === null || $now > $studente->getValidationTokenTime()) {
                throw new Exception("Il link è scaduto.");
            }
            $passwordHash = password_hash($pass, PASSWORD_BCRYPT);
            $studente->setPassword($passwordHash);
            $studente->setValidationToken(null);
            $studente->setValidationTokenTime(null);
            $pm->update();
            $view->mostraFormSuccesso("Password reimpostata con successo.");
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore: " . $e->getMessage());
        }
    }

    /**
     * Gestisce l'auto login dell'utente.
     * mediante il token per il remember me
     */
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
        setcookie('remember_me', $token, time() + (60 * 60 * 24 * 30), "/", "", $this->richiestaSicura(), true); // Cookie valido per 30 giorni
        $hashToken = hash('sha256', $token);
        $studente->setRememberToken($hashToken);
        $studente->setRememberTokenTime((new \DateTime('now', new \DateTimeZone('Europe/Rome')))->modify('+30 days'));// Scadenza token in linea con il cookie
        $pm->update();
    }

    /**
     * Gestisce la paginazione.
     * - calcolo offset e limit
     * - calcolo numero di pagine
     * - restituisce un array con offset, limit e totPage
     * @param string $class prende la classe da paginare
     * @param int $page pagina corrente
     * @return array
     */
    private function paginazione(string $class, int $page): array {
        $page = max(1, $page);
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $pm = PersistentManager::getInstance();
        $totale = $pm->countAll($class, []);
        $totPage = ceil($totale / $limit);
        if($totPage > 50) {
            $totPage = 50;
        }
        return [
            'offset' => $offset,
            'limit' => $limit,
            'totPage' => $totPage
        ];
    }
    
    public function reinviaEmail(): void {
        $view = new ViewUser();
        try{
            $email = $view->getEmail();
            $pm = PersistentManager::getInstance();
            $studente = $pm->findOneBy(Studente::class, ['email' => $email]);
            if($studente === null) {
                throw new Exception("utente non trovato.");
            }
            $token = $studente->getValidationToken();
            $timestamp = $studente->getValidationTokenTime()->getTimestamp();
            if(time() > $timestamp && $token != null) {
                $studente->setValidationToken(null);
                $studente->setValidationTokenTime(null);
                $pm->update();
                throw new Exception("Token scaduto.");
            }
            $view->mostraVerificaEmail($email);
            ob_flush();
            flush();
            $this->reinviaEmailGenerica($studente, $token);
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore: " . $e->getMessage());
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore imprevisto");
        }
    }

    public function reinviaEmailGenerica(Studente $studente, string $token): void {
        require __DIR__ . '/../../config/mailer-bootstrap.php';
        $mail->addAddress($studente->getEmail());
        $mail->Subject ='Reinvio mail Studyroom';
        $view = new ViewUser();
        $domain = $view->getDomain();
        if($studente->getIsVerified() === false) {
            $controller = '/User/verificaEmail/';
        } else {
            $controller = '/User/reimpostaPassword/';
        }
        $link = $domain . $controller . $token;
        $nome = $studente->getNome();
        $tempo = $studente->getValidationTokenTime()->getTimestamp() - time();
        $minuti = floor($tempo / 60) > 0 ? floor($tempo / 60) : 1;
        $mail->Body =
            "Ciao {$nome},\n\n" .
            "Hai richiesto il reinvio della mail.\n\n" .
            "Clicca sul seguente link:\n\n" .
            $link .
            "\n\n" .
            "Il link rimane valido per {$minuti} minuti.\n\n" .
            "Se non hai richiesto tu questa email, ignorala.\n\n" .
            "Grazie!";
        if (!$mail->send()) {
            throw new Exception("Invio email non riuscito: " . $mail->ErrorInfo);
        }
    }
}