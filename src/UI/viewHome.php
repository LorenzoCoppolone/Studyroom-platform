<?php
use Smarty\Smarty;
use config\StartSmarty;

class viewHome{
    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function mostraHome() : void {
        $this->smarty->display('home.tpl');
    }
}