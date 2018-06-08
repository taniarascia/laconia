<?php

$options = [
    PDO::ATTR_PERSISTENT => true,  
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  
]; 

$db = new Database();

try {
	$connection = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS, $options);
	$sql = file_get_contents('data/init.sql');
	$connection->exec($sql);
	
	echo 'Success! <a href="/register">Register a user</a>';
} catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}