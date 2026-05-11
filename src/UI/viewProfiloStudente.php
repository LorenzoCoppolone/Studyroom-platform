<?php
namespace UI;
class viewProfiloStudente {
    
    public function mostraProfiloStudente() : void {
        // logica per mostrare il profilo dell'utente
    }

    public function mostraPreferitiStudente( array $recensioni) : void {
        // logica per mostrare i preferiti dell'utente
    }

    public function mostraDownloadStudente( array $recensioni) : void {
        // logica per mostrare i download dell'utente
    }


    public function mostraSegnalazioniStudente( array $recensioni) : void {
        // logica per mostrare le segnalazioni dell'utente
    }


    public function mostraMaterialiStudente( array $recensioni) : void {
        // logica per mostrare le recensioni dell'utente
    }
    public function mostraRecensioniStudente( array $recensioni) : void {
        // logica per mostrare le recensioni dell'utente
    }

    public function mostraModificaProfilo() : void {
        // logica per mostrare il modulo di modifica del profilo dell'utente
    }

    public function mostraEliminaProfilo() : void {
        // logica per mostrare il modulo di eliminazione del profilo dell'utente
    }


    public function GetDatiStudente() : array {

    return ["bottonePremuto"=>$_POST['bottonePremuto']]; // restituisce il valore del bottone premuto

       
    }
    
}