<?php
/* Smarty version 5.8.0, created on 2026-06-05 17:10:35
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a23030ba165e4_15555632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8445b255f91675a60999e8947b1a6cc9a2d4809' => 
    array (
      0 => 'layout.tpl',
      1 => 1780674198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a23030ba165e4_15555632 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">

    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15493574776a23030ba14519_83954393', "title");
?>
</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="/../CSS/styleLayout.css">

    <!-- CSS Pagina -->
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12121815916a23030ba15083_63917135', "pageCSS");
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
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17445106336a23030ba16125_08581095', "content");
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
class Block_15493574776a23030ba14519_83954393 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>
StudyRoom<?php
}
}
/* {/block "title"} */
/* {block "pageCSS"} */
class Block_12121815916a23030ba15083_63917135 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
}
}
/* {/block "pageCSS"} */
/* {block "content"} */
class Block_17445106336a23030ba16125_08581095 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?>

        <?php
}
}
/* {/block "content"} */
}
