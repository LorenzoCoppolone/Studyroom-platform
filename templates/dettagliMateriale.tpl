{extends file="layout.tpl"}

{block name="title"}{$materiale.titoloMateriale|default:'Materiale'|escape:'html'} — StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleDettagliMateriale.css">
{/block}

{block name="content"}

{* ─────────────────────────────────────────────────────────────
   Pagina di dettaglio di un singolo materiale.
   Rotta prevista: /materiale/{id} → MaterialeController::mostra(id)

   Variabili Smarty attese (da assegnare nella view):
     $studente   username dell'utente loggato  (per la navbar — layout.tpl)
     $base64     foto profilo utente loggato    (per la navbar — layout.tpl)
     $preferito  bool: true se il materiale è già nei preferiti dell'utente

     $materiale.idMateriale       id del materiale
     $materiale.titoloMateriale   titolo
     $materiale.insegnamento      nome insegnamento
     $materiale.corso_di_Laurea   nome corso di laurea
     $materiale.tipologia         'APPUNTO' / 'ESAME'
     $materiale.mediaValutazione  media voti (0..5)
     $materiale.numeroRecensioni  numero recensioni ricevute
     $materiale.numeroDownload    numero download
     $materiale.nome_studente     username di chi ha caricato il materiale
     $base64Materiale           data URI completo del PDF
                                  (es. "data:application/pdf;base64,....")
   ───────────────────────────────────────────────────────────── *}

{assign var="stelle" value=$materiale.mediaValutazione|default:0|round}

<section class="materiale-page">

    <div class="materiale-layout">

        <!-- ===================== CONTENUTO PDF ===================== -->
        <div class="materiale-viewer">
            {if $materiale}
                <iframe class="materiale-viewer__frame"
                        src="/RicercaMateriale/pdf/{$materiale.idMateriale|escape:'url'}#toolbar=0&navpanes=0&scrollbar=0"
                        title="Contenuto del materiale"></iframe>
            {else}
                <div class="materiale-viewer__empty">
                    <i class="fa fa-file-pdf"></i>
                    <p>Anteprima non disponibile</p>
                </div>
            {/if}
        </div>
        <!-- ===================== /CONTENUTO PDF ===================== -->


        <!-- ===================== INFO + AZIONI ===================== -->
        <aside class="materiale-info">

            <h1 class="materiale-info__title">
                {$materiale.titoloMateriale|escape:'html'}
            </h1>

            <span class="materiale-info__tipo">{$materiale.tipologia|escape:'html'}</span>

            <!-- Caricato da -->
            <p class="materiale-info__author">
                <i class="fa fa-circle-user"></i>
                Caricato da <strong>{$materiale.nome_studente|escape:'html'}</strong>
            </p>

            <!-- Metadati -->
            <ul class="materiale-meta">
                <li>
                    <i class="fa fa-book"></i>
                    <span class="materiale-meta__label">Insegnamento</span>
                    <span class="materiale-meta__value">{$materiale.insegnamento|escape:'html'}</span>
                </li>
                <li>
                    <i class="fa fa-graduation-cap"></i>
                    <span class="materiale-meta__label">Corso di Laurea</span>
                    <span class="materiale-meta__value">{$materiale.corso_di_Laurea|escape:'html'}</span>
                </li>
            </ul>

            <!-- Valutazione + download -->
            <div class="materiale-stats">
                <div class="materiale-rating" aria-label="Valutazione: {$stelle} su 5">
                    {section name=s loop=5}
                        {if $smarty.section.s.index < $stelle}
                            <span class="star star--full">★</span>
                        {else}
                            <span class="star star--empty">★</span>
                        {/if}
                    {/section}
                    <span class="materiale-rating__count">
                        ({$materiale.numeroRecensioni|default:0|escape:'html'} recensioni)
                    </span>
                </div>

                <div class="materiale-downloads" aria-label="{$materiale.numeroDownload|default:0} download">
                    <i class="fa fa-download"></i>
                    <span>{$materiale.numeroDownload|default:0|escape:'html'} download</span>
                </div>
            </div>

            <!-- ===================== AZIONI ===================== -->
            <div class="materiale-actions">

                <!-- Scarica -->
                <a id="downloadLink"
                    href="/DownloadMateriale/eseguiDownload/{$materiale.idMateriale|escape:'html'}"
                    style="display:none;">
                </a>

                <button type="button" class="btn-azione btn-azione--primary" onclick="scaricaMateriale()">
                    <i class="fa fa-download"></i> Scarica
                </button>





                <!-- Preferiti -->
                <form action="/GestionePreferiti/gestionePreferitoController" method="POST">
                    <input type="hidden" name="idMateriale" value="{$materiale.idMateriale|escape:'html'}">
                    <button type="submit" class="btn-azione {if $preferito}btn-azione--active{/if}">
                        {if $preferito}
                            <i class="fa fa-heart"></i> Rimuovi dai preferiti
                        {else}
                            <i class="fa fa-heart"></i> Aggiungi ai preferiti
                        {/if}
                    </button>
                </form>

                <!-- Recensione (form inline, senza JS) -->
                <details class="materiale-disclosure">
                    <summary class="btn-azione">
                        <i class="fa fa-star"></i> Lascia una recensione
                    </summary>
                    <form class="materiale-form" action="/recensioneMateriale/inserisciRecensioneController" method="POST">
                        <input type="hidden" name="idMateriale" value="{$materiale.idMateriale|escape:'html'}">

                        <label for="voto">Voto</label>
                        <select id="voto" name="voto" required>
                            <option value="">Seleziona un voto</option>
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★ (4)</option>
                            <option value="3">★★★ (3)</option>
                            <option value="2">★★ (2)</option>
                            <option value="1">★ (1)</option>
                        </select>

                        <label for="commento">Commento</label>
                        <textarea id="commento" name="commento" rows="3" maxlength="255"
                                  placeholder="Scrivi un commento (max 255 caratteri)…"></textarea>

                        <button type="submit" class="btn-azione btn-azione--primary">
                            Invia recensione
                        </button>
                    </form>
                </details>

                <!-- Segnalazione (form inline, senza JS) -->
                <details class="materiale-disclosure">
                    <summary class="btn-azione btn-azione--danger">
                        <i class="fa fa-flag"></i> Segnala materiale
                    </summary>
                    <form class="materiale-form" action="/segnalazioneContenuti/inserisciSegnalazione" method="POST">
                        <input type="hidden" name="idMateriale" value="{$materiale.idMateriale|escape:'html'}">

                        <label for="motivo">Motivo della segnalazione</label>
                        <textarea id="motivo" name="motivo" rows="3" maxlength="255" required
                                  placeholder="Descrivi il problema (max 255 caratteri)…"></textarea>

                        <button type="submit" class="btn-azione btn-azione--danger">
                            Invia segnalazione
                        </button>
                    </form>
                </details>

            </div>
            <!-- ===================== /AZIONI ===================== -->

        </aside>
        <!-- ===================== /INFO + AZIONI ===================== -->

    </div>

</section>

<script src="/../js/downloadMateriale.js"></script>

{/block}
