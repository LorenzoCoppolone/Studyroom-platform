<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successo - StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- LOGO IN ALTO FISSO E CENTRATO -->
    <header class="result-header">
        <a href="/Home/dashboard" class="logo">StudyRoom</a>
    </header>

    <!-- CONTENITORE CENTRALE -->
    <main>
        <div class="result-container" role="status">

            <div class="icon success" aria-hidden="true">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <h1 class="result-title">
                {$successo}
            </h1>

            {if isset($dettaglio) && $dettaglio}
                <p class="result-subtitle">{$dettaglio}</p>
            {/if}

            <div class="result-buttons">
                {if isset($ricarica) && $ricarica}
                    <a href="{$ricarica}" class="btn-retry">Torna a caricare</a>
                {/if}
                <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            </div>

        </div>
    </main>

</body>
</html>
