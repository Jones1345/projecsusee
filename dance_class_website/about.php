<?php
session_start();
require 'db_connect.php'; // Ensure you have a database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Dance Class</title>
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

    <!-- About Section -->
    <section class="about">
        <h1>About Our Dance Class</h1>
        <p>Welcome to our professional dance academy, where passion meets skill. We offer various dance forms taught by experienced instructors.</p>
        
        <div class="about-content">
            <div class="about-text">
                <h2>Our Mission</h2>
                <p>We aim to inspire, educate, and transform students through the art of dance. Whether you're a beginner or an advanced dancer, we have something for you.</p>

                <h2>Why Choose Us?</h2>
                <ul>
                    <li>Expert dance instructors with years of experience.</li>
                    <li>Flexible class schedules and affordable packages.</li>
                    <li>Friendly and supportive environment.</li>
                    <li>Specialized workshops and events.</li>
                </ul>
            </div>
            <div class="about-image">
                <img src="images/class.jpg" alt="Dance Class">
            </div>
        </div>

        <h2>Meet Our Instructors</h2>
        <div class="instructors">
            <div class="instructor">
                <img src="images/in2.jpg" alt="Instructor 1">
                <h3>Emily Johnson</h3>
                <p>Ballet & Contemporary Dance Expert</p>
            </div>
            <div class="instructor">
                <img src="images/in1.jpg" alt="Instructor 2">
                <h3>Michael Smith</h3>
                <p>Hip Hop & Street Dance Instructor</p>
            </div>
            <div class="instructor">
                <img src="images/in3.avif" alt="Instructor 3">
                <h3>Lee Chan</h3>
                <p>Salsa & Latin Dance Specialist</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dance Class. All Rights Reserved.</p>
    </footer>
</body>
</html>
