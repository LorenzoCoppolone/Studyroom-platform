<?php

require_once __DIR__ . "/vendor/autoload.php";

use Controller\MaterialeController;
use UI\ViewUser;
use UI\viewModerazioneContenuti;
use Controller\ModerazioneController;
use Foundation\Persistent\PersistentManager;
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

  $controller = new ModerazioneController();
  $controller->dashboardAdmin();
    exit;
}
