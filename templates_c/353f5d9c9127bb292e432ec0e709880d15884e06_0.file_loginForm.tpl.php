<?php
/* Smarty version 5.8.0, created on 2026-05-26 08:42:09
  from 'file:loginForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a155ce1593289_05043239',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '353f5d9c9127bb292e432ec0e709880d15884e06' => 
    array (
      0 => 'loginForm.tpl',
      1 => 1779784786,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a155ce1593289_05043239 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso • StudyRoom</title>
    <link rel="stylesheet" href="styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&family=Space+Mono:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">

        <h1 class="logo">StudyRoom</h1>
        <h2 class="login-title">Accesso</h2>

        <div class="login-box">

            <form action="/login" method="POST" class="login-form">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           placeholder="nome.cognome@student.univaq.it"
                           required
                           pattern="^[a-zA-Z0-9._%+-]+@student\.univaq\.it$"
                           title="Inserisci una email istituzionale che termini con @student.univaq.it">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           placeholder="Password"
                           required
                           minlength="8"
                           title="La password deve contenere almeno 8 caratteri">
                </div>

                <a href="/password-reset" class="forgot-password">Non ricordo la password</a>

                <button type="submit" class="btn-login">Accedi</button>

            </form>

            <p class="register-text">
                È la tua prima volta?
                <a href="register.html">Registrati ora</a>
            </p>

        </div>

    </div>

</body>
</html>
<?php }
}
