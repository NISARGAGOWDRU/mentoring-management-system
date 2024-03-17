
<?php
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

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $username = sanitize_input($_POST["username"]);
    $gmail = sanitize_input($_POST["gmail"]); // Changed from 'gmail' to 'gmail'
    $new_password = sanitize_input($_POST["new_password"]);
    $repeat_new_password = sanitize_input($_POST["repeat_new_password"]);

    // Check if new passwords match
    if ($new_password !== $repeat_new_password) {
        echo "New passwords do not match!";
        exit;
    }

    // Hashing the new password
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ? AND gmail = ?"); 
    $update_stmt->bind_param("sss", $hashed_new_password, $username, $gmail); 

    // Execute the update query
    if ($update_stmt->execute() === TRUE) {
        // Password reset successful
        echo "Password reset successful!";
    } else {
        echo "Error: " . $update_stmt->error;
    }

    // Close prepared statements
    $update_stmt->close();
}

// Close database connection
$conn->close();
?>
