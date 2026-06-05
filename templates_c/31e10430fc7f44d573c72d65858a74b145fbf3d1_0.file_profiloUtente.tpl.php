<?php
/* Smarty version 5.8.0, created on 2026-06-05 13:54:22
  from 'file:profiloUtente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22d50ee84359_96410462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31e10430fc7f44d573c72d65858a74b145fbf3d1' => 
    array (
      0 => 'profiloUtente.tpl',
      1 => 1780592741,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22d50ee84359_96410462 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5091365956a22d50ee6e159_00731317', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4448102446a22d50ee7e6d9_26541186', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8548076856a22d50ee7fd72_39955626', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_5091365956a22d50ee6e159_00731317 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Profilo Utente - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_4448102446a22d50ee7e6d9_26541186 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

    <link rel="stylesheet" href="/../CSS/styleProfiloUtente.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_8548076856a22d50ee7fd72_39955626 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>


<div class="profile-container">

    <!-- COLONNA SINISTRA -->
    <div class="profile-left">

        <!-- FOTO PROFILO -->
        <div class="profile-photo">
            <img id="profileImg" 
                 src="<?php echo (($tmp = $_smarty_tpl->getValue('utente')['foto'] ?? null)===null||$tmp==='' ? 'default_profile.png' ?? null : $tmp);?>
" 
                 alt="Foto profilo">
        </div>

        <label class="change-photo">
            Cambia immagine
            <input type="file" id="photoInput" accept="image/*" hidden>
        </label>

        <!-- INFO UTENTE -->
        <div class="profile-info">
            <p><strong>Nome:</strong> <?php echo $_smarty_tpl->getValue('utente')['nome'];?>
</p>
            <p><strong>Cognome:</strong> <?php echo $_smarty_tpl->getValue('utente')['cognome'];?>
</p>
            <p><strong>Email:</strong> <?php echo $_smarty_tpl->getValue('utente')['email'];?>
</p>
            <p><strong>Username:</strong> <?php echo $_smarty_tpl->getValue('utente')['username'];?>
</p>
            <p><strong>Password:</strong> ********</p>
        </div>

        <!-- BOTTONI -->
        <a href="/User/modificaProfiloStudente" class="btn-modifica">Modifica</a>
        <a href="/User/logoutUtente" class="btn-logout">Logout</a>

    </div>

    <!-- COLONNA DESTRA -->
    <div class="profile-right">
        <a href="/RicercaMateriale/preferiti" class="profile-section-btn">Preferiti</a>
        <a href="/RicercaMateriale/download" class="profile-section-btn">Scaricati</a>
        <a href="/User/cercaRecensioniUtente" class="profile-section-btn">Mie recensioni</a>
        <a href="/RicercaMateriale/popolariUtente" class="profile-section-btn">Caricati</a>
    </div>

</div>

<!-- JS MINIMO -->
<?php echo '<script'; ?>
 src="/../JS/profiloUtente.js"><?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
