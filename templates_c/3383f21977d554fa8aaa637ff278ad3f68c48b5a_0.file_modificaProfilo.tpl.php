<?php
/* Smarty version 5.8.0, created on 2026-06-09 17:15:36
  from 'file:modificaProfilo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a282e188fae23_09687132',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3383f21977d554fa8aaa637ff278ad3f68c48b5a' => 
    array (
      0 => 'modificaProfilo.tpl',
      1 => 1780933602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a282e188fae23_09687132 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4514479116a282e188c87e5_15530731', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8371015886a282e188d3836_82170490', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7791389156a282e188d49d4_89387765', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_4514479116a282e188c87e5_15530731 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
Modifica Profilo | StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_8371015886a282e188d3836_82170490 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>

    <link rel="stylesheet" href="/../CSS/styleModificaProfilo.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_7791389156a282e188d49d4_89387765 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>


<section class="edit-card">

    <h1 class="edit-title"><i class="fa fa-pen"></i> Modifica profilo</h1>

        <?php if ((true && ($_smarty_tpl->hasVariable('errore') && null !== ($_smarty_tpl->getValue('errore') ?? null)))) {?>
        <p class="edit-error"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errore'), ENT_QUOTES, 'UTF-8', true);?>
</p>
    <?php }?>

    <form action="/User/aggiornaProfiloStudente" method="post"
          enctype="multipart/form-data" class="edit-form" id="formModificaProfilo">

        <!-- FOTO PROFILO -->
        <div class="edit-photo-block">

            <div class="edit-photo" id="previewWrapper">
                <?php if ($_smarty_tpl->getValue('utente')['foto']) {?>
                    <img src="<?php echo $_smarty_tpl->getValue('utente')['foto'];?>
" alt="Foto profilo" id="previewImg">
                <?php } else { ?>
                    <i class="fa fa-circle-user" id="previewPlaceholder"></i>
                <?php }?>
            </div>

            <label for="immagine" class="btn btn-secondary edit-photo-btn">
                <i class="fa fa-camera"></i> Cambia immagine
            </label>
            <input type="file" name="immagine" id="immagine"
                   accept="image/png, image/jpeg, image/jpg, image/webp" hidden>
            <span class="edit-photo-hint">PNG o JPG</span>

        </div>

        <!-- NOME -->
        <div class="edit-field">
            <label for="nome">Nome</label>
            <div class="campo-input">
                <i class="fa fa-user"></i>
                <input type="text" id="nome" name="nome"
                       value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['nome'], ENT_QUOTES, 'UTF-8', true);?>
"
                       placeholder="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['nome'], ENT_QUOTES, 'UTF-8', true);?>
"
                       pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
            </div>
        </div>

        <!-- COGNOME -->
        <div class="edit-field">
            <label for="cognome">Cognome</label>
            <div class="campo-input">
                <i class="fa fa-id-badge"></i>
                <input type="text" id="cognome" name="cognome"
                       value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
"
                       placeholder="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
"
                       pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
            </div>
        </div>

        <!-- USERNAME -->
        <div class="edit-field">
            <label for="username">Username</label>
            <div class="campo-input">
                <i class="fa fa-at"></i>
                <input type="text" id="username" name="username"
                       value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['username'], ENT_QUOTES, 'UTF-8', true);?>
"
                       placeholder="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['username'], ENT_QUOTES, 'UTF-8', true);?>
"
                       pattern="[a-zA-Z0-9_]+" title="Solo lettere, numeri e _ (no spazi)" required>
            </div>
        </div>

        <!-- AZIONI -->
        <div class="edit-actions">
            <a href="/User/profiloStudente" class="btn btn-secondary">
                <i class="fa fa-xmark"></i> Annulla
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-disk"></i> Salva modifiche
            </button>
        </div>

    </form>

</section>

<?php echo '<script'; ?>
 src="/../JS/modificaProfilo.js"><?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
