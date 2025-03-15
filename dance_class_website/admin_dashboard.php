<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login if not an admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dance Class</title>
    <link rel="stylesheet" href="css\styles.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Admin Dashboard Content -->
<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>

    <div class="dashboard-section">
        <h2>User Management</h2>
        <p>Manage all users of the website.</p>
        <a href="view_users.php">View Registered Users</a>
    </div>

    <div class="dashboard-section">
        <h2>Packages Management</h2>
        <p>Manage dance packages offered to the users.</p>
        <a href="manage_packages.php">Manage Packages</a>
    </div>

    <div class="dashboard-section">
        <h2>Feedback</h2>
        <p>View feedback provided by the users.</p>
        <a href="view_feedback.php">View Feedback</a>
    </div>

    <div class="dashboard-section">
        <h2>Other Features</h2>
        <p>Additional features and settings.</p>
        <a href="#">Settings</a>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
