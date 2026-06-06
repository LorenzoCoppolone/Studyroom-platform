<?php
/* Smarty version 5.8.0, created on 2026-06-05 22:42:42
  from 'file:registrationForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2350e21cd073_70224831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19e9f979b8476e8b3886ccde7a1aedab52cff828' => 
    array (
      0 => 'registrationForm.tpl',
      1 => 1780669049,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2350e21cd073_70224831 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Registrazione</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="/../CSS/styleForm.css">

    <!-- Icone -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <main>
        <div class="logo">
            <a href="/Home/dashboard">
                <p>StudyRoom</p>
            </a>
        </div>

        <div class="form-login-container">

            <form action="/User/effettuaRegistrazione" method="post" id="formRegistrazione">
                <h2>Registrati</h2>

                                
                                <?php if ((true && ($_smarty_tpl->hasVariable('errore') && null !== ($_smarty_tpl->getValue('errore') ?? null)))) {?>
                    <span class="msg-errore"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errore'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                <?php }?>

                <!-- Nome -->
                <div class="campo-input">
                    <input type="text" placeholder="Nome" name="nome"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('old')['nome'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                           pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
                    <i class="bx bx-user"></i>
                </div>
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('errori')['nome'] ?? null)))) {?><span class="msg-errore"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errori')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?>

                <!-- Cognome -->
                <div class="campo-input">
                    <input type="text" placeholder="Cognome" name="cognome"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('old')['cognome'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                           pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
                    <i class="bx bx-badge"></i>
                </div>
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('errori')['cognome'] ?? null)))) {?><span class="msg-errore"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errori')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?>

                <!-- Username -->
                <div class="campo-input">
                    <input type="text" placeholder="Username" name="username"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('old')['username'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                           pattern="[a-zA-Z0-9_]+"
                           title="Solo lettere, numeri e _ (no spazi)" required>
                    <i class="bx bx-at"></i>
                </div>
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('errori')['username'] ?? null)))) {?><span class="msg-errore"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errori')['username'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?>

                <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email" id="email"
                           value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('old')['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                           pattern="[a-zA-Z0-9._%+\-]+@student\.univaq\.it"
                           title="Usa la tua email universitaria (@student.univaq.it)" required>
                    <i class="bx bx-envelope"></i>
                </div>
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('errori')['email'] ?? null)))) {?><span class="msg-errore"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errori')['email'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?>

                <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Password" name="password" id="password"
                           minlength="8" title="Minimo 8 caratteri" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

                <!-- Conferma Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Conferma Password" name="conferma_password" id="confermaPassword" required>
                    <i class="bx bx-show toggle-password" id="toggleConferma"></i>
                </div>
                <span class="msg-errore" id="err-conferma"></span>

                <button class="btn" type="submit">Registrati</button>

                <div class="registrazione">
                    <p>Hai gia un account?
                        <a href="/User/login">Accedi</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

<?php echo '<script'; ?>
 src="/../JS/validazione.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
