<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name="titolo"}StudyRoom{/block}</title>

    {* Bootstrap 5 CSS *}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/studyroom-platform/CSS/styleLayout.css" rel="stylesheet">
    {* Bootstrap Icons *}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {* Google Fonts: Courier Prime (brand/headings) + DM Sans (body) *}
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">


    {block name="stili"}{/block}
</head>
<body>

    {* ══════════════════════════════════════════
       NAVBAR
    ══════════════════════════════════════════ *}
    <nav class="sr-navbar d-flex align-items-center gap-3">

        {* Brand *}
        <a href="/home" class="sr-brand me-2">StudyRoom</a>

        {* Search bar *}
        <div class="sr-nav-search">
        <form action="/cerca" method="post">
            <input type="text" name="q" placeholder="Cerca" aria-label="Cerca">
            <button class="sr-nav-search-btn" type="submit" aria-label="Cerca">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

        {* Slogan — hidden on small screens *}
       <a href="/materialiPopolari" class="sr-slogan d-none d-md-inline ms-auto me-auto">
        Prepara i tuoi esami 
       </a>

        {* User chip — pushed to the right on small screens *}
        <div class="ms-auto ms-md-0">
            <a href="/profilo" class="sr-user-chip">
                {if isset($studente.foto) && $studente.foto != ''}
                    <img src="{$studente.foto|escape}" alt="Avatar" class="sr-avatar">
                {else}
                    <span class="sr-avatar-icon"><i class="bi bi-person-fill"></i></span>
                {/if}
                <span>{$studente.username|escape|default:'Ospite'}</span>
            </a>
        </div>

    </nav>

    {* ══════════════════════════════════════════
       CONTENUTO PAGINA
    ══════════════════════════════════════════ *}
    <main>
        {block name="contenuto"}{/block}
    </main>

    {* ══════════════════════════════════════════
       FOOTER
    ══════════════════════════════════════════ *}
    <footer class="sr-footer">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

            {* Logo università *}
            <div class="d-flex align-items-center gap-2">
                {if isset($logo_universita) && $logo_universita != ''}
                    <img src="{$logo_universita|escape}" alt="Logo Università" class="sr-univ-logo">
                {else}
                    {* placeholder testuale se il logo non è disponibile *}
                    <span class="text-muted" style="font-size:.75rem; line-height:1.2; font-weight:600;">UNIVERSITÀ<br>DEGLI STUDI<br>DELL'AQUILA</span>
                {/if}
            </div>

            {* Brand + link *}
            <div class="text-center">
                <div class="sr-brand-footer mb-1">StudyRoom</div>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/chi-siamo">Chi siamo</a>
                    <a href="/supporto">Supporto</a>
                    <a href="/faq">FAQ</a>
                    <a href="/termini">Termini di utilizzo</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
