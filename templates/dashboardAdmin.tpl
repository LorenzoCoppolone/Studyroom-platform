<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom – Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleDashboard.css">
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
                    <span class="badge >
                        {$s.numeroSegnalazioni}
                    </span>
                </span>
                <span>
                    <a href="" class="btn-gestisci">
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