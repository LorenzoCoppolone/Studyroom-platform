<?php
namespace UI;
class viewProfiloStudente {
    
    public function MostraProfiloStudente() : void {
        // logica per mostrare il profilo dell'utente
    }

    public function MostraPreferitiStudente( array $recensioni) : void {
        // logica per mostrare i preferiti dell'utente
    }

    public function MostraDownloadStudente( array $recensioni) : void {
        // logica per mostrare i download dell'utente
    }


    public function MostraSegnalazioniStudente( array $recensioni) : void {
        // logica per mostrare le segnalazioni dell'utente
    }


    public function MostraMaterialiStudente( array $recensioni) : void {
        // logica per mostrare le recensioni dell'utente
    }
    public function MostraRecensioniStudente( array $recensioni) : void {
        // logica per mostrare le recensioni dell'utente
    }

    public function MostraModificaProfilo() : void {
        // logica per mostrare il modulo di modifica del profilo dell'utente
    }

    public function MostraEliminaProfilo() : void {
        // logica per mostrare il modulo di eliminazione del profilo dell'utente
    }


    public function GetDatiStudente() : array {

    return ["bottonePremuto"=>$_POST['bottonePremuto']]; // restituisce il valore del bottone premuto

       
    }
}