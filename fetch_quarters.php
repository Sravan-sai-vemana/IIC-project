<?php
include('db.php');

$year = $_GET['year'];

$query = "SELECT COUNT(*) as count, QUARTER(date) as quarter FROM achievements WHERE YEAR(date) = '$year' GROUP BY QUARTER(date)";
$result = mysqli_query($db, $query);

$quartersData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $quartersData[] = $row;
}

$response = [
    'labels' => array_column($quartersData, 'quarter'),
    'counts' => array_column($quartersData, 'count')
];

echo json_encode($response);
?>
