<?php
/* Smarty version 5.8.0, created on 2026-06-04 19:29:07
  from 'file:caricaMateriale.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21d2039b85a9_80934816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '009c247a6ecdc5efbaf1044f80eebba2863f855c' => 
    array (
      0 => 'caricaMateriale.tpl',
      1 => 1780589114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a21d2039b85a9_80934816 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carica Materiale - StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleCarica.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<header class="navbar">
    <a href="/Home/dashboard" class="logo">StudyRoom</a>
</header>

<main class="upload-container">

    <!-- TIPO DOCUMENTO -->
    <div class="type-selector">
        <button id="btnAppunto" class="type-btn <?php if ($_smarty_tpl->getValue('tipo') == 'appunto') {?>active<?php }?>">Appunto</button>
        <button id="btnEsame" class="type-btn <?php if ($_smarty_tpl->getValue('tipo') == 'esame') {?>active<?php }?>">Esame</button>
    </div>

    <!-- FORM PRINCIPALE -->
    <form method="POST" enctype="multipart/form-data" action="/CaricaMateriale/salva">
        <input type="hidden" name="tipo" id="tipoInput" value="<?php echo (($tmp = $_smarty_tpl->getValue('tipo') ?? null)===null||$tmp==='' ? 'appunto' ?? null : $tmp);?>
">


        <!-- FILE UPLOAD -->
        <label class="upload-box">
            <input type="file" name="file" id="fileInput" accept="application/pdf" required hidden>
            <div class="upload-content">
                <p class="upload-title">Scegli file</p>
                <p class="upload-info">Max 2MB • Formato PDF</p>
                <button type="button" class="upload-btn">Upload <i class="fa fa-hand-pointer"></i></button>
            </div>
            <div class="error-msg">
                <?php echo (($tmp = $_smarty_tpl->getValue('errors')['file'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

            </div>
            <div id="fileName" class="file-name"></div>
        </label>

        <!-- CORSO DI LAUREA -->
        <div class="form-group">
            <label>Corso di Laurea</label>
            <select name="cdl" id="cdlSelect" required onchange="this.form.submit()">
                <option value="">Seleziona corso di laurea</option>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi'), 'c');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('c')->value) {
$foreach0DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('c')['id'];?>
" <?php if ($_smarty_tpl->getValue('selectedCdl') == $_smarty_tpl->getValue('c')['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('c')['nome'];?>
</option>
                        <?php echo $_smarty_tpl->getValue('c')['nome'];?>

                    </option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['cdl'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- INSEGNAMENTO -->
        <div class="form-group">
            <label>Insegnamento</label>
            <select name="insegnamento" id="insSelect" <?php if (!$_smarty_tpl->getValue('selectedCdl')) {?>disabled<?php }?> required>
                <option value="">Seleziona insegnamento</option>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('insegnamenti'), 'i');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('i')->value) {
$foreach1DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('i')['id'];?>
" <?php if ($_smarty_tpl->getValue('selectedIns') == $_smarty_tpl->getValue('i')['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('i')['nome'];?>
</option>

                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['ins'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- TITOLO -->
        <div class="form-group">
            <label>Titolo</label>
            <input type="text" name="titolo" id="titoloInput" required
                placeholder="es. Programmazione Web"
                value="<?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['titolo'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- TAG (solo Appunto) -->
        <div class="form-group">
            <label>Tag</label>
            <select name="tag" id="tagSelect" <?php if ($_smarty_tpl->getValue('tipo') == 'esame') {?>disabled<?php }?>>
                <option value="">Seleziona tipo</option>
                <option value="Riassunto">Riassunto</option>
                <option value="Note">Note</option>
                <option value="Esercizi">Esercizi</option>
            </select>
            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['tag'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- CHECKBOX -->
        <div class="form-check">
            <input type="checkbox" name="terms" id="termsCheck" required>
            <label for="termsCheck">Termini e Condizioni</label>
        </div>
        <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['terms'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>

        <!-- BOTTONI -->
        <div class="buttons">
            <a href="/Home/dashboard" class="btn-home"><i class="fa fa-arrow-left"></i> Home</a>
            <button type="submit" class="btn-upload">Carica <i class="fa fa-arrow-up"></i></button>
        </div>

    </form>

</main>

<?php echo '<script'; ?>
 src="/../JS/upload.js"><?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
