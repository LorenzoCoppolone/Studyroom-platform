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
    $mail->SMTPAuth = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];
    // Encryption
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   // Mittente
    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);

} catch (Exception $e) {
    die("Mailer Error: {$mail->ErrorInfo}");
}
return $mail;
