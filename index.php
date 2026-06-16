<?php
require_once __DIR__ . "/vendor/autoload.php";

use Controller\FrontController;

date_default_timezone_set('Europe/Rome');

$controller = new FrontController();
$controller->run($_SERVER['REQUEST_URI']);