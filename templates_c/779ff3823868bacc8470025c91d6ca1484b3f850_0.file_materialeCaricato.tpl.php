<?php
/* Smarty version 5.8.0, created on 2026-06-06 16:34:33
  from 'file:materialeCaricato.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a242ff90873d8_72357803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '779ff3823868bacc8470025c91d6ca1484b3f850' => 
    array (
      0 => 'materialeCaricato.tpl',
      1 => 1780652316,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a242ff90873d8_72357803 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <meta charset="UTF-8">
    <title>Successo</title>
</head>

<body>

<div class="success-container">
    <div class="success-icon">✅</div>

    <div class="success-message">
        <?php echo $_smarty_tpl->getValue('successo');?>

    </div>

    <div class="success-buttons">
        <a href="/CaricaMateriale/carica" class="btn-left">Torna a caricare</a>
        <a href="/Home/dashboard" class="btn-right">Torna alla home</a>
    </div>
</div>

</body>
</html>
<?php }
}
