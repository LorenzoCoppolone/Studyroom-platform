<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Registrazione</title>

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

            <form action="/User/effettuaRegistrazione" method="post" id="formRegistrazione">
                <h2>Registrati</h2>

                {* Token CSRF — decommentare se il backend lo fornisce *}
                {* <input type="hidden" name="csrf_token" value="{$csrfToken|escape:'html'}"> *}

                {* Errore globale (es. email gia registrata) *}
                {if isset($errore)}
                    <span class="msg-errore">{$errore|escape:'html'}</span>
                {/if}

                <!-- Nome -->
                <div class="campo-input">
                    <input type="text" placeholder="Nome" name="nome"
                           value="{$old.nome|default:''|escape:'html'}"
                           pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
                    <i class="bx bx-user"></i>
                </div>
                {if isset($errori.nome)}<span class="msg-errore">{$errori.nome|escape:'html'}</span>{/if}

                <!-- Cognome -->
                <div class="campo-input">
                    <input type="text" placeholder="Cognome" name="cognome"
                           value="{$old.cognome|default:''|escape:'html'}"
                           pattern="[a-zA-ZÀ-ÿ\s'\-]+" title="Solo lettere, nessun numero" required>
                    <i class="bx bx-badge"></i>
                </div>
                {if isset($errori.cognome)}<span class="msg-errore">{$errori.cognome|escape:'html'}</span>{/if}

                <!-- Username -->
                <div class="campo-input">
                    <input type="text" placeholder="Username" name="username"
                           value="{$old.username|default:''|escape:'html'}"
                           pattern="[a-zA-Z0-9_]+"
                           title="Solo lettere, numeri e _ (no spazi)" required>
                    <i class="bx bx-at"></i>
                </div>
                {if isset($errori.username)}<span class="msg-errore">{$errori.username|escape:'html'}</span>{/if}

                <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email" id="email"
                           value="{$old.email|default:''|escape:'html'}"
                           pattern="[a-zA-Z0-9._%+\-]+@student\.univaq\.it"
                           title="Usa la tua email universitaria (@student.univaq.it)" required>
                    <i class="bx bx-envelope"></i>
                </div>
                {if isset($errori.email)}<span class="msg-errore">{$errori.email|escape:'html'}</span>{/if}

                <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Password" name="password" id="password"
                           minlength="8" title="Minimo 8 caratteri" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

                <!-- Conferma Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Conferma Password" name="conferma_password" id="confermaPassword" required>
                    <i class="bx bx-show toggle-password" id="toggleConferma"></i>
                </div>
                <span class="msg-errore" id="err-conferma"></span>

                <button class="btn" type="submit">Registrati</button>

                <div class="registrazione">
                    <p>Hai gia un account?
                        <a href="/User/login">Accedi</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

<script src="/../JS/validazione.js"></script>
</body>
</html>
