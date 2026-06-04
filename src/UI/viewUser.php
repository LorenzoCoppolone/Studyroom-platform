<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;

class ViewUser {
    private Smarty $smarty;
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function mostraHome(string $studente, ?string $base64) : void {
       $this->smarty->assign("studente", $studente);
       $this->smarty->assign("base64", $base64);
       $this->smarty->display("home.tpl");
    }

    //Funzione che mostra la form di registrazione 
    public function mostraFormRegistrazione () { 
            $this->smarty->display("registrationForm.tpl");
        // implementazione html form oppure chiamata a funzione che lo fa

    }

    //Funzione che mostra la form di login
    public function mostraFormLogin () {
        $this->smarty->display("loginForm.tpl");
    }

    public function mostraFormRecuperoPassword() {
        // logica per mostrare la form di recupero password
    }

    public function mostraFormErrore(string $messaggio) {
        $this->smarty->assign("errore", $messaggio);
        $this->smarty->display("error.tpl");
    }

    //Funzione che mostra il profilo dell`utente
     public function mostraProfiloStudente() : void {
        // logica per mostrare il profilo dell'utente
    }

     /**
     * Restituisce i dati inseriti nella form di registrazione.
     * @return array
     */
    public function getDatiRegistrazione() : array {
        
        return [
            'nome' => $_POST['nome'] ?? '',
            'cognome' => $_POST['cognome'] ?? '',
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];

    }

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

     /**
     * Restituisce la pagina corrente per la paginazione.
     * @return int
     */

    public function getDatiPaginazione() : array {
        return $_GET['pagina'] ?? 1; // Restituisce la pagina corrente, di default 1
    }

    /**
     * Restituisce i dati inseriti nella form di login.
     * @return array
     */
     public function getDatiLogin() : array {
        
        return [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];
    }

    /**
     * Restituisce il token presente nella query string dell'URL.
     * @return string
     */
    public function getTokenEmail() : string {
        return $_GET['token'] ?? '';
    }

    
    /**
     * Mostra le recensioni dell'utente
     * @return void
     */
    public function mostraRecensioniStudente( array $recensioni) : void {
        // logica per mostrare le recensioni dell'utente
    }

    /**
     * Mostra il modulo di modifica del profilo dell'utente
     * @return void
     */
    public function mostraModificaProfilo() : void {
        // logica per mostrare il modulo di modifica del profilo dell'utente
    }

    /**
     * Mostra la form per controllare la propria email dopo la registrazione
     * @return void
     */
    public function mostraVerificaEmail(string $email) : void {
        $this->smarty->assign("email", $email);
        $this->smarty->display("verificationPage.tpl");
    }


    /**
    * Mostra la form di conferma che l'email è stata verificata con successo
    * @return void
    */
    public function mostraConvalidaEmail() : void {
        $this->smarty->display("confirmVerificationPage.tpl");
    }
}