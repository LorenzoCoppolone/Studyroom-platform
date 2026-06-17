<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestisci Segnalazione | StudyRoom</title>

    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rajdhani:wght@700&family=Exo+2:wght@700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../CSS/styleAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <span class="logo">StudyRoom</span>
    <a href="/Admin/dashboard" class="btn-logout"><i class="fa fa-arrow-left"></i> Dashboard</a>
</header>

<main>

    <a href="/Admin/dashboard" class="back-link"><i class="fa fa-arrow-left"></i> Torna alla dashboard</a>

    <h1 class="page-title">Gestisci Segnalazione</h1>

    <div class="materiale-layout">

        <!-- ===================== CONTENUTO PDF ===================== -->
        <div class="materiale-viewer">
            {if $materiale.idMateriale}
                <iframe class="materiale-viewer__frame"
                        src="/RicercaMateriale/pdf/{$materiale.idMateriale|escape:'url'}#toolbar=0&navpanes=0&scrollbar=0"
                        title="Contenuto del materiale"></iframe>
            {else}
                <div class="materiale-viewer__empty">
                    <i class="fa fa-file-pdf"></i>
                    <p>Anteprima non disponibile</p>
                </div>
            {/if}
        </div>
        <!-- ===================== /CONTENUTO PDF ===================== -->

        <!-- ===================== INFO + AZIONI ===================== -->
        <aside class="materiale-info">

            <h1 class="materiale-info__title">{$materiale.titolo|escape:'html'}</h1>

            <span class="materiale-info__tipo">Materiale segnalato</span>

            <!-- Caricato da -->
            <p class="materiale-info__author">
                <i class="fa fa-circle-user"></i>
                Caricato da <strong>{$utente.username|escape:'html'}</strong>
            </p>

            <!-- Dati utente -->
            <ul class="materiale-meta">
                <li>
                    <i class="fa fa-id-card"></i>
                    <span class="materiale-meta__label">Nome</span>
                    <span class="materiale-meta__value">{$utente.nome|escape:'html'} {$utente.cognome|escape:'html'}</span>
                </li>
                <li>
                    <i class="fa fa-at"></i>
                    <span class="materiale-meta__label">Username</span>
                    <span class="materiale-meta__value">{$utente.username|escape:'html'}</span>
                </li>
                <li>
                    <i class="fa fa-envelope"></i>
                    <span class="materiale-meta__label">Email</span>
                    <span class="materiale-meta__value">{$utente.email|escape:'html'}</span>
                </li>
            </ul>

            <!-- ===================== AZIONI ===================== -->
            <div class="materiale-actions">

                <!-- Accetta: archivia le segnalazioni, il materiale rimane -->
                <form method="post" action="/Admin/eseguiAzione">
                    <input type="hidden" name="bottonePremuto" value="accetta">
                    <input type="hidden" name="idMaterialeSegnalato" value="{$materiale.idMateriale|escape:'html'}">
                    <input type="hidden" name="idUtente" value="{$utente.id|escape:'html'}">
                    <button type="submit" class="btn-azione btn-azione--primary"
                            onclick="return confirm('Accettare la segnalazione archivierà tutte le segnalazioni collegate. Continuare?')">
                        <i class="fa fa-check"></i> Annulla segnalazione
                    </button>
                </form>

                <!-- Rifiuta: elimina il materiale e le segnalazioni -->
                <form method="post" action="/Admin/eseguiAzione">
                    <input type="hidden" name="bottonePremuto" value="rifiuta">
                    <input type="hidden" name="idMaterialeSegnalato" value="{$materiale.idMateriale|escape:'html'}">
                    <input type="hidden" name="idUtente" value="{$utente.id|escape:'html'}">
                    <button type="submit" class="btn-azione"
                            onclick="return confirm('Questo eliminerà il materiale e tutte le segnalazioni ad esso associate. Continuare?')">
                        <i class="fa fa-trash"></i> Rimuovi materiale
                    </button>
                </form>

                <!-- Banna utente -->
                <form method="post" action="/Admin/eseguiAzione">
                    <input type="hidden" name="bottonePremuto" value="banUtente">
                    <input type="hidden" name="idMaterialeSegnalato" value="{$materiale.idMateriale|escape:'html'}">
                    <input type="hidden" name="idUtente" value="{$utente.id|escape:'html'}">
                    <button type="submit" class="btn-azione btn-azione--danger"
                            onclick="return confirm('Sei sicuro di voler bannare questo utente?')">
                        <i class="fa fa-ban"></i> Banna utente
                    </button>
                </form>

            </div>
            <!-- ===================== /AZIONI ===================== -->

        </aside>
        <!-- ===================== /INFO + AZIONI ===================== -->

    </div>

</main>

</body>
</html>