<?php
/* Smarty version 5.8.0, created on 2026-06-04 17:05:51
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21b06f6559a8_67019781',
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
function content_6a21b06f6559a8_67019781 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14593023056a21b06f63f093_08193646', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7347130406a21b06f6533f3_71970266', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6902582956a21b06f654877_23863988', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_14593023056a21b06f63f093_08193646 extends \Smarty\Runtime\Block
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
class Block_7347130406a21b06f6533f3_71970266 extends \Smarty\Runtime\Block
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
class Block_6902582956a21b06f654877_23863988 extends \Smarty\Runtime\Block
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
