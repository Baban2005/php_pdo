<?php
// DBCONFIG.php

$host = '127.0.0.1'; // Database host (usually localhost or 127.0.0.1)
$db   = 'senador'; // The name of your database
$user = 'root'; // Database username (default for XAMPP/WAMP is 'root')
$pass = ''; // Database password (default for XAMPP/WAMP is empty)
$charset = 'utf8mb4'; // Standard encoding

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Best practices options for PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays by default
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Prevent SQL injection by using actual prepared statements
];

try {
    // Create the PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Uncomment the line below to test if the connection is successful
    // echo "Connected successfully!";
} catch (\PDOException $e) {
    // If there is an error, throw it so you know what went wrong
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
