{extends file="layout.tpl"}

{block name="title"}Carica Materiale - StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleCarica.css">
{/block}

{block name="content"}

<section class="upload-card">

    <h1 class="upload-card-title"><i class="fa fa-cloud-arrow-up"></i> Carica materiale</h1>

    {* Errore globale *}
    {if isset($errore)}
        <p class="upload-error">{$errore|escape:'html'}</p>
    {/if}

    <!-- TIPO DOCUMENTO -->
    <div class="type-selector">
        <button type="button" id="btnAppunto" class="type-btn {if $tipo != 'esame'}active{/if}">Appunto</button>
        <button type="button" id="btnEsame" class="type-btn {if $tipo == 'esame'}active{/if}">Esame</button>
    </div>

    <!-- FORM PRINCIPALE -->
    <form method="POST" enctype="multipart/form-data" action="/CaricaMateriale/salva" class="upload-form">
        <input type="hidden" name="tipo" id="tipoInput" value="{$tipo|default:'appunto'}">

        <!-- FILE UPLOAD -->
        <label class="upload-box">
            <input type="file" name="file" id="fileInput" accept="application/pdf" required hidden>
            <div class="upload-content">
                <i class="fa fa-file-pdf upload-box-icon"></i>
                <p class="upload-title">Scegli file</p>
                <p class="upload-info">Max 2MB &bull; Formato PDF</p>
                <span class="btn btn-primary upload-btn">Upload <i class="fa fa-hand-pointer"></i></span>
            </div>
            <div id="fileName" class="file-name"></div>
        </label>
        <div class="error-msg">{$errors.file|default:''}</div>

        <!-- CORSO DI LAUREA (ricerca: scrivi e scegli) -->
        <div class="form-group">
            <label for="cdlInput">Corso di Laurea</label>
            <div class="combo" id="cdlCombo">
                <i class="fa fa-magnifying-glass combo-icon"></i>
                <input type="text" id="cdlInput" class="combo-input" autocomplete="off"
                       placeholder="Scrivi il tuo corso di laurea..."
                       value="{$selectedCdlNome|default:''|escape:'html'}" required>
                <input type="hidden" name="cdl" id="cdlValue" value="{$selectedCdl|default:''}">
                <ul class="combo-list" id="cdlList" role="listbox">
                    {foreach $corsi as $c}
                        <li class="combo-item" role="option"
                            data-value="{$c.id}" data-label="{$c.nome|escape:'html'}">{$c.nome}</li>
                    {/foreach}
                    <li class="combo-empty" hidden>Nessun corso trovato</li>
                </ul>
            </div>
            <div class="error-msg">{$errors.cdl|default:''}</div>
        </div>

        <!-- INSEGNAMENTO (bloccato finché non si sceglie il corso) -->
        <div class="form-group">
            <label for="insInput">Insegnamento</label>
            <div class="combo" id="insCombo">
                <i class="fa fa-magnifying-glass combo-icon"></i>
                <input type="text" id="insInput" class="combo-input" autocomplete="off"
                       placeholder="Seleziona prima un corso di laurea"
                       data-placeholder-locked="Seleziona prima un corso di laurea"
                       data-placeholder-ready="Scrivi l'insegnamento..."
                       value="{$selectedInsNome|default:''|escape:'html'}" required disabled>
                <input type="hidden" name="insegnamento" id="insValue" value="{$selectedIns|default:''}">
                <ul class="combo-list" id="insList" role="listbox">
                    {foreach $insegnamenti as $i}
                        <li class="combo-item" role="option"
                            data-value="{$i.id}" data-cdl="{$i.codiceCorso}"
                            data-label="{$i.nome|escape:'html'}">{$i.nome}</li>
                    {/foreach}
                    <li class="combo-empty" hidden>Nessun insegnamento trovato</li>
                </ul>
            </div>
            <div class="error-msg">{$errors.ins|default:''}</div>
        </div>

        <!-- TITOLO -->
        <div class="form-group">
            <label for="titoloInput">Titolo</label>
            <input type="text" name="titolo" id="titoloInput" required
                   placeholder="es. Programmazione Web"
                   value="{$titolo|default:''}">
            <div class="error-msg">{$errors.titolo|default:''}</div>
        </div>

        <!-- TAG (solo Appunto) -->
        <div class="form-group" id="tagGroup">
            <label for="tagSelect">Tag</label>
            <select name="tag" id="tagSelect" {if $tipo == 'esame'}disabled{/if}>
                <option value="">Seleziona tipo</option>
                <option value="Riassunto">Riassunto</option>
                <option value="Note">Note</option>
                <option value="Esercizi">Esercizi</option>
            </select>
            <div class="error-msg">{$errors.tag|default:''}</div>
        </div>

        <!-- CHECKBOX -->
        <div class="form-check">
            <input type="checkbox" name="terms" id="termsCheck" required>
            <label for="termsCheck">Accetto i Termini e Condizioni</label>
        </div>
        <div class="error-msg">{$errors.terms|default:''}</div>

        <!-- BOTTONI -->
        <div class="upload-actions">
            <a href="/Home/dashboard" class="btn btn-secondary btn-home"><i class="fa fa-arrow-left"></i> Home</a>
            <button type="submit" class="btn btn-carica">
                <i class="fa fa-cloud-arrow-up"></i> Carica materiale
            </button>
        </div>

    </form>

</section>

<script src="/../JS/upload.js"></script>

{/block}
