<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | StudyRoom</title>
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
    <h1 class="page-title">Dashboard Admin</h1>

    <!-- Tabella segnalazioni -->
    <div class="table-card">
        <div class="table-header">
            <span>Titolo</span>
            <span>N° Segnalazioni</span>
            <span>Azione</span>
        </div>

        {if $segnalazioni}
            {foreach $segnalazioni as $s}
            <div class="table-row">
                <span class="titolo-cell">{$s.titoloMateriale|escape}</span>
                <span>
                    <span class="badge" >
                         {$s.numeroSegnalazioni}
                    </span>
                </span>
                <span>
                    <a href="/Admin/gestisciSegnalazione/{$s.idMateriale|escape}" class="btn-gestisci">
                        Gestisci
                    </a>
                </span>
            </div>
            {/foreach}
        {else} 
            <div class="empty">Nessuna segnalazione presente.</div>
        {/if}
    </div>
</main>

</body>
</html>