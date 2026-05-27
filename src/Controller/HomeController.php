<?php
namespace Controller;
use UI\viewHome;
class HomeController{

    public function dashboard() : void {
        $view = new viewHome();
        $view->mostraHome();
    }

    public function index() : void {
        $view = new viewHome();
        $view->index();
    }
}