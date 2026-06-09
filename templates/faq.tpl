{extends file="layout.tpl"}

{block name="title"}FAQ - StudyRoom{/block}

{block name="pageCSS"}
<link rel="stylesheet" href="/../CSS/styleInfo.css">
{/block}

{block name="content"}

<section class="info-container">

    <h1 class="info-title">FAQ</h1>

    <details class="faq-item">
        <summary class="faq-question">Posso caricare esami degli anni precedenti?</summary>
        <p class="faq-answer">
            Sì, puoi caricare esami passati purché tu ne abbia la disponibilità. Ricorda che la responsabilità
            del contenuto caricato è esclusivamente dell’utente che lo pubblica.
        </p>
    </details>

    <details class="faq-item">
        <summary class="faq-question">Perché il mio materiale non appare subito nella ricerca?</summary>
        <p class="faq-answer">
            Dopo il caricamento, il sistema potrebbe impiegare qualche minuto per indicizzare il file.
            Inoltre, se hai inserito tag o titolo poco chiari, potrebbe essere più difficile trovarlo.
        </p>
    </details>

    <details class="faq-item">
        <summary class="faq-question">Che tipo di file posso caricare?</summary>
        <p class="faq-answer">
            Sono accettati solo file PDF. Contenuti non pertinenti allo studio vengono rimossi automaticamente.
        </p>
    </details>

</section>

{/block}
