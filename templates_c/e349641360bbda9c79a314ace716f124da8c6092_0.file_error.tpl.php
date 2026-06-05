<?php
/* Smarty version 5.8.0, created on 2026-06-04 17:37:25
  from 'file:error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a219bb58cfb89_89411729',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e349641360bbda9c79a314ace716f124da8c6092' => 
    array (
      0 => 'error.tpl',
      1 => 1779973003,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a219bb58cfb89_89411729 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Studyroom-platform/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore - StudyRoom</title>
    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <header class="result-header">
        <h1 class="logo">StudyRoom</h1>
    </header>

    <main class="result-container">

        <div class="icon error">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <h2 class="result-title">
            <?php echo $_smarty_tpl->getValue('errore');?>
 
        </h2>

        <div class="result-buttons">
            <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
        </div>

    </main>

</body>
</html>
<?php }
}
