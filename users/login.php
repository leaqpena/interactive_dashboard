<?php
// Assuming you already have a connection to the database
    include ('../config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        session_start(); // Start the session for user
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        echo "Login successful!";
        // Redirect or show logged-in page
    } else {
        // Invalid login credentials
        die("Invalid email or password.");
    }
}
?><form action="login.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <button type="submit">Login</button>
    <a href="register.php">Register</a>
</form>