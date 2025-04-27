<?php
// Database credentials (replace with your actual credentials)
$servername = "localhost";
$db_username = "username";
$db_password = "password";
$dbname = "loftydb";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the token from the URL
$token = $_GET['token'];

// Check if the token exists and is valid
$sql = "SELECT * FROM users WHERE verification_token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Token is valid, update the user's status to verified
    $row = $result->fetch_assoc();
    $userId = $row['id']; // Assuming you have an 'id' column

    $updateSql = "UPDATE users SET verified = 1, verification_token = NULL WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $userId);

    if ($updateStmt->execute()) {
        echo "Your email has been verified! You can now <a href='index.html'>login</a>.";
    } else {
        echo "Error verifying email.";
    }
    $updateStmt->close();
} else {
    echo "Invalid verification token.";
}

$stmt->close();
$conn->close();
?>
