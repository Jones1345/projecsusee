<?php
session_start();
require 'db_connect.php'; // Ensure database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dance Class</title>
    <link rel="stylesheet" href="css\styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Dance Class</div>
        <div>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="change_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Dashboard Section -->
    <section class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

        <?php if ($user['role'] == 'admin'): ?>
            <h2>Admin Panel</h2>
            <a href="manage_packages.php">Manage Packages</a>
            <a href="view_registrations.php">View Registrations</a>
            <a href="view_feedback.php">View Feedback</a>
        <?php else: ?>
            <h2>User Options</h2>
            <a href="view_packages.php">View Dance Packages</a>
            <a href="feedback.php">Submit Feedback</a>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
