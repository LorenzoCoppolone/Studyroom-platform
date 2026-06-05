<?php
/* Smarty version 5.8.0, created on 2026-06-05 16:40:46
  from 'file:profiloUtente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22dfee48aff8_34241696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9661a70b774c49763d3b41f31c2b3114a587aa9' => 
    array (
      0 => 'profiloUtente.tpl',
      1 => 1780659077,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22dfee48aff8_34241696 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8652176296a22dfee47f853_34219041', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12566254156a22dfee486522_88733340', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17349374676a22dfee486ed4_89017365', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_8652176296a22dfee47f853_34219041 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
Profilo Utente - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_12566254156a22dfee486522_88733340 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

    <link rel="stylesheet" href="/../CSS/styleProfiloUtente.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_17349374676a22dfee486ed4_89017365 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
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
