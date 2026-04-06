<?php
// Include your database connection script
require_once 'softwarelec/core/dbConfig.php';

// ==============================================================================
// 6. SHOW CODE DEMONSTRATING DELETION OF RECORD TO YOUR DATABASE
// ==============================================================================
echo "<h3>5. Demonstrating DELETE</h3>";

$deleteQuery = "DELETE FROM rock_bands WHERE band_id = :id";
$stmt = $pdo->prepare($deleteQuery);

// Deleting the Nirvana record we just created
$isDeleted = $stmt->execute([
    'id' => 6
]);

if ($isDeleted) {
    echo "Record successfully deleted!<br>";
}
?>