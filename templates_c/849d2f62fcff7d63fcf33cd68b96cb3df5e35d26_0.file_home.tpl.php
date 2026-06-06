<?php
/* Smarty version 5.8.0, created on 2026-06-06 17:32:57
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a243da90d28b4_78571234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '849d2f62fcff7d63fcf33cd68b96cb3df5e35d26' => 
    array (
      0 => 'home.tpl',
      1 => 1780585509,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a243da90d28b4_78571234 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6428740916a243da90cfe93_83877526', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19770261716a243da90d2009_00788905', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19267690456a243da90d2505_01755833', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_6428740916a243da90cfe93_83877526 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

    StudyRoom - Home
<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_19770261716a243da90d2009_00788905 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

    <link rel="stylesheet" href="/../CSS/styleHome.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_19267690456a243da90d2505_01755833 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>


<section class="section-search">

    <h1 class="section-title">Che esame stai preparando?</h1>
    <p class="section-subtitle">Non studiare da solo: usa gli appunti della community</p>

    <form class="search-box" method="GET" action="/RicercaMateriale/cerca/">
        <input type="text"
           name="titolo"
           placeholder="Inizia a cercare"
           maxlength="100"
           required>

        <button class="btn-search-main" type="submit">
            <i class="fa fa-magnifying-glass"></i>
        </button>
    </form>

        </section>
        <!-- SEZIONE UPLOAD -->
        <section class="section-upload">
            <div class="upload-text">
                <h2 class="upload-title">Condividi il tuo materiale</h2>
                <p class="upload-subtitle">Entra a far parte della community</p>
            </div>

            <a href="/CaricaMateriale/carica" class="upload-box">
                <i class="fa fa-cloud-arrow-up upload-icon"></i>
                <p class="upload-label"><strong>Carica File</strong></p>
                <p class="upload-hint">(Appunti, Esami passati, esercizi, ecc)</p>
            </a>

        </section>
<?php
}
}
/* {/block "content"} */
}
