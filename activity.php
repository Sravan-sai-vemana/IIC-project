<?php
// Include your database connection file
require_once('db.php');

$user = $_COOKIE['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

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
            margin-bottom: 10px;
            cursor: pointer;
        }

        .download {
            position: absolute;
            top: 203px;
            right: 0;
        }

        /* Add this inside the <style> tag or in your style.css file */
        .grid {
            display: grid;
            padding: 10px;
        }

        /* Set the responsive columns and gap */
        .grid-cols-1 {
            grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
        }

        @media (min-width: 640px) {
            .sm\\:grid-cols-2 {
                grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .lg\\:grid-cols-2 {
                grid-template-columns: repeat(auto-fit, minmax(0, 1fr)); /* Dynamic size based on content */
            }
        }

        /* Set the gap between grid items */
        .gap-4 {
            gap: 1rem; /* Adjust as needed */
        }

        /* Make images responsive within grid items */
        .relative img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Maintain aspect ratio without cropping */
        }

        /* Ensure the images do not exceed their container's dimensions */
        .overflow-hidden {
            overflow: hidden;
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
            margin-bottom: 10px;
            cursor: pointer;
            margin-left: calc(100vw - 370px);
            
        }


    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <title>activity</title>
</head>

<body>
    <div class="MainBody">
        <div class=" bg-[#2d3091] flex justify-between items-center">
            <a href="main.php">
                <img src="./Images/iiclogo.png" class=" clip bg-white px-16 py-4 w-72" />
            </a>
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
            <p id="achi">ACTIVITIES</p>

            <a href="activity_filter.html" id="filter">Search</a>

            <table border="3" id="table1">
                <tr>
                    <th>S.NO</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Event Name</th>
                    <th>Resource Person Name</th>
                    <th>No. Of Hours</th>
                    <th>Coordinator</th>
                    <th>Facebook Link</th>
                    <th>Instagram</th>
                    <th>Linkedin</th>
                    <th>Twitter(x)</th>
                    <th>Youtube</th>
                    <th>Prizes</th>
                    <th>Amount Spent</th>
                    <th>Banner</th>
                    <th>Certificate Template</th>
                    <th>Report PDF</th>
                    <th>Report Word</th>
                    <th>Event Photos</th>
                </tr>
                <?php
                $query1 = "SELECT * FROM activity ";
                $result1 = mysqli_query($db, $query1);
                if (mysqli_num_rows($result1) > 0) {
                    $flag = 1;
                    while ($tab = mysqli_fetch_assoc($result1)) {
                        $startDate = $tab['startDate'];
                        $endDate = $tab['endDate'];
                        $eventName = $tab['eventName'];
                        $hours = $tab['hours'];
                        $coordinator = $tab['coordinator'];
                        $facebookLink = $tab['facebookLink'];
                        if($facebookLink==""){
                            $facebookLink="No Link";
                        }
                        $instagram = $tab['instagram'];
                        if($instagram==""){
                            $instagram="No Link";
                        }
                        $linkedin = $tab['linkedin'];
                        if($linkedin==""){
                            $linkedin="No Link";
                        }
                        $twitter = $tab['twitter'];
                        if($twitter==""){
                            $twitter="No Link";
                        }
                        $youtube = $tab['youtube'];
                        if($youtube==""){
                            $youtube="No Link";
                        }
                        $position = $tab['position'];
                        $amount = $tab['amount'];
                        $banner = $tab['bannerFileName'];
                        $certificate = $tab['docFileName'];
                        $report = $tab['reportFileName'];
                        $reportWord = $tab['reportFileNameWord'];
                        
                        $query2 = "SELECT * FROM resource_persons Where startDate = '$startDate' AND endDate = '$endDate' AND eventName = '$eventName' ";
                        $result2 = mysqli_query($db, $query2);
                        
                        $person_names = "";
                        $z=0;

                        foreach($result2 as $i)
                        {
                            if($z==0)
                            {
                                $person_names = $i['resourcePersonName'];
                                $z=1;
                            }
                            else{
                                $person_names = $person_names.' , '. $i['resourcePersonName'];
                            }
                        }


                        echo "<tr>";
                        echo "<td>" . $flag . "</td>";
                        echo "<td>" . $startDate . "</td>";
                        echo "<td>" . $endDate . "</td>";
                        echo "<td>" . $eventName . "</td>";
                        echo "<td>" . $person_names . "</td>";
                        echo "<td>" . $hours . "</td>";
                        echo "<td>" . $coordinator . "</td>";
                        if($facebookLink=='No Link'){
                            echo "<td>"  . $facebookLink  . "</td>";
                        }
                        else{
                            echo "<td>" . "<a href=".$facebookLink." target='_blank'>Link</a></td>";
                        }
                        if($instagram=='No Link'){
                            echo "<td>"  . $instagram  . "</td>";
                        }
                        else{
                            echo "<td>" . "<a href=".$instagram." target='_blank'>Link</a></td>";
                        }
                        if($linkedin=='No Link'){
                            echo "<td>"  . $linkedin  . "</td>";
                        }
                        else{
                            echo "<td>" . "<a href=".$linkedin." target='_blank'>Link</a></td>";
                        }
                        if($twitter=='No Link'){
                            echo "<td>"  . $twitter  . "</td>";
                        }
                        else{
                            echo "<td>" . "<a href=".$twitter." target='_blank'>Link</a></td>";
                        }
                        if($youtube=='No Link'){
                            echo "<td>"  . $youtube  . "</td>";
                        }
                        else{
                            echo "<td>" . "<a href=".$youtube." target='_blank'>Link</a></td>";
                        }
                        echo "<td>" . $position . "</td>";
                        echo "<td>" . $amount . "</td>";
                        if($banner==""){
                            echo "<td>No Banner</td>";
                        }
                        else{
                            echo "<td><a href='uploads/" . $banner . "' target='_blank'><img src='uploads/" . $banner . "'></a></td>";
                        }
                        if($certificate==""){
                            echo "<td>No Certificate Template</td>";
                        }
                        else{
                            echo "<td><a href='uploads/" . $certificate . "' target='_blank'><img src='uploads/" . $certificate . "'></a></td>";
                        }
                        if($report==""){
                            echo "<td>No Report</td>";
                        }
                        else{
                            echo "<td><a href='uploads/" . $report . "' target='_blank'>Download</a></td>";
                        }
                        if($reportWord==""){
                            echo "<td>No Word Report</td>";
                        }
                        else{
                            echo "<td><a href='uploads/" . $reportWord . "' target='_blank'>Download</a></td>";
                        }                        
                        echo "<td> <button onclick='display($flag)' style=' color :blue '> View </button>  </td>";
                        echo "</tr>";

                        // Fetch event photos for the current activity
                        $query_photos = "SELECT * FROM event_photos Where startDate = '$startDate' AND endDate = '$endDate' AND eventName = '$eventName'";
                        $result_photos = mysqli_query($db, $query_photos);
                        if (mysqli_num_rows($result_photos) > 0) {
                            // Display event photos row
                            echo "<tr class='photos-row $flag' style='display: none;'>";
                            echo "<td colspan='18'>";
                            echo "<div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-10'>";

                            // Display event photos
                            while ($row = mysqli_fetch_assoc($result_photos)) {
                                echo "<div class='relative overflow-hidden w-full h-48 sm:h-64 lg:h-80 xl:h-96'>";
                                echo "<a href='uploads/" . $row['photoFileName'] . "' target='_blank'><img src='uploads/" . $row['photoFileName'] . "'></a>";
                                echo "</div>";
                            }

                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        else{
                            echo "<tr class='photos-row $flag' style='display: none;'>";
                            echo "<td colspan='18'>";
                            echo "<div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-10'>";

                            
                            echo "<p>No Event Photos</p>";

                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        
                        $flag += 1;
                    }
                }
                ?>
            </table>
            <a href="activity_add_record.html"><input type="button" value="Add Record" id="buttontext"></a><br>
        </center>

        <input type="button" value="Download" id="buttontext" class="download" onclick="exportToExcel()">
        
    </div>
    <center>
            <div class="mt-20 text-center flex items-center justify-center" id="banner">
                <marquee behavior="scroll" direction="left">
                    <h1 class="text-xl text-white font-semibold">Designed and Developed by <span class="text-[#f9a72a]">DR V Narsimha Raju | P L N Prakash Kumar | Vemana Sravan Sai | Katta Mani Shankar</span></h1>
                </marquee>
            </div>
        </center>
    <script>
        function display(el) {
            var rows = document.getElementsByClassName('photos-row');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                if (row.classList.contains(el)) {
                    if (row.style.display === "none" || row.style.display === "") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        }

        function exportToExcel() {
    // Get the table element
    var table = document.getElementById('table1');

    // Create a worksheet
    var ws = XLSX.utils.table_to_sheet(table);

    // Set wrap text for all cells
    ws['!cols'] = Array(XLSX.utils.decode_range(ws['!ref']).e.c + 1).fill({
        wch: 20,
        s: {
            wrapText: true
        }
    });

    // Create a workbook
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Activities");

    // Trigger the download
    XLSX.writeFile(wb, 'activities_export.xlsx');
}

    </script>

</body>

</html>
