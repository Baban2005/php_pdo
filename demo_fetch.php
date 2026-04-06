<?php
// Include your database connection script
require_once 'softwarelec/core/dbConfig.php';

// 4. SHOW CODE DEMONSTRATING HOW FETCH() IS USED. USE PRINT_R(). WITH “<pre>” TAG IN BETWEEN.
echo "<h3>2. Demonstrating fetch()</h3>";

// Fetching just a single record 
$stmt = $pdo->prepare("SELECT * FROM rock_bands WHERE band_id = :id");
$stmt->execute(['id' => 1]);
$singleBand = $stmt->fetch();

echo "<pre>";
print_r($singleBand);
echo "</pre>";
?>
