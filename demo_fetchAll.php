<?php
// Include your database connection script
require_once 'softwarelec/core/dbConfig.php';

// ==============================================================================
// 1. SHOW CODE DEMONSTRATING FETCH_ALL(). USE PRINT_R(). WITH “<pre>” TAG IN BETWEEN.
// ==============================================================================
echo "<h3>1. Demonstrating fetchAll()</h3>";

$stmt = $pdo->prepare("SELECT * FROM rock_bands");
$stmt->execute();
$allBands = $stmt->fetchAll();

echo "<pre>";
print_r($allBands);
echo "</pre>";
?>
