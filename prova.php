<?php

require_once __DIR__ . "/vendor/autoload.php";

use Controller\MaterialeController;
use UI\ViewUser;
/*
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['action']) && $_GET['action'] === 'caricaMateriale') {

        $controller = new MaterialeController();
        $controller->mostraFormCaricamento();
        exit;
    }

    // altrimenti mostra la home
    require __DIR__ . "/html/home.html";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === 'caricaMateriale') {

        $controller = new CaricaMaterialeController();
        $controller->caricaMateriale();
        exit;
    }
}
*/
// Carica PHPMailer configurato
// $mail = require __DIR__ . '/config/mailer-bootstrap.php';

// try {
//     // Destinatario (può essere finto)
//     $mail->addAddress('utente-di-test@example.com');

//     // Oggetto e corpo
//     $mail->Subject = 'Test email da StudyRoom';
//     $mail->Body    = 'Se vedi questa email in Mailpit, PHPMailer funziona!';

//     // Invia
//     $mail->send();

//     echo "Email inviata correttamente!";

// } catch (Exception $e) {
//     echo "Errore nell'invio: {$mail->ErrorInfo}";
// }

$view = new ViewUser();
$view->mostraConvalidaEmail();
