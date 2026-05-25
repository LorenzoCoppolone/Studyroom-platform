<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione • StudyRoom</title>
    <link rel="stylesheet" href="styleRegister.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&family=Space+Mono:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="register-container">

        <h1 class="logo">StudyRoom</h1>
        <h2 class="register-title">Registrazione</h2>

        <div class="register-box">

            <form action="/register" method="POST" class="register-form">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input id="nome" type="text" name="nome" placeholder="Nome" 
                           required minlength="2" title="Inserisci un nome valido">
                </div>

                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input id="cognome" type="text" name="cognome" placeholder="Cognome"
                           required minlength="2" title="Inserisci un cognome valido">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" placeholder="Username"
                           required minlength="3" title="L'username deve contenere almeno 3 caratteri">
                </div>

                <div class="form-group">
                    <label for="email">Email istituzionale</label>
                    <input id="email" type="email" name="email" placeholder="nome.cognome@student.univaq.it"
                           required
                           pattern="^[a-zA-Z0-9._%+-]+@student\.univaq\.it$"
                           title="L'email deve terminare con @student.univaq.it">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Minimo 8 caratteri"
                           required minlength="8"
                           title="La password deve contenere almeno 8 caratteri">
                </div>

                <button type="submit" class="btn-register">Registrati</button>

            </form>

        </div>

    </div>

</body>
</html>

