<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;
use Exception;

class viewUser {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /** -------------------------------------------------------------
     *  SEZIONE — PAGINE PRINCIPALI (Home, Login, Registrazione)
     * --------------------------------------------------------------*/

    /**
     * Mostra la home page, con o senza utente loggato.
     *
     * @param string|null $studente Username dello studente loggato
     * @param string|null $base64   Immagine profilo codificata in base64
     * @return void
     */
    public function mostraHome(?string $studente, ?string $base64) : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign("studente", $studente);
        $this->smarty->assign("base64", $base64);
        $this->smarty->display("layout/home.tpl");
    }

    /**
     * Mostra la form di registrazione.
     * @return void
     */ 
    public function mostraFormRegistrazione () { 
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->display("auth/registrationForm.tpl");
    }

    /**
     * Mostra la form di login.
     * 
     * @return void
     */
    public function mostraFormLogin () {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->display("auth/loginForm.tpl");
    }

    /** -------------------------------------------------------------
     *  SEZIONE — RECUPERO PASSWORD
     * --------------------------------------------------------------*/
    
    /**
     * Mostra la form per inserire l'email nel recupero password.
     * 
     * @return void
     */
    public function mostraFormRecuperoPassword() {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->display("auth/recuperoPassword.tpl");
    }

    /**
     * Restituisce l'email inserita nella form di recupero password.
     * 
     * @return string
     */
    public function getEmailRecuperoPassword(): string {
        $dati = array_merge($_POST, $_GET);
        return trim($dati['email'] ?? '');
    }

    /**
     * Mostra la form per reimpostare la password tramite token.
     *
     * @param string $token Token di recupero valido
     * @return void
     */
    public function mostraFormReimpostaPassword(string $token): void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign("token", $token);
        $this->smarty->display("auth/reimpostaPassword.tpl");
    }

    /**
     * Restituisce i dati inseriti nella form di nuova password.
     *
     * @return array
     */
    public function getDatiNuovaPassword(): array {
        return [
            'token' => $_POST['token'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm' => $_POST['conferma_password'] ?? ''
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE — PROFILO UTENTE
     * --------------------------------------------------------------*/
    
    /**
     * Mostra il profilo dello studente loggato.
     *
     * @param array $utente Dati dello studente
     * @return void
     */
     public function mostraProfiloStudente(array $utente) : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign("utente", $utente);
        $this->smarty->assign("base64", $utente['foto']);
        $this->smarty->assign("studente", $utente['username']);
        $this->smarty->display("utente/profiloUtente.tpl");
    }

    /**
     * Mostra la form per modificare il profilo dello studente.
     *
     * @param array $utente Dati dello studente
     * @return void
     */
    public function mostraModificaProfilo(array $utente) : void {
        $this->smarty->assign("utente", $utente);
        $this->smarty->assign("base64", $utente['foto']);
        $this->smarty->assign("studente", $utente['username']);
        $this->smarty->display("utente/modificaProfilo.tpl");
    }

    /**
     * Restituisce i dati inseriti nella form di modifica profilo.
     *
     * @return array
     */
    public function getDatiModificaProfilo() : array {
        return [
            'nome' => $_POST['nome'] ?? '',
            'cognome' => $_POST['cognome'] ?? '',
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'immagine' => [
                           $_FILES['immagine']['name'] ?? null,
                           $_FILES['immagine']['tmp_name'] ?? null,
                           $_FILES['immagine']['error'],
                           $_FILES['immagine']['size'] ?? null,
                           $_FILES['immagine']['type'] ?? null
                           ],
            'password' => $_POST['password'] ?? ''
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE — REGISTRAZIONE (DATI)
     * --------------------------------------------------------------*/
     
    /**
     * Restituisce i dati inseriti nella form di registrazione.
     *
     * @return array
     */
    public function getDatiRegistrazione() : array {
        return [
            'nome'     => $_POST['nome'] ?? '',
            'cognome'  => $_POST['cognome'] ?? '',
            'username' => $_POST['username'] ?? '',
            'email'    => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE — LOGIN (DATI)
     * --------------------------------------------------------------*/

    /**
     * Restituisce i dati inseriti nella form di login.
     *
     * @return array
     */
     public function getDatiLogin() : array {
        return [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'remember' => isset($_POST['ricordami']) && $_POST['ricordami'] === 'on' ? true : false
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE 7 — PAGINAZIONE E TOKEN
     * --------------------------------------------------------------*/

    /**
     * Restituisce la pagina corrente per la paginazione.
     *
     * @return int
     */
    public function getDatiPaginazione() : int {
        return (int)($_GET['pagina'] ?? 1);
    }

    /**
     * Restituisce il token presente nella query string.
     *
     * @return string
     */
    public function getTokenEmail() : string {
        return $_GET['token'] ?? '';
    }

    /** -------------------------------------------------------------
     *  SEZIONE — MESSAGGI DI SISTEMA (Errore / Successo / Verifica)
     * --------------------------------------------------------------*/
    
    /**
     * Mostra una pagina di errore generica.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio) : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign("errore", $messaggio);
        $this->smarty->display("feedback/error.tpl");
    }

    /**
     * Mostra la pagina che invita a verificare l'email.
     *
     * @param string $email
     * @return void
     */
    public function mostraVerificaEmail(string $email) : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign("email", $email);
        $this->smarty->display("auth/verificationPage.tpl");
    }

    /**
     * Mostra la conferma di email verificata.
     *
     * @return void
     */
    public function mostraConvalidaEmail() : void {
        $this->smarty->display("auth/confirmVerificationPage.tpl");
    }

    /**
     * Mostra una pagina di successo generica.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraFormSuccesso(string $messaggio) : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign("successo", $messaggio);
        $this->smarty->display("feedback/successo.tpl");
    }

    /** -------------------------------------------------------------
     *  SEZIONE — RECENSIONI 
     * --------------------------------------------------------------*/

    /**
     * Mostra le recensioni dello studente (implementazione futura).
     *
     * @param array $recensioni
     * @return void
     */
    public function mostraRecensioniUtente(array $recensioni, int $totPage, int $page, ?string $username = null, ?string $base64 = null): void {
        $this->smarty->assign('recensioni', $recensioni);
        $this->smarty->assign('totPage', $totPage);
        $this->smarty->assign('page', $page);
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('utente/recensioniUtente.tpl');
    }

}