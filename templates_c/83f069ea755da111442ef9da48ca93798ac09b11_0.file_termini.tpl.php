<?php
/* Smarty version 5.8.0, created on 2026-06-08 15:15:53
  from 'file:termini.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a26dca901f897_62520361',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83f069ea755da111442ef9da48ca93798ac09b11' => 
    array (
      0 => 'termini.tpl',
      1 => 1780931615,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a26dca901f897_62520361 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18133871746a26dca900da85_26214337', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11257165476a26dca901d906_97571211', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19432436766a26dca901eb93_38550891', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_18133871746a26dca900da85_26214337 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
Termini di utilizzo - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_11257165476a26dca901d906_97571211 extends \Smarty\Runtime\Block
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
class Block_19432436766a26dca901eb93_38550891 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>


<section class="info-container">

    <h1 class="info-title">Termini di utilizzo</h1>

    <p class="info-text">
        Utilizzando StudyRoom accetti i seguenti termini. La piattaforma è pensata per favorire la condivisione
        del materiale universitario tra studenti UNIVAQ, nel rispetto delle regole e del buon senso.
    </p>

    <h2 class="info-subtitle">1. Responsabilità dei contenuti</h2>
    <p class="info-text">
        Ogni utente è responsabile del materiale che carica. Puoi caricare:
    </p>
    <ul class="info-list">
        <li>appunti personali</li>
        <li>riassunti</li>
        <li>esercizi</li>
        <li>esami degli anni precedenti</li>
    </ul>

    <p class="info-text">
        Se un docente dovesse richiedere la rimozione di un contenuto, la responsabilità ricade esclusivamente
        sull’utente che lo ha caricato.
    </p>

    <h2 class="info-subtitle">2. Contenuti vietati</h2>
    <p class="info-text">
        È severamente vietato caricare:
    </p>
    <ul class="info-list">
        <li>materiale osceno, offensivo o non pertinente allo studio</li>
        <li>contenuti protetti da copyright senza autorizzazione</li>
        <li>file dannosi o potenzialmente pericolosi</li>
    </ul>

    <p class="info-text">
        La violazione di queste regole comporta il ban permanente dalla piattaforma.
    </p>

    <h2 class="info-subtitle">3. Comportamento nella community</h2>
    <p class="info-text">
        Gli utenti devono mantenere un comportamento rispettoso. Commenti volgari, discriminatori o offensivi
        non sono tollerati.
    </p>

    <h2 class="info-subtitle">4. Uso corretto della piattaforma</h2>
    <p class="info-text">
        StudyRoom è uno strumento di supporto allo studio. Non deve essere utilizzato per scopi commerciali,
        spam o attività non legate all’università.
    </p>

</section>

<?php
}
}
/* {/block "content"} */
}
