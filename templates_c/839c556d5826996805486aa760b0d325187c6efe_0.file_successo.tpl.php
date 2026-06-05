<?php
/* Smarty version 5.8.0, created on 2026-06-05 17:02:31
  from 'file:successo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a230127f3a205_01868103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '839c556d5826996805486aa760b0d325187c6efe' => 
    array (
      0 => 'successo.tpl',
      1 => 1780592741,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a230127f3a205_01868103 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successo - StudyRoom</title>
    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <header class="result-header">
        <h1 class="logo">StudyRoom</h1>
    </header>

    <main class="result-container">

        <div class="icon success">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <h2 class="result-title">
            <?php echo '<?'; ?>
= htmlspecialchars($successo ?? "Operazione completata con successo!") <?php echo '?>'; ?>

        </h2>

        <div class="result-buttons">
            <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            <a href="/CaricaMateriale/carica" class="btn-retry">Continua a caricare</a>
        </div>

    </main>

</body>
</html>
<?php }
}
