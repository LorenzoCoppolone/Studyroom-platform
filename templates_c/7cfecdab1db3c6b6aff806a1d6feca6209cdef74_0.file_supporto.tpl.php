<?php
/* Smarty version 5.8.0, created on 2026-06-05 11:30:29
  from 'file:supporto.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2297357e6f84_93236332',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cfecdab1db3c6b6aff806a1d6feca6209cdef74' => 
    array (
      0 => 'supporto.tpl',
      1 => 1780650527,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2297357e6f84_93236332 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8687987156a2297357dee91_68814820', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19449672266a2297357e5b53_80206443', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8452665246a2297357e65a4_46272275', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_8687987156a2297357dee91_68814820 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
Supporto - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_19449672266a2297357e5b53_80206443 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

<link rel="stylesheet" href="/../CSS/styleInfo.css">
<?php
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_8452665246a2297357e65a4_46272275 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
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
