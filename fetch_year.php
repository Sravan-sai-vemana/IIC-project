<?php
include('db.php');

// Fetch data for initial load
$achievementsQuery = "SELECT COUNT(*) as count, YEAR(date) as year FROM achievements GROUP BY YEAR(date)";
$achievementsResult = mysqli_query($db, $achievementsQuery);

// Prepare data for charts
$yearData = [];
while ($row = mysqli_fetch_assoc($achievementsResult)) {
    $yearData[] = $row;
}

echo json_encode($yearData);
?>
