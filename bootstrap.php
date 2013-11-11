<?php

require_once 'vendor/autoload.php';

$dbHost     = getenv('LATTES_DB_HOST') ?: '192.168.33.101';
$dbUser     = getenv('LATTES_DB_USER') ?: 'root';
$dbPass     = getenv('LATTES_DB_PASS') ?: '';
$dbName     = getenv('LATTES_DB_NAME') ?: 'lattes';

$pdo = new \Pdo("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
