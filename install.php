<?php

define('DB_HOST', 'localhost');  
define('DB_USER', 'root');  
define('DB_PASS', 'root');  

$options = [
    PDO::ATTR_PERSISTENT => true,  
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  
]; 

try {
	$connection = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS, $options);
	$sql = file_get_contents('init.sql');
	$connection->exec($sql);
	
	echo 'Success! <a href="/public/register.php">Register a user</a>';
} catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}