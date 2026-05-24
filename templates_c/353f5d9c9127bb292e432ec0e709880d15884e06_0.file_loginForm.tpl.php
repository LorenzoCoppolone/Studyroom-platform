<?php
/* Smarty version 5.8.0, created on 2026-05-23 18:31:24
  from 'file:loginForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a11f27c462a71_48021846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '353f5d9c9127bb292e432ec0e709880d15884e06' => 
    array (
      0 => 'loginForm.tpl',
      1 => 1779561080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a11f27c462a71_48021846 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Login</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/Studyroom-platform/img/studyroom_favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleForm.css">

    <!-- Icone -->
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>

<body>

    <main>
        <div class="form-login-container">

            <a href="home.html" target="_self">
                <img src="/Studyroom-platform/img/logo.png" alt="Logo StudyRoom" class="logo-form-login">
            </a>
 
            <form action="login.php" method="post">
                <h2>Login</h2>


                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email" required >
                <i class="bx bx-envelope"></i>
                </div>

                <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Password" name="password" id="password"  required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

                <div class="Ricordami">
                    <label for="controllo">
                        <input type="checkbox" id="controllo"> Ricordami
                    </label>
                    <a href="#">Hai dimenticato la password?</a>
                </div>

                <button class="btn" type="submit">Accedi</button>

                <div class="registrazione">
                    <p>Non hai un account?
                    <a href="/Studyroom-platform/html/registrationForm.html">Registrati</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

<?php echo '<script'; ?>
 src="/Studyroom-platform/JS/validazione.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
