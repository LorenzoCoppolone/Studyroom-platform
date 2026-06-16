{extends file="layout/layout.tpl"}

{block name="title"}Profilo | StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleProfiloUtente.css">
{/block}

{block name="content"}

<a href="/Home/dashboard" class="back-link"><i class="fa fa-arrow-left"></i> Torna alla home</a>

<section class="profile-card">

    <!-- HEADER: foto + dati + Modifica -->
    <header class="profile-header">

        <div class="profile-photo">
            {if $utente.foto}
                <img src="{$utente.foto}" alt="Foto profilo">
            {else}
                <i class="fa fa-circle-user"></i>
            {/if}
        </div>

        <div class="profile-identity">
            <h1 class="profile-name">{$utente.nome|escape:'html'} {$utente.cognome|escape:'html'}</h1>
            <p class="profile-meta"><i class="fa fa-envelope"></i> {$utente.email|escape:'html'}</p>
            <p class="profile-meta"><i class="fa fa-at"></i> {$utente.username|escape:'html'}</p>

            <a href="/User/modificaProfiloStudente" class="btn btn-primary btn-modifica">
                <i class="fa fa-pen"></i> Modifica
            </a>
        </div>

    </header>

    <hr class="profile-divider">

    <!-- SEZIONI -->
    <nav class="profile-sections">
        <a href="/RicercaMateriale/preferiti" class="section-link">
            <i class="fa fa-heart"></i> Preferiti
        </a>
        <a href="/RicercaMateriale/download" class="section-link">
            <i class="fa fa-download"></i> Scaricati
        </a>
        <a href="/User/cercaRecensioniUtente" class="section-link">
            <i class="fa fa-star"></i> Mie recensioni
        </a>
        <a href="/RicercaMateriale/popolariUtente" class="section-link">
            <i class="fa fa-file-arrow-up"></i> Caricati
        </a>
    </nav>

    <hr class="profile-divider">

    <!-- AZIONI ACCOUNT -->
    <div class="profile-account-actions">
        <a href="/User/recuperoPassword" class="btn btn-secondary">
            <i class="fa fa-key"></i> Modifica password
        </a>
        <a href="/User/Logout" class="btn btn-logout">
            <i class="fa fa-right-from-bracket"></i> Logout
        </a>
    </div>

</section>

{/block}
