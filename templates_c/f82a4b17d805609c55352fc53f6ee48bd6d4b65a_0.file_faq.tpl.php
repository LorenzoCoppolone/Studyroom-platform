<?php
/* Smarty version 5.8.0, created on 2026-06-05 14:30:26
  from 'file:faq.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22dd82c898a8_77898907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f82a4b17d805609c55352fc53f6ee48bd6d4b65a' => 
    array (
      0 => 'faq.tpl',
      1 => 1780668032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22dd82c898a8_77898907 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10916877086a22dd82c7c7d6_03385355', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20897557676a22dd82c86dd6_84050690', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2576702476a22dd82c887b3_08229913', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_10916877086a22dd82c7c7d6_03385355 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
FAQ - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_20897557676a22dd82c86dd6_84050690 extends \Smarty\Runtime\Block
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
class Block_2576702476a22dd82c887b3_08229913 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
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
