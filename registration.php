<?php
session_start();
$errors = array();

require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive input values from the form
    $fullName = mysqli_real_escape_string($db, $_POST['fullName']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $departmentname = mysqli_real_escape_string($db, $_POST['departmentname']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);

    // Form validation
    if (empty($fullName) || empty($email) || empty($departmentname) || empty($password) || empty($confirmPassword)) {
        $errors[] = "All fields are required";
    } else {
        if ($password != $confirmPassword) {
            $errors[] = "The two passwords do not match";
        }

        // Check if user or email already exists
        $user_check_query = "SELECT * FROM users WHERE username='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $existingUser = mysqli_fetch_assoc($result);

        if ($existingUser) {
            if ($existingUser['fullName'] === $fullName) {
                $errors[] = "Username already exists";
            }

            if ($existingUser['username'] === $email) {
                $errors[] = "Email already exists";
            }
        }
    }

    // If there are errors, display them
    if (!empty($errors)) {
      echo "<script>";
      echo "let errorMessage = '';";
      foreach ($errors as $error) {
          $escaped_error = addslashes($error); // Escape any special characters in error message
          echo "errorMessage += '$escaped_error\\n';";
      }
      echo "window.alert(errorMessage);";
      echo "</script>";
  } else {
        // If no errors, proceed with registration
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (fullName, username, departmentname, password) 
                  VALUES('$fullName', '$email', '$departmentname', '$hashed_password')";
        
        mysqli_query($db, $query);

        $_SESSION['fullName'] = $fullName;
        $_SESSION['success'] = "You are now logged in";
        header('location: login.html');
        exit();
    }
}
?>
