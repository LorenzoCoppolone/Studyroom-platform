{extends file="layout.tpl"}

{block name="title"}
    {if $result.type == 'success'}
        Successo - StudyRoom
    {else}
        Errore - StudyRoom
    {/if}
{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="styleResult.css">
{/block}

{block name="content"}

<main class="result-container">

    <!-- Icona dinamica -->
    <div class="icon {$result.type}">
        {if $result.type == 'success'}
            <i class="fa-solid fa-circle-check"></i>
        {else}
            <i class="fa-solid fa-circle-xmark"></i>
        {/if}
    </div>

    <!-- Messaggio dinamico -->
    <h2 class="result-title">
        {$result.message|escape:'html'}
    </h2>

    <!-- Pulsanti -->
    <div class="result-buttons">
        <a href="{$result.homeUrl}" class="btn-home">Torna alla home</a>

        {if $result.type == 'success'}
            <a href="{$result.retryUrl}" class="btn-retry">Continua a caricare</a>
        {else}
            <a href="{$result.retryUrl}" class="btn-retry">Riprova</a>
        {/if}
    </div>

</main>

{/block}
