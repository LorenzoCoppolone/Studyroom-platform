<?php
/* Smarty version 5.8.0, created on 2026-06-05 18:02:15
  from 'file:loginForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a22f307598a59_91701417',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5cc59adf6988ca1c518b38d5b33aebf08e680345' => 
    array (
      0 => 'loginForm.tpl',
      1 => 1780675331,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a22f307598a59_91701417 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Login</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="/../CSS/styleForm.css">

    <!-- Icone -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <main>

        <div class="logo">
            <a href="/Home/dashboard">
                <p>StudyRoom</p>
            </a>
        </div>

        <div class="form-login-container">

            <form action="/User/effettuaLogin" method="post">
                <h2>Accedi</h2>

                                
                                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                    <span class="msg-errore"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                <?php }?>

                <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('emailInserita') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" required>
                    <i class="bx bx-envelope"></i>
                </div>

                <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

                <div class="Ricordami">
                    <label for="controllo">
                        <input type="checkbox" id="controllo" name="ricordami"> Ricordami
                    </label>
                    <a href="/User/recuperoPassword">Hai dimenticato la password?</a>
                </div>

                <button class="btn" type="submit">Accedi</button>

                <div class="registrazione">
                    <p>Non hai un account?
                        <a href="/User/registrazione">Registrati</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

<?php echo '<script'; ?>
 src="/../JS/validazione.js"><?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
