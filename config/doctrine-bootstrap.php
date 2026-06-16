<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$isDevMode = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOL);
$config = ORMSetup::createConfiguration($isDevMode);

$driver = new \Doctrine\ORM\Mapping\Driver\AttributeDriver([
    __DIR__ . '/../src/Model'
]);

$config->setMetadataDriverImpl($driver);

if(!isset($_ENV['DATABASE_URL'])) {
$connectionParams = [
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'host'     => $_ENV['DB_HOST'],
    'port'     => $_ENV['DB_PORT'],
    'driver'   => 'pdo_mysql',
];
} else {
    $url = parse_url($_ENV['DATABASE_URL']);
    $connectionParams = [
        'dbname'   => substr($url['path'], 1),
        'user'     => $url['user'],
        'password' => $url['pass'],
        'host'     => $url['host'],
        'port'     => $url['port'],
        'driver'   => 'pdo_mysql',
    ];
}
$connection = DriverManager::getConnection($connectionParams, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;