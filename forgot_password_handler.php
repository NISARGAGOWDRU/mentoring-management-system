<?php
session_start();

// Establishing a connection to MySQL database
$servername = "localhost"; // Change this according to your database server
$username = "root"; // Change this according to your database username
$password = ""; // Change this according to your database password
$database = "database"; // Change this according to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Handling forgot password form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $gmail = sanitize_input($_POST["gmail"]);
    $new_password = sanitize_input($_POST["new_password"]);

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE gmail = ?");
    $update_stmt->bind_param("ss", $hashed_password, $gmail);
    $update_stmt->execute();

    // Check if the password was successfully updated
    if ($update_stmt->affected_rows == 1) {
        // Send the new password to the user via email (not implemented here)

        // Redirect to a success page or provide a success message
        header("Location: password_reset_success.php");
        exit;
    } else {
        // Failed to update password
        header("Location: forgot_password_form.php?error=Failed to reset password. Please try again later.");
        exit;
    }

    // Close prepared statement
    $update_stmt->close();
}

// Close database connection
$conn->close();
?>
