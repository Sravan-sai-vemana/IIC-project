<?php
// Turn off output buffering to avoid any issues
ob_end_clean();

require_once('db.php'); // Include your database connection file
require 'vendor/autoload.php'; // Include autoload file for PHPSpreadsheet

// Fetch achievements data based on the user's email stored in the cookie
$user = $_COOKIE['user'];
$query = $_POST['query'];
$result = mysqli_query($db, $query);

// Create a new Excel spreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers for the Excel file
$sheet->setCellValue('A1', 'S.NO');
$sheet->setCellValue('B1', 'Date');
$sheet->setCellValue('C1', 'Register No');
$sheet->setCellValue('D1', 'Student Name');
$sheet->setCellValue('E1', 'Branch');
$sheet->setCellValue('F1', 'Year');
$sheet->setCellValue('G1', 'Level');
$sheet->setCellValue('H1', 'Event Name');
$sheet->setCellValue('I1', 'Event Category');
$sheet->setCellValue('J1', 'Team Name/Individual');
$sheet->setCellValue('K1', 'Won/Participation');
$sheet->setCellValue('L1', 'Amount');
$sheet->setCellValue('M1', 'Certificate');

// Fetch data and populate Excel rows
if (mysqli_num_rows($result) > 0) {
    $count = 2; // Start from row 2 (to avoid overwriting headers)
    while ($row = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $count, $count - 1);
        $sheet->setCellValue('B' . $count, $row['date']);
        $sheet->setCellValue('C' . $count, $row['regno']);
        $sheet->setCellValue('D' . $count, $row['name']);
        $sheet->setCellValue('E' . $count, $row['branch']);
        $sheet->setCellValue('F' . $count, $row['year']);
        $sheet->setCellValue('G' . $count, $row['Level']);
        $sheet->setCellValue('H' . $count, $row['eventName']);
        $sheet->setCellValue('I' . $count, $row['Category']);
        $sheet->setCellValue('J' . $count, $row['teamName']);
        $sheet->setCellValue('K' . $count, $row['position']);
        $sheet->setCellValue('L' . $count, $row['amount']);
        $sheet->setCellValue('M' . $count, 'http://localhost:8000/iicproject/uploads/'.$row['doc']);
        $count++;
    }
}

// Create a writer and output the Excel file
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = 'achievements.xlsx'; // Define the file name

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
