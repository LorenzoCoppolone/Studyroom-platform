<?php
namespace UI;
class viewProfiloStudente {
    
    /**
     * Mostra il profilo dell'utente
     * @return void
     */
    public function mostraProfiloStudente() : void {
        // logica per mostrare il profilo dell'utente
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
     * Mostra le segnalazioni dell'utente
     * @return void
     */
    public function mostraSegnalazioniStudente( array $recensioni) : void {
        // logica per mostrare le segnalazioni dell'utente
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
     * Mostra il modulo di eliminazione del profilo dell'utente
     * @return void
     */
    public function mostraEliminaProfilo() : void {
        // logica per mostrare il modulo di eliminazione del profilo dell'utente
    }

    /**
     * Restituisce il valore del bottone premuto.
     * 
     * @return array
     */
    public function GetDatiStudente() : array {

    return ["bottonePremuto"=>$_POST['bottonePremuto']];
    
     // restituisce il valore del bottone premuto   
    }
    
}