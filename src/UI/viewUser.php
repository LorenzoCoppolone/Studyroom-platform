<?php

namespace UI;

class ViewUser {


    //Funzione che mostra la form di registrazione 
    public function mostraFormRegistrazione () { 

        // implementazione html form oppure chiamata a funzione che lo fa

    }

    //Funzione che mostra la form di login
    public function mostraFormLogin () {

        // implementazione html form oppure chiamata a funzione che lo fa

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
     * Restituisce il valore del bottone premuto.
     * 
     * @return array
     */
    public function getBottoneCliccato() : array {

    return ["bottonePremuto"=>$_POST['bottonePremuto']];
    
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

}