<?php
session_start();
require 'db_connect.php'; // Ensure you have a database connection file

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance Class</title>
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

    <!-- Hero Section -->
    <header class="hero">
        <h1>Welcome to Our Dance Class</h1>
        <p>Learn the art of dance with professional instructors.</p>
        <a href="register.php" class="button">Join Now</a>
    </header>

    <!-- Offers Section -->
    <section class="offers">
        <h2>Our Packages</h2>
        <div class="package-container">
            <?php
            $result = $conn->query("SELECT * FROM packages LIMIT 3");
            while ($row = $result->fetch_assoc()):
            ?>
                <div class="package">
                    <img src="images/<?php echo $row['file_name']; ?>" alt="<?php echo $row['title']; ?>" />
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p><strong>Price: $<?php echo $row['price']; ?> / month</strong></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <h2>Contact Us</h2>
        <p>Email: info@danceclass.com | Phone: +123 456 7890</p>
        <p>Visit us at: 123 Dance Street, City, Country</p>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
