<?php
require_once 'softwarelec/core/dbConfig.php';

// Define the SQL query using standard joins to link the tables
$query = "
    -- Select the band name and genre directly from the rock_bands table
    SELECT 
        b.band_name AS rock_band,
        b.genre AS sub_genre,
        
        -- Calculate the total revenue by multiplying tickets sold and ticket prices
        SUM((a.general_tickets_sold * a.ticket_price_general) + (a.vip_tickets_sold * a.ticket_price_vip)) AS total_revenue,
        
        -- Calculate the average percentage of the venue that was filled
        AVG((a.general_tickets_sold + a.vip_tickets_sold) / v.max_capacity) AS avg_capacity_filled,
        
        -- Use a subquery to find out which venue generated the most money for this specific band
        (
            SELECT v2.venue_name 
            FROM rock_concert_attendances a2 
            JOIN venues v2 ON a2.venue_id = v2.venue_id 
            WHERE a2.band_id = b.band_id 
            ORDER BY ((a2.general_tickets_sold * a2.ticket_price_general) + (a2.vip_tickets_sold * a2.ticket_price_vip)) DESC 
            LIMIT 1
        ) AS most_profitable_venue
        
    -- Start with the rock_bands table and join the attendances and venues to get all the data linked together
    FROM rock_bands b
    JOIN rock_concert_attendances a ON b.band_id = a.band_id
    JOIN venues v ON a.venue_id = v.venue_id
    
    -- Group everything by the band, so we get one row per band
    GROUP BY b.band_id, b.band_name, b.genre
    
    -- Order the final results from highest revenue to lowest
    ORDER BY total_revenue DESC
";

try {
    // Prepare and execute the database query securely
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Fetch all the results into a PHP array
    $results = $stmt->fetchAll();
    
    // We calculate the rankings manually in PHP to avoid complex SQL errors on older databases
    $globalRank = 1;      // Starts at 1 for the highest overall revenue
    $genreRanks = [];     // An empty array to keep track of the current rank for each specific genre
    
    // Loop through each row of the results to add ranking information
    foreach ($results as &$row) {
        
        // Assign the overall rank and increment the counter for the next band
        $row['overall_global_rank'] = $globalRank++;
        
        // Find out what genre this band plays
        $genre = $row['sub_genre'];
        
        // If we haven't seen this genre yet, start its rank at 1
        if (!isset($genreRanks[$genre])) {
            $genreRanks[$genre] = 1;
        }
        
        // Assign the genre-specific rank and increment it for the next band in this genre
        $row['rank_within_genre'] = $genreRanks[$genre]++;
    }
    unset($row); // Always break the PHP reference loop when using '&' to avoid bugs later

} catch (Exception $e) {
    // If the database query fails, stop loading the page and show an error message
    die("Query Failed. Make sure you imported the database! Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rock Concert Analytics</title>
</head>
<body>

    <h2>Rock Concert Tour Analytics</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Global Rank</th>
                <th>Band</th>
                <th>Genre</th>
                <th>Rank In Genre</th>
                <th>Most Profitable Venue</th>
                <th>Avg Capacity Filled</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['overall_global_rank']); ?></td>
                    <td><?php echo htmlspecialchars($row['rock_band']); ?></td>
                    <td><?php echo htmlspecialchars($row['sub_genre']); ?></td>
                    <td><?php echo htmlspecialchars($row['rank_within_genre']); ?></td>
                    <td><?php echo htmlspecialchars($row['most_profitable_venue']); ?></td>
                    <td><?php echo number_format($row['avg_capacity_filled'] * 100, 2); ?>%</td>
                    <td>$<?php echo number_format($row['total_revenue'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($results)): ?>
                    <tr><td colspan="7">No data found. Please run the schema.sql file in your database!</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
