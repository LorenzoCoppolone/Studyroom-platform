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
        $studente->setToken($token);
        
        $scadenzaToken = (new \DateTime('now', new \DateTimeZone('Europe/Rome')))->add(new \DateInterval('PT10M')); // Token valido per 10 minuti
        
        $studente->setValidazioneToken($scadenzaToken);
        
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
        try {
            $base64 = null; // Inizializza la variabile $base64 ovvero l'immagine di default o null se non c'è un'immagine di profilo
            
            $session = Session::getInstance();
            $view = new viewUser();
            $pm = PersistentManager::getInstance();
            
            $datiLogin = $view->getDatiLogin();
            
            if (empty($datiLogin['email'])) throw new \Exception("L'email è obbligatoria.");
            if (empty($datiLogin['password'])) throw new \Exception("La password è obbligatoria.");
            
            $studente = $pm->findOneBy(Studente::class, ['email' => $datiLogin['email'] ]);
            $admin = $pm->findOneBy(Amministratore::class, ['email' => $datiLogin['email']]);
            
            if ($studente === null && $admin === null) {
                $view->mostraFormErrore("L'email o la password sono errate"); // Mostra di nuovo la form di login
                exit; // Termina l'esecuzione della funzione
            }
            
            // login Admin
            if($admin !== null && password_verify($datiLogin['password'], $admin->getPassword())){
                $session->setSessionElement('admin', $admin->getId());
                $viewAdmin = new viewAdmin();
                $viewAdmin->mostraDashboardAdmin($pm->trovaSegnalazioniAdmin(0,10));
                exit;
            }
            
            // Controlli studente
            if(!$studente->getIsVerified()) {
                $view->mostraFormErrore("L'email non è stata verificata, controlla la tua email o riprova a registrarti"); // Mostra di nuovo la form di login
                exit;
            }
            elseif($studente->getIsBanned()) {
                $view->mostraFormErrore("Il tuo account è stato bannato, contatta l'assistenza per maggiori informazioni"); // Mostra di nuovo la form di login
                exit;
            }
            
            if (!password_verify($datiLogin['password'], $studente->getPassword())) {
                throw new \Exception("Credenziali non corrette."); // Lancia un'ecezione per indicare che le credenziali non sono corrette
                exit;
            }
            else {
                $session->setSessionElement('studente', $studente->getId());
                $base64 = $studente->getImmagineProfilo()->getBase64($studente);
            }
            
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
            
            $studente = $pm->findOneBy(Studente::class, ['token' => $token]); // Cerco lo studente nel DB per token

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
            
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
            
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
    public function inviaEmailVerifica(studente $studente, string $token) {
        try {
            require __DIR__ . '/../../config/mailer-bootstrap.php';
            
            $mail->addAddress($studente->getEmail()); 
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
        try {
            $view = new viewUser();
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
                $view->mostraFormErrore(
                    "Nessun account associato a questa email.");
                return;
            }

            $token = bin2hex(random_bytes(32));
            $studente->setToken($token);

            $scadenzaToken = (new \DateTime('now',new \DateTimeZone('Europe/Rome')))
                                ->add(new \DateInterval('PT10M'));

            $studente->setValidazioneToken($scadenzaToken);

            $pm->update($studente);

            $view->mostraVerificaEmail($email);

            ob_flush();
            flush();

            $this->inviaEmailRecuperoPassword($studente, $token);

        } catch (Exception $e) {
            $view = new viewUser();
            $view->mostraFormErrore("Errore durante il recupero password: " . $e->getMessage());
        }
    }

    /**
     * Invia email con link per reimpostare la password.
     */
    public function inviaEmailRecuperoPassword(Studente $studente, string $token): void {
        try {
            require __DIR__ . '/../../config/mailer-bootstrap.php';

            $mail->addAddress($studente->getEmail());
            $mail->Subject ='Recupero password StudyRoom';

            $link ="https://Studyroom-platform.test/User/reimpostaPassword/" . $token;

            $mail->Body =
                "Ciao {$studente->getNome()},\n\n" .
                "Hai richiesto il recupero della password.\n\n" .
                "Clicca sul seguente link:\n\n" .
                $link .
                "\n\n" .
                "Il link sarà valido per 10 minuti.";

            $mail->send();

        } catch (Exception $e) {
            echo "Errore nell'invio email: " . $mail->ErrorInfo;
        }
    }

    /**
     * Mostra la form per impostare una nuova password tramite token.
     */
    public function reimpostaPassword(string $token): void {
        try {
            $view = new viewUser();
            $pm = PersistentManager::getInstance();

            $studente = $pm->findOneBy(Studente::class,['token' => $token]);

            if ($studente === null) {
                $view->mostraFormErrore( "Link di recupero non valido.");
                return;
            }

            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome'));

            if ($studente->getValidazioneToken() === null || $now > $studente->getValidazioneToken()) {
                $view->mostraFormErrore("Il link di recupero è scaduto.");
                return;
            }   

            $view->mostraFormReimpostaPassword($token);

        } catch (Exception $e) {
            $view = new viewUser();
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

            $studente = $pm->findOneBy(Studente::class,['token' => $token]);

            if ($studente === null) {
                throw new Exception("Link non valido.");
            }

            $now = new \DateTime('now', new \DateTimeZone('Europe/Rome'));

            if ($studente->getValidazioneToken() === null || $now > $studente->getValidazioneToken()) {
                throw new Exception("Il link è scaduto.");
            }

            $passwordHash = password_hash($pass, PASSWORD_BCRYPT);
            $studente->setPassword($passwordHash);

            $studente->setToken(null);
            $studente->setValidazioneToken(null);

            $pm->update($studente);

            $view->mostraFormLogin();

        } catch (Exception $e) {
            $view->mostraFormReimpostaPassword($d['token'] ?? '', $e->getMessage());
        }
    }
}