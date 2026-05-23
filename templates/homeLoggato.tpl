{extends file="layout.tpl"}

{block name="titolo"}StudyRoom – Home{/block}

{* ── Stili specifici di questa pagina ── *}
{block name="stili"}
<link rel="stylesheet" href="/studyroom-platform/CSS/styleHome.css">
{/block}

{block name="contenuto"}

    {* ── HERO ── *}
    <section class="sr-hero">
        <h1 class="sr-hero-title">Che esame stai preparando?</h1>
        <p class="sr-hero-subtitle">Non studiare da solo: usa gli appunti della community</p>

        <form action="/cerca" method="get" class="d-flex justify-content-center">
            <div class="sr-search-wrap">
                <input
                    type="text"
                    name="q"
                    placeholder="Inizia a cercare"
                    aria-label="Cerca un esame"
                    autocomplete="off"
                >
                <button type="submit" aria-label="Cerca">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </section>

    {* ── SHARE MATERIAL ── *}
    <section class="sr-share-section">
        <div class="row align-items-center g-4">

            {* Testo sinistro *}
            <div class="col-12 col-md-6">
                <h2 class="sr-share-title">Condividi il tuo materiale</h2>
                <p class="sr-share-subtitle">Entra a far parte della community</p>
            </div>

            {* Drop-zone destra *}
            <div class="col-12 col-md-6">
                <div
                    class="sr-upload-zone"
                    id="dropZone"
                    role="button"
                    tabindex="0"
                    aria-label="Carica file"
                    onclick="location.href='/avviaCaricamento'"
                >
        <i class="bi bi-cloud-arrow-up sr-upload-icon"></i>
        <span class="sr-upload-label">Carica File</span>
        <span class="sr-upload-hint">(Appunti, Esami passati, esercizi, ecc)</span>
        </div>
    </div>
    </section>
{/block}