<?php
// Include your database connection file
require_once('db.php');

$user=$_COOKIE['user'];

$eventName = $_POST['eventName'];
$eventCatogery = $_POST['catogery'];
if(isset($_POST['groupOption']))
{
  $teamOrIndividual = $_POST['groupOption'];
  if($teamOrIndividual == 'team'){
    $teamOrIndividual = $_POST['teamNameInput'];
  }
}
$name = $_POST['name'];
$regno = $_POST['regno'];
$year = $_POST['year'];
$branch = $_POST['branch'];
if( isset($_POST['prizeOption']))
{
  $wonOrParticipation = $_POST['prizeOption'];
}
$level = $_POST['level'];

$query = "SELECT * FROM achievements WHERE 1=1 ";
if(isset($_POST['dateOption'])){
  if($_POST['dateOption']=='fromTo'){
    $from=$_POST['From'];
    $to = $_POST['To'];
    $query = $query . "and date >= '$from' and date <='$to'";
  }
  else{
    $quater=$_POST['quater'];
    $dYear=$_POST['dYear'];
    if($quater=='q1'){
      $query = $query . "and Year(date) = '$dYear' and Month(date) <= 3";
    }
    else if($quater=='q2'){
      $query = $query . "and Year(date) = '$dYear' and Month(date) >= 4 and Month(date) <= 6";
    }
    else if($quater=='q3'){
      $query = $query . "and Year(date) = '$dYear' and Month(date) >= 7 and Month(date) <= 9";
    }
    else if($quater=='q4'){
      $query = $query . "and Year(date) = '$dYear' and Month(date) >= 10 and Month(date) <= 12";
    }
  }
}
if (!empty($date)) {
  $query = $query . " and date = '$date'";
}
if (!empty($eventName)) {
  $query = $query . " and eventName = '$eventName'";
}
if (!empty($eventCategory)) {
  $query = $query . " and category = '$eventCategory'";
}
if (isset($_POST['groupOption'])) {
  $query = $query . " and teamName = '$teamOrIndividual'";
}
if (!empty($name)) {
  $query = $query . " and name = '$name'";
}
if (!empty($regno)) {
  $query = $query . " and regno = '$regno'";
}
if (!empty($year)) {
  $query = $query . " and year = '$year'";
}
if (!empty($branch)) {
  $query = $query . " and branch = '$branch'";
}
if (isset($_POST['prizeOption'])) {
  if($wonOrParticipation == 'won'){
    $query = $query . " and position <> 'Participation'";
  }
  else{
    $query = $query . " and position = 'Participation'";
  }
}
if (!empty($level)) {
  $query = $query . " and level = '$level'";
}
$query1 = "(select date, teamName, category, eventName, position, Level, amount from (". $query .") as ach where teamName!='Individual' group by date , teamName , eventName)";
$query1 = $query1 ." UNION ALL ";
$query1 = $query1 . "(select date, teamName, category, eventName, position, Level, amount from (". $query .") as ach where teamName ='Individual' );";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    @layer utilities {
          .content-auto {
            content-visibility: auto;
          }
        }
    #achi{
        background-color: rgb(94, 42, 224);
        color: white;
        font-size: 40px;
        font-family: 'Courier New', Courier, monospace;
        margin-top: 30px;
        margin-bottom: 20px;
        font-weight: bolder;
    }
    #table1 {
        text-align: center;
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
        background-color: white;
        margin-top: 70px;
    }

    #table1 th,
    #table1 td {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    #table1 th {
        background-color: #f2f2f2;
    }

    #table1 input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
     }
    #button1 {
            text-align: right;
            margin-top: 15px;
            margin-right: 24px;
        }

        #buttontext {
            background-color: rgb(237, 111, 111);
            font-size: 20px;
            font-weight: bold;
            padding: 8px;
            margin-right: 10px;
            cursor: pointer;
        }
        .download{
          position: absolute;
          top: 203px;
          right: 0;

        }
        .MainBody{
          min-height: 90vh;
        }
        #filter{
            background-color: rgb(237, 111, 111);
            font-size: 20px;
            font-weight: bold;
            padding: 8px;
            margin-right: 10px;
            margin-bottom: 5px;
            cursor: pointer;
            margin-left: calc(100vw - 370px);
            
        }
        
        
      </style>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
      <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

  <title>achievements - Search & Download</title>
