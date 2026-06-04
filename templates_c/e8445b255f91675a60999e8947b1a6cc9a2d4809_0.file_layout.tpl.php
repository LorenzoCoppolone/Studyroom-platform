<?php
/* Smarty version 5.8.0, created on 2026-06-04 15:03:10
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2193ae46e485_64578866',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8445b255f91675a60999e8947b1a6cc9a2d4809' => 
    array (
      0 => 'layout.tpl',
      1 => 1780585387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2193ae46e485_64578866 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2976720976a2193ae45d712_63896950', "title");
?>
</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="/../CSS/styleLayout.css">

    <!-- CSS Pagina -->
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15377987336a2193ae463f43_17609219', "pageCSS");
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
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2952357656a2193ae46d646_63901096', "content");
?>


    </main>

    <!-- FOOTER -->
    <footer class="footer">

        <a href="https://www.univaq.it"
           target="_blank"
           class="footer-logo-univaq">

            <img src="/../img/UnivaqLogo.png"
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
class Block_2976720976a2193ae45d712_63896950 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_15377987336a2193ae463f43_17609219 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_2952357656a2193ae46d646_63901096 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

        <?php
}
}
/* {/block "content"} */
}
