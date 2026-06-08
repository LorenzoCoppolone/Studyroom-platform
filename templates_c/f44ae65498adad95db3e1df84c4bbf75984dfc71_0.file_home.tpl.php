<?php
/* Smarty version 5.8.0, created on 2026-06-08 18:39:45
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a26f051592dd6_19259588',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f44ae65498adad95db3e1df84c4bbf75984dfc71' => 
    array (
      0 => 'home.tpl',
      1 => 1780933404,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a26f051592dd6_19259588 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4904066486a26f051579f04_10772478', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11194590016a26f051590e85_19378443', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16927473176a26f0515921e5_34883347', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_4904066486a26f051579f04_10772478 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>

    Home | StudyRoom
<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_11194590016a26f051590e85_19378443 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>

    <link rel="stylesheet" href="/../CSS/styleHome.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_16927473176a26f0515921e5_34883347 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
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
