<?php
/* Smarty version 5.8.0, created on 2026-06-05 14:30:25
  from 'file:supporto.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22dd81563cc3_65344551',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed230292d4030bf9744afd9374d1c5ba28b7d2f1' => 
    array (
      0 => 'supporto.tpl',
      1 => 1780668032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22dd81563cc3_65344551 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2883944726a22dd81555466_03278669', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11754296316a22dd81560c68_48197897', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20789704946a22dd81562952_53804241', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_2883944726a22dd81555466_03278669 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
Supporto - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_11754296316a22dd81560c68_48197897 extends \Smarty\Runtime\Block
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
class Block_20789704946a22dd81562952_53804241 extends \Smarty\Runtime\Block
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
        <li><strong>Yuvraj Singh</strong> — yuvraj.singh@student.univaq.it</li>
        <li><strong>Lorenzo Coppolone</strong> — lorenzo.coppolone@student.univaq.it</li>
        <li><strong>Matteo Massimi</strong> — matteo.massimi@student.univaq.it</li>
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
