<?php
session_start();
require 'db_connect.php'; // Ensure database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $feedback_text = $_POST['feedback'];

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (user_id, feedback_text) VALUES ('$user_id', '$feedback_text')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Thank you for your feedback!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Dance Class</title>
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
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Feedback Section -->
    <section class="feedback">
        <h1>Give Us Your Feedback</h1>
        <p>We appreciate your thoughts!</p>

        <!-- Success/Error Messages -->
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Your Feedback</label>
            <textarea name="feedback" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
