<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;

class viewInfo {

    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function chiSiamo() : void {
        $this->smarty->display('chi-siamo.tpl');
    }

    public function supporto() : void {
        $this->smarty->display('supporto.tpl');
    }

    public function faq() : void {
        $this->smarty->display('faq.tpl');
    }

    public function termini() : void {
        $this->smarty->display('termini.tpl');
    }
}
