<?php
/* Smarty version 5.8.0, created on 2026-05-29 09:56:32
  from 'file:dashboardAdmin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a1962d09a2fa9_14734593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd1b389e3040cb443b6d81c6dea3202aafe5fc65' => 
    array (
      0 => 'dashboardAdmin.tpl',
      1 => 1780008873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a1962d09a2fa9_14734593 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rajdhani:wght@700&family=Exo+2:wght@700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleAdmin.css">
</head>
<body>

<header>
    <span class="logo">StudyRoom</span>
    <span class="header-badge">Admin</span>
</header>

<main>
    <h1 class="page-title">Dashboard Admin</h1>

    <!-- Tabella segnalazioni -->
    <div class="table-card">
        <div class="table-header">
            <span>Titolo</span>
            <span>N° Segnalazioni</span>
            <span>Azione</span>
        </div>

        <?php if ($_smarty_tpl->getValue('segnalazioni')) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('segnalazioni'), 's');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('s')->value) {
$foreach0DoElse = false;
?>
            <div class="table-row">
                <span class="titolo-cell"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('s')['titoloMateriale'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                <span>
                    <span class="badge" >
                         <?php echo $_smarty_tpl->getValue('s')['numeroSegnalazioni'];?>

                    </span>
                </span>
                <span>
                    <a href="/Studyroom-platform/index.php/admin/gestisciSegnalazione/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('s')['idMateriale'], ENT_QUOTES, 'UTF-8', true);?>
" class="btn-gestisci">
                        Gestisci
                    </a>
                </span>
            </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?> 
            <div class="empty">Nessuna segnalazione presente.</div>
        <?php }?>
    </div>
</main>

</body>
</html><?php }
}
