<?php
/* Smarty version 5.8.0, created on 2026-06-05 11:31:25
  from 'file:termini.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22976de356c7_18072756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62141067c906c2fd6b7ba1552919e6727852e9db' => 
    array (
      0 => 'termini.tpl',
      1 => 1780650563,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22976de356c7_18072756 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5235099426a22976de2f439_62758715', "title");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7578760286a22976de34110_43353765', "pageCSS");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11707559326a22976de34d20_96684544', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "title"} */
class Block_5235099426a22976de2f439_62758715 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
Termini di utilizzo - StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_7578760286a22976de34110_43353765 extends \Smarty\Runtime\Block
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
class Block_11707559326a22976de34d20_96684544 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
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
