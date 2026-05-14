<?php
namespace UI;

class viewModerazioneContenuti {
    
    /**
     * Restituisce il valore del bottone premuto.
     * Più l'id della segnalazione da considerare
     * 
     * @return array
     */
    public function getDatiSegnalazione() : array {

        return ["bottonePremuto"=>$_POST['bottonePremuto'],
                'idMaterialeSegnalato'=>$_POST['idMaterialeSegnalato'],
        ]; // restituisce il valore del bottone premuto
    }
    

    /**
     * Mostra i materiali segnalati
     * 
     * @return void
     */
    public function mostraMaterialiSegnalati(array $materiali) : void{

        // logica per mostrare i materiali segnalati

    }
}