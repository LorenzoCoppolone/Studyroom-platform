<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyRoom | Login</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/Studyroom-platform/img/studyroom_favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="/Studyroom-platform/CSS/styleForm.css">

    <!-- Icone -->
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>

<body>
    <div class="form-login-container">
        <a href="home.html" target="_self">
            <img src="/Studyroom-platform/img/logo.png" alt="Logo StudyRoom" class="logo-form-login">
        </a>

        <form action="login.php" method="post">
            <h2>Login</h2>

            <!-- Campo email con validazione HTML -->
            <div class="campo-input">
                <input 
                    type="email" 
                    placeholder="Email" 
                    name="email" 
                    required
                    pattern=".+@student\.univaq\.it"
                    title="Inserisci un indirizzo email universitario valido (es: nome.cognome@student.univaq.it)"
                >
                <i class="bx bx-envelope"></i>
            </div>

            <!-- Campo password con validazione HTML -->
            <div class="campo-input">
                <input 
                    type="password" 
                    placeholder="Password" 
                    name="password" 
                    required
                    minlength="6"
                    title="La password deve avere almeno 6 caratteri"
                >
                <i class="bx bx-lock"></i>
            </div>

            <div class="Ricordami">
                <label for="controllo">
                    <input type="checkbox" id="controllo"> Ricordami
                </label>
                <a href="#">Hai dimenticato la password?</a>
            </div>

            <button class="btn" type="submit">Accedi</button>

            <div class="registrazione">
                <p>Non hai un account?
                    <a href="/Studyroom-platform/html/registrationForm.html">Registrati</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
