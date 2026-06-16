<?php
namespace config;
$autoload = realpath(__DIR__ . '/../vendor/autoload.php');

if ($autoload === false) {
    die("Autoload non trovato: " . __DIR__ . '/../vendor/autoload.php');
}

require_once $autoload;
use Smarty\Smarty;

$templatesC = __DIR__ . '/../templates_c/';

if (!is_dir($templatesC)) {
    mkdir($templatesC, 0755, true);
}

$cacheDir = __DIR__ . '/../cache/';

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

// In produzione (APP_DEBUG=false) i template sono pre-compilati: niente ricompilazione a ogni richiesta.
$debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOL);
$smarty = new Smarty();
$smarty->compile_check = $debug;
$smarty->force_compile = $debug;
$smarty->caching = false;
// cartelle nella root del progetto
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir($templatesC);
$smarty->setCacheDir($cacheDir);

return $smarty;