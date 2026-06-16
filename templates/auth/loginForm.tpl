<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi | StudyRoom</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/../img/studyroom_favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="/../CSS/styleForm.css">

    <!-- Icone -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <main>

        <div class="logo">
            <a href="/Home/dashboard">
                <p>StudyRoom</p>
            </a>
        </div>

        <div class="form-login-container">

            <form action="/User/effettuaLogin" method="post">
                <h2>Accedi</h2>

                <input type="hidden" name="csrf_token" value="{$csrf_token}">

                {* Token CSRF — decommentare se il backend lo fornisce *}
                {* <input type="hidden" name="csrf_token" value="{$csrfToken|escape:'html'}"> *}

                {* Errore di autenticazione (credenziali errate) *}
                {if isset($error)}
                    <span class="msg-errore">{$error|escape:'html'}</span>
                {/if}

                <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email"
                           value="{$emailInserita|default:''|escape:'html'}" required>
                    <i class="bx bx-envelope"></i>
                </div>

                <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

                <div class="Ricordami">
                    <label for="controllo">
                        <input type="checkbox" id="controllo" name="ricordami"> Ricordami
                    </label>
                    <a href="/User/recuperoPassword">Hai dimenticato la password?</a>
                </div>

                <button class="btn" type="submit">Accedi</button>

                <div class="registrazione">
                    <p>Non hai un account?
                        <a href="/User/registrazione">Registrati</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

<script src="/../JS/validazione.js"></script>
</body>
</html>

