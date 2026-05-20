<?php
require_once __DIR__ . '/vendor/autoload.php';

$smarty = new \Smarty\Smarty();

// Configura le directory (adatta i percorsi al tuo progetto)
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');
$smarty->setCacheDir(__DIR__ . '/cache/');
$smarty->setConfigDir(__DIR__ . '/configs/');

// Assegna una variabile
$smarty->assign('nome', 'Matteo');

// Visualizza un template
$smarty->display('test.tpl');