<?php
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catogery = $_POST['catogery'];
    $type = $_POST['type'];
    

    $checkquery = "SELECT COUNT(catogery) FROM event_catogery Where catogery = '$catogery'";
    $checkcount = mysqli_query($db,$checkquery);
    $row = mysqli_fetch_assoc($checkcount);
    $teamCount = $row['COUNT(catogery)'];
    if($teamCount>0){
        echo "<script>";
        echo "window.alert('Event Catogery already exists.');";
        echo "window.location.href = 'add_event_catogery.html';";
        echo "</script>";
    }
    else{
        $query1 = "INSERT INTO event_catogery 
                    VALUES ('$catogery', '$type')";
                    
                    mysqli_query($db, $query1);
                    echo "<script>";
                    echo "window.alert('Event Catogery added successfully.');";
                    echo "window.location.href = 'achievement_add_record.php';";
                    echo "</script>";

}
}
?>
