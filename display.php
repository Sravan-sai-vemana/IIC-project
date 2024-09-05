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
    <title>Achievements and Activities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .total {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Total Achievements and Activities</h1>
        <div class="total" id="totalAchievements">0</div>
        <div class="total" id="totalActivities">0</div>
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
