<?php

define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'root');
define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'phplogin');

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE,
    MYSQL_USER, 
    MYSQL_PASSWORD, 
    $pdoOptions
);