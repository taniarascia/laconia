<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * This script connects to MySQL using the PDO object.
 * This can be included in web pages where a database connection is needed.
 * Customize these to match your MySQL database connection details.
 * This info should be available from within your hosting panel.
 */
 
//Our MySQL user account.
define('MYSQL_USER', 'root');
 
//Our MySQL password.
define('MYSQL_PASSWORD', 'root');
 
//The server that MySQL is located on.
define('MYSQL_HOST', 'localhost');

//The name of our database.
define('MYSQL_DATABASE', 'phplogin');

/**
 * PDO options / configuration details.
 * I'm going to set the error mode to "Exceptions".
 * I'm also going to turn off emulated prepared statements.
 */
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

$root = __DIR__;

/**
 * Connect to MySQL and instantiate the PDO object.
 */
$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);

//The PDO object can now be used to query MySQL.
