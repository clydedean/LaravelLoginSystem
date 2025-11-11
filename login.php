<?php
// Start the session
session_start();

// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS - Login</title>
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
            max-width: 400px;
            box-sizing: border-box;
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

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #555;
        }

        .signup-link a {
            color: #005A9C;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .signup-link a:hover {
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
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo-container">
            <!-- IMPORTANT: Change 'logo.png' to your actual logo filename -->
            <img src="images/logo.png" alt="School Logo">
        </div>
        <h1>Student Login</h1>
        <p>Student Information System</p>

        <?php
        // Check if there is a login error message
        if (isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])) {
            echo '<div class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
            // Clear the error message after displaying it
            unset($_SESSION['login_error']);
        }
        ?>

        <form action="login_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>

</body>
</html>