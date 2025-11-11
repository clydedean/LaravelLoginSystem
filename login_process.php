<?php
// Start the session
session_start();

// Include database connection file
require_once "db_connect.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Validate empty fields
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Username and Password are required.";
        header("location: login.php");
        exit;
    }

    // Prepare a select statement
    $sql = "SELECT id, username, password, first_name, student_id FROM students WHERE username = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_username);
        
        // Set parameters
        $param_username = $username;
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();
            
            // Check if username exists, if yes then verify password
            if ($stmt->num_rows == 1) {
                // Bind result variables
                $stmt->bind_result($id, $username, $hashed_password, $first_name, $student_id);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, so start a new session
                        session_start(); // Already started, but good to be sure
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["first_name"] = $first_name;
                        $_SESSION["student_id"] = $student_id;
                        
                        // Redirect user to dashboard page
                        header("location: dashboard.php");
                        exit;
                    } else {
                        // Password is not valid
                        $_SESSION['login_error'] = "Invalid username or password.";
                        header("location: login.php");
                        exit;
                    }
                }
            } else {
                // Username doesn't exist
                $_SESSION['login_error'] = "Invalid username or password.";
                header("location: login.php");
                exit;
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $conn->close();
} else {
    // If someone tries to access this file directly, redirect them
    header("location: login.php");
    exit;
}