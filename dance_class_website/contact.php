<?php
session_start();
require 'db_connect.php'; // Ensure you have a database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        $success_message = "Your message has been sent successfully!";
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
    <title>Contact Us - Dance Class</title>
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

    <!-- Contact Section -->
    <section class="contact">
        <h1>Contact Us</h1>
        <p>Have questions? Get in touch with us.</p>

        <!-- Success/Error Messages -->
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <div class="contact-content">
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form method="POST">
                    <label>Name</label>
                    <input type="text" name="name" required>
                    
                    <label>Email</label>
                    <input type="email" name="email" required>
                    
                    <label>Message</label>
                    <textarea name="message" rows="5" required></textarea>
                    
                    <button type="submit">Submit</button>
                </form>
            </div>

            <!-- Contact Details -->
            <div class="contact-details">
                <h2>Our Location</h2>
                <p><strong>Address:</strong> 123 Dance Street, City, Country</p>
                <p><strong>Email:</strong> info@danceclass.com</p>
                <p><strong>Phone:</strong> +123 456 7890</p>

                <h2>Follow Us</h2>
                <p>
                    <a href="#">Facebook</a> | 
                    <a href="#">Instagram</a> | 
                    <a href="#">Twitter</a>
                </p>

                <!-- Google Maps Embed -->
                <iframe 
                    src="https://www.google.com/maps/embed?...your-map-url..." 
                    width="100%" 
                    height="250" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
