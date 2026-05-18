<?php

require_once __DIR__ . "/vendor/autoload.php";

use Controller\UserController;

// GET → mostra il form HTML specifico
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . "/html/registrazioneStudente.html";
    exit;
}

// POST → processa i dati
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "<h3>Dati ricevuti dal form:</h3>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Passiamo i dati al controller
    $controller = new UserController();
    $controller->registrazioneStudente($_POST);

    exit;
}



