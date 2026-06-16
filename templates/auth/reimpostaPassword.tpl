<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reimposta Password • StudyRoom</title>

    <!-- Icone -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <link rel="stylesheet" href="/../CSS/styleForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<main>

    <!-- LOGO -->
    <a href="/Home/dashboard" class="logo">StudyRoom</a>

    <!-- BOX FORM -->
    <div class="form-login-container">

        <h2>Reimposta Password</h2>

        <form method="POST" action="/User/salvaNuovaPassword">

            <input type="hidden" name="csrf_token" value="{$csrf_token}">
            <input type="hidden" name="token" value="{$token}">

            <!-- NUOVA PASSWORD -->
            <!-- Password -->
                <div class="campo-input">
                    <input type="password" placeholder="Nuova password" name="password" id="password" required>
                    <i class="bx bx-show toggle-password" id="togglePassword"></i>
                </div>

            <!-- CONFERMA PASSWORD -->
            <div class="campo-input">
                    <input type="password" placeholder="Conferma Password" name="conferma_password" id="confermaPassword" required>
                    <i class="bx bx-show toggle-password" id="toggleConferma"></i>
                </div>

            <!-- ERRORE -->
            <span class="msg-errore">
                {$errore|default:''}
            </span>

            <!-- BOTTONE -->
            <button type="submit" class="btn">Reimposta</button>

        </form>

        <!-- LINK LOGIN -->
        <p class="registrazione">
            Torna alla <a href="/Home/dashboard">Home</a>
        </p>

    </div>

</main>
<script src="/../JS/validazione.js"></script>
</body>
</html>
