<?php
session_start();
require 'db_connect.php'; // Ensure database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all feedback from the database
$feedbacks = $conn->query("SELECT feedback.id, users.name, feedback.feedback_text, feedback.created_at 
                           FROM feedback 
                           JOIN users ON feedback.user_id = users.id 
                           ORDER BY feedback.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - Dance Class</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Dance Class</div>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_packages.php">Manage Packages</a>
            <a href="view_users.php">View Users</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- View Feedback Section -->
    <section class="view-feedback">
        <h1>User Feedback</h1>
        
        <table>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Feedback</th>
                <th>Date Submitted</th>
            </tr>
            <?php while ($feedback = $feedbacks->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $feedback['id']; ?></td>
                    <td><?php echo htmlspecialchars($feedback['name']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['feedback_text']); ?></td>
                    <td><?php echo date('Y-m-d H:i', strtotime($feedback['created_at'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section><br><br><br>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
