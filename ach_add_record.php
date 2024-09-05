<?php
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_COOKIE['user'];
    $date = $_POST['date'];
    $eventName = $_POST['eventName'];
    if($eventName==""){
        echo "<script>";
        echo "window.alert('Invalid Event Name.');";
        echo "window.location.href = 'achievement_add_record.php';";
        echo "</script>";
        exit;
    }
    $catogery = $_POST['catogery'];
    if($catogery==""){
        echo "<script>";
        echo "window.alert('Invalid Event Category.');";
        echo "window.location.href = 'achievement_add_record.php';";
        echo "</script>";
        exit;
    }
    if($_POST['groupOption']=='Individual')
    {
        $teamName = 'Individual';
    }
    else{
        $teamName = $_POST['teamNameInput'];
        if($teamName==''){
            echo "<script>";
            echo "window.alert('Invalid Team Name.');";
            echo "window.location.href = 'achievement_add_record.php';";
            echo "</script>";
            exit;
        }
    }
    if($_POST['prizeOption']=='participant'){
        $position = 'Participation';
        $amount = '0';
    }
    else{
        $position = $_POST['prizeInput'];
        $amount = $_POST['amountInput'];
        if($position==''){
            echo "<script>";
            echo "window.alert('Invalid position.');";
            echo "window.location.href = 'achievement_add_record.php';";
            echo "</script>";
            exit;
        }
        if($amount==''){
            echo "<script>";
            echo "window.alert('Invalid amount.');";
            echo "window.location.href = 'achievement_add_record.php';";
            echo "</script>";
            exit;
        }
    }
    $level = $_POST['level'];
    if($level==""){
        echo "<script>";
        echo "window.alert('Invalid Level.');";
        echo "window.location.href = 'achievement_add_record.php';";
        echo "</script>";
        exit;
    }

    if($teamName!='Individual'){
        $checkquery = "SELECT COUNT(teamName) FROM achievements Where date = '$date' AND eventName = '$eventName' AND teamName = '$teamName'";
        $checkcount = mysqli_query($db,$checkquery);
        $row = mysqli_fetch_assoc($checkcount);
        $teamCount = $row['COUNT(teamName)'];
        if($teamCount>0){
            echo "<script>";
            echo "window.alert('Record already exists.');";
            echo "window.location.href = 'achievement.php';";
            echo "</script>";
            exit;
        }
    }
    

    if (isset($_FILES["doc"])) {
        
            $targetDir = "uploads/"; // Directory to store uploaded files

            // Check if there's only one file or multiple files
            if (is_array($_FILES["doc"]["name"])){

                for($i=0 ; $i<count($_FILES["doc"]["name"]) ; $i++)
                {
                    $fileName = basename($_FILES["doc"]["name"][$i]);
                    $targetFilePath = $targetDir . $fileName;

                    $name = $_POST["name"][$i];
                    $regno = $_POST["regno"][$i];
                    $year = $_POST["year"][$i];
                    $branch = $_POST["Branch"][$i];

                    if (move_uploaded_file($_FILES["doc"]["tmp_name"][$i], $targetFilePath)){
                        $query1 = "INSERT INTO achievements (email, date, name, regno, year, branch, eventName, teamName, position, Level, amount, doc , category)
                                  VALUES ('$email', '$date','$name' ,'$regno' ,'$year' ,'$branch' ,'$eventName', '$teamName', '$position', '$level', '$amount', '$fileName' , '$catogery')";
                    
                    mysqli_query($db, $query1);

                }
                echo "<script>";
                echo "window.alert('Records inserted successfully.');";
                echo "window.location.href = 'achievement.php';";
                echo "</script>";
                exit;
            }
            }
            else{
                $fileName = basename($_FILES["doc"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                echo ("Hi");

                $name = $_POST["name"][0];
                $regno = $_POST["regno"][0];
                $year = $_POST["year"][0];
                $branch = $_POST["Branch"][0];

                // Move uploaded file to destination directory
                if (move_uploaded_file($_FILES["doc"]["tmp_name"], $targetFilePath)){
                    $query1 = "INSERT INTO achievements (email, date, name, regno, year, branch, eventName, teamName, position, Level, amount, doc , catogery)
                              VALUES ('$email', '$date','$name' ,'$regno' ,'$year' ,'$branch' ,'$eventName', '$teamName', '$position', '$level', '$amount', '$fileName' , '$catogery')";
                    
                    if(mysqli_query($db, $query1))
                    {
                        echo "<script>";
                        echo "window.alert('Records inserted successfully.');";
                        echo "window.location.href = 'achievement.php';";
                        echo "</script>";
                        exit;
                    }
                     
            }
            
        }
    }
}

?>
