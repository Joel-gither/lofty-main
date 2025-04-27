<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database credentials (replace with your actual credentials)
$servername = "localhost";
$db_username = "root";
$db_password = "password";
$dbname = "loftydb";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to check if the user exists and is verified
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User exists, now check the password and verification status
    $row = $result->fetch_assoc();
    if ($row['verified'] == 1) { // Check if the user is verified
        if ($password == $row['password']) { // In a real app, use password_verify() with hashed passwords
            // Login successful
            echo "Login successful!";
            // Redirect to a protected page or set a session variable
            // header("Location: dashboard.php");
        } else {
            // Incorrect password
            echo "Incorrect password.";
        }
    } else {
        // User not verified
        echo "Please verify your email before logging in.";
    }
} else {
    // User not found
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
