<?php
/* Smarty version 5.8.0, created on 2026-06-09 12:43:57
  from 'file:Error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a280a8d0f4522_75615447',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5162d4acb9d1e1e7974667bed1085d76b8d6a22c' => 
    array (
      0 => 'Error.tpl',
      1 => 1780989839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a280a8d0f4522_75615447 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore - StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- LOGO IN ALTO CENTRATO -->
    <header class="result-header">
        <a href="/Home/dashboard" class="logo">StudyRoom</a>
    </header>

    <!-- CONTENITORE CENTRALE -->
    <main>
        <div class="result-container">

            <div class="icon error">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>

            <h2 class="result-title">
                <?php echo $_smarty_tpl->getValue('errore');?>

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
