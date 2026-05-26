<?php
namespace config;
$autoload = realpath(__DIR__ . '/../vendor/autoload.php');

if ($autoload === false) {
    die("Autoload non trovato: " . __DIR__ . '/../vendor/autoload.php');
}

require_once $autoload;
use Smarty\Smarty;
$smarty = new Smarty();

// cartelle nella root del progetto
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../templates_c/');
$smarty->setCacheDir(__DIR__ . '/../cache/');

return $smarty;