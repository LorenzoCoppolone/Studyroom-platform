<?php
/* Smarty version 5.8.0, created on 2026-06-05 13:03:52
  from 'file:faq.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22c938dea5c0_51857935',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a047758395bb547f4c4fe4a1446335ba30bb4f8' => 
    array (
      0 => 'faq.tpl',
      1 => 1780664136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22c938dea5c0_51857935 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9014297376a22c938de3fd9_94701227', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3755251766a22c938de9132_01846719', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14049324756a22c938de9d14_25228386', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_9014297376a22c938de3fd9_94701227 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
FAQ - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_3755251766a22c938de9132_01846719 extends \Smarty\Runtime\Block
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
class Block_14049324756a22c938de9d14_25228386 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
