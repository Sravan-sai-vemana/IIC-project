<!DOCTYPE html>
<html>
<head>
    <title>College Achievements Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: rgba(0, 0, 0,1);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.15); /* Semi-transparent white background */
            backdrop-filter: blur(5px); /* Blurs the background */
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
    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
      <link rel="stylesheet" href="style.css">
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
        <h1 class="text-[#ffee00] text-4xl font-bold">ACHIEVMENTS DASHBOARD</h1>
    </center>
<div class="container">
    <div class="form-group">
        <label for="yearInput">Year:</label>
        <input type="number" id="yearInput" name="yearInput" value="<?php echo date('Y'); ?>">

        <label for="quarterInput">Quarter:</label>
        <select id="quarterInput" name="quarterInput">
        <option value="all" selected>All</option>
            <option value="1" >Q1</option>
            <option value="2" >Q2</option>
            <option value="3" >Q3</option>
            <option value="4" >Q4</option>
        </select>

        <button onclick="updateCharts()">Update</button>
    </div>

    <div style="width: 100%; display: flex; justify-content: space-around; flex-wrap: wrap;">
        <div style="width: 45%; margin-bottom: 20px;">
            <h1>Years</h1>
            <canvas id="yearChart"></canvas>
        </div>

        <div style="width: 45%; margin-bottom: 20px;">
        <h1>Quaters in Year</h1>
            <canvas id="quarterChart"></canvas>
        </div>

        <div style="width: 45%; margin-bottom: 20px;">
        <h1>Techincal</h1>
            <canvas id="technicalChart"></canvas>
        </div>

        <div style="width: 45%; margin-bottom: 20px;">
        <h1>Non-Technical</h1>
            <canvas id="nonTechnicalChart"></canvas>
        </div>
    </div>
</div>
<div class="mt-20 text-center flex items-center justify-center" id="banner">
      <marquee behavior="scroll" direction="left">
        <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]">DR V Narsimha Raju  |  P L N Prakash Kumar  |  V Sravan Sai  |  K Mani Shankar</span></h1>
      </marquee>
    </div>

    <script>
        // Function to fetch year data via AJAX
        function fetchYearData() {
            $.ajax({
                url: 'fetch_year.php',
                method: 'GET',
                success: function(response) {
                    var yearData = JSON.parse(response);
                    updateYearChart(yearData);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching year data:', error);
                }
            });
        }

        // Function to fetch quarter data via AJAX
        function fetchQuarterData(year) {
            $.ajax({
                url: 'fetch_quarters.php',
                method: 'GET',
                data: { year: year },
                success: function(response) {
                    var data = JSON.parse(response);
                    updateQuarterChart(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching quarter data:', error);
                }
            });
        }

        // Function to fetch technical and non-technical data via AJAX
        function fetchTechnicalData(year, quarter) {
            $.ajax({
                url: 'fetch_technical.php',
                method: 'GET',
                data: { year: year, quarter: quarter },
                success: function(response) {
                    var data = JSON.parse(response);
                    updateTechnicalChart(data.technical);
                    updateNonTechnicalChart(data.nonTechnical);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching technical data:', error);
                }
            });
        }

        // Function to update the year chart
        function updateYearChart(yearData) {
            var yearLabels = yearData.map(function(data) { return data.year; });
            var yearCounts = yearData.map(function(data) { return data.count; });

            var ctx = document.getElementById('yearChart').getContext('2d');
            var yearChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: yearLabels,
                    datasets: [{
                        label: 'Count of Achievements',
                        data: yearCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateQuarterChart(data) {
    var ctx = document.getElementById('quarterChart').getContext('2d');

    // Check if a chart instance already exists and destroy it
    if (window.quarterChart instanceof Chart) {
        window.quarterChart.destroy();
    }

    // Create new chart instance
    window.quarterChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels.map(q => 'Q' + q),
            datasets: [{
                label: 'Achievements per Quarter',
                data: data.counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            onClick: function(e, elements) {
                if (elements.length > 0) {
                    var quarter = this.data.labels[elements[0].index].replace('Q', '');
                    fetchTechnicalData(window.selectedYear, quarter);
                }
            }
        }
    });
}


        function updateTechnicalChart(data) {
    var ctx = document.getElementById('technicalChart').getContext('2d');

    // Check if a chart instance already exists and destroy it
    if (window.technicalChart instanceof Chart) {
        window.technicalChart.destroy();
    }

    // Create new chart instance
    window.technicalChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Technical Achievements',
                data: data.counts,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        }
    });
}

function updateNonTechnicalChart(data) {
    var ctx = document.getElementById('nonTechnicalChart').getContext('2d');

    // Check if a chart instance already exists and destroy it
    if (window.nonTechnicalChart instanceof Chart) {
        window.nonTechnicalChart.destroy();
    }

    // Create new chart instance
    window.nonTechnicalChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Non-Technical Achievements',
                data: data.counts,
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)'],
                borderWidth: 1
            }]
        }
    });
}


        // Function to update all charts based on selected year and quarter
        function updateCharts() {
            var selectedYear = document.getElementById('yearInput').value;
            var selectedQuarter = document.getElementById('quarterInput').value;

            fetchQuarterData(selectedYear);
            fetchTechnicalData(selectedYear, selectedQuarter);
        }

        // Initial fetch of year data on page load
        $(document).ready(function() {
            fetchYearData(); // Fetch year data initially
            
            var currentYear = new Date().getFullYear();
            var currentQuarter = getQuarter(new Date());
            fetchQuarterData(currentYear);
            fetchTechnicalData(currentYear, 'all');
        });

        // Function to determine the quarter based on a date
        function getQuarter(date) {
            var month = date.getMonth() + 1; // getMonth() returns zero-based index
            return Math.ceil(month / 3);
        }
    </script>
</body>
</html>
