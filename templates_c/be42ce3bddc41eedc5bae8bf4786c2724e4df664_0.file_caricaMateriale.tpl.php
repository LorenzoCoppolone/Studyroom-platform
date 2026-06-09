<?php
/* Smarty version 5.8.0, created on 2026-06-09 12:37:16
  from 'file:caricaMateriale.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2808fcbbefc2_27854894',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be42ce3bddc41eedc5bae8bf4786c2724e4df664' => 
    array (
      0 => 'caricaMateriale.tpl',
      1 => 1780989839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2808fcbbefc2_27854894 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6507342266a2808fcb86d95_07443141', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20004594216a2808fcb8ecb5_37849594', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11044934306a2808fcb8ff60_81418811', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_6507342266a2808fcb86d95_07443141 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Carica Materiale - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_20004594216a2808fcb8ecb5_37849594 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

    <link rel="stylesheet" href="/../CSS/styleCarica.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_11044934306a2808fcb8ff60_81418811 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>


<section class="upload-card">

    <h1 class="upload-card-title"><i class="fa fa-cloud-arrow-up"></i> Carica materiale</h1>

        <?php if ((true && ($_smarty_tpl->hasVariable('errore') && null !== ($_smarty_tpl->getValue('errore') ?? null)))) {?>
        <p class="upload-error"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errore'), ENT_QUOTES, 'UTF-8', true);?>
</p>
    <?php }?>

    <!-- TIPO DOCUMENTO -->
    <div class="type-selector">
        <button type="button" id="btnAppunto" class="type-btn <?php if ($_smarty_tpl->getValue('tipo') != 'esame') {?>active<?php }?>">Appunto</button>
        <button type="button" id="btnEsame" class="type-btn <?php if ($_smarty_tpl->getValue('tipo') == 'esame') {?>active<?php }?>">Esame</button>
    </div>

    <!-- FORM PRINCIPALE -->
    <form method="POST" enctype="multipart/form-data" action="/CaricaMateriale/salva" class="upload-form">
        <input type="hidden" name="tipo" id="tipoInput" value="<?php echo (($tmp = $_smarty_tpl->getValue('tipo') ?? null)===null||$tmp==='' ? 'appunto' ?? null : $tmp);?>
">

        <!-- FILE UPLOAD -->
        <label class="upload-box">
            <input type="file" name="file" id="fileInput" accept="application/pdf" required hidden>
            <div class="upload-content">
                <i class="fa fa-file-pdf upload-box-icon"></i>
                <p class="upload-title">Scegli file</p>
                <p class="upload-info">Max 2MB &bull; Formato PDF</p>
                <span class="btn btn-primary upload-btn">Upload <i class="fa fa-hand-pointer"></i></span>
            </div>
            <div id="fileName" class="file-name"></div>
        </label>
        <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['file'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>

        <!-- CORSO DI LAUREA (ricerca: scrivi e scegli) -->
        <div class="form-group">
            <label for="cdlInput">Corso di Laurea</label>
            <div class="combo" id="cdlCombo">
                <i class="fa fa-magnifying-glass combo-icon"></i>
                <input type="text" id="cdlInput" class="combo-input" autocomplete="off"
                       placeholder="Scrivi il tuo corso di laurea..."
                       value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('selectedCdlNome') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" required>
                <input type="hidden" name="cdl" id="cdlValue" value="<?php echo (($tmp = $_smarty_tpl->getValue('selectedCdl') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                <ul class="combo-list" id="cdlList" role="listbox">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi'), 'c');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('c')->value) {
$foreach0DoElse = false;
?>
                        <li class="combo-item" role="option"
                            data-value="<?php echo $_smarty_tpl->getValue('c')['id'];?>
" data-label="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('c')['nome'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->getValue('c')['nome'];?>
</li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <li class="combo-empty" hidden>Nessun corso trovato</li>
                </ul>
            </div>
            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['cdl'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- INSEGNAMENTO (bloccato finché non si sceglie il corso) -->
        <div class="form-group">
            <label for="insInput">Insegnamento</label>
            <div class="combo" id="insCombo">
                <i class="fa fa-magnifying-glass combo-icon"></i>
                <input type="text" id="insInput" class="combo-input" autocomplete="off"
                       placeholder="Seleziona prima un corso di laurea"
                       data-placeholder-locked="Seleziona prima un corso di laurea"
                       data-placeholder-ready="Scrivi l'insegnamento..."
                       value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('selectedInsNome') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" required disabled>
                <input type="hidden" name="insegnamento" id="insValue" value="<?php echo (($tmp = $_smarty_tpl->getValue('selectedIns') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                <ul class="combo-list" id="insList" role="listbox">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('insegnamenti'), 'i');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('i')->value) {
$foreach1DoElse = false;
?>
                        <li class="combo-item" role="option"
                            data-value="<?php echo $_smarty_tpl->getValue('i')['id'];?>
" data-cdl="<?php echo $_smarty_tpl->getValue('i')['codiceCorso'];?>
"
                            data-label="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('i')['nome'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->getValue('i')['nome'];?>
</li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <li class="combo-empty" hidden>Nessun insegnamento trovato</li>
                </ul>
            </div>
            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['ins'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- TITOLO -->
        <div class="form-group">
            <label for="titoloInput">Titolo</label>
            <input type="text" name="titolo" id="titoloInput" required
                   placeholder="es. Programmazione Web"
                   value="<?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
            <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['titolo'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
        </div>

        <!-- TAG (solo Appunto) -->
        <div class="form-group" id="tagGroup">
            <label for="tagSelect">Tag</label>
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
            <label for="termsCheck">Accetto i Termini e Condizioni</label>
        </div>
        <div class="error-msg"><?php echo (($tmp = $_smarty_tpl->getValue('errors')['terms'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>

        <!-- BOTTONI -->
        <div class="upload-actions">
            <a href="/Home/dashboard" class="btn btn-secondary btn-home"><i class="fa fa-arrow-left"></i> Home</a>
            <button type="submit" class="btn btn-carica">
                <i class="fa fa-cloud-arrow-up"></i> Carica materiale
            </button>
        </div>

    </form>

</section>

<?php echo '<script'; ?>
 src="/../JS/upload.js"><?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
