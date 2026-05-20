#!/usr/bin/env php
<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/../vendor/autoload.php';

// Carica l'EntityManager da doctrine-bootstrap.php
$entityManager = require __DIR__ . '/../config/doctrine-bootstrap.php';

// Avvia la console Doctrine ORM 3
ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);