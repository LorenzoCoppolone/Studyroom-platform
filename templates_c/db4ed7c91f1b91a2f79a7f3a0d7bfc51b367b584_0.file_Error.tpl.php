<?php
/* Smarty version 5.8.0, created on 2026-05-21 17:26:31
  from 'file:Error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a0f4047213ba9_73162990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db4ed7c91f1b91a2f79a7f3a0d7bfc51b367b584' => 
    array (
      0 => 'Error.tpl',
      1 => 1779372238,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a0f4047213ba9_73162990 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <link rel="stylesheet" href="../CSS/styleError.css">
    <meta charset="UTF-8">
    <title>Errore</title>
</head>

<body>

<div class="error-container">
    <div class="error-icon">❌</div>

    <div class="error-message">
        <?php echo $_smarty_tpl->getValue('errore');?>

    </div>

    <a class="back-btn" href="javascript:history.back()">Torna indietro</a>
</div>

</body>
</html><?php }
}
