<?php
/* Smarty version 5.8.0, created on 2026-06-05 14:33:03
  from 'file:termini.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22de1fec6dc0_61796041',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83f069ea755da111442ef9da48ca93798ac09b11' => 
    array (
      0 => 'termini.tpl',
      1 => 1780668032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22de1fec6dc0_61796041 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6471445016a22de1feb1808_57957265', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_13587246796a22de1fec3bb4_19512833', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1703966956a22de1fec5954_54056910', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_6471445016a22de1feb1808_57957265 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
Termini di utilizzo - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_13587246796a22de1fec3bb4_19512833 extends \Smarty\Runtime\Block
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
class Block_1703966956a22de1fec5954_54056910 extends \Smarty\Runtime\Block
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

    <h3 class="info-subtitle">1. Responsabilità dei contenuti</h3>
    <p class="info-text">
        Ogni utente è responsabile del materiale che carica. Puoi caricare:
        <br>• appunti personali
        <br>• riassunti
        <br>• esercizi
        <br>• esami degli anni precedenti
    </p>

    <p class="info-text">
        Se un docente dovesse richiedere la rimozione di un contenuto, la responsabilità ricade esclusivamente
        sull’utente che lo ha caricato.
    </p>

    <h3 class="info-subtitle">2. Contenuti vietati</h3>
    <p class="info-text">
        È severamente vietato caricare:
        <br>• materiale osceno, offensivo o non pertinente allo studio
        <br>• contenuti protetti da copyright senza autorizzazione
        <br>• file dannosi o potenzialmente pericolosi
    </p>

    <p class="info-text">
        La violazione di queste regole comporta il ban permanente dalla piattaforma.
    </p>

    <h3 class="info-subtitle">3. Comportamento nella community</h3>
    <p class="info-text">
        Gli utenti devono mantenere un comportamento rispettoso. Commenti volgari, discriminatori o offensivi
        non sono tollerati.
    </p>

    <h3 class="info-subtitle">4. Uso corretto della piattaforma</h3>
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
