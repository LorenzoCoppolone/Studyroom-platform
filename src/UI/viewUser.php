<?php

namespace UI;

class ViewUser {

    public function __construct() {
        // Costruttore vuoto, se necessario puoi aggiungere inizializzazioni qui
    }

    //Funzione che mostra la form di registrazione 
    public function mostraFormRegistrazione () { 
            require __DIR__ . '/../../html/registrationForm.html';
        // implementazione html form oppure chiamata a funzione che lo fa

    }

    //Funzione che mostra la form di login
    public function mostraFormLogin () {
        require __DIR__ . '/../../html/loginForm.html';
        
        // implementazione html form oppure chiamata a funzione che lo fa

    }

    public function mostraFormRecuperoPassword() {
        // logica per mostrare la form di recupero password
    }

    public function mostraFormErrore(string $messaggio) {
        $smarty = StartSmarty::configuration();
        $smarty->assign("errore", $messaggio);
        $smarty->display("Error.tpl");
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
     * Restituisce il valore del bottone premuto.
     * 
     * @return array
     */
    public function getBottoneCliccato() : array {

    return $_POST['bottone'] ?? '';
    
     // restituisce il valore del bottone premuto   
    }
   

    /**
     * Mostra i preferiti dell'utente
     * @return void
     */
    public function mostraPreferitiStudente( array $recensioni) : void {
        // logica per mostrare i preferiti dell'utente
    }

    /**
     * Mostra i download dell'utente
     * @return void
     */
    public function mostraDownloadStudente( array $recensioni) : void {
        // logica per mostrare i download dell'utente
    }

    /**
     * Mostra le recensioni dell'utente
     * @return void
     */
    public function mostraMaterialiStudente( array $recensioni) : void {
        // logica per mostrare le recensioni dell'utente
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
    public function mostraVerificaEmail() : void {
        require __DIR__ . '/../../html/verificationPage.html';
        // logica per mostrare la form con scritto "controlla la tua email"
    }

    /**
    * Mostra la form di conferma che l'email è stata verificata con successo
    * @return void
    */
    public function mostraConvalidaEmail() : void {
        require __DIR__ . '/../../html/confirmVerificationPage.html';
        // logica per mostrare la form di conferma che l'email è stata verificata con successo
    }

}