<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore - StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- LOGO IN ALTO CENTRATO -->
    <header class="result-header">
        <a href="/Home/dashboard" class="logo">StudyRoom</a>
    </header>

    <!-- CONTENITORE CENTRALE -->
    <main>
        <div class="result-container" role="alert">

            <div class="icon error" aria-hidden="true">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>

            <h1 class="result-title">
                {$errore}
            </h1>

            {if isset($dettaglio) && $dettaglio}
                <p class="result-subtitle">{$dettaglio}</p>
            {/if}

            <div class="result-buttons">
                {if isset($riprova) && $riprova}
                    <a href="{$riprova}" class="btn-retry">Riprova</a>
                {/if}
                <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            </div>

        </div>
    </main>

</body>
</html>
