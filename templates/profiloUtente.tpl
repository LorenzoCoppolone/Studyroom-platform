{extends file="layout.tpl"}

{block name="title"}Profilo Utente - StudyRoom{/block}

{block name="pageCSS"}
    <link rel="stylesheet" href="/../CSS/styleProfiloUtente.css">
{/block}

{block name="content"}

<div class="profile-container">

    <!-- COLONNA SINISTRA -->
    <div class="profile-left">

        <!-- FOTO PROFILO -->
        <div class="profile-photo">
            <img id="profileImg" 
                 src="{$utente.foto|default:'default_profile.png'}" 
                 alt="Foto profilo">
        </div>

        <label class="change-photo">
            Cambia immagine
            <input type="file" id="photoInput" accept="image/*" hidden>
        </label>

        <!-- INFO UTENTE -->
        <div class="profile-info">
            <p><strong>Nome:</strong> {$utente.nome}</p>
            <p><strong>Cognome:</strong> {$utente.cognome}</p>
            <p><strong>Email:</strong> {$utente.email}</p>
            <p><strong>Username:</strong> {$utente.username}</p>
            <p><strong>Password:</strong> ********</p>
        </div>

        <!-- BOTTONI -->
        <a href="/User/modificaProfiloStudente" class="btn-modifica">Modifica</a>
        <a href="/User/logoutUtente" class="btn-logout">Logout</a>

    </div>

    <!-- COLONNA DESTRA -->
    <div class="profile-right">
        <a href="/RicercaMateriale/preferiti" class="profile-section-btn">Preferiti</a>
        <a href="/RicercaMateriale/download" class="profile-section-btn">Scaricati</a>
        <a href="/User/cercaRecensioniUtente" class="profile-section-btn">Mie recensioni</a>
        <a href="/RicercaMateriale/popolariUtente" class="profile-section-btn">Caricati</a>
    </div>

</div>

<!-- JS MINIMO -->
<script src="/../JS/profiloUtente.js"></script>

{/block}
