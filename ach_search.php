<?php
include 'db.php';
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

    #achi {
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

    #table1 input,
    select {
      width: 200px;
      padding: 8px;
      border: 2px solid black;
      border-radius: 5px;
    }

    select {
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
    .hidden {
      display: none;
    }

    .rad {
      display: none;
    }

    .rad + label {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 2px solid black;
      cursor: pointer;
      position: relative;
      transition: transform 0.3s ease-in-out;
      margin-right: 10px;
    }

    .rad:checked + label::after {
      content: '';
      display: block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: black;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .rad + label:active {
      transform: scale(1.2);
    }
  </style>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

  <title>achievements</title>
</head>

<body>
  <div>
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
      <p id="achi">ACHIEVEMENTS - SEARCH</p>

      <form action="ach_filter.php" method="POST" enctype="multipart/form-data">

        <table border="3" id="table1">
          <tr>
            <td>Date </td>
            <td>
              <input type="radio" name="dateOption" value="fromTo" class="rad" id="fromto" >
              <label for="fromto"></label>From-To
              <input type="radio" name="dateOption" value="quaterYear" class="rad" id="quateryear" >
              <label for="quateryear"></label>Quater-Year
              <div id="fromToBox" class="hidden">
                <label for="dateFrom">From:</label><br>
                <input type="date" name="From" id="dateFrom"><br>
                <label for="dateTo">To:</label><br>
                <input type="date" name="To" id="dateTo">
              </div>
              <div id="quaterYearBox" class="hidden">
                <label for="Quater">From:</label><br>
                <select name="quater" id="Quater">
                  <option value="">Select</option>
                  <option value="q1">Quater-1</option>
                  <option value="q2">Quater-2</option>
                  <option value="q3">Quater-3</option>
                  <option value="q4">Quater-4</option>
                </select><br>
                <label for="dateYear">Year:</label><br>
                <input type="number" value=2024 name="dYear" id="dateYear">
              </div>
            </td>
          </tr>
          <tr>
            <td id="vb">Event Name</td>
            <td>
              <select name="eventName">
                <option value="">Select</option>
              <?php 
            // Include the database connection file
            include 'db.php';

            // Query to get all records from event_category, grouped by type and ordered by type in ascending order
            $sql = "select event from events order by event";
            $result = $db->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data of each row as options
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row["event"]) . '">' . htmlspecialchars($row["event"]) . '</option>';
                }
            } else {
                echo '<option value="">No categories available</option>';
            }?>
              </select>
            </td>
            
          </tr>
          <tr>
            <td id="vb">Event Catogery</td>
            <td>
              <select name="catogery">
                <option value="">Select</option>
                <optgroup label="Technical">
              <?php 
            // Include the database connection file
            include 'db.php';

            // Query to get all records from event_category, grouped by type and ordered by type in ascending order
            $sql = "select catogery from event_catogery where type='Technical' order by catogery";
            $result = $db->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data of each row as options
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row["catogery"]) . '">' . htmlspecialchars($row["catogery"]) . '</option>';
                }
            } else {
                echo '<option value="">No categories available</option>';
            }

            // Close connection
            $db->close();
            ?>
            </optgroup>
            <optgroup label="Non-Technical">
              <?php 
            // Include the database connection file
            include 'db.php';

            // Query to get all records from event_category, grouped by type and ordered by type in ascending order
            $sql = "select catogery from event_catogery where type='Non-Technical' order by catogery";
            $result = $db->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data of each row as options
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row["catogery"]) . '">' . htmlspecialchars($row["catogery"]) . '</option>';
                }
            } else {
                echo '<option value="">No categories available</option>';
            }

            // Close connection
            $db->close();
            ?>
            </optgroup>

              </select>
            </td>
          </tr>
          <tr>
            <td>Team Name / Individual</td>
            <td>
              <input type="radio" name="groupOption" value="team" class="rad" id="team" >
              <label for="team"></label>Team
              <input type="radio" name="groupOption" value="individual" class="rad" id="individual" >
              <label for="individual"></label>Individual
              <div id="teamInputBox" class="hidden">
                <label for="teamNameInput">Team Name:</label><br>
                <input type="text" name="teamNameInput" id="teamNameInput">
              </div>
            </td>
          </tr>
          <tr>
            <td>Student Details</td>
            <td><input type="text" name="name" placeholder="Name" ></td>
            <td><input type="text" name="regno" placeholder="Register No" ></td>
            <td>
              <select name="year" >
                <option value="">Year</option>
                <option value="1">I</option>
                <option value="2">II</option>
                <option value="3">III</option>
                <option value="4">IV</option>
              </select>
            </td>
            <td>
              <select name="branch" >
                <option value="">Branch</option>
                <option value="AIML">AIML</option>
                <option value="AIDS">AIDS</option>
                <option value="CSE">CSE</option>
                <option value="CSBS">CSBS</option>
                <option value="IT">IT</option>
                <option value="ECE">ECE</option>
                <option value="EEE">EEE</option>
                <option value="ME">ME</option>
                <option value="CE">CE</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Prize Won/Participation</td>
            <td>
              <input type="radio" name="prizeOption" value="won" class="rad" id="won" >
              <label for="won"></label>Won
              <input type="radio" name="prizeOption" value="participant" class="rad" id="participant" >
              <label for="participant"></label>Participation
            </td>
          </tr>
          <tr>
            <td>Level</td>
            <td>
              <select name="level" >
                <option value="">Level</option>
                <option value="Institution">Institution</option>
                <option value="State">State</option>
                <option value="National">National</option>
              </select>
            </td>
          </tr>
          
        </table>

        <input type="submit" value="Submit" id="buttontext"><br>
      </form>
    </center>

    <center>
      <div class="mt-20 text-center flex items-center justify-center" id="banner">
        <marquee behavior="scroll" direction="left">
          <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]">DR V Narsimha Raju  |  P L N Prakash Kumar  |  Vemana Sravan Sai  |  Katta Mani Shankar</span></h1>
        </marquee>
      </div>
    </center>

  </div>
</body>
<script>
  var individualRadio = document.getElementById('individual');
  var teamRadio = document.getElementById('team');
  var teamInputBox = document.getElementById('teamInputBox');

  var fromToRadio = document.getElementById('fromto');
  var quaterYearRadio = document.getElementById('quateryear');
  var fromToBox = document.getElementById('fromToBox');
  var quaterYearBox = document.getElementById('quaterYearBox');

  individualRadio.addEventListener('change', function() {
    if (this.checked) {
      teamInputBox.classList.add('hidden');
    }
  });

  teamRadio.addEventListener('change', function() {
    if (this.checked) {
      teamInputBox.classList.remove('hidden');
    }
  });

  fromToRadio.addEventListener('change', function() {
    if (this.checked) {
      fromToBox.classList.remove('hidden');
      quaterYearBox.classList.add('hidden');
    }
  });

  quaterYearRadio.addEventListener('change', function() {
    if (this.checked) {
      quaterYearBox.classList.remove('hidden');
      fromToBox.classList.add('hidden');
    }
  });

</script>

</html>


