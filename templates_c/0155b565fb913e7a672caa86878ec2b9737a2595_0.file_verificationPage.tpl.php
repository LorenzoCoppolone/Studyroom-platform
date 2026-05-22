<?php
/* Smarty version 5.8.0, created on 2026-05-22 10:20:37
  from 'file:verificationPage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a102df59fdb27_06547572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0155b565fb913e7a672caa86878ec2b9737a2595' => 
    array (
      0 => 'verificationPage.tpl',
      1 => 1779445192,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a102df59fdb27_06547572 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Verifica Email</title>
    <link rel="icon" type="image/x-icon" href="/Studyroom-platform/img/studyroom_favicon.ico">
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleEmailPages.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
<body>
    <div class="page-container">
        <a href="home.html" target="_self">
            <img src="/Studyroom-platform/img/logo.png" alt="Logo StudyRoom" class="logo-verifica">
        </a>
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
                <button class="resend-btn">Invia di nuovo</button>
            </div>
        </div>
    </div>

</body>
</html><?php }
}
