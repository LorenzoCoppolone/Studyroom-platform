<?php
/* Smarty version 5.8.0, created on 2026-06-09 12:36:28
  from 'file:termini.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2808cc0092c8_12134054',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54b66af4fdd07c3bbb44519f8c2436b25e073e5e' => 
    array (
      0 => 'termini.tpl',
      1 => 1780989839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2808cc0092c8_12134054 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10961635046a2808cbf41e69_76922322', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12613273796a2808cc006f16_78715689', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17443026896a2808cc008454_18060512', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_10961635046a2808cbf41e69_76922322 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
Termini di utilizzo - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_12613273796a2808cc006f16_78715689 extends \Smarty\Runtime\Block
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
class Block_17443026896a2808cc008454_18060512 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
