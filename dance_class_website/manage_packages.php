<?php
session_start();
require 'db_connect.php'; // Ensure database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle package creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_package'])) {
    $package_name = $_POST['package_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO packages (package_name, price, description) VALUES ('$package_name', '$price', '$description')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Package added successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Handle package deletion
if (isset($_GET['delete'])) {
    $package_id = $_GET['delete'];
    $sql = "DELETE FROM packages WHERE id = '$package_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_packages.php");
    } else {
        $error_message = "Error deleting package.";
    }
}

// Fetch all packages
$packages = $conn->query("SELECT * FROM packages");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Dance Class</title>
    <link rel="stylesheet" href="css\styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Dance Class</div>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Manage Packages Section -->
    <section class="manage-packages">
        <h1>Manage Packages</h1>

        <!-- Success/Error Messages -->
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Add Package Form -->
        <form method="POST">
            <label>Package Name</label>
            <input type="text" name="package_name" required>

            <label>Price</label>
            <input type="number" name="price" required>

            <label>Description</label>
            <textarea name="description" required></textarea>

            <button type="submit" name="add_package">Add Package</button>
        </form>

        <!-- Package List -->
        <h2>Existing Packages</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Package Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($package = $packages->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $package['id']; ?></td>
                    <td><?php echo $package['name']; ?></td>
                    <td>₹<?php echo $package['price']; ?></td>
                    <td><?php echo $package['description']; ?></td>
                    <td>
                        <a href="edit_package.php?id=<?php echo $package['id']; ?>">Edit</a>
                        <a href="manage_packages.php?delete=<?php echo $package['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
