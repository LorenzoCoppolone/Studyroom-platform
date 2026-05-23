<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom – Cerca materiale</title>
    <link rel="stylesheet" href="css/search_results.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- ===================== HEADER ===================== -->
<header class="site-header">
    <div class="header-inner">

        <a href="index.php" class="logo">StudyRoom</a>

        <form class="header-search" action="search.php" method="GET">
            <input
                type="text"
                name="titolo"
                class="header-search__input"
                placeholder="Cerca"
                value="{$queryCorrente|escape:'html'}"
            >
            <button type="submit" class="header-search__btn" aria-label="Cerca">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>
        </form>

        <nav class="header-nav">
            <a href="esami.php" class="header-nav__link">Prepara i tuoi esami</a>
            <a href="auth.php"  class="header-nav__link header-nav__link--auth">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Accedi&nbsp;/&nbsp;Registrati
            </a>
        </nav>

    </div>
</header>
<!-- ===================== /HEADER ===================== -->


<!-- ===================== HERO SEARCH ===================== -->
<section class="hero-search">
    <form class="hero-search__form" action="search.php" method="GET">
        <input
            type="text"
            name="q"
            class="hero-search__input"
            placeholder="materiale cercato"
            value="{$queryCorrente|escape:'html'}"
        >
        <button type="submit" class="hero-search__btn" aria-label="Avvia ricerca">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </button>
    </form>
</section>
<!-- ===================== /HERO SEARCH ===================== -->


<!-- ===================== FILTRI ===================== -->
<section class="filters-bar">
    <div class="filters-bar__inner">

        <!-- FORM UNICO -->
        <form id="filter-form" action="search.php" method="GET">

            <!-- Mantieni la query corrente -->
            <input type="hidden" name="q" value="{$queryCorrente|escape:'html'}">
            <input type="hidden" name="page" value="1">

            <div class="filters-bar__pills">

                <!-- Corso di Laurea -->
                <div class="filter-pill {if $filtri.corsoDiLaurea}filter-pill--active{/if}">
                   <select name="corsoDiLaurea" id="select-corso" class="filter-pill__select">
                        <option value="">Corso di Laurea</option>
                        {foreach $corsiDiLaurea as $corso}
                            <option value="{$corso.id|escape:'html'}"
                                {if $filtri.corsoDiLaurea == $corso.id}selected{/if}>
                                {$corso.nome|escape:'html'}
                            </option>
                        {/foreach}
                    </select>
                </div>


<!-- Insegnamento -->

            <div class="filter-pill 
                    {if $filtri.insegnamento}filter-pill--active{/if}
                    {if !$filtri.corsoDiLaurea}filter-pill--disabled{/if}">
                    <select id="select-insegnamento"
        name="insegnamento"
        class="filter-pill__select"
        {if !$filtri.corsoDiLaurea}disabled{/if}>
    <option value="">Insegnamento</option>

    {foreach $insegnamenti as $ins}
        <option value="{$ins.id|escape:'html'}"
                data-corso-id="{$ins.corsoDiLaureaId|escape:'html'}"
                {if $filtri.insegnamento == $ins.id}selected{/if}>
            {$ins.nome|escape:'html'}
        </option>
    {/foreach}
</select>

