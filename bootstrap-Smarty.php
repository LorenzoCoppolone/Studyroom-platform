// bootstrap.php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');

return $smarty;