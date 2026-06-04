<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carica Materiale - StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleCarica.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<header class="navbar">
    <a href="/Home/dashboard" class="logo">StudyRoom</a>
</header>

<main class="upload-container">

    <!-- TIPO DOCUMENTO -->
    <div class="type-selector">
        <button id="btnAppunto" class="type-btn {if $tipo == 'appunto'}active{/if}">Appunto</button>
        <button id="btnEsame" class="type-btn {if $tipo == 'esame'}active{/if}">Esame</button>
    </div>

    <!-- FORM PRINCIPALE -->
    <form method="POST" enctype="multipart/form-data" action="/CaricaMateriale/salva">
        <input type="hidden" name="tipo" id="tipoInput" value="{$tipo|default:'appunto'}">


        <!-- FILE UPLOAD -->
        <label class="upload-box">
            <input type="file" name="file" id="fileInput" accept="application/pdf" required hidden>
            <div class="upload-content">
                <p class="upload-title">Scegli file</p>
                <p class="upload-info">Max 2MB • Formato PDF</p>
                <button type="button" class="upload-btn">Upload <i class="fa fa-hand-pointer"></i></button>
            </div>
            <div class="error-msg">
                {$errors.file|default:''}
            </div>
            <div id="fileName" class="file-name"></div>
        </label>

        <!-- CORSO DI LAUREA -->
        <div class="form-group">
            <label>Corso di Laurea</label>
            <select name="cdl" id="cdlSelect" required onchange="this.form.submit()">
                <option value="">Seleziona corso di laurea</option>
                {foreach $corsi as $c}
                    <option value="{$c.id}" {if $selectedCdl == $c.id}selected{/if}>{$c.nome}</option>
                        {$c.nome}
                    </option>
                {/foreach}
            </select>
            <div class="error-msg">{$errors.cdl|default:''}</div>
        </div>

        <!-- INSEGNAMENTO -->
        <div class="form-group">
            <label>Insegnamento</label>
            <select name="insegnamento" id="insSelect" {if !$selectedCdl}disabled{/if} required>
                <option value="">Seleziona insegnamento</option>
                {foreach $insegnamenti as $i}
                    <option value="{$i.id}" {if $selectedIns == $i.id}selected{/if}>{$i.nome}</option>

                {/foreach}
            </select>
            <div class="error-msg">{$errors.ins|default:''}</div>
        </div>

        <!-- TITOLO -->
        <div class="form-group">
            <label>Titolo</label>
            <input type="text" name="titolo" id="titoloInput" required
                placeholder="es. Programmazione Web"
                value="{$titolo|default:''}">

            <div class="error-msg">{$errors.titolo|default:''}</div>
        </div>

        <!-- TAG (solo Appunto) -->
        <div class="form-group">
            <label>Tag</label>
            <select name="tag" id="tagSelect" {if $tipo == 'esame'}disabled{/if}>
                <option value="">Seleziona tipo</option>
                <option value="Riassunto">Riassunto</option>
                <option value="Note">Note</option>
                <option value="Esercizi">Esercizi</option>
            </select>
            <div class="error-msg">{$errors.tag|default:''}</div>
        </div>

        <!-- CHECKBOX -->
        <div class="form-check">
            <input type="checkbox" name="terms" id="termsCheck" required>
            <label for="termsCheck">Termini e Condizioni</label>
        </div>
        <div class="error-msg">{$errors.terms|default:''}</div>

        <!-- BOTTONI -->
        <div class="buttons">
            <a href="/Home/dashboard" class="btn-home"><i class="fa fa-arrow-left"></i> Home</a>
            <button type="submit" class="btn-upload">Carica <i class="fa fa-arrow-up"></i></button>
        </div>

    </form>

</main>

<script src="/../JS/upload.js"></script>
</body>
</html>

