<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Gestisci Segnalazione</title>

    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rajdhani:wght@700&family=Exo+2:wght@700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../CSS/styleAdmin.css">
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
</head>
<body>

<header>
    <span class="logo">StudyRoom</span>
    <span class="header-badge">Admin</span>
</header>

<main>

    <a href="/Admin/dashboard" class="back-link">← Torna alla dashboard</a>

    <h1 class="page-title">Gestisci Segnalazione</h1>

    <div class="detail-grid">

        <!-- ── COLONNA SINISTRA: file ── -->
        <div class="detail-card">
            <div class="detail-card-title">File segnalato</div>
            <div class="detail-card-body">

                <div class="file-meta">
                    <div class="file-meta-label">Titolo</div>
                    <div class="file-meta-value">{$materiale.titolo|escape}</div>
                </div>

                {if $materiale.fileSrc}
                    {if $materiale.isImage}
                        <img src="{$materiale.fileSrc}"
                             alt="Anteprima file"
                             style="max-width:100%; border-radius:8px; margin-top:12px;">
                    {else}
                        <iframe src="{$materiale.fileSrc}"
                                width="100%" height="400"
                                style="border:none; border-radius:8px; margin-top:12px;">
                        </iframe>
                    {/if}
                {else}
                    <div class="file-preview">
                        <span class="file-preview-icon">📄</span>
                        <span>Anteprima non disponibile</span>
                    </div>
                {/if}

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
                        <span class="user-field-value">{$utente.nome|escape}</span>
                    </div>
                    <div class="user-field">
                        <span class="user-field-label">Cognome</span>
                        <span class="user-field-value">{$utente.cognome|escape}</span>
                    </div>
                    <div class="user-field">
                        <span class="user-field-label">Username</span>
                        <span class="user-field-value">{$utente.username|escape}</span>
                    </div>
                    <div class="user-field">
                        <span class="user-field-label">Email</span>
                        <span class="user-field-value">{$utente.email|escape}</span>
                    </div>
                </div>
            </div>

            <!-- Azioni -->
            <div class="detail-card">
                <div class="detail-card-title">Azioni</div>
                <div class="detail-card-body">
                    <div class="action-group">

                        <!-- Accetta: archivia le segnalazioni, il materiale rimane -->
                        <form method="post" action="/Admin/eseguiAzione">
                            <input type="hidden" name="bottonePremuto" value="accetta">
                            <input type="hidden" name="idMaterialeSegnalato" value="{$materiale.idMateriale|escape}">
                            <input type="hidden" name="idUtente" value="{$utente.id|escape}">
                            <button type="submit" class="btn-action btn-success"
                                    onclick="return confirm('Accettare la segnalazione archivierà tutte le segnalazioni collegate. Continuare?')">
                                ✓&nbsp; Accetta segnalazione
                            </button>
                        </form>

                        <!-- Rifiuta: elimina il materiale e le segnalazioni -->
                        <form method="post" action="/Admin/eseguiAzione">
                            <input type="hidden" name="bottonePremuto" value="rifiuta">
                            <input type="hidden" name="idMaterialeSegnalato" value="{$materiale.idMateriale|escape}">
                            <input type="hidden" name="idUtente" value="{$utente.id|escape}">
                            <button type="submit" class="btn-action btn-outline"
                                    onclick="return confirm('Rifiutare la segnalazione eliminerà il materiale e tutte le segnalazioni ad esso associate. Continuare?')">
                                ✕&nbsp; Rifiuta segnalazione (rimuovi materiale)
                            </button>
                        </form>

                        <!-- Banna utente -->
                        <form method="post" action="/Admin/eseguiAzione">
                            <input type="hidden" name="bottonePremuto" value="banUtente">
                            <input type="hidden" name="idMaterialeSegnalato" value="{$materiale.idMateriale|escape}">
                            <input type="hidden" name="idUtente" value="{$utente.id|escape}">
                            <button type="submit" class="btn-action btn-danger"
                                    onclick="return confirm('Sei sicuro di voler bannare questo utente?')">
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
