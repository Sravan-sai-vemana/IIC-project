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
  <title>Achievements</title>
  <style>
    body {
      background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Black_Wallpaper.jpg/2560px-Black_Wallpaper.jpg);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding-top: 20px;
    }

    .table-container {
      margin-bottom: 20px;
    }

    #table1 {
      background: rgb(224, 223, 223);
      color: #1a1818;
      border-radius: 16px;
      box-shadow: 0 2px 5px rgb(243, 242, 242);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(2px);
    }

    #table1 th,
    #table1 td {
      padding: 13px;
    }

    #table1 th {
      background-color: #f2f2f2;
    }

    .img-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 20px;
    }

    .img1 {
      height: 200px;
      width: auto;
      transition: transform 0.3s ease-in-out;
      cursor: pointer;
    }

    .img1:hover {
      transform: scale(1.1);
      backdrop-filter: blur(1px);
    }

    .p1 {
      text-align: center;
      font-size: 30px;
      margin-top: 10px;
      color: #f2f2f2;
      margin-bottom: 2%;
    }

    .p2 {
      text-align: center;
      font-size: 30px;
      margin-top: 10px;
      color: #f2f2f2;
      margin-bottom: 7%;
    }

    .table-wrapper {
      display: flex;
    }

    .table-container {
      flex: 1;
    }

    #frame {
      width: 100%;
      overflow: hidden;
      position: relative;
      margin: auto;
    }

    /* Modal styling */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.9);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
    }

    .close {
      position: absolute;
      top: 20px;
      right: 35px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      background-image: url('https://wallpapers.com/images/hd/all-black-background-zhwy8n8us2js8729.jpg'); /* Replace with your image URL */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed; /* Ensures the background image stays fixed during scrolling */
  }
  </style>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
  <div id="frame">
    <div class="bg-[#2d3091] flex justify-between items-center">
      <a href="main.php"><img src="./Images/iiclogo.png" class="clip bg-white px-16 py-4 w-72" /></a>
      <div class="text-center">
        <h1 class="text-[#ffee00] text-2xl font-bold">VISHNU INSTITUTE OF TECHNOLOGY</h1>
        <h1 class="text-white text-3xl font-bold">Institution's Innovation Council</h1>
      </div>
      <div class="flex items-center mr-20">
        <img src="./Images/founder.png" class="w-14" />
        <div class="divider"></div>
        <img src="./Images/logo.png" class="w-14 mr-2" />
        <div class="text-white font-bold">
          <h1>VIT</h1>
          <h1>Bhimavaram</h1>
        </div>
      </div>
    </div>
    <div class="table-wrapper">
      <div class="container table-container">
        <div class="table-container">
          <p class="p1">Event Details</p>
          <table id="table1">
            <?php 
            $d=$_POST['date'];
            $tN=$_POST['teamName'];
            $eN=$_POST['eventName'];
            $query1 = "SELECT * FROM achievements where date='$d' and teamName='$tN' and eventName='$eN'";
            $result1 = mysqli_query($db, $query1);
            if (mysqli_num_rows($result1) > 0) {
              $flag=1;
              while ($tab = mysqli_fetch_assoc($result1)) {
                $date = $tab['date'];
                $teamName = $tab['teamName'];
                $eventName = $tab['eventName'];
                $position = $tab['position'];
                $level = $tab['Level'];
                $amount = $tab['amount'];
                echo'<tr>';
                echo '<td><b>Date :</b></td>';
                echo '<td>'.$date.'</td>';
                echo '</tr><tr>';
                echo '<td><b>Event Name :</b></td>';
                echo '<td>'.$eventName.'</td>';
                echo '</tr><tr>';
                echo '<td><b>Team Name :</b></td>';
                echo '<td>'.$teamName.'</td>';
                echo '</tr><tr>';
                echo '<td><b>Prize Won / Participation :</b></td>';
                echo '<td> '.$position.'</td>';
                echo '</tr><tr>';
                echo '<td><b>Level :</b></td>';
                echo '<td>'.$level.'</td>';
                echo '</tr><tr>';
                echo '<td><b>Amount :</b></td>';
                echo '<td>'.$amount.'</td>';
                echo '</tr>';
                break;
        }}
            ?>
          </table>
        </div>
      </div>
      <div class="container table-container">
        <div class="table-container">
          <p class="p2">Team Details</p>
          <table id="table1">
            <tr>
              <td><b>No</b></td>
              <td><b>Name</b></td>
              <td><b>Register No</b></td>
              <td><b>Year</b></td>
              <td><b>Branch</b></td>
            </tr>
<?php
    $query = "SELECT * FROM achievements WHERE date='$d' and teamName='$tN' and eventName='$eN'";
    $result = mysqli_query($db, $query);
    // Loop through fetched records and display in table rows
    if (mysqli_num_rows($result) > 0) {
      $count = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $count++ . "</td>"; 
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['regno'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "</tr>";
      }
    } 
?>
          </table>
        </div>
      </div>
    </div>
    <div class="img-container">
    <?php
    $query = "SELECT * FROM achievements WHERE date='$d' and teamName='$tN' and eventName='$eN'";
    $result = mysqli_query($db, $query);
    // Loop through fetched records and display in table rows
    if (mysqli_num_rows($result) > 0) {
      $count = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div>';
        echo '<p class="p1">Member '.$count.'</p>';
        echo '<img src="uploads/'.$row['doc'].'" class="img1">';
        echo '</div>';
        $count++;
      }
    } 
?>
      
  </div>
  <div class="mt-20 text-center flex items-center justify-center" id="banner">
      <marquee behavior="scroll" direction="left">
        <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]">DR V Narsimha Raju | P L N Prakash Kumar | V Sravan Sai | K Mani Shankar</span></h1>
      </marquee>
    </div>

  <!-- Modal for full-screen image -->
  <div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
  </div>

  <script>
    function displayFullScreenImage(url) {
      var modal = document.getElementById('imageModal');
      var modalImg = document.getElementById('modalImage');
      modal.style.display = 'flex';
      modalImg.src = url;
    }

    var closeBtn = document.getElementsByClassName('close')[0];
    closeBtn.onclick = function() {
      var modal = document.getElementById('imageModal');
      modal.style.display = 'none';
    }

    var images = document.querySelectorAll('.img1');
    images.forEach(function(image) {
      image.addEventListener('click', function() {
        displayFullScreenImage(image.src);
      });
    });

    window.onclick = function(event) {
      var modal = document.getElementById('imageModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
  </script>
</body>

</html>