</head>

<body>
  <div class="MainBody">
    <div class=" bg-[#2d3091] flex justify-between items-center">
      <a href="main.php"><img src="./Images/iiclogo.png" class=" clip bg-white px-16 py-4 w-72" /></a>
      <div class="text-center">
        <h1 class="text-[#ffee00] text-2xl font-bold">VISHNU INSTITUTE  OF TECHNOLOGY</h1>
        <h1 class="text-white text-3xl font-bold">Institution's Innovation Council</h1>
      </div>
      <div class="flex items-center mr-20">
        <img src="./Images//founder.png" class="w-14" />
        <div class="divider"></div>
        <img src="./Images/logo.png" class="w-14 mr-2" />
        <div class="text-white font-bold">
          <h1>VIT</h1>
          <h1>Bhimavaram</h1>
        </div>
      </div>
    </div>
    
    <center>
    <p id="achi">ACHIEVEMENTS</p>

    <a href="ach_search.php" id="filter">Search</a>
    
        <table border="3" id="table1">
            <tr>
                <th>S.NO</th>
                <th>Date</th>
                <th>Event Name</th>
                <th>Event Category</th>
                <th>Team Name / Individual</th>
                <th>Prize Won</th>
                <th>Level</th>
                <th>Amount</th>
                <th>Team Details</th>
            </tr>
            <?php
        $result1 = mysqli_query($db, $query1);
        if (mysqli_num_rows($result1) > 0) {
          $flag=1;
          while ($tab = mysqli_fetch_assoc($result1)) {
            $date = $tab['date'];
            $teamName = $tab['teamName'];
            $eventName = $tab['eventName'];
            $catogery = $tab['Category'];
            $position = $tab['position'];
            $level = $tab['Level'];
            $amount = $tab['amount'];
              echo "<tr>";
              echo "<td>" . $flag . "</td>";
              echo "<td>" . $date . "</td>";
              echo "<td>" . $eventName . "</td>";
              echo "<td>" . $catogery . "</td>";
              echo "<td>" . $teamName . "</td>";
              echo "<td>" . $position . "</td>";
              echo "<td>" . $level . "</td>";
              echo "<td>" . $amount . "</td>";
              echo "<td>  <form action='achi_team.php' method='post' target='_blank'> <input type='hidden' name='date' value='".$date."'> <input type='hidden' name='teamName' value='".$teamName."'> <input type='hidden' name='eventName' value='".$eventName."'> <button type='submit' style='color: blue;'>View</button> </form> </td>";
              echo "</tr>";
          $flag+=1;

        }
        

      }
        
        ?>
        </table>
        <a href="achievement_add_record.php" ><input type="button" value="Add Record" id="buttontext"></a><br>
    </center>

    <form action='download.php' method=post>
      <input type="hidden" name="query" value="<?php echo $query ?>">
    <input type="submit" value="Download" id="buttontext" class="download" >
    </form>
    <center>
    

  </div>
  <div class="mt-20 text-center flex items-center justify-center" id="banner">
        <marquee behavior="scroll" direction="left">
          <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]"> DR V Narsimha Raju  |  P L N Prakash Kumar  |  V Sravan Sai  |  K Mani Shankar</span></h1>
        </marquee>
    </div>
</body>
<script>
function exportToExcel() {
    // Fetch data from the server
    $.ajax({
        url: 'ach_fetch_data.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Convert JSON data to Excel
            var ws = XLSX.utils.json_to_sheet(data);

            // Create a workbook
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Achievements");

            // Trigger the download
            XLSX.writeFile(wb, 'achievements_export.xlsx');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });
}


  
</script>

</html>