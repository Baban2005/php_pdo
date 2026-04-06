<?php
// DBCONFIG.php

$host = '127.0.0.1'; // database host 
$db = 'senador'; // database name
$user = 'root'; // database username 
$pass = ''; // database password 
$charset = 'utf8mb4'; // standard encoding

// data source name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// best practices options for PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // fetch associative arrays by default
    PDO::ATTR_EMULATE_PREPARES => false, // prevent sql injection by using actual prepared statements
];

try {
    // create the PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);


    echo "Connected successfully!";
} catch (\PDOException $e) {

    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>
