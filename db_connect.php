<?php
/*
 * Database Connection File
 * Connects to the MySQL database using MySQLi.
 */

// Database credentials (default for XAMPP)
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sis_db'); // The database you created

// Attempt to connect to MySQL database
// This line is corrected to use positional arguments
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn->connect_error){
    die("ERROR: Could not connect. " . $conn->connect_error);
}
