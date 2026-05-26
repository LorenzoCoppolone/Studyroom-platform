<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewModerazioneContenuti {
    
    private Smarty $smarty;
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

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

        $this->smarty->assign('materiali', $materiali);
        $this->smarty->display('materialiSegnalati.tpl');

    }
   

      public function mostraDashboardAdmin(array $segnalazioni): void {
 
        $this->smarty->assign('segnalazioni',$segnalazioni);
        $this->smarty->display('dashboardAdmin.tpl');
    }
}