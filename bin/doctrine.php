#!/usr/bin/env php
<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/../vendor/autoload.php';

// Carica il tuo EntityManager dal bootstrap
$entityManager = require_once __DIR__ . '/../src/Foundation/Persistent/doctrine-bootstrap.php';


// Avvia la console Doctrine ORM 3
ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
