<?php
// Include the database connection
include ('../config.php');  // Ensure the path to db.php is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if $mysqli is defined (for debugging)
    if (!$mysqli) {
        die("Database connection failed.");
    }

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the inputs (this is just a basic example)
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    // Prepare the SQL statement to check for existing email
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        die("Error preparing query: " . $mysqli->error);  // Debugging: show MySQLi error if preparing fails
    }

    $stmt->bind_param("s", $email);  // "s" means the parameter is a string
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        die("Email already taken.");
    }

    // Insert new user into the database
    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error preparing query: " . $mysqli->error);  // Debugging: show MySQLi error if preparing fails
    }

    $stmt->bind_param("sss", $name, $email, $hashed_password);  // "sss" means the parameters are strings
    $stmt->execute();

    echo "Registration successful!";
}
?>

<form action="register.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <button type="submit">Register</button>
</form