<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login if not an admin
    exit();
}

// Include database connection
require 'db_connect.php';

// Check if a package ID is passed
if (isset($_GET['id'])) {
    $packageId = $_GET['id'];

    // Fetch the package details from the database
    $sql = "SELECT * FROM packages WHERE id = $packageId";
    $result = $conn->query($sql);
    print_r($result);

    if ($result->num_rows > 0) {
        // Fetch package data
        $package = $result->fetch_assoc();
        print_r($package);
    } else {
        echo "Package not found!";
        exit();
    }
} else {
    echo "No package ID provided!";
    exit();
}

// Handle form submission to update the package
if (isset($_POST['update'])) {
    $name = $_POST['name'];
}