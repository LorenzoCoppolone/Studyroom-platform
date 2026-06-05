<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;

class viewHome{
    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function index() : void {
        header("Location: Home/dashboard");
        exit;
    }

    public function mostraHome(?string $username, ?string $base64) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('home.tpl');
    }
}