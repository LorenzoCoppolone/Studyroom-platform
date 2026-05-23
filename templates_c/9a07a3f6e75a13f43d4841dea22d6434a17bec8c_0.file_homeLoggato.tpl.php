<?php
/* Smarty version 5.8.0, created on 2026-05-23 11:00:02
  from 'file:homeLoggato.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a1188b2aec516_38979230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a07a3f6e75a13f43d4841dea22d6434a17bec8c' => 
    array (
      0 => 'homeLoggato.tpl',
      1 => 1779533989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a1188b2aec516_38979230 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19221407316a1188b2ae5635_02767968', "titolo");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3631809546a1188b2aeb026_79352973', "stili");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11663820796a1188b2aeba48_46500749', "contenuto");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "titolo"} */
class Block_19221407316a1188b2ae5635_02767968 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
StudyRoom – Home<?php
}
}
/* {/block "titolo"} */
/* {block "stili"} */
class Block_3631809546a1188b2aeb026_79352973 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>

<link rel="stylesheet" href="/studyroom-platform/CSS/styleHome.css">
<?php
}
}
/* {/block "stili"} */
/* {block "contenuto"} */
class Block_11663820796a1188b2aeba48_46500749 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>


        <section class="sr-hero">
        <h1 class="sr-hero-title">Che esame stai preparando?</h1>
        <p class="sr-hero-subtitle">Non studiare da solo: usa gli appunti della community</p>

        <form action="/cerca" method="get" class="d-flex justify-content-center">
            <div class="sr-search-wrap">
                <input
                    type="text"
                    name="q"
                    placeholder="Inizia a cercare"
                    aria-label="Cerca un esame"
                    autocomplete="off"
                >
                <button type="submit" aria-label="Cerca">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </section>

        <section class="sr-share-section">
        <div class="row align-items-center g-4">

                        <div class="col-12 col-md-6">
                <h2 class="sr-share-title">Condividi il tuo materiale</h2>
                <p class="sr-share-subtitle">Entra a far parte della community</p>
            </div>

                        <div class="col-12 col-md-6">
                <div
                    class="sr-upload-zone"
                    id="dropZone"
                    role="button"
                    tabindex="0"
                    aria-label="Carica file"
                    onclick="location.href='/avviaCaricamento'"
                >
        <i class="bi bi-cloud-arrow-up sr-upload-icon"></i>
        <span class="sr-upload-label">Carica File</span>
        <span class="sr-upload-hint">(Appunti, Esami passati, esercizi, ecc)</span>
        </div>
    </div>
    </section>
<?php
}
}
/* {/block "contenuto"} */
}
