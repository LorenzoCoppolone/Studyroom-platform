<?php
/* Smarty version 5.8.0, created on 2026-06-05 11:33:20
  from 'file:faq.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2297e0ecac48_86375456',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '988bc07d58c394c97eff2edf1210e61d2c409d4f' => 
    array (
      0 => 'faq.tpl',
      1 => 1780651991,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2297e0ecac48_86375456 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12729034676a2297e0ec31d2_03862062', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3946576166a2297e0ec8096_34228620', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7389288376a2297e0ec8d95_86533423', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_12729034676a2297e0ec31d2_03862062 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
FAQ - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_3946576166a2297e0ec8096_34228620 extends \Smarty\Runtime\Block
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
class Block_7389288376a2297e0ec8d95_86533423 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>


<section class="info-container">

    <h1 class="info-title">FAQ</h1>

    <div class="faq-item">
        <h3 class="faq-question">Posso caricare esami degli anni precedenti?</h3>
        <p class="faq-answer">
            Sì, puoi caricare esami passati purché tu ne abbia la disponibilità. Ricorda che la responsabilità
            del contenuto caricato è esclusivamente dell’utente che lo pubblica.
        </p>
    </div>

    <div class="faq-item">
        <h3 class="faq-question">Perché il mio materiale non appare subito nella ricerca?</h3>
        <p class="faq-answer">
            Dopo il caricamento, il sistema potrebbe impiegare qualche minuto per indicizzare il file.
            Inoltre, se hai inserito tag o titolo poco chiari, potrebbe essere più difficile trovarlo.
        </p>
    </div>

    <div class="faq-item">
        <h3 class="faq-question">Che tipo di file posso caricare?</h3>
        <p class="faq-answer">
            Sono accettati solo file PDF. Contenuti non pertinenti allo studio vengono rimossi automaticamente.
        </p>
    </div>

</section>

<?php
}
}
/* {/block "content"} */
}
