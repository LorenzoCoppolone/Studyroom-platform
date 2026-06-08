<?php
require_once __DIR__ . "/vendor/autoload.php";

// Fuso orario applicativo: garantisce che scrittura e rilettura delle date
// (es. scadenza token) avvengano nello stesso timezone usato nel codice.
date_default_timezone_set('Europe/Rome');

use Controller\FrontController;

$controller = new FrontController();
$controller->run($_SERVER['REQUEST_URI']);