<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['gmail'])) {
    header("Location: login_form.php");
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "database";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve logged-in user's email
$gmail = $_SESSION['gmail'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $interests = mysqli_real_escape_string($conn, $_POST['interests']);
    $weaknesses = mysqli_real_escape_string($conn, $_POST['weaknesses']);
    $free_time_activities = mysqli_real_escape_string($conn, $_POST['free_time_activities']);
    $communication_channels = mysqli_real_escape_string($conn, $_POST['communication_channels']);
    $goals_and_expectations = mysqli_real_escape_string($conn, $_POST['goals_and_expectations']);
    $learning_style_and_preferences = mysqli_real_escape_string($conn, $_POST['learning_style_and_preferences']);

    // SQL query to update mentee details
    $sql = "UPDATE mentee_details SET 
            name='$name', 
            college='$college', 
            department='$department', 
            semester='$semester', 
            contact_number='$contact_number', 
            interests='$interests', 
            weaknesses='$weaknesses', 
            free_time_activities='$free_time_activities', 
            communication_channels='$communication_channels', 
            goals_and_expectations='$goals_and_expectations', 
            learning_style_and_preferences='$learning_style_and_preferences' 
            WHERE gmail='$gmail'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Mentee details updated successfully";
    } else {
        $_SESSION['message'] = "Error updating mentee details: " . $conn->error;
    }

    // Redirect back to mentee.php
    header("Location: mentee.php");
    exit;
}

// Close database connection
$conn->close();
?>
