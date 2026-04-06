<?php
// Include your database connection script
require_once 'softwarelec/core/dbConfig.php';

// ==============================================================================
// 5. SHOW CODE DEMONSTRATING INSERTION OF RECORD TO YOUR DATABASE
// ==============================================================================
echo "<h3>3. Demonstrating INSERT</h3>";

$insertQuery = "INSERT INTO rock_bands (band_id, band_name, genre, formed_year) VALUES (:id, :name, :genre, :year)";
$stmt = $pdo->prepare($insertQuery);

// Executing the query with an array of values
$isInserted = $stmt->execute([
    'id' => 6,
    'name' => 'Nirvana',
    'genre' => 'Grunge',
    'year' => 1987
]);

if ($isInserted) {
    echo "Record successfully inserted!<br>";
}
?>