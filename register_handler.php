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
    $gmail = sanitize_input($_POST["gmail"]); 
    $password = sanitize_input($_POST["password"]);
    $repeat_password = sanitize_input($_POST["repeat_password"]);
    $role = sanitize_input($_POST["role"]);

    // Check if passwords match
    if ($password !== $repeat_password) {
        echo "Passwords do not match!";
        exit;
    }

   
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR gmail = ?"); 
    $check_stmt->bind_param("ss", $username, $gmail); 
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Username or gmail already exists. Please register with different credentials."; 
        exit;
    }

    // Hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL Injection safe query
    $insert_stmt = $conn->prepare("INSERT INTO users (username, gmail, password, role) VALUES (?, ?, ?, ?)"); 
    $insert_stmt->bind_param("ssss", $username, $gmail, $hashed_password, $role); 
    
    // Execute the insert query
    if ($insert_stmt->execute() === TRUE) {
        // Registration successful
        echo "Registration successful!";
        
        // Redirect based on user's role
        if ($role === "mentee") {
            header("Location: mentee_details_page.php"); // Redirect to mentee form
            exit;
        } else if ($role === "mentor") {
            header("Location: mentor_details_page.php"); // Redirect to mentor form
            exit;
        }
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    // Close prepared statements
    $insert_stmt->close();
    $check_stmt->close();
}

// Close database connection
$conn->close();
?>


