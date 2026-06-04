<?php
/* Smarty version 5.8.0, created on 2026-06-04 17:08:10
  from 'file:registrationForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21b0fa0d86d2_57212784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19e9f979b8476e8b3886ccde7a1aedab52cff828' => 
    array (
      0 => 'registrationForm.tpl',
      1 => 1780008873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a21b0fa0d86d2_57212784 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione • StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleRegister.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&family=Space+Mono:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="register-container">

        <h1 class="logo">StudyRoom</h1>
        <h2 class="register-title">Registrazione</h2>

        <div class="register-box">

            <form action="/User/effettuaRegistrazione" method="POST" class="register-form">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input id="nome" type="text" name="nome" placeholder="Nome" 
                        required minlength="2" title="Inserisci un nome valido">
                </div>

                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input id="cognome" 
                           type="text" 
                           name="cognome" 
                           placeholder="Cognome"
                           required minlength="2"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('old')['cognome'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" 
                           type="text" 
                           name="username" 
                           placeholder="Username"
                           required minlength="3"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('old')['username'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
                </div>

                <div class="form-group">
                    <label for="email">Email istituzionale</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           placeholder="nome.cognome@student.univaq.it"
                           required
                           pattern=".+@student\.univaq\.it"
                           title="L'email deve terminare con @student.univaq.it">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           placeholder="Minimo 8 caratteri"
                           required minlength="8">
                </div>

                <button type="submit" class="btn-register">Registrati</button>

            </form>

        </div>

    </div>

</body>
</html>
<?php }
}
