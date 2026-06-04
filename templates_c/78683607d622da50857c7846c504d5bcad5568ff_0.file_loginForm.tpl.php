<?php
/* Smarty version 5.8.0, created on 2026-06-04 17:10:16
  from 'file:loginForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21b17890a9c6_64488065',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78683607d622da50857c7846c504d5bcad5568ff' => 
    array (
      0 => 'loginForm.tpl',
      1 => 1780008873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a21b17890a9c6_64488065 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso • StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&family=Space+Mono:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">

        <h1 class="logo">StudyRoom</h1>
        <h2 class="login-title">Accesso</h2>

        <div class="login-box">

            <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                <div class="login-error">
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>

                </div>
            <?php }?>

            <form action="/User/effettuaLogin" method="POST" class="login-form">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           placeholder="nome.cognome@student.univaq.it"
                           required
                           pattern="^[a-zA-Z0-9._%+-]+@^[a-zA-Z0-9._%+-]+@(student\.univaq\.it|studyroom\.it)$"
                           title="Inserisci una email istituzionale che termini con @student.univaq.it"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('emailInserita') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
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
                <a href="/User/registrazione">Registrati ora</a>
            </p>

        </div>

    </div>

</body>
</html>

<?php }
}
