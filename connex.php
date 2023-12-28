<?php
$servername = "localhost";
$username = "root";
$password = "****";
$dbname = "dibadudb";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Instead of die(), you can throw an exception or log the error
    throw new Exception("Connection failed: " . $conn->connect_error);
}

// Now you can use $conn for your database operations
?>
