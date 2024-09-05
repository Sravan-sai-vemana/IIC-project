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
      <p id="achi">ACHIEVEMENTS - ADD RECORD</p>

      <form action="ach_add_record.php" method="POST" enctype="multipart/form-data">

        <table border="3" id="table1">
          <tr>
            <td>Date </td>
            <td><input type="date" name="date" required></td>
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
            <td><a href="add_event.html">Add event</a></td>
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
            <td><a href="add_event_catogery.html">Add event category</a></td>
          </tr>
          <tr>
            <td>Team Name / Individual</td>
            <td>
              <input type="radio" name="groupOption" value="team" class="rad" id="team" required>
              <label for="team"></label>Team
              <input type="radio" name="groupOption" value="Individual" class="rad" id="individual" required>
              <label for="individual"></label>Individual
              <div id="teamInputBox" class="hidden">
                <label for="teamNameInput">Team Name:</label><br>
                <input type="text" name="teamNameInput" id="teamNameInput">
              </div>
            </td>
          </tr>
          <tr>
            <td>Student Details</td>
            <td><input type="text" name="name[]" placeholder="Name" required></td>
            <td><input type="text" name="regno[]" placeholder="Register No" required></td>
            <td>
              <select name="year[]" required>
                <option value="None">Year</option>
                <option value="1">I</option>
                <option value="2">II</option>
                <option value="3">III</option>
                <option value="4">IV</option>
              </select>
            </td>
            <td>
              <select name="Branch[]" required>
                <option value="None">Branch</option>
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
            <td><input type="file" name="doc[]" accept="image/jpeg" required></td>
            <td><button id="addButton" onclick="add()" type="button">+</button></td>
          </tr>
          <tr>
            <td>Prize Won/Participation</td>
            <td>
              <input type="radio" name="prizeOption" value="won" class="rad" id="won" required>
              <label for="won"></label>Won
              <input type="radio" name="prizeOption" value="participant" class="rad" id="participant" required>
              <label for="participant"></label>Participation
              <div id="prizeInputBox" class="hidden">
                <label for="prizeInput">Prize:</label><br>
                <input type="text" name="prizeInput" id="prizeInput"><br>
                <label for="amountInput">Prize Amount:</label><br>
                <input type="text" name="amountInput" id="amountInput">
              </div>
            </td>
          </tr>
          <tr>
            <td>Level</td>
            <td>
              <select name="level" required>
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
  var row_count=0
  function removeRows() {
  var table = document.getElementById("table1");
  for (var i = 0; i < row_count ; i++) {
      table.deleteRow(5); 
  }
  row_count=0;
  }
  function add() {
      row_count=row_count+1;
    var table = document.getElementById("table1");
    var row = table.insertRow(5);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML = "";
    cell2.innerHTML = '<input type="text" name="name[]" placeholder="Name">';
    cell3.innerHTML = '<input type="text" name="regno[]" placeholder="Register No">';
    cell4.innerHTML = '<select name="year[]"><option value="None">Year</option><option value="1">I</option><option value="2">II</option><option value="3">III</option><option value="4">IV</option></select>';
    cell5.innerHTML = '<select name="Branch[]"> <option value="None">Branch</option> <option value="AIML">AIML</option> <option value="AIDS">AIDS</option> <option value="CSE">CSE</option> <option value="CSBS">CSBS</option> <option value="IT">IT</option> <option value="ECE">ECE</option> <option value="EEE">EEE</option> <option value="ME">ME</option> <option value="CE">CE</option> </select>';
    cell6.innerHTML = '<input type="file" name="doc[]" accept="image/jpeg" placeholder="Certificate">';
    cell7.innerHTML = '<button type="button" onclick="removeRow(this.parentNode.parentNode)">-</button>';

    cell1.style.borderLeft = '1px solid transparent';
    cell1.style.borderBottom = '1px solid transparent';
    var vb = document.getElementById('vb');
    vb.style.borderTop = '2px solid #dddd';
  }

  var individualRadio = document.getElementById('individual');
  var teamRadio = document.getElementById('team');
  var addButton = document.getElementById('addButton');
  var teamInputBox = document.getElementById('teamInputBox');
  var wonRadio = document.getElementById('won');
  var participantRadio = document.getElementById('participant');
  var prizeInputBox = document.getElementById('prizeInputBox');

  individualRadio.addEventListener('change', function() {
    if (this.checked) {
      addButton.disabled = true;
      teamInputBox.classList.add('hidden');
      removeRows();
    }
  });

  teamRadio.addEventListener('change', function() {
    if (this.checked) {
      addButton.disabled = false;
      teamInputBox.classList.remove('hidden');
    }
  });

  wonRadio.addEventListener('change', function() {
    if (this.checked) {
      prizeInputBox.classList.remove('hidden');
    }
  });

  participantRadio.addEventListener('change', function() {
    if (this.checked) {
      prizeInputBox.classList.add('hidden');
    }
  });

  function removeRow(row) {
    row.parentNode.removeChild(row);
  }
</script>

</html>