</div>


                <!-- Tag -->
                <div class="filter-pill {if $filtri.tag}filter-pill--active{/if}">
                    <select name="tag" class="filter-pill__select">
                        <option value="">Tag</option>
                        {foreach $tags as $tag}
                            <option value="{$tag.id|escape:'html'}"
                                {if $filtri.tag == $tag.id}selected{/if}>
                                {$tag.nome|escape:'html'}
                            </option>
                        {/foreach}
                    </select>
                </div>

                <!-- Tipologia -->
                <div class="filter-pill {if $filtri.tipologia}filter-pill--active{/if}">
                    <select name="tipologia" class="filter-pill__select">
                        <option value="">Tipologia</option>

                        <option value="appunto"
                            {if $filtri.tipologia == 'appunto'}selected{/if}>
                            Appunto
                        </option>

                        <option value="esame"
                            {if $filtri.tipologia == 'esame'}selected{/if}>
                            Esame
                        </option>
                    </select>
                </div>

            </div><!-- /.filters-bar__pills -->

            <!-- BOTTONE APPLICA FILTRI -->
            <button type="submit" class="btn-applica-filtri">
                Applica filtri
            </button>

        </form>

        <!-- Ordina per -->
        <div class="sort-bar">
            <span class="sort-bar__label">
                <svg class="sort-bar__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><polyline points="5 12 12 5 19 12"/>
                    <line x1="12" y1="19" x2="12" y2="5"/><polyline points="19 12 12 19 5 12"/>
                </svg>
                Ordina per
            </span>

            <select name="ordinamento" form="filter-form" class="sort-bar__select">
                <option value="rilevanza"   {if $ordinamento == 'rilevanza'}selected{/if}>Rilevanza</option>
                <option value="recente"     {if $ordinamento == 'recente'}selected{/if}>Più recente</option>
                <option value="scaricati"   {if $ordinamento == 'scaricati'}selected{/if}>Più scaricati</option>
                <option value="valutazione" {if $ordinamento == 'valutazione'}selected{/if}>Valutazione</option>
            </select>
        </div>

    </div><!-- /.filters-bar__inner -->
</section>
<!-- ===================== /FILTRI ===================== -->


<!-- ===================== RISULTATI ===================== -->
<main class="results-section">
    <div class="results-grid">

        {if $materiali|@count > 0}

            {foreach $materiali as $mat}

                {* Ogni card è un link verso la pagina di dettaglio del materiale *}
                <a href="materiale.php?id={$mat.idMateriale|escape:'url'}"
                   class="card"
                   aria-label="Apri {$mat.titolo|escape:'html'}">

                    <!-- Icona documento -->
                    <div class="card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 96" fill="none">
                            <!-- corpo documento -->
                            <rect x="4" y="4" width="72" height="88" rx="6" ry="6"
                                  stroke="#1a1a2e" stroke-width="4" fill="white"/>
                            <!-- orecchio pagina in alto a destra -->
                            <path d="M52 4 L76 28" stroke="#1a1a2e" stroke-width="4"/>
                            <path d="M52 4 L52 28 L76 28" fill="#e8e0ff" stroke="#1a1a2e" stroke-width="4"
                                  stroke-linejoin="round"/>
                            <!-- righe di testo -->
                            <line x1="14" y1="44" x2="66" y2="44" stroke="#6c63ff" stroke-width="3.5" stroke-linecap="round"/>
                            <line x1="14" y1="56" x2="66" y2="56" stroke="#6c63ff" stroke-width="3.5" stroke-linecap="round"/>
                            <line x1="14" y1="68" x2="50" y2="68" stroke="#6c63ff" stroke-width="3.5" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <!-- Meta info -->
                    <div class="card__body">
                        <h2 class="card__title">{$mat.titolo|escape:'html'}</h2>
                        <p class="card__meta">{$mat.insegnamento|escape:'html'}</p>
                        <p class="card__meta">{$mat.corsoDiLaurea|escape:'html'}</p>
                        <p class="card__meta card__meta--tipo">{$mat.tipologia|escape:'html'}</p>

                        <!-- Stelle valutazione -->
                        <div class="card__rating" aria-label="Valutazione: {$mat.valutazione} su 5">
                            {section name=s loop=5}
                                {if $smarty.section.s.index < $mat.valutazione}
                                    <span class="star star--full" aria-hidden="true">★</span>
                                {else}
                                    <span class="star star--empty" aria-hidden="true">★</span>
                                {/if}
                            {/section}
                            <span class="card__rating-count">({$mat.numValutazioni|escape:'html'})</span>
                        </div>

                        <!-- Download count -->
                        <div class="card__downloads" aria-label="{$mat.numDownload} download">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 aria-hidden="true">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            <span>{$mat.numDownload|escape:'html'}</span>
                        </div>
                    </div><!-- /.card__body -->

                </a><!-- /.card -->

            {/foreach}

        {else}

            <div class="results-empty">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    <line x1="8" y1="11" x2="14" y2="11"/>
                </svg>
                <p>Nessun materiale trovato per la tua ricerca.</p>
                <span>Prova a modificare i filtri o la parola chiave.</span>
            </div>

        {/if}

    </div><!-- /.results-grid -->
