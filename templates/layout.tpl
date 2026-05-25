<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{block name="title"}StudyRoom{/block}</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="./CSS/styleLayout.css">

    <!-- CSS Pagina -->
    {block name="pageCSS"}{/block}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">

        <a href="/home" class="logo">StudyRoom</a>

        <div class="navbar-search">
            <input type="text" placeholder="Cerca...">

            <button class="btn-search">
                <i class="fa fa-magnifying-glass"></i>
            </button>
        </div>

        <nav class="navbar-links">

            <a href="/esami" class="nav-link nav-esami">
                Prepara i tuoi esami
            </a>

            <div class="nav-auth">

                <i class="fa fa-circle-user nav-user-icon"></i>

                <a href="/login" class="nav-link">
                    Accedi /
                </a>

                <a href="/registrazione" class="nav-link">
                    Registrati
                </a>

            </div>

        </nav>

    </header>

    <!-- CONTENUTO PAGINA -->
    <main class="page-content">

        {block name="content"}
        {/block}

    </main>

    <!-- FOOTER -->
    <footer class="footer">

        <a href="https://www.univaq.it"
           target="_blank"
           class="footer-logo-univaq">

            <img src="./img/UnivaqLogo.png"
                 alt="Logo Università degli Studi dell'Aquila">

        </a>

        <div class="footer-center">

            <a href="home.php" class="footer-brand">
                StudyRoom
            </a>

            <nav class="footer-links">
                <a href="chi-siamo.tpl">Chi siamo</a>
                <a href="supporto.tpl">Supporto</a>
                <a href="faq.tpl">FAQ</a>
                <a href="termini.tpl">Termini di utilizzo</a>
            </nav>

        </div>

    </footer>

</body>
</html>
