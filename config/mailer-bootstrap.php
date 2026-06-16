<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Carica .env dalla root
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST'];
    $mail->Port       = $_ENV['MAIL_PORT'];
    $mail->SMTPAuth   = !empty($_ENV['MAIL_USERNAME']); // true solo se username non è vuoto
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];

    // Encryption
    if ($_ENV['MAIL_ENCRYPTION'] === 'tls') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    } elseif ($_ENV['MAIL_ENCRYPTION'] === 'ssl') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    } else {
        $mail->SMTPSecure = false;
    }

    // Mittente
    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);

} catch (Exception $e) {
    error_log("Mailer configuration error: {$mail->ErrorInfo}");
    throw new \RuntimeException("Impossibile inizializzare il servizio email.");
}

return $mail;
