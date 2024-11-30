<?php
session_start();  // Start the session

// Destroy the session and all its data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Optional: Redirect to the login page or home page after logging out
header("Location: users/login.php"); 
exit();
?>
