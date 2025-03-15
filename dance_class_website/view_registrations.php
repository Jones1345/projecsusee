<?php
session_start();
require 'db_connect.php'; // Ensure correct path

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all registered users
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registrations - Dance Class</title>
    <link rel="stylesheet" href="css\ViewRegistrations.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Dance Class</div>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_packages.php">Manage Packages</a>
            <a href="view_feedback.php">View Feedback</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- View Registrations Section -->
    <section class="view-registrations">
        <h1>Registered Users</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo ucfirst($user['role']); ?></td>
                    <td>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

     <!-- Footer -->

</body>
</html>