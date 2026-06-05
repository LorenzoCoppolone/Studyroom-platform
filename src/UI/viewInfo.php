<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;

class viewInfo {

    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function chiSiamo(?string $username, ?string $base64) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('chi-siamo.tpl');
    }

    public function supporto(?string $username, ?string $base64) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('supporto.tpl');
    }

    public function faq(?string $username, ?string $base64) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('faq.tpl');
    }

    public function termini(?string $username, ?string $base64) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('termini.tpl');
    }
}
