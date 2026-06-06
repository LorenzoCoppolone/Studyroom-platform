<?php
/* Smarty version 5.8.0, created on 2026-06-05 22:47:32
  from 'file:profiloUtente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2352041ac013_28387511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31e10430fc7f44d573c72d65858a74b145fbf3d1' => 
    array (
      0 => 'profiloUtente.tpl',
      1 => 1780674198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2352041ac013_28387511 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20393074606a23520419fab8_56376791', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4840522436a2352041a4b72_65835714', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1665822536a2352041a5682_84553216', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_20393074606a23520419fab8_56376791 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Profilo Utente - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_4840522436a2352041a4b72_65835714 extends \Smarty\Runtime\Block
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
class Block_1665822536a2352041a5682_84553216 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
