<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Get user's first name from session
$first_name = htmlspecialchars($_SESSION["first_name"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIS</title>
    <style>
        /* Import Inter font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 260px;
            background-color: #004a80; /* Darker blue for sidebar */
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            box-sizing: border-box;
            flex-shrink: 0;
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            color: #ffffff;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            color: #e0e0e0;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background-color: #005A9C;
            color: #ffffff;
        }

        .sidebar-nav a.logout-btn {
            color: #ffcdd2;
        }

        .sidebar-nav a.logout-btn:hover {
            background-color: #c62828;
            color: #ffffff;
        }
        
        /* Icon placeholder - you can add SVG icons here */
        .sidebar-nav a svg {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
            opacity: 0.8;
        }

        .main-content {
            flex-grow: 1;
            padding: 2.5rem;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .content-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .welcome-card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .welcome-card h2 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .welcome-card p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            SIS Portal
        </div>
        <ul class="sidebar-nav">
            <li>
                <!-- Home is 'active' by default -->
                <a href="#" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10 0h3a1 1 0 001-1V10M9 20v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h-2m5 0h2" /></svg>
                    Home
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 016-6h6a6 6 0 016 6v1h-3M15 21H9" /></svg>
                    Students
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2TEST/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.747h18" /></svg>
                    Subjects
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Grades
                </a>
            </li>
        </ul>
        <ul class="sidebar-nav"> <!-- Separate list for logout -->
             <li>
                <a href="logout.php" class="logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-header">
            <h1>Dashboard</h1>
        </div>

        <div class="welcome-card">
            <h2>Welcome back, <?php echo $first_name; ?>!</h2>
            <p>Hi everyone!This is our student dashboard. The links in the sidebar don't lead anywhere yet, except for the functional logout button.</p>
            <p>You can manage your student information, check your grades, and view subject details here once the full system is built.</p>
        </div>
    </div>

</body>
</html>