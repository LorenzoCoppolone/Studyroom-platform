<?php
/* Smarty version 5.8.0, created on 2026-06-06 17:01:36
  from 'file:profiloUtente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2436509dcec3_16673966',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9661a70b774c49763d3b41f31c2b3114a587aa9' => 
    array (
      0 => 'profiloUtente.tpl',
      1 => 1780674219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2436509dcec3_16673966 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10464654876a2436509d7284_52666960', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6702495446a2436509d9855_42106686', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19949344616a2436509d9e52_92152837', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_10464654876a2436509d7284_52666960 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
Profilo Utente - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_6702495446a2436509d9855_42106686 extends \Smarty\Runtime\Block
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
class Block_19949344616a2436509d9e52_92152837 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>


<section class="profile-card">

    <!-- HEADER: foto + dati + Modifica -->
    <header class="profile-header">

        <div class="profile-photo">
            <?php if ($_smarty_tpl->getValue('utente')['foto']) {?>
                <img src="<?php echo $_smarty_tpl->getValue('utente')['foto'];?>
" alt="Foto profilo">
            <?php } else { ?>
                <i class="fa fa-circle-user"></i>
            <?php }?>
        </div>

        <div class="profile-identity">
            <h1 class="profile-name"><?php echo $_smarty_tpl->getValue('utente')['nome'];?>
 <?php echo $_smarty_tpl->getValue('utente')['cognome'];?>
</h1>
            <p class="profile-meta"><i class="fa fa-envelope"></i> <?php echo $_smarty_tpl->getValue('utente')['email'];?>
</p>
            <p class="profile-meta"><i class="fa fa-at"></i> <?php echo $_smarty_tpl->getValue('utente')['username'];?>
</p>

            <a href="/User/modificaProfiloStudente" class="btn btn-primary btn-modifica">
                <i class="fa fa-pen"></i> Modifica
            </a>
        </div>

    </header>

    <hr class="profile-divider">

    <!-- SEZIONI -->
    <nav class="profile-sections">
        <a href="/RicercaMateriale/preferiti" class="section-link">
            <i class="fa fa-heart"></i> Preferiti
        </a>
        <a href="/RicercaMateriale/download" class="section-link">
            <i class="fa fa-download"></i> Scaricati
        </a>
        <a href="/User/cercaRecensioniUtente" class="section-link">
            <i class="fa fa-star"></i> Mie recensioni
        </a>
        <a href="/RicercaMateriale/popolariUtente" class="section-link">
            <i class="fa fa-file-arrow-up"></i> Caricati
        </a>
    </nav>

    <hr class="profile-divider">

    <!-- AZIONI ACCOUNT -->
    <div class="profile-account-actions">
        <a href="/User/recuperoPassword" class="btn btn-secondary">
            <i class="fa fa-key"></i> Modifica password
        </a>
        <a href="/User/Logout" class="btn btn-logout">
            <i class="fa fa-right-from-bracket"></i> Logout
        </a>
    </div>

</section>

<?php
}
}
/* {/block "content"} */
}
