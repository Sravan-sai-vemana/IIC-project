<?php

require_once('db.php');

// SQL query
$sql = "SELECT  a.date,  a.eventName, a.teamName, a.position, a.Level, a.amount,a.name, a.regno, a.year, a.branch, a.doc, ai.position AS ai_position, ai.amount AS ai_amount FROM achievements a INNER JOIN achievementsinfo ai ON a.date = ai.date AND a.teamName = ai.teamName AND a.eventName = ai.eventName" ;

// Execute query
$result = mysqli_query($db, $sql);

// Fetch result as associative array
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}



// Output result as JSON
header('Content-Type: application/json');
echo json_encode($data);

?>
