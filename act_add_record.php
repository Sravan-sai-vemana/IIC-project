<?php
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $eventName = $_POST['eventName'];
    $hours = $_POST['hours'];
    $coordinator = $_POST['coordinator'];
    $faceOkLink = $_POST['faceOkLink'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $position = $_POST['position'];
    $amount = $_POST['amount'];
    $bannerFileName = $_FILES["banner"]["name"];
    $docFileName = $_FILES["doc"]["name"];
    $reportFileName = $_FILES["report"]["name"];
    $reportFileNameWord = $_FILES["reportWord"]["name"];

    // Move uploaded files to destination directory
    $targetDir = "uploads/";
    move_uploaded_file($_FILES["banner"]["tmp_name"], $targetDir . $bannerFileName);
    move_uploaded_file($_FILES["doc"]["tmp_name"], $targetDir . $docFileName);
    move_uploaded_file($_FILES["report"]["tmp_name"], $targetDir . $reportFileName);
    move_uploaded_file($_FILES["report"]["tmp_name"], $targetDir . $reportFileNameWord);

    // Insert data into the activity_records table
    $query1 = "INSERT INTO activity 
                (startDate, endDate, eventName, hours, coordinator, facebookLink, instagram, linkedin, twitter, youtube, position, amount, bannerFileName, docFileName, reportFileName,reportFileNameWord) 
                VALUES ('$startDate', '$endDate', '$eventName', '$hours', '$coordinator', '$faceOkLink', '$instagram', '$linkedin', '$twitter', '$youtube', '$position', '$amount', '$bannerFileName', '$docFileName', '$reportFileName','$reportFileNameWord')";

    if (mysqli_query($db, $query1)) {
        
    } else {
        echo "Error: " . $query1 . "<br>" . mysqli_error($db);
    }

    // Insert data into the resource_persons table
    if (isset($_POST['resourcePersonName'])) {
        foreach ($_POST['resourcePersonName'] as $resourcePersonName) {
            $query2 = "INSERT INTO resource_persons (startDate, endDate, eventName, resourcePersonName) 
                        VALUES ('$startDate', '$endDate', '$eventName', '$resourcePersonName')";
            mysqli_query($db, $query2);
        }
    }

    // Insert data into the event_photos table
    if (isset($_FILES["photos"])) {
        for($i=0;$i<sizeof($_FILES["photos"]["name"]);$i++)
        {
            $fileName = $_FILES["photos"]["name"][$i];
            move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $targetDir . $fileName);
            
            $query3 = "INSERT INTO event_photos (startDate, endDate, eventName, photoFileName) 
                        VALUES ('$startDate', '$endDate', '$eventName', '$fileName')";
            mysqli_query($db, $query3);
        }

    }
    echo "<script>";
    echo "window.alert('Records inserted successfully.');";
    echo "window.location.href = 'activity.php';";
    echo "</script>";
    exit;
}
?>
