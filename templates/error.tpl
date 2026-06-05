<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore - StudyRoom</title>
    <link rel="stylesheet" href="/../CSS/styleResult.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <header class="result-header">
        <a href="/Home/dashboard" class="logo">StudyRoom</a>
    </header>

    <main class="result-container">

        <div class="icon error">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <h2 class="result-title">
            {$errore} 
        </h2>

        <div class="result-buttons">
            <a href="/Home/dashboard" class="btn-home">Torna alla home</a>
        </div>

    </main>

</body>
</html>
