<?php
namespace Controller;
use UI\viewHome;
class HomeController{

    public function mostraHome() : void {
        $view = new viewHome();
        $view->mostraHome();
    }
}