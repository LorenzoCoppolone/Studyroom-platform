{extends file="layout.tpl"}

{block name="title"}
    StudyRoom - Home
{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="../CSS/styleHome.css">
{/block}

{block name="content"}

<section class="section-search">

    <h1 class="section-title">
        Che esame stai preparando?
    </h1>

    <p class="section-subtitle">
        Non studiare da solo: usa gli appunti della community
    </p>

    <div class="search-box">

        <input type="text" placeholder="Inizia a cercare">

        <button class="btn-search-main">
            <i class="fa fa-magnifying-glass"></i>
        </button>

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

            <div id="dropZone" class="upload-box" role="button" tabindex="0">
                <i class="fa fa-cloud-arrow-up upload-icon"></i>
                <p class="upload-label"><strong>Trascina qui il tuo file o clicca</strong></p>
                <p class="upload-hint">(Appunti, Esami passati, esercizi, ecc)</p>
            </div>

        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">

    <!-- LOGO UNIVAQ A SINISTRA, CLICCABILE -->
    <a href="https://www.univaq.it" target="_blank" class="footer-logo-univaq">
        <img src="UnivaqLogo.png" alt="Logo Università degli Studi dell'Aquila">    
    </a>

    <!-- BRAND STUDYROOM E LINK CENTRALI -->
    <div class="footer-center">
        <a href="home.html" class="footer-brand">StudyRoom</a>

        <nav class="footer-links">
            <a href="chi-siamo.html">Chi siamo</a>
            <a href="supporto.html">Supporto</a>
            <a href="faq.html">FAQ</a>
            <a href="termini.html">Termini di utilizzo</a>
        </nav>
    </div>

</section>

<section class="section-upload">

    <div class="upload-text">

        <h2 class="upload-title">
            Condividi il tuo materiale
        </h2>

        <p class="upload-subtitle">
            Entra a far parte della community
        </p>

    </div>

    <a href="carica.tpl" class="upload-box">

        <i class="fa fa-cloud-arrow-up upload-icon"></i>

        <p class="upload-label">
            <strong>Carica File</strong>
        </p>

        <p class="upload-hint">
            (Appunti, Esami passati, esercizi, ecc)
        </p>

    </a>

</section>

{/block}