<?php
/* Smarty version 5.8.0, created on 2026-05-23 18:24:50
  from 'file:registrationForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a11f0f2ddbfb4_41468618',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8d94536fd645d61977a3977d953b8be6f1ac44b' => 
    array (
      0 => 'registrationForm.tpl',
      1 => 1779560687,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a11f0f2ddbfb4_41468618 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Registrazione</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/Studyroom-platform/img/studyroom_favicon.ico">
    <!-- Link allo stile css -->
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleForm.css">
    <!-- Icone -->
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
<body>

    <main>
        <div class="form-login-container">

            <a href="home.html" target="_self">
                <img src="/Studyroom-platform/img/logo.png" alt="Logo StudyRoom" class="logo-form-registration">
            </a>

            <form action="registrazione.php" method="post" id="formRegistrazione" >
                <h2>Registrati</h2>

                <!-- Nome -->
                <div class="campo-input">
                    <input type="text" placeholder="Nome" name="nome" pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
                    <i class="bx bx-user"></i>
                </div>

                <!-- Cognome -->
                <div class="campo-input">
                    <input type="text" placeholder="Cognome" name="cognome" pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
                    <i class="bx bx-badge"></i>
                </div>

                <!-- Username -->
                <div class="campo-input">
                    <input type="text" placeholder="Username" name="username" pattern="[a-zA-Z0-9_]+" 
       title="Solo lettere, numeri e _ (no spazi)" required>
                    <i class="bx bx-at"></i>
                </div>

                <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email" id="email"  pattern="[a-zA-Z0-9._%+\-]+@student\.univaq\.it"title="Usa la tua email universitaria (@student.univaq.it)" required>
                    <i class="bx bx-envelope"></i>
                </div>

                <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Password" name="password" id="password" minlength="8" title="Minimo 8 caratteri" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>
                <span class="msg-errore" id="err-password"></span>

                <!-- Conferma Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Conferma Password" name="conferma_password" id="confermaPassword" required>
                    <i class="bx bx-show toggle-password" id="toggleConferma"></i>
                </div>
                <span class="msg-errore" id="err-conferma"></span>

                <button class="btn" type="submit">Registrati</button>
            </form>
        </div>
    </main>
<?php echo '<script'; ?>
 src="/Studyroom-platform/JS/validazione.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
