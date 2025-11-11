<?php
// Start the session to store error messages
session_start();

// Include the database connection file
require_once "db_connect.php";

// Initialize an array to store validation errors
$errors = [];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Validate Student ID ---
    $student_id = trim($_POST["student_id"]);
    if (empty($student_id)) {
        $errors[] = "Student ID is required.";
    }

    // --- Validate First Name ---
    $first_name = trim($_POST["first_name"]);
    if (empty($first_name)) {
        $errors[] = "First Name is required.";
    }

    // --- Validate Last Name ---
    $last_name = trim($_POST["last_name"]);
    if (empty($last_name)) {
        $errors[] = "Last Name is required.";
    }

    // --- Validate Age ---
    $age = trim($_POST["age"]);
    if (empty($age)) {
        $errors[] = "Age is required.";
    } elseif (!filter_var($age, FILTER_VALIDATE_INT) || $age <= 0) {
        $errors[] = "Age must be a valid positive number.";
    }

    // --- Validate Address (optional) ---
    $address = trim($_POST["address"]); // Address can be empty

    // --- Validate Username ---
    $username = trim($_POST["username"]);
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 4) {
        $errors[] = "Username must have at least 4 characters.";
    } else {
        // Check if username already exists
        $sql = "SELECT id FROM students WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $errors[] = "This username is already taken.";
            }
            $stmt->close();
        }
    }

    // --- Validate Password ---
    $password = $_POST["password"]; // Don't trim password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    } elseif (!preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $errors[] = "Password must contain at least one letter and one number.";
    }

    // --- Check if Student ID already exists ---
    if (empty($errors)) { // Only check if other errors are not present
        $sql = "SELECT id FROM students WHERE student_id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $errors[] = "This Student ID is already registered.";
            }
            $stmt->close();
        }
    }

    // --- If there are no errors, proceed with registration ---
    if (empty($errors)) {
        
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an insert statement
        $sql = "INSERT INTO students (username, password, first_name, last_name, age, address, student_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssiss", $username, $hashed_password, $first_name, $last_name, $age, $address, $student_id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page upon successful registration
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    } else {
        // There were errors. Store them in the session and redirect back to signup page.
        $_SESSION['errors'] = $errors;
        header("location: signup.php");
        exit();
    }

    // Close connection
    $conn->close();
} else {
    // If someone tries to access this file directly, redirect them
    header("location: signup.php");
    exit();
}