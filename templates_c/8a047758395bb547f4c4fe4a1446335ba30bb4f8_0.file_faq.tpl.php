<?php
/* Smarty version 5.8.0, created on 2026-06-09 12:36:44
  from 'file:faq.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2808dc38b229_65263788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a047758395bb547f4c4fe4a1446335ba30bb4f8' => 
    array (
      0 => 'faq.tpl',
      1 => 1780989839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2808dc38b229_65263788 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6212558136a2808dc3821f0_58708899', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19145095006a2808dc3892a4_32500063', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7932293936a2808dc38a4f1_88238559', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_6212558136a2808dc3821f0_58708899 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
FAQ - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_19145095006a2808dc3892a4_32500063 extends \Smarty\Runtime\Block
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
class Block_7932293936a2808dc38a4f1_88238559 extends \Smarty\Runtime\Block
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
