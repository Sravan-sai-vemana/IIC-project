<?php
session_start();
$errors = array();

require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Form validation
    if (empty($email) || empty($password)) {
        $errors[] = "Both email and password are required";
    }

    // If no errors, proceed with login
    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE username='$email'";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Verify password
           
            if (password_verify($password, $user['password'])) {
                setcookie('user', $user['username'], time() + (86400 * 30), "/");
                $_SESSION['success'] = "You are now logged in";
                header('location: main.php'); // Redirect to the dashboard or desired page
                exit();
            } else {
                $errors[] = "Incorrect password";
            }
        } else {
            $errors[] = $password;
            $errors[] = $user['password'];
            $errors[] = "User with this email does not exist";
        }
    }

    // If there are errors, display them using JavaScript alert
    if (!empty($errors)) {
        echo "<script>";
        echo "let errorMessage = '';";
        foreach ($errors as $error) {
            $escaped_error = addslashes($error); // Escape any special characters in error message
            echo "errorMessage += '$escaped_error\\n';";
        }
        echo "window.alert(errorMessage);";
        echo "</script>";
        header('location: login.html'); // Redirect to the dashboard or desired page
        exit();
    }
}
?>
