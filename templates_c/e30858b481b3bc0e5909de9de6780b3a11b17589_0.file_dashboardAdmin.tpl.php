<?php
/* Smarty version 5.8.0, created on 2026-05-26 11:25:25
  from 'file:dashboardAdmin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a1583258ddae6_50666839',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e30858b481b3bc0e5909de9de6780b3a11b17589' => 
    array (
      0 => 'dashboardAdmin.tpl',
      1 => 1779794718,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a1583258ddae6_50666839 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleDashboard.css">
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
                    <a href="gestisciSegnalazione.php?id=<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('s')['idMateriale'], ENT_QUOTES, 'UTF-8', true);?>
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
