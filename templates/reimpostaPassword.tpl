<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reimposta Password • StudyRoom</title>

    <link rel="stylesheet" href="/../CSS/styleRecupero.css">
</head>

<body>

<div class="login-container">

    <a href="/Home/dashboard" class="logo">StudyRoom</a>
    <h2 class="login-title">Reimposta Password</h2>

    <div class="login-box">

        <form method="POST" action="/User/salvaNuovaPassword" class="login-form">

            <input type="hidden" name="token" value="{$token}">

            <div class="form-group">
                <label for="password">Nuova Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       minlength="8">
            </div>

            <div class="form-group">
                <label for="confirm">Conferma Password</label>
                <input id="confirm"
                       type="password"
                       name="confirm"
                       required
                       minlength="8">
            </div>

            <div class="error-msg">
                {$errore|default:''}
            </div>

            <button type="submit" class="btn-login">Reimposta</button>

        </form>

    </div>

</div>

</body>
</html>
