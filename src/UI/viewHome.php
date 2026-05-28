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

    public function mostraHome() : void {
        $this->smarty->display('home.tpl');
    }
}