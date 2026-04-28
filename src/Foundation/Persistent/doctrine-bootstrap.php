<?php

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../../../vendor/autoload.php';

// 1. Configurazione metadata (attribute mapping)
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../../entity'],
    isDevMode: true
);

// 2. Configurazione DB (array)
$connectionParams = [
    'dbname' => 'studyroom',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

// 3. Creazione della Connection (Doctrine 3.x richiede questo)
$connection = DriverManager::getConnection($connectionParams, $config);

// 4. Creazione EntityManager (Doctrine 3.x)
$entityManager = new EntityManager($connection, $config);

return $entityManager;

