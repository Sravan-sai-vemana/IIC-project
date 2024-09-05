<?php
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST['eventName'];
    $description = $_POST['description'];
    

    $checkquery = "SELECT COUNT(event) FROM events Where event = '$eventName'";
    $checkcount = mysqli_query($db,$checkquery);
    $row = mysqli_fetch_assoc($checkcount);
    $teamCount = $row['COUNT(event)'];
    if($teamCount>0){
        echo "<script>";
        echo "window.alert('Event Name already exists.');";
        echo "window.location.href = 'add_event.html';";
        echo "</script>";
    }
    else{
        $query1 = "INSERT INTO events 
                    VALUES ('$eventName', '$description')";
                    
                    mysqli_query($db, $query1);
                    echo "<script>";
                    echo "window.alert('Event Name added successfully.');";
                    echo "window.location.href = 'achievement_add_record.php';";
                    echo "</script>";

}
}
?>
