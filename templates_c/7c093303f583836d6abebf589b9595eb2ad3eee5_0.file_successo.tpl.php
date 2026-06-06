<?php
/* Smarty version 5.8.0, created on 2026-06-06 16:58:36
  from 'file:successo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a24359cbb1288_85386053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c093303f583836d6abebf589b9595eb2ad3eee5' => 
    array (
      0 => 'successo.tpl',
      1 => 1780757792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a24359cbb1288_85386053 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successo - StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- LOGO IN ALTO FISSO E CENTRATO -->
    <header class="result-header">
        <a href="/Home/dashboard" class="logo">StudyRoom</a>
    </header>

    <!-- CONTENITORE CENTRALE -->
    <main>
        <div class="result-container">

            <div class="icon success">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <h2 class="result-title">
                <?php echo $_smarty_tpl->getValue('successo');?>

            </h2>

            <div class="result-buttons">
                <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            </div>

        </div>
    </main>

</body>
</html>

<?php }
}
