<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carica Materiale - StudyRoom</title>

    <link rel="stylesheet" href="../CSS/styleCarica.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <a href="home.html" class="logo">StudyRoom</a>
    </header>

    <!-- MAIN -->
    <main class="upload-container">

        <!-- TIPO DOCUMENTO -->
        <div class="type-selector">
            <button id="btnAppunto" class="type-btn active">Appunto</button>
            <button id="btnEsame" class="type-btn">Esame</button>
        </div>

        <!-- FILE UPLOAD -->
        <label class="upload-box">
            <input type="file" id="fileInput" hidden>
            <div class="upload-content">
                <p class="upload-title">Scegli file</p>
                <p class="upload-info">Max 2MB • Formato PDF</p>
                <button class="upload-btn">Upload <i class="fa fa-hand-pointer"></i></button>
            </div>
            <div class="error-msg" id="err-file"></div>
            <div id="fileName" class="file-name"></div>
        </label>

        <!-- FORM -->
        <div class="form-section">

            <!-- CORSO DI LAUREA -->
            <div class="form-group">
                <label>Corso di Laurea</label>
                <input type="text" id="cdlInput" placeholder="Seleziona corso di laurea">
                <div id="cdlList" class="dropdown"></div>
                <div class="error-msg" id="err-cdl"></div>
            </div>

            <!-- INSEGNAMENTO -->
            <div class="form-group">
                <label>Insegnamento</label>
                <input type="text" id="insInput" placeholder="Seleziona prima corso di laurea" disabled>
                <div id="insList" class="dropdown"></div>
                <div class="error-msg" id="err-ins"></div>
            </div>

            <!-- TITOLO -->
            <div class="form-group">
                <label>Titolo</label>
                <input type="text" id="titoloInput" placeholder="es. Programmazione Web">
                <div class="error-msg" id="err-titolo"></div>
            </div>

            <!-- TAG -->
            <div class="form-group">
                <label>Tag</label>
                <select id="tagSelect">
                    <option value="">Seleziona tipo</option>
                    <option value="Riassunto">Riassunto</option>
                    <option value="Note">Note</option>
                    <option value="Esercizi">Esercizi</option>
                </select>
                <div class="error-msg" id="err-tag"></div>
            </div>

            <!-- CHECKBOX -->
            <div class="form-check">
                <input type="checkbox" id="termsCheck">
                <label for="termsCheck">Termini e Condizioni</label>
            </div>
            <div class="error-msg" id="err-terms"></div>
        </div>

        <!-- BOTTONI -->
        <div class="buttons">
            <a href="home.html" class="btn-home"><i class="fa fa-arrow-left"></i> Home</a>
            <button id="btnCarica" class="btn-upload">Carica <i class="fa fa-arrow-up"></i></button>
        </div>

    </main>

    <script src="../JS/upload.js"></script>
</body>
</html>
