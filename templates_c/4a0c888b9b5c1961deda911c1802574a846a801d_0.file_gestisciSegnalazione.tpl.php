<?php
/* Smarty version 5.8.0, created on 2026-05-28 16:42:44
  from 'file:gestisciSegnalazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a18708423f5b4_23852606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a0c888b9b5c1961deda911c1802574a846a801d' => 
    array (
      0 => 'gestisciSegnalazione.tpl',
      1 => 1779986162,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a18708423f5b4_23852606 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\Studyroom-platform\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Gestisci Segnalazione</title>

    <link rel="icon" type="image/x-icon" href="/Studyroom-platform/img/studyroom_favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rajdhani:wght@700&family=Exo+2:wght@700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleAdmin.css">
</head>
<body>

<header>
    <span class="logo">StudyRoom</span>
    <span class="header-badge">Admin</span>
</header>

<main>

    <a href="/Studyroom-platform/index.php/admin/dashboard" class="back-link">← Torna alla dashboard</a>

    <h1 class="page-title">Gestisci Segnalazione</h1>

    <div class="detail-grid">

        <!-- ── COLONNA SINISTRA: file ── -->
        <div class="detail-card">
            <div class="detail-card-title">File segnalato</div>
            <div class="detail-card-body">

                <div class="file-meta">
                    <div class="file-meta-label">Titolo</div>
                    <div class="file-meta-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('materiale')['titolo'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                </div>

                <?php if ($_smarty_tpl->getValue('materiale')['mimeType']) {?>
                    <?php if ($_smarty_tpl->getValue('materiale')['isImage']) {?>
                        <img src="/Studyroom-platform/index.php/admin/serviFile/<?php echo $_smarty_tpl->getValue('materiale')['idMateriale'];?>
"
                             alt="Anteprima file"
                             style="max-width:100%; border-radius:8px; margin-top:12px;">
                    <?php } else { ?>
                        <iframe src="/Studyroom-platform/index.php/admin/serviFile/<?php echo $_smarty_tpl->getValue('materiale')['idMateriale'];?>
"
                                width="100%" height="400"
                                style="border:none; border-radius:8px; margin-top:12px;">
                        </iframe>
                    <?php }?>
                <?php } else { ?>
                    <div class="file-preview">
                        <span class="file-preview-icon">📄</span>
                        <span>Anteprima non disponibile</span>
                    </div>
                <?php }?>

            </div>
        </div>

        <!-- ── COLONNA DESTRA: utente + azioni ── -->
        <div class="detail-col">

            <!-- Dati utente -->
            <div class="detail-card">
                <div class="detail-card-title">Dati Utente</div>
                <div class="detail-card-body">
                    <div class="user-field">
                        <span class="user-field-label">Nome</span>
                        <span class="user-field-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                    <div class="user-field">
                        <span class="user-field-label">Cognome</span>
                        <span class="user-field-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                    <div class="user-field">
                        <span class="user-field-label">Username</span>
                        <span class="user-field-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['username'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                    <div class="user-field">
                        <span class="user-field-label">Email</span>
                        <span class="user-field-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['email'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                </div>
            </div>

            <!-- Azioni -->
            <div class="detail-card">
                <div class="detail-card-title">Azioni</div>
                <div class="detail-card-body">
                    <div class="action-group">

                        <!-- Accetta: archivia le segnalazioni, il materiale rimane -->
                        <form method="post" action="/Studyroom-platform/index.php/admin/eseguiAzione">
                            <input type="hidden" name="bottonePremuto" value="accetta">
                            <input type="hidden" name="idMaterialeSegnalato" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('materiale')['idMateriale'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <input type="hidden" name="idUtente" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <button type="submit" class="btn-action btn-success"
                                    onclick="return confirm('Accettare la segnalazione archivierà tutte le segnalazioni collegate. Continuare?')">
                                ✓&nbsp; Accetta segnalazione
                            </button>
                        </form>

                        <!-- Rifiuta: elimina il materiale e le segnalazioni -->
                        <form method="post" action="/Studyroom-platform/index.php/admin/eseguiAzione">
                            <input type="hidden" name="bottonePremuto" value="rifiuta">
                            <input type="hidden" name="idMaterialeSegnalato" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('materiale')['idMateriale'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <input type="hidden" name="idUtente" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <button type="submit" class="btn-action btn-outline"
                                    onclick="return confirm('Rifiutare la segnalazione eliminerà il materiale. Continuare?')">
                                ✕&nbsp; Rifiuta segnalazione (rimuovi materiale)
                            </button>
                        </form>

                        <!-- Banna utente -->
                        <form method="post" action="/Studyroom-platform/index.php/admin/eseguiAzione">
                            <input type="hidden" name="bottonePremuto" value="banUtente">
                            <input type="hidden" name="idMaterialeSegnalato" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('materiale')['idMateriale'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <input type="hidden" name="idUtente" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <button type="submit" class="btn-action btn-danger"
                                    onclick="return confirm('Sei sicuro di voler bannare questo utente? Non potrà più accedere al sito.')">
                                ⛔&nbsp; Banna utente
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div><!-- /detail-col -->

    </div><!-- /detail-grid -->

</main>

</body>
</html>
<?php }
}
