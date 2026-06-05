<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{block name="title"}StudyRoom{/block}</title>

    <!-- CSS Layout -->
    <link rel="stylesheet" href="/../CSS/styleLayout.css">

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

        <a href="/Home/dashboard" class="logo">StudyRoom</a>

        <form class="navbar-search" method="GET" action="/RicercaMateriale/cerca">
            <input type="text" name="titolo" placeholder="Cerca..." maxlength="100" required>
            <button class="btn-search" type="submit">
                <i class="fa fa-magnifying-glass"></i>
            </button>
        </form>


        <nav class="navbar-links">

            <a href="/RicercaMateriale/popolari" class="nav-link nav-esami">
                Prepara i tuoi esami
            </a>

            <div class="nav-auth">

                {if $studente}

                    <!-- FOTO PROFILO -->
                    <div class="nav-user-avatar">
                    <img src="$base64" alt="Foto profilo">
                    </div>

                    <!-- USERNAME -->
                    <a href="/User/profiloStudente" class="nav-user-name">{$studente}</a>


                    <!-- LOGOUT -->
                    <a href="/User/logoutUtente" class="nav-link">
                        Esci
                    </a>

                {else}

                    <!-- ICONA DEFAULT -->
                    <i class="fa fa-circle-user nav-user-icon"></i>

                    <a href="/User/login" class="nav-link">
                        Accedi /
                    </a>

                    <a href="/User/registrazione" class="nav-link">
                       Registrati
                    </a>

                {/if}

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

            <img src="/../img/UnivaqLogo.png"
                 alt="Logo Università degli Studi dell'Aquila">

        </a>

        <div class="footer-center">

            <a href="/Home/dashboard" class="footer-brand">StudyRoom</a>

            <nav class="footer-links">
                <a href="/Info/chiSiamo">Chi siamo</a>
                <a href="/Info/supporto">Supporto</a>
                <a href="/Info/faq">FAQ</a>
                <a href="/Info/termini">Termini di utilizzo</a>
            </nav>

        </div>

    </footer>

</body>
</html>
