<?php

require_once __DIR__ . "/vendor/autoload.php";

use Controller\MaterialeController;
use UI\ViewUser;
/*
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['action']) && $_GET['action'] === 'caricaMateriale') {

        $controller = new MaterialeController();
        $controller->mostraFormCaricamento();
        exit;
    }

    // altrimenti mostra la home
    require __DIR__ . "/html/home.html";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === 'caricaMateriale') {

        $controller = new CaricaMaterialeController();
        $controller->caricaMateriale();
        exit;
    }
}
*/
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $view = new ViewUser();
    $studente = [
        "username" => "Mario",
        "foto" => null
    ];

    $view->mostraHomeLoggato($studente);
    exit;
}
