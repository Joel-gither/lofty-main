<?php
// Database credentials (replace with your actual credentials)
$db_host = "localhost";
$db_user = "root";
$db_pass = "Boblinjoel38";
$db_name = "loftydb";

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get and sanitize user input
    $username = htmlspecialchars($_POST["username"]); // Prevent XSS
    $password = $_POST["password"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // Sanitize email

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check if username already exists
    $check_username_sql = "SELECT * FROM users WHERE username = ?";
    $check_username_stmt = $conn->prepare($check_username_sql);
    $check_username_stmt->bind_param("s", $username);
    $check_username_stmt->execute();
    $result = $check_username_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the user
    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("sss", $username, $hashed_password, $email);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    $check_username_stmt->close();
} else {
    // Display the registration form
    ?>
    Register User:<br />
    <form method="post">
        <input type="text" name="username" required> User <br />
        <input type="password" name="password" required> Password <br />
        <input type="email" name="email" required> E-mail <br />
        <input type="submit" name="submit" value="send" />
    </form>
    <?php
}

// Close the database connection
$conn->close();
?>
