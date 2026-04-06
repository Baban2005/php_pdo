<?php
// Include your database connection script
require_once 'softwarelec/core/dbConfig.php';

// 7. SHOW CODE DEMONSTRATING UPDATING OF RECORD FROM YOUR DATABASE
echo "<h3>4. Demonstrating UPDATE</h3>";

$updateQuery = "UPDATE rock_bands SET genre = :newGenre WHERE band_id = :id";
$stmt = $pdo->prepare($updateQuery);

// Changing Nirvana's genre
$isUpdated = $stmt->execute([
    'newGenre' => 'Alternative Rock / Grunge',
    'id' => 6
]);

if ($isUpdated) {
    echo "Record successfully updated!<br>";
} ?>
