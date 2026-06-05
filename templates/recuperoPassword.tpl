<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero Password • StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Space+Mono:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="login-container">

    <a href="/Home/dashboard" class="logo">StudyRoom</a>
    <h2 class="login-title">Recupero Password</h2>

    <div class="login-box">

        <form method="POST" action="/User/recuperoPassword" class="login-form">

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email"
                       type="email"
                       name="email"
                       placeholder="nome.cognome@student.univaq.it"
                       required>
            </div>

            <div class="error-msg">
                {$errore|default:''}
            </div>

            <button type="submit" class="btn-login">Invia</button>

        </form>

        <p class="register-text">
            Torna al <a href="/User/login">Login</a>
        </p>

    </div>

</div>

</body>
</html>
