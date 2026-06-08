{extends file="layout.tpl"}

{block name="title"}Modifica Profilo | StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleModificaProfilo.css">
{/block}

{block name="content"}

<section class="edit-card">

    <h1 class="edit-title"><i class="fa fa-pen"></i> Modifica profilo</h1>

    {* Errore globale (es. username gia in uso) *}
    {if isset($errore)}
        <p class="edit-error">{$errore|escape:'html'}</p>
    {/if}

    <form action="/User/aggiornaProfiloStudente" method="post"
          enctype="multipart/form-data" class="edit-form" id="formModificaProfilo">

        <!-- FOTO PROFILO -->
        <div class="edit-photo-block">

            <div class="edit-photo" id="previewWrapper">
                {if $utente.foto}
                    <img src="{$utente.foto}" alt="Foto profilo" id="previewImg">
                {else}
                    <i class="fa fa-circle-user" id="previewPlaceholder"></i>
                {/if}
            </div>

            <label for="immagine" class="btn btn-secondary edit-photo-btn">
                <i class="fa fa-camera"></i> Cambia immagine
            </label>
            <input type="file" name="immagine" id="immagine"
                   accept="image/png, image/jpeg, image/jpg, image/webp" hidden>
            <span class="edit-photo-hint">PNG o JPG</span>

        </div>

        <!-- NOME -->
        <div class="edit-field">
            <label for="nome">Nome</label>
            <div class="campo-input">
                <i class="fa fa-user"></i>
                <input type="text" id="nome" name="nome"
                       value="{$utente.nome|escape:'html'}"
                       placeholder="{$utente.nome|escape:'html'}"
                       pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
            </div>
        </div>

        <!-- COGNOME -->
        <div class="edit-field">
            <label for="cognome">Cognome</label>
            <div class="campo-input">
                <i class="fa fa-id-badge"></i>
                <input type="text" id="cognome" name="cognome"
                       value="{$utente.cognome|escape:'html'}"
                       placeholder="{$utente.cognome|escape:'html'}"
                       pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
            </div>
        </div>

        <!-- USERNAME -->
        <div class="edit-field">
            <label for="username">Username</label>
            <div class="campo-input">
                <i class="fa fa-at"></i>
                <input type="text" id="username" name="username"
                       value="{$utente.username|escape:'html'}"
                       placeholder="{$utente.username|escape:'html'}"
                       pattern="[a-zA-Z0-9_]+" title="Solo lettere, numeri e _ (no spazi)" required>
            </div>
        </div>

        <!-- AZIONI -->
        <div class="edit-actions">
            <a href="/User/profiloStudente" class="btn btn-secondary">
                <i class="fa fa-xmark"></i> Annulla
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-disk"></i> Salva modifiche
            </button>
        </div>

    </form>

</section>

<script src="/../JS/modificaProfilo.js"></script>

{/block}
