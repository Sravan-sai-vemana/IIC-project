<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>achievements</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
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

    .level-block {
  display: inline-block;
  margin: 20px;
  padding: 20px;
  border: 2px solid #dddddd;
  border-radius: 10px;
  width: 300px;
  height: 350px;
  transition: all 0.3s ease;
  cursor: pointer;
  position: relative; /* Add position relative */
}

.level-block:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.level-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 5px;
}

.level-image {
  border-radius: 10px;
  height: 270px;
  width: 100%;
  margin-bottom: 10px;
  object-fit: cover;
}

.level-description {
  font-size: 16px;
}

#frame {
  min-width: 1200px; /* Add minimum width to frame */
}

#all {
  position: relative;
  width: 980px;
  height: 100px;
  font-size: 50px;
  font-weight: bold;
  border: 2px solid #dddddd;
  border-radius: 10px;
  transition: all 0.3s ease;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; /* Ensure the image fits within the border radius */
  text-align: center;
}
#all img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover; /* Ensures the image covers the entire div */
  z-index: -1; /* Places the image behind the text */
}
#all h2 {
  position: relative;
  z-index: 1;
  color: white; /* Optional: Improve readability */
  padding: 10px;
  margin: 0;
}
#all:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}.level-title {
      position: absolute;
      top: 50%; /* Center vertically */
      left: 50%; /* Center horizontally */
      transform: translate(-50%, -50%); /* Center adjustment */
      z-index: 1;
      color: white;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin: 0;
      padding: 10px;
      background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent background */
      width: 100%; /* Full width of parent */
      transition: background-color 0.3s ease; /* Smooth transition for hover */
    }
    .level-block:hover .level-title {
      background-color: rgba(0, 0, 0, 0.8); /* Darker background on hover */
    }

    .level-image {
      border-radius: 10px;
      height: 270px;
      width: 100%;
      margin-bottom: 10px;
      object-fit: cover;
    }
    .category-block {
      margin: 40px;
      border: 4px solid black;
      border-radius : 10%;
       /* Space between technical and non-technical blocks */
    }
    .category-title {
      margin-top: 25px;
      font-size: 40px;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div id="frame">
    <div class=" bg-[#2d3091] flex justify-between items-center">
      <a href="main.php"><img src="./Images/iiclogo.png" class=" clip bg-white px-16 py-4 w-72" /></a>
      <div class="text-center">
        <h1 class="text-[#ffee00] text-2xl font-bold">VISHNU INSTITUTE OF TECHNOLOGY</h1>
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

      <div id="institute-level" class="level-block">
        <a href="achi_institute.php">
          <h2 class="level-title">Institution Level</h2>
          <img class="level-image" src="https://as2.ftcdn.net/v2/jpg/05/55/78/61/1000_F_555786171_94GdahGA1CvTBiyCpOzJCXNo0sYUGgSQ.jpg" >
        </a>
      </div>

      <div id="state-level" class="level-block">
        <a href="achi_state.php">
        <h2 class="level-title">State Level</h2>
        <img class="level-image" src="https://rukminim2.flixcart.com/image/850/1000/k0cqqvk0/puzzle/h/v/y/99-elite-india-map-with-state-capitals-educational-to-sanchi-original-imafkfzpvup5mbxf.jpeg?q=90&crop=false" >
      </a>
      </div>

      <div id="national-level" class="level-block">
        <a href="achi_national.php">
        <h2 class="level-title">National Level</h2>
        <img class="level-image" src="https://png.pngtree.com/thumb_back/fh260/background/20210729/pngtree-scratched-watercolor-indian-flag-background-image_753774.jpg">
      </a>
      </div>

      <div id="all">
        <center>
        <a href="achievement.php" style="text-decoration: none; color: inherit;">
          <h2>All</h2>
          <img src="https://img.freepik.com/free-photo/abstract-blurred-multi-colored-background-generative-ai_169016-30200.jpg?size=626&ext=jpg&ga=GA1.1.1141335507.1717891200&semt=ais_user">
        </a>
      </center>
      </div>
      <?php
      require('db.php');
      $sql = "SELECT Catogery, type FROM event_catogery";
      $result = $db->query($sql);

      // Initialize arrays for technical and non-technical categories
      $technical_categories = [];
      $non_technical_categories = [];

      // Separate categories based on category_type
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $category_name = $row["Catogery"];
          $type = $row["type"];
          $category_type = $row["type"];

          // Determine category block based on category_type
          if ($category_type == "Technical") {
            $technical_categories[] = [
              'name' => $category_name,
              'type' => $type
            ];
          } else {
            $non_technical_categories[] = [
              'name' => $category_name,
              'type' => $type
            ];
          }
        }
      }

      // Display technical categories
      if (!empty($technical_categories)) {
        echo "<h2 class='category-title'>Technical</h2>";
        echo "<div class='category-block'>";
        foreach ($technical_categories as $category) {
          echo "<div class='level-block'>";
          echo "<form action='category.php' method='post'>";
          echo "<input type='hidden' name='Category' value='" . $category['name'] . "'>";
          echo "<button type='submit' style='padding: 0; border: none; background: none;'>";
          echo "<img class='level-image' src='images/" . $category['type'] . ".jpg'>";
          echo "<h2 class='level-title'>" . $category['name'] . "</h2>";
          echo "</button>";
          echo "</form>";
          echo "</div>";
        }
        echo "</div>";
      }

      // Display non-technical categories
      if (!empty($non_technical_categories)) {
        echo "<h2 class='category-title'>Non-Technical</h2>";
        echo "<div class='category-block'>";
        foreach ($non_technical_categories as $category) {
          echo "<div class='level-block'>";
          echo "<form action='category.php' method='post'>";
          echo "<input type='hidden' name='Category' value='" . $category['name'] . "'>";
          echo "<button type='submit' style='padding: 0; border: none; background: none;'>";
          echo "<img class='level-image' src='images/" . $category['type'] . ".jpg'>";
          echo "<h2 class='level-title'>" . $category['name'] . "</h2>";
          echo "</button>";
          echo "</form>";
          echo "</div>";
        }
        echo "</div>";
      }
      ?>

    </center>
    <div class="mt-20 text-center flex items-center justify-center" id="banner">
      <marquee behavior="scroll" direction="left">
        <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]">DR V Narsimha Raju | P L N Prakash Kumar | V Sravan Sai | K Mani Shankar</span></h1>
      </marquee>
    </div>

  </div>

</body>

</html>