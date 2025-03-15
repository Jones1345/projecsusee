<?php
// Include database connection
require 'db_connect.php';

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match!";
    } else {
        // Verify the current password
        if (md5($current_password) !== $user['password']) {
            $error = "Current password is incorrect!";
        } else {
            // Update the password
            $new_password_hash = md5($new_password);  // MD5 hashing (not recommended for modern security)
            $update_sql = "UPDATE users SET password = '$new_password_hash' WHERE id = $user_id";
            if (mysqli_query($conn, $update_sql)) {
                $success = "Password changed successfully!";
            } else {
                $error = "Error updating password. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="css\styles.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include 'includes/header.php'; ?>

<h2>Change Your Password</h2>

<?php if (isset($error)): ?>
    <div class="error-message"><?= $error; ?></div>
<?php elseif (isset($success)): ?>
    <div class="success-message"><?= $success; ?></div>
<?php endif; ?>

<form action="" method="POST">
    <label for="current_password">Current Password:</label>
    <input type="password" name="current_password" id="current_password" required>
    
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" id="new_password" required>
    
    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required>
    
    <button type="submit">Change Password</button>
</form><br><br>

<?php include 'includes/footer.php'; ?>

</body>
</html>
