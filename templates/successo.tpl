<!DOCTYPE html>
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
            <?= htmlspecialchars($successo ?? "Operazione completata con successo!") ?>
        </h2>

        <div class="result-buttons">
            <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
            <a href="/CaricaMateriale/carica" class="btn-retry">Continua a caricare</a>
        </div>

    </main>

</body>
</html>
