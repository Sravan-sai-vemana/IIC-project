<?php
include('db.php');

$year = $_GET['year'];
$quarter = $_GET['quarter'];

// Initialize conditions for quarter filtering
$quarterCondition = "";
if ($quarter !== "all") {
    $quarterCondition = "AND QUARTER(a.date) = '$quarter'";
}

// Fetch Technical Data
$technicalQuery = "SELECT ec.Catogery, COUNT(*) as count 
                   FROM achievements a
                   JOIN event_catogery ec ON a.Category = ec.Catogery
                   WHERE YEAR(a.date) = '$year' $quarterCondition AND ec.Type = 'Technical'
                   GROUP BY ec.Catogery";
$technicalResult = mysqli_query($db, $technicalQuery);

$technicalData = [];
while ($row = mysqli_fetch_assoc($technicalResult)) {
    $technicalData[] = $row;
}

// Fetch Non-Technical Data
$nonTechnicalQuery = "SELECT ec.Catogery, COUNT(*) as count 
                      FROM achievements a
                      JOIN event_catogery ec ON a.Category = ec.Catogery
                      WHERE YEAR(a.date) = '$year' $quarterCondition AND ec.Type = 'Non-Technical'
                      GROUP BY ec.Catogery";
$nonTechnicalResult = mysqli_query($db, $nonTechnicalQuery);

$nonTechnicalData = [];
while ($row = mysqli_fetch_assoc($nonTechnicalResult)) {
    $nonTechnicalData[] = $row;
}

$response = [
    'technical' => [
        'labels' => array_column($technicalData, 'Catogery'),
        'counts' => array_column($technicalData, 'count')
    ],
    'nonTechnical' => [
        'labels' => array_column($nonTechnicalData, 'Catogery'),
        'counts' => array_column($nonTechnicalData, 'count')
    ]
];

echo json_encode($response);
?>
