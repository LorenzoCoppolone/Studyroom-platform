<?php
/* Smarty version 5.8.0, created on 2026-05-29 13:47:58
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a197cee16e9f8_11744623',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35d0888da54cdf23f13798e3393dd44edd9b6702' => 
    array (
      0 => 'layout.tpl',
      1 => 1780055275,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a197cee16e9f8_11744623 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5590694696a197cee159a72_66167520', "title");
?>
</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleLayout.css">

    <!-- CSS Pagina -->
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9274224936a197cee165779_45683163', "pageCSS");
?>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">

        <a href="" class="logo">StudyRoom</a>

        <form class="navbar-search" method="GET" action="/RicercaMateriale/cerca">
            <input type="text" name="titolo" placeholder="Cerca..." maxlength="100" required>
            <button class="btn-search" type="submit">
                <i class="fa fa-magnifying-glass"></i>
            </button>
        </form>


        <nav class="navbar-links">

            <a href="/RicercaMateriali/popolari" class="nav-link nav-esami">
                Prepara i tuoi esami
            </a>

            <div class="nav-auth">

                <?php if ($_smarty_tpl->getValue('utente')) {?>

                    <!-- FOTO PROFILO -->
                    <div class="nav-user-avatar">
                    <img src="<?php echo $_smarty_tpl->getValue('utente')['foto'];?>
" alt="Foto profilo">
                    </div>

                    <!-- NOME E COGNOME -->
                    <span class="nav-user-name">
                        <?php echo $_smarty_tpl->getValue('utente')['nome'];?>
 <?php echo $_smarty_tpl->getValue('utente')['cognome'];?>

                    </span>

                    <!-- LOGOUT -->
                    <a href="/User/logout" class="nav-link">
                        Esci
                    </a>

                <?php } else { ?>

                    <!-- ICONA DEFAULT -->
                    <i class="fa fa-circle-user nav-user-icon"></i>

                    <a href="/User/login" class="nav-link">
                        Accedi /
                    </a>

                    <a href="/User/registrazione" class="nav-link">
                       Registrati
                    </a>

                <?php }?>

            </div>


        </nav>

    </header>

    <!-- CONTENUTO PAGINA -->
    <main class="page-content">

        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2309167706a197cee16c8a4_79101615', "content");
?>


    </main>

    <!-- FOOTER -->
    <footer class="footer">

        <a href="https://www.univaq.it"
           target="_blank"
           class="footer-logo-univaq">

            <img src="/Studyroom-platform/img/UnivaqLogo.png"
                 alt="Logo Università degli Studi dell'Aquila">

        </a>

        <div class="footer-center">

            <a href="" class="footer-brand">
                StudyRoom
            </a>

            <nav class="footer-links">
                <a href="chi-siamo.php">Chi siamo</a>
                <a href="supporto.php">Supporto</a>
                <a href="faq.php">FAQ</a>
                <a href="termini.php">Termini di utilizzo</a>
            </nav>

        </div>

    </footer>

</body>
</html>
<?php }
/* {block "title"} */
class Block_5590694696a197cee159a72_66167520 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_9274224936a197cee165779_45683163 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_2309167706a197cee16c8a4_79101615 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

        <?php
}
}
/* {/block "content"} */
}
