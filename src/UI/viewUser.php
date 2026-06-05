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
     */
    public function mostraHome(?string $studente = null, ?string $base64 = null) : void {
       $this->smarty->assign("studente", $studente);
       $this->smarty->assign("base64", $base64);
       $this->smarty->display("home.tpl");
    }

    /**
     * Mostra la form di registrazione.
     */ 
    public function mostraFormRegistrazione () { 
            $this->smarty->display("registrationForm.tpl");
    }

    /**
     * Mostra la form di login.
     */
    public function mostraFormLogin () {
        $this->smarty->display("loginForm.tpl");
    }

    /** -------------------------------------------------------------
     *  SEZIONE — RECUPERO PASSWORD
     * --------------------------------------------------------------*/
    
    /**
     * Mostra la form per inserire l'email nel recupero password.
     */
    public function mostraFormRecuperoPassword() {
        $this->smarty->display("recuperoPassword.tpl");
    }

    /**
     * Restituisce l'email inserita nella form di recupero password.
     */
    public function getEmailRecuperoPassword(): string {
        return trim($_POST['email'] ?? '');
    }

    /**
     * Mostra la form per reimpostare la password tramite token.
     */
    public function mostraFormReimpostaPassword(string $token): void {
        $this->smarty->assign("token", $token);
        $this->smarty->display("reimpostaPassword.tpl");
    }

    /**
     * Restituisce i dati inseriti nella form di nuova password.
     */
    public function getDatiNuovaPassword(): array {
        return [
            'token' => $_POST['token'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm' => $_POST['confirm'] ?? ''
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE — PROFILO UTENTE
     * --------------------------------------------------------------*/
    
    /**
     * Mostra il profilo dello studente loggato.
     */
     public function mostraProfiloStudente(array $utente) : void {
        $this->smarty->assign("utente", $utente);
        $this->smarty->assign("base64", $utente['foto']);
        $this->smarty->assign("studente", $utente['username']);
        $this->smarty->display("profiloUtente.tpl");
    }

    /**
     * Mostra la form per modificare il profilo dello studente.
     */
    public function mostraModificaProfilo(array $utente) : void {
        $this->smarty->assign("utente", $utente);
        $this->smarty->assign("base64", $utente['foto']);
        $this->smarty->assign("studente", $utente['username']);
        $this->smarty->display("modificaProfilo.tpl");
    }

    /**
     * Restituisce i dati inseriti nella form di modifica profilo.
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
     */
     public function getDatiLogin() : array {
        return [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE 7 — PAGINAZIONE E TOKEN
     * --------------------------------------------------------------*/

    /**
     * Restituisce la pagina corrente per la paginazione.
     */
    public function getDatiPaginazione() : int {
        return (int)($_GET['pagina'] ?? 1);
    }

    /**
     * Restituisce il token presente nella query string.
     */
    public function getTokenEmail() : string {
        return $_GET['token'] ?? '';
    }

    /** -------------------------------------------------------------
     *  SEZIONE — MESSAGGI DI SISTEMA (Errore / Successo / Verifica)
     * --------------------------------------------------------------*/
    
    /**
     * Mostra una pagina di errore generica.
     */
    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign("errore", $messaggio);
        $this->smarty->display("error.tpl");
    }

    /**
     * Mostra la pagina che invita a verificare l'email.
     */
    public function mostraVerificaEmail(string $email) : void {
        $this->smarty->assign("email", $email);
        $this->smarty->display("verificationPage.tpl");
    }

    /**
     * Mostra la conferma di email verificata.
     */
    public function mostraConvalidaEmail() : void {
        $this->smarty->display("confirmVerificationPage.tpl");
    }

    /**
     * Mostra una pagina di successo generica.
     */
    public function mostraFormSuccesso(string $messaggio) : void {
        $this->smarty->assign("successo", $messaggio);
        $this->smarty->display("successo.tpl");
    }

    /** -------------------------------------------------------------
     *  SEZIONE — RECENSIONI 
     * --------------------------------------------------------------*/

    /**
     * Mostra le recensioni dello studente (implementazione futura).
     */
    public function mostraRecensioniStudente(array $recensioni) : void {
        // Implementazione futura
    }
}