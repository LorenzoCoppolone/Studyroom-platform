<?php
/* Smarty version 5.8.0, created on 2026-06-05 20:36:45
  from 'file:reimpostaPassword.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a23173dd8d635_74604941',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e13e8d36410d0816899473268ac76abb9c99b16' => 
    array (
      0 => 'reimpostaPassword.tpl',
      1 => 1780678764,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a23173dd8d635_74604941 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reimposta Password • StudyRoom</title>

    <!-- Icone -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <link rel="stylesheet" href="/../CSS/styleForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<main>

    <!-- LOGO -->
    <a href="/Home/dashboard" class="logo">StudyRoom</a>

    <!-- BOX FORM -->
    <div class="form-login-container">

        <h2>Reimposta Password</h2>

        <form method="POST" action="/User/salvaNuovaPassword">

            <input type="hidden" name="token" value="<?php echo $_smarty_tpl->getValue('token');?>
">

            <!-- NUOVA PASSWORD -->
            <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Nuova password" name="password" id="password" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

            <!-- CONFERMA PASSWORD -->
            <div class="campo-input">
                    <input type="password" placeholder="Conferma Password" name="conferma_password" id="confermaPassword" required>
                    <i class="bx bx-show toggle-password" id="toggleConferma"></i>
                </div>

            <!-- ERRORE -->
            <span class="msg-errore">
                <?php echo (($tmp = $_smarty_tpl->getValue('errore') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

            </span>

            <!-- BOTTONE -->
            <button type="submit" class="btn">Reimposta</button>

        </form>

        <!-- LINK LOGIN -->
        <p class="registrazione">
            Torna al <a href="/User/login">Login</a>
        </p>

    </div>

</main>
<?php echo '<script'; ?>
 src="/../JS/validazione.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
