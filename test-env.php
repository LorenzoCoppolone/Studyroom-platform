<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Carica il file .env dalla root del progetto
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Stampa una variabile per vedere se funziona

print "DB_NAME = " . $_ENV['DB_NAME']. "\n";
print "DB_USER = " . $_ENV['DB_USER']. "\n";
print "DB_PASSWORD = " . $_ENV['DB_PASSWORD']. "\n";
print "DB_HOST = " . $_ENV['DB_HOST']. "\n";
print "DB_PORT = " . $_ENV['DB_PORT']. "\n";