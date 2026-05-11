<?php
namespace UI;

class viewModerazioneContenuti {
    
    public function getDatiSegnalazione() : array {

        return ["bottonePremuto"=>$_POST['bottonePremuto'],
                'idSegnalazione'=>$_POST['idSegnalazione'],
                
        ]; // restituisce il valore del bottone premuto
    }
    
    public function mostraMaterialiSegnalati(array $materiali) : void{

        // logica per mostrare i materiali segnalati

    }
}