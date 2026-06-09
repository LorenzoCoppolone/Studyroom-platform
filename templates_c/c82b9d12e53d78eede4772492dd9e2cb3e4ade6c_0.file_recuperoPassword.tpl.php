<?php
/* Smarty version 5.8.0, created on 2026-06-09 15:37:49
  from 'file:recuperoPassword.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a28334d238c39_78664748',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c82b9d12e53d78eede4772492dd9e2cb3e4ade6c' => 
    array (
      0 => 'recuperoPassword.tpl',
      1 => 1781018578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a28334d238c39_78664748 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero Password | StudyRoom</title>

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

        <h2>Recupero Password</h2>

        <form method="POST" action="/User/effettuaRecuperoPassword">

            <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('emailInserita') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" required>
                    <i class="bx bx-envelope"></i>
                </div>

            <!-- MESSAGGIO ERRORE -->
            <span class="msg-errore">
                <?php echo (($tmp = $_smarty_tpl->getValue('errore') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

            </span>

            <!-- BOTTONE -->
            <button type="submit" class="btn">Invia</button>

        </form>

        <!-- LINK LOGIN -->
        <p class="registrazione">
            Torna alla <a href="/Home/dashboard">Home</a>
        </p>

    </div>

</main>

</body>
</html>
<?php }
}
