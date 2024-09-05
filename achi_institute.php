<?php
// Include your database connection file
require_once('db.php');

$user=$_COOKIE['user'];

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

  <title>achievements</title>
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
    <p id="achi">ACHIEVEMENTS - INSTITUTION LEVEL</p>

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
        $query = "(SELECT date, teamName, category, eventName, position, Level, amount FROM achievements WHERE teamName != 'Individual' and Level='Institution' GROUP BY date, teamName, eventName) UNION ALL (SELECT date, teamName, category, eventName, position, Level, amount FROM achievements WHERE teamName = 'Individual' and Level='Institution')";
        $result1 = mysqli_query($db, $query);
        if (mysqli_num_rows($result1) > 0) {
          $flag=1;
          while ($tab = mysqli_fetch_assoc($result1)) {
            $date = $tab['date'];
            $teamName = $tab['teamName'];
            $eventName = $tab['eventName'];
            $catogery = $tab['category'];
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