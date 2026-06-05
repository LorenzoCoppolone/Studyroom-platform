<?php
/* Smarty version 5.8.0, created on 2026-06-05 17:10:13
  from 'file:recuperoPassword.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2302f538a336_69318430',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c82b9d12e53d78eede4772492dd9e2cb3e4ade6c' => 
    array (
      0 => 'recuperoPassword.tpl',
      1 => 1780672352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2302f538a336_69318430 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero Password • StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="login-container">

    <a href="/Home/dashboard" class="logo">StudyRoom</a>
    <h2 class="login-title">Recupero Password</h2>

    <div class="login-box">

        <form method="POST" action="/User/recuperoPassword" class="login-form">

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email"
                       type="email"
                       name="email"
                       placeholder="nome.cognome@student.univaq.it"
                       required>
            </div>

            <div class="error-msg">
                <?php echo (($tmp = $_smarty_tpl->getValue('errore') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

            </div>

            <button type="submit" class="btn-login">Invia</button>

        </form>

        <p class="register-text">
            Torna al <a href="/User/login">Login</a>
        </p>

    </div>

</div>

</body>
</html>
<?php }
}
