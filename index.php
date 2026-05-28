<?php
require_once __DIR__ . "/vendor/autoload.php";

use Controller\FrontController;

$controller = new FrontController();
$controller->run($_SERVER['REQUEST_URI']);