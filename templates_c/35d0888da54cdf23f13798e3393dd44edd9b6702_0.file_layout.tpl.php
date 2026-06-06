<?php
/* Smarty version 5.8.0, created on 2026-06-06 17:34:28
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a243e04248ef1_59418649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35d0888da54cdf23f13798e3393dd44edd9b6702' => 
    array (
      0 => 'layout.tpl',
      1 => 1780674219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a243e04248ef1_59418649 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">

    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10249095586a243e04247704_29946409', "title");
?>
</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="/../CSS/styleLayout.css">

    <!-- CSS Pagina -->
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_13762997746a243e04247c52_76137515', "pageCSS");
?>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">

        <a href="/Home/dashboard" class="logo">StudyRoom</a>

        <form class="navbar-search" method="GET" action="/RicercaMateriale/cerca">
            <input type="text" name="titolo" placeholder="Cerca..." maxlength="100" required>
            <button class="btn-search" type="submit">
                <i class="fa fa-magnifying-glass"></i>
            </button>
        </form>


        <nav class="navbar-links">

            <a href="/RicercaMateriale/popolari" class="nav-link nav-esami">
                Prepara i tuoi esami
            </a>

            <div class="nav-auth">

                <?php if ($_smarty_tpl->getValue('studente')) {?>

                    <!-- FOTO PROFILO -->
                    <a href="/User/profiloStudente" class="nav-user-avatar">
                        <?php if ($_smarty_tpl->getValue('base64')) {?>
                            <img src="<?php echo $_smarty_tpl->getValue('base64');?>
" alt="Foto profilo">
                        <?php } else { ?>
                            <i class="fa fa-circle-user"></i>
                        <?php }?>
                    </a>

                    <!-- USERNAME -->
                    <a href="/User/profiloStudente" class="nav-user-name"><?php echo $_smarty_tpl->getValue('studente');?>
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
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_355966976a243e04248af7_04234019', "content");
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

            <a href="/Home/dashboard" class="footer-brand">StudyRoom</a>

            <nav class="footer-links">
                <a href="/Info/chiSiamo">Chi siamo</a>
                <a href="/Info/supporto">Supporto</a>
                <a href="/Info/faq">FAQ</a>
                <a href="/Info/termini">Termini di utilizzo</a>
            </nav>

        </div>

    </footer>

</body>
</html>
<?php }
/* {block "title"} */
class Block_10249095586a243e04247704_29946409 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>
StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_13762997746a243e04247c52_76137515 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_355966976a243e04248af7_04234019 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?>

        <?php
}
}
/* {/block "content"} */
}
