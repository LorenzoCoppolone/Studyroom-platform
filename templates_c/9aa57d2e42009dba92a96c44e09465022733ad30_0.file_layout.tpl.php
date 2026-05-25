<?php
/* Smarty version 5.8.0, created on 2026-05-25 08:47:21
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a140c999b07b8_82534673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9aa57d2e42009dba92a96c44e09465022733ad30' => 
    array (
      0 => 'layout.tpl',
      1 => 1779698827,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a140c999b07b8_82534673 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1275054006a140c999a5368_69965077', "title");
?>
</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="./CSS/styleLayout.css">

    <!-- CSS Pagina -->
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6520950696a140c999ae5e4_89194131', "pageCSS");
?>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">

        <a href="./templates/home.tpl" class="logo">StudyRoom</a>

        <div class="navbar-search">
            <input type="text" placeholder="Cerca...">

            <button class="btn-search">
                <i class="fa fa-magnifying-glass"></i>
            </button>
        </div>

        <nav class="navbar-links">

            <a href="esami.tpl" class="nav-link nav-esami">
                Prepara i tuoi esami
            </a>

            <div class="nav-auth">

                <i class="fa fa-circle-user nav-user-icon"></i>

                <a href="loginForm.tpl" class="nav-link">
                    Accedi /
                </a>

                <a href="registrationForm.tpl" class="nav-link">
                    Registrati
                </a>

            </div>

        </nav>

    </header>

    <!-- CONTENUTO PAGINA -->
    <main class="page-content">

        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11067600246a140c999af9c0_13803960', "content");
?>


    </main>

    <!-- FOOTER -->
    <footer class="footer">

        <a href="https://www.univaq.it"
           target="_blank"
           class="footer-logo-univaq">

            <img src="./img/UnivaqLogo.png"
                 alt="Logo Università degli Studi dell'Aquila">

        </a>

        <div class="footer-center">

            <a href="home.php" class="footer-brand">
                StudyRoom
            </a>

            <nav class="footer-links">
                <a href="chi-siamo.tpl">Chi siamo</a>
                <a href="supporto.tpl">Supporto</a>
                <a href="faq.tpl">FAQ</a>
                <a href="termini.tpl">Termini di utilizzo</a>
            </nav>

        </div>

    </footer>

</body>
</html>
<?php }
/* {block "title"} */
class Block_1275054006a140c999a5368_69965077 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_6520950696a140c999ae5e4_89194131 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_11067600246a140c999af9c0_13803960 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>

        <?php
}
}
/* {/block "content"} */
}
