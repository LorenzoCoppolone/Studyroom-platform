<?php
/* Smarty version 5.8.0, created on 2026-06-06 10:08:31
  from 'file:error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a23f19f44e1e7_46101232',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '521ef1275f667d143ba653ac44fc20a5bdbbed14' => 
    array (
      0 => 'error.tpl',
      1 => 1780664136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a23f19f44e1e7_46101232 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
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
        <a href="/Home/dashboard" class="logo">StudyRoom</a>
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
