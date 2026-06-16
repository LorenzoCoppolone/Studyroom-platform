<?php
require_once __DIR__ . "/vendor/autoload.php";

use Controller\FrontController;
use Dotenv\Dotenv;

// Carica le variabili d'ambiente il prima possibile, così APP_DEBUG/APP_URL
// sono disponibili in tutti i bootstrap (Doctrine, Smarty, mailer).
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOL);

// In produzione non mostrare mai stack trace o errori PHP all'utente:
// gli errori vengono comunque scritti nel log del server.
ini_set('display_errors', $debug ? '1' : '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// Handler globale per le eccezioni non catturate: logga il dettaglio
// e mostra all'utente una pagina generica (no stack trace in produzione).
set_exception_handler(function (\Throwable $e) use ($debug) {
    error_log((string) $e);
    if (!headers_sent()) {
        http_response_code(500);
    }
    echo $debug
        ? '<pre>' . htmlspecialchars((string) $e, ENT_QUOTES) . '</pre>'
        : 'Errore interno del server.';
});

$controller = new FrontController();
$controller->run($_SERVER['REQUEST_URI']);
