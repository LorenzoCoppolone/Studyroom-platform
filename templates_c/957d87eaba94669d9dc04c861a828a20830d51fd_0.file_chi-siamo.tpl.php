<?php
/* Smarty version 5.8.0, created on 2026-06-06 00:01:12
  from 'file:chi-siamo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2363484a2625_41753470',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '957d87eaba94669d9dc04c861a828a20830d51fd' => 
    array (
      0 => 'chi-siamo.tpl',
      1 => 1780664136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2363484a2625_41753470 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19742714996a23634849b184_53843578', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_13641955376a2363484a1207_19063633', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1586984716a2363484a1dc0_96600284', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_19742714996a23634849b184_53843578 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Chi siamo - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_13641955376a2363484a1207_19063633 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

<link rel="stylesheet" href="/../CSS/styleInfo.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_1586984716a2363484a1dc0_96600284 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
