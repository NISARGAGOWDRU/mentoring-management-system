<?php
// Establishing a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : "";
    $college = isset($_POST['college']) ? sanitize_input($_POST['college']) : "";
    $department = isset($_POST['department']) ? sanitize_input($_POST['department']) : "";
    $semester = isset($_POST['semester']) ? sanitize_input($_POST['semester']) : "";
    $contact_number = isset($_POST['contact_number']) ? sanitize_input($_POST['contact_number']) : "";
    $gmail = isset($_POST['gmail']) ? sanitize_input($_POST['gmail']) : "";
    $interests = isset($_POST['interests']) ? sanitize_input($_POST['interests']) : "";
    $weaknesses = isset($_POST['weaknesses']) ? sanitize_input($_POST['weaknesses']) : "";
    $free_time_activities = isset($_POST['free_time_activities']) ? sanitize_input($_POST['free_time_activities']) : "";
    $communication_channels = isset($_POST['communication_channels']) ? sanitize_input($_POST['communication_channels']) : "";
    $goals_and_expectations = isset($_POST['goals_and_expectations']) ? sanitize_input($_POST['goals_and_expectations']) : "";
    $learning_style_and_preferences = isset($_POST['learning_style_and_preferences']) ? sanitize_input($_POST['learning_style_and_preferences']) : "";

    // Check if the name field is empty
    if (empty($name)) {
        echo "Name is required.";
        exit;
    }

    // SQL Injection safe query to insert mentee details into database
    $stmt = $conn->prepare("INSERT INTO mentee_details (name, college, department, semester, contact_number, gmail, interests, weaknesses, free_time_activities, communication_channels, goals_and_expectations, learning_style_and_preferences) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $name, $college, $department, $semester, $contact_number, $gmail, $interests, $weaknesses, $free_time_activities, $communication_channels, $goals_and_expectations, $learning_style_and_preferences);

    // Execute the query
    if ($stmt->execute() === TRUE) {
        // Display a success message to the user
        echo "<h1>Thank you for submitting your mentee details!</h1>";
        echo "<p>We appreciate your interest in the mentorship program.</p>";

        // Display buttons for actions
        echo "<form action='mentee_details_page.php' method='post'>";
        echo "<button type='submit'>Submit Again</button>";
        echo "</form>";

        echo "<form action='login_form.php'>";
        echo "<button type='submit'>Login</button>";
        echo "</form>";

        // Redirect to the login page after a brief delay
        echo "<meta http-equiv='refresh' content='3;url=login_form.php'>"; // Redirect after 3 seconds
        exit; // Stop further execution of the script
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
} else {
    // If the form was not submitted via POST method, show an error message
    echo "<h1>Error: Form submission method not allowed.</h1>";
    echo "<p>Please make sure to submit the form using the POST method.</p>";
}

// Close database connection
$conn->close();

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
