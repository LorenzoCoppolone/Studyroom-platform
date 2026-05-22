<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom - UNIVAQ</title>

    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleHome.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <a href="home.php" class="logo">StudyRoom</a>

        <div class="navbar-search">
            <input type="text" placeholder="Cerca...">
            <button class="btn-search"><i class="fa fa-magnifying-glass"></i></button>
        </div>

        <nav class="navbar-links">
            <a href="esami.php" class="nav-link nav-esami">Prepara i tuoi esami</a>

            <a href="notifiche.php" class="nav-icon" title="Notifiche">
                <i class="fa fa-bell"></i>
            </a>

            <!-- UTENTE LOGGATO -->
        <div class="nav-auth nav-auth-logged">
            {if $profile_image}
                <img src="{$profile_image}" alt="Profilo utente" class="nav-user-avatar">
            {else}
                {* Icona di default, NON immagine *}
                <i class="fa fa-circle-user nav-user-icon-default"></i>
            {/if}

                <span class="nav-username">{$username}</span>
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main>

        <!-- SEZIONE RICERCA -->
        <section class="section-search">
            <h1 class="section-title">Che esame stai preparando?</h1>
            <p class="section-subtitle">Non studiare da solo: usa gli appunti della community</p>

            <div class="search-box">
                <input type="text" placeholder="Inizia a cercare">
                <button class="btn-search-main"><i class="fa fa-magnifying-glass"></i></button>
            </div>
        </section>

        <!-- SEZIONE UPLOAD -->
        <section class="section-upload">
            <div class="upload-text">
                <h2 class="upload-title">Condividi il tuo materiale</h2>
                <p class="upload-subtitle">Entra a far parte della community</p>
            </div>

            <a href="carica.php" class="upload-box">
                <i class="fa fa-cloud-arrow-up upload-icon"></i>
                <p class="upload-label"><strong>Carica File</strong></p>
                <p class="upload-hint">(Appunti, Esami passati, esercizi, ecc)</p>
            </a>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-logo-univaq">
            <img src="univaq-logo.png" alt="Logo Università degli Studi dell'Aquila">
            <div class="footer-univaq-text">
                <span>UNIVERSITÀ</span>
                <span>DEGLI STUDI</span>
                <span>DELL'AQUILA</span>
            </div>
        </div>

        <div class="footer-center">
            <a href="index.php" class="footer-brand">StudyRoom</a>

            <nav class="footer-links">
                <a href="chi-siamo.php">Chi siamo</a>
                <a href="supporto.php">Supporto</a>
                <a href="faq.php">FAQ</a>
                <a href="termini.php">Termini di utilizzo</a>
            </nav>
        </div>
    </footer>

</body>
</html>
