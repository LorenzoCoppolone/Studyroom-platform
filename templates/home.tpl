{extends file="layout.tpl"}

{block name="title"}
    StudyRoom - Home
{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="./CSS/styleHome.css">
{/block}

{block name="content"}

<section class="section-search">

    <h1 class="section-title">Che esame stai preparando?</h1>
    <p class="section-subtitle">Non studiare da solo: usa gli appunti della community</p>

    <div class="search-box">

        <input type="text" placeholder="Inizia a cercare">

        <button class="btn-search-main">
            <i class="fa fa-magnifying-glass"></i>
        </button>
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
{/block}