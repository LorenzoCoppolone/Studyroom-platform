{extends file="layout/layout.tpl"}

{block name="title"}Risultati ricerca — StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleRicercaMateriale.css">
{/block}

{block name="content"}

{* ─────────────────────────────────────────────────────────────
   Variabili derivate dai dati che view/controller forniscono.
   La view assegna: materiali, paginaCorrente, totalePagine,
   corsiDiLaurea, insegnamenti, filtri (+ studente/base64 per la navbar).
   Qui ricaviamo i valori che il markup usa ma che non arrivano
   direttamente assegnati.
   ───────────────────────────────────────────────────────────── *}

{* Titolo cercato: il controller lo salva in sessione (ricerca_titolo);
   in fallback usiamo l'eventuale titolo presente nei filtri. *}
{assign var="queryCorrente" value=$smarty.session.ricerca_titolo|default:$filtri.titolo|default:''}

{* Criterio di ordinamento attivo (salvato tra i filtri di ricerca). *}
{assign var="ordinamento" value=$filtri.criterio_ordinamento|default:''}

{* URL base per la paginazione: stessa rotta corrente, senza il
   parametro page, con titolo e filtri attivi riportati come query
   string (gli stessi nomi GET letti dai controller). I link
   aggiungono poi "&page=N". *}
{capture assign="urlBasePagina"}{$smarty.server.REQUEST_URI|regex_replace:'/\?.*$/':''}?titolo={$queryCorrente|escape:'url'}&corsoDiLaurea={$filtri.corso_di_laurea|default:''|escape:'url'}&insegnamento={$filtri.insegnamento|default:''|escape:'url'}&tag={$filtri.tag|default:''|escape:'url'}&tipologia={$filtri.tipologia|default:''|escape:'url'}&criterio={$ordinamento|escape:'url'}{/capture}

<!-- ===================== HERO SEARCH ===================== -->
<section class="hero-search">
    <form class="hero-search__form" action="/RicercaMateriale/cerca" method="GET">
        <input
            type="text"
            name="titolo"
            class="hero-search__input"
            placeholder="Cerca un materiale per titolo…"
            value="{$queryCorrente|escape:'html'}"
            maxlength="100"
            required
        >
        <button type="submit" class="hero-search__btn" aria-label="Avvia ricerca">
            <i class="fa fa-magnifying-glass"></i>
        </button>
    </form>
</section>
<!-- ===================== /HERO SEARCH ===================== -->


<!-- ===================== RISULTATI ===================== -->
<section class="results-section">
    <div class="results-grid">

        {if $materiali|@count > 0}

            {foreach $materiali as $mat}

                {assign var="stelle" value=$mat.mediaValutazione|default:0|round}

                <div class="card">

                    {* Link "principale" invisibile: si allunga via CSS a coprire
                       tutta la card (stretched-link). Permette di avere altri link
                       interni (es. recensioni) senza annidare <a> dentro <a>. *}
                    <a class="card__link"
                       href="/RicercaMateriale/dettagli/{$mat.idMateriale|escape}"
                       aria-label="Apri il materiale {$mat.titoloMateriale|escape:'html'}"></a>

                    <div class="card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 96" fill="none">
                            <rect x="4" y="4" width="72" height="88" rx="6" ry="6"
                                  stroke="#1a1a2e" stroke-width="4" fill="white"/>
                            <path d="M52 4 L76 28" stroke="#1a1a2e" stroke-width="4"/>
                            <path d="M52 4 L52 28 L76 28" fill="#ede9fb" stroke="#1a1a2e" stroke-width="4"
                                  stroke-linejoin="round"/>
                            <line x1="14" y1="44" x2="66" y2="44" stroke="#6C4FD4" stroke-width="3.5" stroke-linecap="round"/>
                            <line x1="14" y1="56" x2="66" y2="56" stroke="#6C4FD4" stroke-width="3.5" stroke-linecap="round"/>
                            <line x1="14" y1="68" x2="50" y2="68" stroke="#6C4FD4" stroke-width="3.5" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <div class="card__body">
                        <h2 class="card__title">{$mat.titoloMateriale|escape:'html'}</h2>
                        <p class="card__meta">{$mat.insegnamento|escape:'html'}</p>
                        <p class="card__meta">{$mat.corso_di_Laurea|escape:'html'}</p>
                        <p class="card__meta card__meta--tipo">{$mat.tipologia|escape:'html'}</p>

                        <div class="card__rating" aria-label="Valutazione: {$stelle} su 5">
                            {section name=s loop=5}
                                {if $smarty.section.s.index < $stelle}
                                    <span class="star star--full">★</span>
                                {else}
                                    <span class="star star--empty">★</span>
                                {/if}
                            {/section}
                            <a class="card__rating-count"
                               href="/RecensioneMateriale/recensioni/{$mat.idMateriale|escape}"
                               title="Vedi tutte le recensioni">({$mat.numeroRecensioni|default:0|escape:'html'} recensioni)</a>
                        </div>

                        <div class="card__footer">
                            <div class="card__downloads" aria-label="{$mat.numeroDownload|default:0} download">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="7 10 12 15 17 10"/>
                                    <line x1="12" y1="15" x2="12" y2="3"/>
                                </svg>
                                <span>{$mat.numeroDownload|default:0|escape:'html'}</span>
                            </div>
                        </div>
                    </div>

                </div>

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

    </div>
</section>
<!-- ===================== /RISULTATI ===================== -->


<!-- ===================== PAGINAZIONE ===================== -->
{if $totalePagine >= 1}
<nav class="pagination" aria-label="Navigazione pagine">

    {* Freccia precedente *}
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

    {* Calcolo finestra pagine *}
    {assign var="winStart" value=$paginaCorrente - 2}
    {assign var="winEnd"   value=$paginaCorrente + 2}
    {if $winStart < 1}{assign var="winStart" value=1}{/if}
    {if $winEnd > $totalePagine}{assign var="winEnd" value=$totalePagine}{/if}

    {* Prima pagina *}
    {if $winStart > 1}
        <a href="{$urlBasePagina|escape:'html'}&amp;page=1"
           class="pagination__page {if $paginaCorrente == 1}pagination__page--active{/if}">1</a>
        {if $winStart > 2}
            <span class="pagination__ellipsis">…</span>
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

    {* Ultima pagina *}
    {if $winEnd < $totalePagine}
        {if $winEnd < $totalePagine - 1}
            <span class="pagination__ellipsis">…</span>
        {/if}
        <a href="{$urlBasePagina|escape:'html'}&amp;page={$totalePagine}"
           class="pagination__page {if $paginaCorrente == $totalePagine}pagination__page--active{/if}">
            {$totalePagine}
        </a>
    {/if}

    {* Freccia successiva *}
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
<script src="/../JS/upload.js"></script>

{/block}
