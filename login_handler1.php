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

// Handling login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $gmail = sanitize_input($_POST["gmail"]);
    $password = sanitize_input($_POST["password"]);

    // Check if the email exists in the database
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE gmail = ?");
    $check_stmt->bind_param("s", $gmail);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 1) { // If gmail exists in the database
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        $role = $row["role"]; // Get user's role
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set up session
            $_SESSION["gmail"] = $gmail;
            // Redirect based on role
            if ($role === "mentee") {
                header("Location: user.php");
            } elseif ($role === "mentor") {
                header("Location: user.php");
            } elseif ($role === "admin") {
                header("Location: user.php");
            } else {
                // Handle unknown role
                header("Location: login_form1.php?error=Unknown role.");
            }
            exit;
        } else {
            // Password does not match
            header("Location: login_form1.php?error=Incorrect password. Please try again.");
            exit;
        }
    } else {
        // Email does not exist in the database
        header("Location: login_form1.php?error=Gmail not found. Please check your gmail address or register if you haven't already.");
        exit;
    }

    // Close prepared statement
    $check_stmt->close();
}

// Close database connection
$conn->close();
?>
