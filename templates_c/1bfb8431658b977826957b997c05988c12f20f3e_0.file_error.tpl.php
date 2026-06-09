<?php
/* Smarty version 5.8.0, created on 2026-06-09 17:14:14
  from 'file:error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a282dc66df9e8_86730107',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1bfb8431658b977826957b997c05988c12f20f3e' => 
    array (
      0 => 'error.tpl',
      1 => 1780932555,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a282dc66df9e8_86730107 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
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
        <div class="result-container" role="alert">

            <div class="icon error" aria-hidden="true">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>

            <h1 class="result-title">
                <?php echo $_smarty_tpl->getValue('errore');?>

            </h1>

            <?php if ((true && ($_smarty_tpl->hasVariable('dettaglio') && null !== ($_smarty_tpl->getValue('dettaglio') ?? null))) && $_smarty_tpl->getValue('dettaglio')) {?>
                <p class="result-subtitle"><?php echo $_smarty_tpl->getValue('dettaglio');?>
</p>
            <?php }?>

            <div class="result-buttons">
                <?php if ((true && ($_smarty_tpl->hasVariable('riprova') && null !== ($_smarty_tpl->getValue('riprova') ?? null))) && $_smarty_tpl->getValue('riprova')) {?>
                    <a href="<?php echo $_smarty_tpl->getValue('riprova');?>
" class="btn-retry">Riprova</a>
                <?php }?>
                <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            </div>

        </div>
    </main>

</body>
</html>
<?php }
}
