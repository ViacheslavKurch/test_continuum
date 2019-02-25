<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once './autoloader.php';
require_once './config.php';

$dbConnection = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);

$services = include('./services.php');

$container = new \App\Lib\Container($services);

try {
    (new \App\Application($container))->run($container);
} catch (Exception $exception) {
    echo 'Error : ' . $exception->getMessage();
}