</main>
<!-- ===================== /RISULTATI ===================== -->


<!-- ===================== PAGINAZIONE ===================== -->
{*
    Variabili attese dal controller PHP:
      $paginaCorrente  (int)     – pagina attiva (1-based)
      $totalePagine    (int)     – numero totale di pagine
      $urlBasePagina   (string)  – URL con tutti i parametri GET tranne 'page'
                                   es. "search.php?q=analisi&corsoDiLaurea=3"
                                   Il controller la costruisce così:
                                   $params = $_GET; unset($params['page']);
                                   $urlBase = 'search.php?' . http_build_query($params);
*}
{if $totalePagine > 1}
<nav class="pagination" aria-label="Navigazione pagine">

    {* ---- Freccia precedente ---- *}
    {if $paginaCorrente > 1}
        <a href="{$urlBasePagina|escape:'html'}&amp;page={$paginaCorrente - 1}"
           class="pagination__btn pagination__btn--prev"
           aria-label="Pagina precedente">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </a>
    {else}
        <span class="pagination__btn pagination__btn--prev pagination__btn--disabled" aria-disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </span>
    {/if}

    {* ---- Numeri di pagina con logica finestra ---- *}
    {*
        Mostra sempre: prima pagina, ultima pagina, e una finestra di 2 pagine
        attorno a quella corrente. Le lacune vengono colmate con "…"
    *}
    {assign var="winStart" value=$paginaCorrente - 2}
    {assign var="winEnd"   value=$paginaCorrente + 2}
    {if $winStart < 1}{assign var="winStart" value=1}{/if}
    {if $winEnd > $totalePagine}{assign var="winEnd" value=$totalePagine}{/if}

    {* Prima pagina sempre visibile *}
    {if $winStart > 1}
        <a href="{$urlBasePagina|escape:'html'}&amp;page=1"
           class="pagination__page {if $paginaCorrente == 1}pagination__page--active{/if}">1</a>
        {if $winStart > 2}
            <span class="pagination__ellipsis" aria-hidden="true">…</span>
        {/if}
    {/if}

    {* Finestra centrale *}
    {for $p = $winStart to $winEnd}
        {if $p == $paginaCorrente}
            <span class="pagination__page pagination__page--active" aria-current="page">{$p}</span>
        {else}
            <a href="{$urlBasePagina|escape:'html'}&amp;page={$p}"
               class="pagination__page">{$p}</a>
        {/if}
    {/for}

    {* Ultima pagina sempre visibile *}
    {if $winEnd < $totalePagine}
        {if $winEnd < $totalePagine - 1}
            <span class="pagination__ellipsis" aria-hidden="true">…</span>
        {/if}
        <a href="{$urlBasePagina|escape:'html'}&amp;page={$totalePagine}"
           class="pagination__page {if $paginaCorrente == $totalePagine}pagination__page--active{/if}">
            {$totalePagine}
        </a>
    {/if}

    {* ---- Freccia successiva ---- *}
    {if $paginaCorrente < $totalePagine}
        <a href="{$urlBasePagina|escape:'html'}&amp;page={$paginaCorrente + 1}"
           class="pagination__btn pagination__btn--next"
           aria-label="Pagina successiva">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>
    {else}
        <span class="pagination__btn pagination__btn--next pagination__btn--disabled" aria-disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </span>
    {/if}

</nav>
{/if}
<!-- ===================== /PAGINAZIONE ===================== -->


<!-- ===================== FOOTER ===================== -->
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-logo-wrap">
            <img src="img/logo-aquila.png" alt="Università degli Studi dell'Aquila" class="footer-uni-logo">
        </div>

        <div class="footer-brand">
            <span class="logo">StudyRoom</span>
        </div>

        <nav class="footer-nav">
            <a href="chi-siamo.php"        class="footer-nav__link">Chi siamo</a>
            <a href="supporto.php"         class="footer-nav__link">Supporto</a>
            <a href="faq.php"              class="footer-nav__link">FAQ</a>
            <a href="termini-utilizzo.php" class="footer-nav__link">Termini di utilizzo</a>
        </nav>
    </div>
</footer>
<!-- ===================== /FOOTER ===================== -->

<script src="js/SelectDipendenti.js"></script>
</body>
</html>