<?php
/* Smarty version 5.8.0, created on 2026-05-23 11:15:34
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a118c567119b0_36874091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9aa57d2e42009dba92a96c44e09465022733ad30' => 
    array (
      0 => 'layout.tpl',
      1 => 1779534931,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a118c567119b0_36874091 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3863738046a118c566f8a51_24692071', "titolo");
?>
</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/studyroom-platform/CSS/styleLayout.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">


    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10448449656a118c566ff980_24804938', "stili");
?>

</head>
<body>

        <nav class="sr-navbar d-flex align-items-center gap-3">

                <a href="/home" class="sr-brand me-2">StudyRoom</a>

                <div class="sr-nav-search">
        <form action="/cerca" method="post">
            <input type="text" name="q" placeholder="Cerca" aria-label="Cerca">
            <button class="sr-nav-search-btn" type="submit" aria-label="Cerca">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

               <a href="/materialiPopolari" class="sr-slogan d-none d-md-inline ms-auto me-auto">
        Prepara i tuoi esami 
       </a>

                <div class="ms-auto ms-md-0">
            <a href="/profilo" class="sr-user-chip">
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('studente')['foto'] ?? null))) && $_smarty_tpl->getValue('studente')['foto'] != '') {?>
                    <img src="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('studente')['foto'], ENT_QUOTES, 'UTF-8', true);?>
" alt="Avatar" class="sr-avatar">
                <?php } else { ?>
                    <span class="sr-avatar-icon"><i class="bi bi-person-fill"></i></span>
                <?php }?>
                <span><?php echo (($tmp = htmlspecialchars((string)$_smarty_tpl->getValue('studente')['username'], ENT_QUOTES, 'UTF-8', true) ?? null)===null||$tmp==='' ? 'Ospite' ?? null : $tmp);?>
</span>
            </a>
        </div>

    </nav>

        <main>
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16439730356a118c5670e364_76975555', "contenuto");
?>

    </main>

        <footer class="sr-footer">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                        <div class="d-flex align-items-center gap-2">
                <?php if ((true && ($_smarty_tpl->hasVariable('logo_universita') && null !== ($_smarty_tpl->getValue('logo_universita') ?? null))) && $_smarty_tpl->getValue('logo_universita') != '') {?>
                    <img src="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('logo_universita'), ENT_QUOTES, 'UTF-8', true);?>
" alt="Logo Università" class="sr-univ-logo">
                <?php } else { ?>
                                        <span class="text-muted" style="font-size:.75rem; line-height:1.2; font-weight:600;">UNIVERSITÀ<br>DEGLI STUDI<br>DELL'AQUILA</span>
                <?php }?>
            </div>

                        <div class="text-center">
                <div class="sr-brand-footer mb-1">StudyRoom</div>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/chi-siamo">Chi siamo</a>
                    <a href="/supporto">Supporto</a>
                    <a href="/faq">FAQ</a>
                    <a href="/termini">Termini di utilizzo</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
<?php }
/* {block "titolo"} */
class Block_3863738046a118c566f8a51_24692071 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?>
StudyRoom<?php
}
}
/* {/block "titolo"} */
/* {block "stili"} */
class Block_10448449656a118c566ff980_24804938 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
}
}
/* {/block "stili"} */
/* {block "contenuto"} */
class Block_16439730356a118c5670e364_76975555 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
}
}
/* {/block "contenuto"} */
}
