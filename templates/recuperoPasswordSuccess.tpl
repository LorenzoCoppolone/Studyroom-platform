<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email inviata • StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleRecupero.css">
</head>

<body>

<div class="login-container">

    <a href="/Home/dashboard" class="logo">StudyRoom</a>
    <h2 class="login-title">Controlla la tua email</h2>

    <div class="login-box">

        <p class="success-msg">
            Ti abbiamo inviato un link per reimpostare la password all’indirizzo:<br>
            <strong>{$email}</strong>
        </p>

        <a href="/User/login" class="btn-login" style="margin-top:2rem;">Torna al Login</a>

    </div>

</div>

</body>
</html>
