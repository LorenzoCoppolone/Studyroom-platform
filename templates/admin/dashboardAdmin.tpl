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
{if $totPage >= 1}
<nav class="pagination" aria-label="Navigazione pagine">

    {if $page > 1}
        <a href="/Admin/dashboard/?pagina={$page - 1}"
           class="pagination__btn" aria-label="Pagina precedente">
            <i class="fa fa-chevron-left"></i>
        </a>
    {else}
        <span class="pagination__btn pagination__btn--disabled" aria-disabled="true">
            <i class="fa fa-chevron-left"></i>
        </span>
    {/if}

    {for $p = 1 to $totPage}
        {if $p == $page}
            <span class="pagination__page pagination__page--active" aria-current="page">{$p}</span>
        {else}
            <a href="/Admin/dashboard/?pagina={$p}" class="pagination__page">{$p}</a>
        {/if}
    {/for}

    {if $page < $totPage}
        <a href="/Admin/dashboard/?pagina={$page + 1}"
           class="pagination__btn" aria-label="Pagina successiva">
            <i class="fa fa-chevron-right"></i>
        </a>
    {else}
        <span class="pagination__btn pagination__btn--disabled" aria-disabled="true">
            <i class="fa fa-chevron-right"></i>
        </span>
    {/if}

</nav>
{/if}
</body>
</html>