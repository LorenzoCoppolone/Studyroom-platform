<?php
/* Smarty version 5.8.0, created on 2026-06-08 15:15:34
  from 'file:supporto.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a26dc96386a41_50864055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed230292d4030bf9744afd9374d1c5ba28b7d2f1' => 
    array (
      0 => 'supporto.tpl',
      1 => 1780931645,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a26dc96386a41_50864055 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17524589406a26dc96379a65_51652782', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16725445236a26dc963842f0_26379456', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11892186986a26dc963857a0_50492672', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_17524589406a26dc96379a65_51652782 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
Supporto - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_16725445236a26dc963842f0_26379456 extends \Smarty\Runtime\Block
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
class Block_11892186986a26dc963857a0_50492672 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>


<section class="info-container">

    <h1 class="info-title">Supporto</h1>

    <p class="info-text">
        Hai bisogno di aiuto, hai riscontrato un problema o vuoi segnalarci qualcosa?
        Puoi contattarci direttamente via email:
    </p>

    <ul class="info-list">
        <li><strong>Yuvraj Singh</strong> — <a href="mailto:yuvraj.singh@student.univaq.it">yuvraj.singh@student.univaq.it</a></li>
        <li><strong>Lorenzo Coppolone</strong> — <a href="mailto:lorenzo.coppolone@student.univaq.it">lorenzo.coppolone@student.univaq.it</a></li>
        <li><strong>Matteo Massimi</strong> — <a href="mailto:matteo.massimi@student.univaq.it">matteo.massimi@student.univaq.it</a></li>
    </ul>

    <p class="info-text">
        Rispondiamo il prima possibile. StudyRoom è un progetto universitario, quindi potrebbe volerci qualche ora,
        ma facciamo sempre del nostro meglio.
    </p>

</section>

<?php
}
}
/* {/block "content"} */
}
