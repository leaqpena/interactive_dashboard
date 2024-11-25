<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "interactive_dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " (" . $conn->connect_errno . ")");
}

echo "Connected successfully";
?>