<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero Password • StudyRoom</title>

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

        <h2>Recupero Password</h2>

        <form method="POST" action="/User/effettuaRecuperoPassword">

            <!-- Email -->
                <div class="campo-input">
                    <input type="email" placeholder="Email" name="email"
                           value="{$emailInserita|default:''|escape:'html'}" required>
                    <i class="bx bx-envelope"></i>
                </div>

            <!-- MESSAGGIO ERRORE -->
            <span class="msg-errore">
                {$errore|default:''}
            </span>

            <!-- BOTTONE -->
            <button type="submit" class="btn">Invia</button>

        </form>

        <!-- LINK LOGIN -->
        <p class="registrazione">
            Torna alla <a href="/Home/dashboard">Home</a>
        </p>

    </div>

</main>

</body>
</html>
