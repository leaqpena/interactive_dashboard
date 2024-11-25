<?php
session_start(); // Start the session

// Check if the user is logged in (replace with your actual condition)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: users/login.php");
    exit();
}

// Your page content goes here
?>