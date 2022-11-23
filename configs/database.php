<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$config['database'] = [
    'host' => $_ENV['DB_HOST'],
    'user' => $_ENV['DB_USER'],
    'pass' => $_ENV['DB_PASS'],
    'db' => $_ENV['DB_NAME'],
    'port' => $_ENV['DB_PORT'],
]
?>