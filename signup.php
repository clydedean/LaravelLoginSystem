<?php
// Start the session to handle error messages
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS - Sign Up</title>
    <style>
        /* Import Inter font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
            margin: 2rem 0;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo-container img {
            max-width: 100px; /* Adjust max-width as needed */
            height: auto;
        }

        h1 {
            text-align: center;
            color: #333;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        p {
            text-align: center;
            color: #666;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box; /* Important for padding to work correctly */
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #005A9C;
            box-shadow: 0 0 0 3px rgba(0, 90, 156, 0.1);
        }

        .btn {
            width: 100%;
            padding: 0.85rem;
            border: none;
            border-radius: 8px;
            background-color: #005A9C;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #004a80;
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #555;
        }

        .login-link a {
            color: #005A9C;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #004a80;
            text-decoration: underline;
        }

        /* Error Message Styling */
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .error-message ul {
            margin: 0;
            padding-left: 1.2rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo-container">
            <!-- IMPORTANT: Change 'logo.png' to your actual logo filename -->
            <img src="images/logo.png" alt="School Logo">
        </div>
        <h1>Create Account</h1>
        <p>Student Information System</p>

        <?php
        // Check if there are any error messages stored in the session
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            echo '<div class="error-message">';
            echo '<strong>Please fix the following errors:</strong>';
            echo '<ul>';
            foreach ($_SESSION['errors'] as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
            
            // Clear the errors from the session
            unset($_SESSION['errors']);
        }
        ?>

        <form action="signup_process.php" method="POST" novalidate>
            <div class="form-group">
                <label for="student_id">Student ID Number</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Sign In</a>
        </div>
    </div>

</body>
</html>