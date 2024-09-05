<?php
// db.php - Your database connection file
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST['formName'];
    $fields = $_POST['fields'];
    $types = $_POST['types'];

    if (!empty($formName) && !empty($fields) && !empty($types)) {
        // Create the table
        $query = "CREATE TABLE $formName (id INT AUTO_INCREMENT PRIMARY KEY, ";
        
        for ($i = 0; $i < count($fields); $i++) {
            $field = $fields[$i];
            $type = $types[$i];
            $query .= "$field $type, ";
        }
        
        // Remove the trailing comma and space, then close the query
        $query = rtrim($query, ', ') . ')';
        
        if ($conn->query($query) === TRUE) {
            // Insert the form name into the forms table
            $stmt = $conn->prepare("INSERT INTO forms (form_name) VALUES (?)");
            $stmt->bind_param("s", $formName);
            $stmt->execute();
            $stmt->close();
            echo "Form created successfully!";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Form name and fields are required!";
    }
}
?>

