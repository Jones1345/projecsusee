<?php
// Start session to access session variables
session_start();

// Destroy all session data to log the user out
session_unset();
session_destroy();

// Redirect to the homepage after logging out
header("Location: index.php");
exit;
?>
