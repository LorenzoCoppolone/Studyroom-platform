<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | StudyRoom</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rajdhani:wght@700&family=Exo+2:wght@700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../CSS/styleAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">
</head>
<body>

<header>
    <span class="logo">StudyRoom</span>
    <a href="/User/Logout" class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</header>

<main>
    <h1 class="page-title">Dashboard Admin</h1>

    <!-- Tabella segnalazioni -->
    <div class="table-card">
        <div class="table-header">
            <span>Titolo</span>
            <span>N° Segnalazioni</span>
            <span>Azione</span>
        </div>

        {if $segnalazioni}
            {foreach $segnalazioni as $s}
            <div class="table-row">
                <span class="titolo-cell">{$s.titoloMateriale|escape}</span>
                <span>
                    <span class="badge" >
                         {$s.numeroSegnalazioni}
                    </span>
                </span>
                <span>
                    <a href="/Admin/gestisciSegnalazione/{$s.idMateriale|escape}" class="btn-gestisci">
                        Gestisci
                    </a>
                </span>
            </div>
            {/foreach}
        {else} 
            <div class="empty">Nessuna segnalazione presente.</div>
        {/if}
    </div>
    
</main>

    {* ===================== PAGINAZIONE ===================== *}
{if $totalePagine >= 1}
<nav class="pagination" aria-label="Navigazione pagine">

    {* Freccia precedente *}
    {if $paginaCorrente > 1}
        <a href="{$urlBasePagina|escape:'html'}?page={$paginaCorrente - 1}"
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
        <a href="{$urlBasePagina|escape:'html'}?page=1"
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
            <a href="{$urlBasePagina|escape:'html'}?page={$p}"
               class="pagination__page">{$p}</a>
        {/if}
    {/for}

    {* Ultima pagina *}
    {if $winEnd < $totalePagine}
        {if $winEnd < $totalePagine - 1}
            <span class="pagination__ellipsis">…</span>
        {/if}
        <a href="{$urlBasePagina|escape:'html'}?page={$totalePagine}"
           class="pagination__page {if $paginaCorrente == $totalePagine}pagination__page--active{/if}">
            {$totalePagine}
        </a>
    {/if}

    {* Freccia successiva *}
    {if $paginaCorrente < $totalePagine}
        <a href="{$urlBasePagina|escape:'html'}?page={$paginaCorrente + 1}"
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
</body>
</html>