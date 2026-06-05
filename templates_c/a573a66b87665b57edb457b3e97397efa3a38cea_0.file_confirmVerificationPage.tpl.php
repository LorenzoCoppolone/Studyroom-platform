<?php
/* Smarty version 5.8.0, created on 2026-06-04 18:41:53
  from 'file:confirmVerificationPage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21aad1236225_19141468',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a573a66b87665b57edb457b3e97397efa3a38cea' => 
    array (
      0 => 'confirmVerificationPage.tpl',
      1 => 1779977604,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a21aad1236225_19141468 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
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
         <a href="home.html" target="_self">
            <img src="/Studyroom-platform/img/logo.png" alt="Logo StudyRoom" class="logo-conferma">
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
