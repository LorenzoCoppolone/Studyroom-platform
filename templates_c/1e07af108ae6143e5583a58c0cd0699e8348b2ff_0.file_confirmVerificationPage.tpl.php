<?php
/* Smarty version 5.8.0, created on 2026-06-04 17:09:18
  from 'file:confirmVerificationPage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21b13e4fa357_87877223',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e07af108ae6143e5583a58c0cd0699e8348b2ff' => 
    array (
      0 => 'confirmVerificationPage.tpl',
      1 => 1780592741,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a21b13e4fa357_87877223 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Registrazione Confermata</title>
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
    <link rel="stylesheet" href="/../CSS/styleEmailPages.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
<body>
    <div class="page-container">
         <a href="/Home/dashboard" target="_self">
            <img src="/../img/logo.png" alt="Logo StudyRoom" class="logo-conferma">
        </a>
        <div class="card">
            <div class="check-circle">
                <i class="bx bx-check"></i>
            </div>
            <h2>Account confermato!</h2>
            <p>La tua registrazione è andata a buon fine.<br>
               Benvenuto su <strong>StudyRoom</strong>!</p>
            <hr class="divider">
            <a href="/User/login" class="btn-login">Accedi ora</a>
        </div>
    </div>

</body>
</html><?php }
}
