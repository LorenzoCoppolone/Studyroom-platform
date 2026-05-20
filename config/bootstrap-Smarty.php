<?php
require_once __DIR__ . '/../vendor/autoload.php';

$smarty = new Smarty();

// cartelle nella root del progetto
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../templates_c/');

return $smarty;