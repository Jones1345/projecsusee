<?php
session_start();
require 'db_connect.php'; // Ensure database connection

// Check if ID is passed via URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Sanitize the ID

    // Fetch package details based on the provided ID
    $sql = "SELECT * FROM packages WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $package = $result->fetch_assoc();
    } else {
        // Error message if package not found
        $error_message = "Package not found.";
    }
} else {
    // Redirect if no ID is passed
    header("Location: view_packages.php");
    exit;
}

// Handle form submission for package update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $file_name = $_FILES['file_name']['name'];
    
    // Handle file upload if a new image is selected
    if ($file_name) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($file_name);
        move_uploaded_file($_FILES['file_name']['tmp_name'], $target_file);
    } else {
        // Keep the current file if no new file is uploaded
        $file_name = $package['file_name'];
    }

    // Update package in the database
    $update_sql = "UPDATE packages SET 
                   name = ?, 
                   description = ?, 
                   price = ?, 
                   file_name = ? 
                   WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssdsi", $name, $description, $price, $file_name, $id);

    if ($stmt->execute()) {
        $success_message = "Package updated successfully.";
        // Reload the package data after update
        $result = $conn->query("SELECT * FROM packages WHERE id = $id");
        $package = $result->fetch_assoc();
    } else {
        $error_message = "Error updating package.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package - Dance Class</title>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Dance Class</div>
        <div>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Error or Success Message -->
    <?php if (isset($error_message)): ?>
        <section class="error-message">
            <p style="color: red;"><?php echo $error_message; ?></p>
        </section>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
        <section class="success-message">
            <p style="color: green;"><?php echo $success_message; ?></p>
        </section>
    <?php endif; ?>

    <!-- Edit Package Form -->
    <section class="edit-package">
        <h2>Edit Package: <?php echo $package['name']; ?></h2>
        <form action="edit_package.php?id=<?php echo $package['id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="name">Package Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $package['name']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $package['description']; ?></textarea>

            <label for="price">Price (₹):</label>
            <input type="number" id="price" name="price" value="<?php echo $package['price']; ?>" required step="0.01">

            <label for="file_name">Package Image (optional):</label>
            <input type="file" id="file_name" name="file_name">

            <button type="submit">Update Package</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
