<?php
/* Smarty version 5.8.0, created on 2026-06-04 19:09:25
  from 'file:confirmVerificationPage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a21cd657489a8_15688197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4363a4c3e98835dc9ba3fa77eb261c071c00dd66' => 
    array (
      0 => 'confirmVerificationPage.tpl',
      1 => 1780600059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a21cd657489a8_15688197 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Registrazione Confermata</title>
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
    <link rel="stylesheet" href="/../CSS/styleEmailPages.css?v=3">
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
