<?php
/* Smarty version 5.8.0, created on 2026-06-08 15:15:30
  from 'file:chi-siamo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a26dc92c9b6c2_88678811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e38f5540f915369baf823dc42fd003bb2d71106c' => 
    array (
      0 => 'chi-siamo.tpl',
      1 => 1780930266,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a26dc92c9b6c2_88678811 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10137589676a26dc92c8ea03_64862817', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11634163126a26dc92c99596_94173634', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_606864946a26dc92c9a701_01806054', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_10137589676a26dc92c8ea03_64862817 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
Chi siamo | StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_11634163126a26dc92c99596_94173634 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>

<link rel="stylesheet" href="/../CSS/styleInfo.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_606864946a26dc92c9a701_01806054 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>


<section class="info-container">

    <h1 class="info-title">Chi siamo</h1>

    <p class="info-text">
        Siamo <strong>Yuvraj Singh</strong>, <strong>Lorenzo Coppolone</strong> e <strong>Matteo Massimi</strong>,
        tre studenti dell’Università degli Studi dell’Aquila (UNIVAQ).
    </p>

    <p class="info-text">
        Abbiamo creato <strong>StudyRoom</strong> perché, come molti altri studenti, abbiamo spesso avuto difficoltà
        nel reperire materiale utile per preparare gli esami. Appunti sparsi, PDF introvabili, vecchi esami passati
        condivisi solo tra pochi… tutto questo rendeva lo studio più complicato del necessario.
    </p>

    <p class="info-text">
        Per questo abbiamo deciso di sviluppare una piattaforma semplice, intuitiva e completamente gratuita,
        pensata per aiutare gli studenti dell’UNIVAQ a condividere e trovare materiale in modo rapido e ordinato.
    </p>

    <p class="info-text">
        Il nostro obiettivo è creare una community collaborativa, dove ogni studente possa contribuire e allo stesso tempo
        beneficiare del lavoro degli altri.
    </p>

</section>

<?php
}
}
/* {/block "content"} */
}
