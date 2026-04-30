<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

// 1. Configurazione metadata (attribute mapping)
$config = ORMSetup::createConfiguration(true);
$driver = new \Doctrine\ORM\Mapping\Driver\AttributeDriver([__DIR__ . '/../../Model']);
$config->setMetadataDriverImpl($driver);


// 2. Configurazione DB (array)
$connectionParams = [
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'host'     => $_ENV['DB_HOST'],
    'port'     => $_ENV['DB_PORT'],
    'driver'   => 'pdo_mysql',
];


// 3. Creazione della Connection
$connection = DriverManager::getConnection($connectionParams, $config);

// 4. Creazione EntityManager
$entityManager = new EntityManager($connection, $config);

return $entityManager;

