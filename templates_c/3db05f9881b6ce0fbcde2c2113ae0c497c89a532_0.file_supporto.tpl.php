<?php
/* Smarty version 5.8.0, created on 2026-06-05 13:03:36
  from 'file:supporto.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22c9285faff6_54419016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3db05f9881b6ce0fbcde2c2113ae0c497c89a532' => 
    array (
      0 => 'supporto.tpl',
      1 => 1780664136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22c9285faff6_54419016 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9104349476a22c9285f48b2_94335948', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7892330646a22c9285f9e95_77224392', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15008493456a22c9285fa8a0_49398386', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_9104349476a22c9285f48b2_94335948 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Supporto - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_7892330646a22c9285f9e95_77224392 extends \Smarty\Runtime\Block
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
class Block_15008493456a22c9285fa8a0_49398386 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
