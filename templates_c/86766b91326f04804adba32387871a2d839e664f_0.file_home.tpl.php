<?php
/* Smarty version 5.8.0, created on 2026-06-06 16:36:40
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a244c980a33d2_83542749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86766b91326f04804adba32387871a2d839e664f' => 
    array (
      0 => 'home.tpl',
      1 => 1780585323,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a244c980a33d2_83542749 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12417575646a244c980986e8_51268773', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1867123306a244c980a1485_13929492', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9649034706a244c980a2771_64531101', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_12417575646a244c980986e8_51268773 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

    StudyRoom - Home
<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_1867123306a244c980a1485_13929492 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

    <link rel="stylesheet" href="/../CSS/styleHome.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_9649034706a244c980a2771_64531101 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
