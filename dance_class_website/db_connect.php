<?php
// Database Configuration
$host = "localhost";   
$username = "root";    // Your database username
$password = "123";        // Your database password
$database = "dance_class"; // Your database name

// Create Database Connection
$conn = new mysqli($host, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment to display success message during testing
// echo "Database Connected Successfully";
?>
