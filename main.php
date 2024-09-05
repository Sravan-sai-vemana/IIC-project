<?php
require('db.php');

// Query to count total achievements
$achievementsQuery = "
    SELECT COUNT(*) as totalAchievements FROM (
        (SELECT date, teamName, category, eventName, position, Level, amount 
         FROM achievements 
         WHERE teamName != 'Individual' 
         GROUP BY date, teamName, eventName)
        UNION ALL
        (SELECT date, teamName, category, eventName, position, Level, amount 
         FROM achievements 
         WHERE teamName = 'Individual')
    ) AS combinedAchievements
";

// Execute the query
$achievementsResult = $db->query($achievementsQuery);

// Fetch the total number of achievements
if ($achievementsResult) {
    $achievementsRow = $achievementsResult->fetch_assoc();
    $totalAchievements = $achievementsRow['totalAchievements'];
} else {
    echo "Error: " . $conn->error;
    $totalAchievements = 0;
}

// Query to count total activities
$activitiesQuery = "SELECT COUNT(*) as totalActivities FROM activity";

// Execute the query
$activitiesResult = $db->query($activitiesQuery);

// Fetch the total number of activities
if ($activitiesResult) {
    $activitiesRow = $activitiesResult->fetch_assoc();
    $totalActivities = $activitiesRow['totalActivities'];
} else {
    echo "Error: " . $conn->error;
    $totalActivities = 0;
}

// Close the connection
$db->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
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
        
        margin: 20px auto;
        background-color: white;
    }

    #table1 th,
    #table1 td {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    #table1 th {
        background-color: #f2f2f2;
    }

    #table1 input,select {
        width: 200px;
        padding: 8px;
        border: 2px solid black;
        border-radius: 5px;
     }
     select{
        text-align: center;
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
        .images{
            border-radius: 50px;
            height: 450px;
            width: 1000px;
        }
        .images:hover {
          box-shadow: 0 0 18px rgba(33,33,33,.2); 
        }
        #ach{
            position: absolute;
            top: 300px;
            left: 280px;
            font-size: 80px;
        }
        #act{
          position: absolute;
          top: 700px;
          left: 280px;
          font-size: 80px;
      }
      #frame{
        width: 40cm;
        overflow: hidden;
        position: relative;
        margin: auto;
    }
    a{
      display: inline-block;
    }
    .total {
            position: absolute;
            font-size:100px;
            background: rgba(255, 255, 255, 0.15); /* Semi-transparent white background */
            backdrop-filter: blur(5px); /* Blurs the background */
            border-radius: 30%; /* Rounded corners */
            padding: 20px; /* Padding for content inside */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }
    #totalAchievements{
      right:20%;
      top:400px;
    }
    #totalActivities{
      right:20%;
      top:870px;
    }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="number"], select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        canvas {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .chart-button {
        position: absolute;
        font-size: 32px; /* Increase icon size */
        color: white;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for contrast */
        padding: 15px; /* Adjust padding as needed */
        border-radius: 10%;
        left:75%;
      }
      </style>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
      <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
  <title>achievements</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div id="frame">
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
        <br><br>
      <br>
        
      <a href="achi_main.php" class="image-container">
  <p id="ach">ACHIEVEMENTS</p>
  <div class="total" id="totalAchievements">0</div>
  <figure>
    <img class="images" src="https://www.firstnaukri.com/career-guidance/wp-content/uploads/2020/09/iStock-1178511783.jpg">
    <a href="dashboard.php" class="chart-button">
      <i class="ri-bar-chart-2-line"></i> <!-- Assuming you're using Remix Icon for the chart symbol -->
    </a>
  </figure>
</a>

<a href="activity.php" class="image-container">
  <p id="act">ACTIVITY</p>
  <div class="total" id="totalActivities">0</div>
  <figure>
    <img class="images" src="https://breezeblog.s3.amazonaws.com/6/time_management.jpg">
    <a href="dashboard.php" class="chart-button">
      <i class="ri-bar-chart-2-line"></i> <!-- Assuming you're using Remix Icon for the chart symbol -->
    </a>
  </figure>
</a>



        

    </center>
    <div class="mt-20 text-center flex items-center justify-center" id="banner">
      <marquee behavior="scroll" direction="left">
        <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]">DR V Narsimha Raju  |  P L N Prakash Kumar  |  V Sravan Sai  |  K Mani Shankar</span></h1>
      </marquee>
    </div>

  </div>
  <script>
    // Simulate incrementing the total counts with JavaScript
    const totalAchievementsElement = document.getElementById('totalAchievements');
    const totalActivitiesElement = document.getElementById('totalActivities');
    
    let totalAchievements = 0;
    let totalActivities = 0;

    function incrementCounts() {
        if (totalAchievements <= <?php echo $totalAchievements; ?>) {
            totalAchievementsElement.textContent = totalAchievements++;
        }
        if (totalActivities <= <?php echo $totalActivities; ?>) {
            totalActivitiesElement.textContent = totalActivities++;
        }

        if (totalAchievements <= <?php echo $totalAchievements; ?> || totalActivities <= <?php echo $totalActivities; ?>) {
            setTimeout(incrementCounts, 50); // Adjust speed of increment animation here (milliseconds)
        }
    }

    // Start incrementing counts on page load
    window.onload = function() {
        incrementCounts();
    };
</script>
  
</body>

</html>