<?php
/* Smarty version 5.8.0, created on 2026-06-06 17:09:52
  from 'file:verificationPage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2454609ff890_80102600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8dab7b1092003dae84d2b289866534ab54fa9c0' => 
    array (
      0 => 'verificationPage.tpl',
      1 => 1780755705,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2454609ff890_80102600 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Verifica Email</title>
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
    <link rel="stylesheet" href="/../CSS/styleEmailPages.css?v=4">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-container">
        <div class="logo">
            <a href="/Home/dashboard">
                <p>StudyRoom</p>
            </a>
        </div>
        <div class="card">
           <div class="icon-circle">
                <i class="bx bx-mail-send"></i>
            </div>
            <h2>Controlla la tua email</h2>
            <p>Abbiamo inviato un link di conferma a:</p>
            <!-- L'email deve essere quella dell'utente che sta facendo la registrazione -->
            <div class="email-badge"><?php echo $_smarty_tpl->getValue('email');?>
</div>
            <hr class="divider">
            <div class="nota-spam">
                <i class="bx bx-error"></i>
                <span>Controlla anche la cartella <strong>Spam</strong> o <strong>Posta indesiderata</strong></span>
            </div>
            <div class="resend-row">
                <span>Non hai ricevuto nulla?</span>
               <a href="/User/EmailVerifica?email=<?php echo $_smarty_tpl->getValue('email');?>
" class="resend-btn">
                    Invia di nuovo
                </a>

            </div>
        </div>
    </div>
</body>
</html><?php }
}
