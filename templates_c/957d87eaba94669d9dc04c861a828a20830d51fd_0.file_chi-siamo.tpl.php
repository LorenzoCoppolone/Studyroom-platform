<?php
/* Smarty version 5.8.0, created on 2026-06-05 13:03:04
  from 'file:chi-siamo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22c908823156_06111497',
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
function content_6a22c908823156_06111497 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16279867606a22c90881d1c4_66300276', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7686206366a22c908821f39_31857843', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6179936266a22c908822a37_93315780', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_16279867606a22c90881d1c4_66300276 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Chi siamo - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_7686206366a22c908821f39_31857843 extends \Smarty\Runtime\Block
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
class Block_6179936266a22c908822a37_93315780 extends \Smarty\Runtime\Block
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
