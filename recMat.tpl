{extends file="layout.tpl"}

{block name="title"}Recensioni| StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleRecensioniUtente.css">
{/block}

{block name="content"}

<section class="reviews-wrapper">

    <h1 class="reviews-title"><i class="fa fa-star"></i> Recensioni</h1>

    {if $recensioni|@count > 0}

        <div class="reviews-list">

            {foreach $recensioni as $rec}

                {assign var="stelle" value=$rec.votoRecensione|default:0|round}

                <article class="review-card">

                    <header class="review-card__head">
                        <span class="review-card__material">
                            <i class="fa fa-circle-user"></i>
                            {$rec.nomeStudente|escape:'html'}
                        </span>

                        <div class="review-card__rating" aria-label="Valutazione: {$stelle} su 5">
                            {section name=s loop=5}
                                {if $smarty.section.s.index < $stelle}
                                    <span class="star star--full">★</span>
                                {else}
                                    <span class="star star--empty">★</span>
                                {/if}
                            {/section}
                            <span class="review-card__rating-value">{$rec.votoRecensione|default:0}/5</span>
                        </div>
                    </header>

                    <p class="review-card__comment">{$rec.commentoRecensione|escape:'html'}</p>

                </article>

            {/foreach}

        </div>

    {else}

        <div class="reviews-empty">
            <div class="reviews-empty__icon">
                <i class="fa fa-star"></i>
            </div>
            <p class="reviews-empty__title">Questo materiale non ha ancora recensioni</p>
            <span class="reviews-empty__text">
                Sii il primo a lasciare una valutazione: le recensioni compariranno qui.
            </span>
            <a href="/RicercaMateriale/dettagli/{$idMateriale|escape}" class="reviews-empty__btn">
                <i class="fa fa-arrow-left"></i> Vai al materiale
            </a>
        </div>

    {/if}

</section>

{* ===================== PAGINAZIONE ===================== *}
{if $totPage >= 1}
<nav class="pagination" aria-label="Navigazione pagine">

    {if $page > 1}
        <a href="/recensioneMateriale/mostraRecensioniMateriale/{$idMateriale|escape}?pagina={$page - 1}"
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
            <a href="/recensioneMateriale/mostraRecensioniMateriale/{$idMateriale|escape}?pagina={$p}" class="pagination__page">{$p}</a>
        {/if}
    {/for}

    {if $page < $totPage}
        <a href="/recensioneMateriale/mostraRecensioniMateriale/{$idMateriale|escape}?pagina={$page + 1}"
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

{/block}