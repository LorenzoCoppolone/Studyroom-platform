<?php
/* Smarty version 5.8.0, created on 2026-06-09 15:38:10
  from 'file:successo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2833622008e1_51425434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '839c556d5826996805486aa760b0d325187c6efe' => 
    array (
      0 => 'successo.tpl',
      1 => 1781018578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2833622008e1_51425434 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
        <div class="result-container" role="status">

            <div class="icon success" aria-hidden="true">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <h1 class="result-title">
                <?php echo $_smarty_tpl->getValue('successo');?>

            </h1>

            <?php if ((true && ($_smarty_tpl->hasVariable('dettaglio') && null !== ($_smarty_tpl->getValue('dettaglio') ?? null))) && $_smarty_tpl->getValue('dettaglio')) {?>
                <p class="result-subtitle"><?php echo $_smarty_tpl->getValue('dettaglio');?>
</p>
            <?php }?>

            <div class="result-buttons">
                <?php if ((true && ($_smarty_tpl->hasVariable('ricarica') && null !== ($_smarty_tpl->getValue('ricarica') ?? null))) && $_smarty_tpl->getValue('ricarica')) {?>
                    <a href="<?php echo $_smarty_tpl->getValue('ricarica');?>
" class="btn-retry">Torna a caricare</a>
                <?php }?>
                <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            </div>

        </div>
    </main>

</body>
</html>
<?php }
}
