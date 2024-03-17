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
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $contact_details = mysqli_real_escape_string($conn, $_POST['contact_details']);
    $education_degree = mysqli_real_escape_string($conn, $_POST['education_degree']);
    $education_institution = mysqli_real_escape_string($conn, $_POST['education_institution']);
    $education_field = mysqli_real_escape_string($conn, $_POST['education_field']);
    $experience_job_title = mysqli_real_escape_string($conn, $_POST['experience_job_title']);
    $experience_employer = mysqli_real_escape_string($conn, $_POST['experience_employer']);
    $experience_dates = mysqli_real_escape_string($conn, $_POST['experience_dates']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $certifications = mysqli_real_escape_string($conn, $_POST['certifications']);
    $availability_days = mysqli_real_escape_string($conn, $_POST['availability_days']);
    $availability_hours = mysqli_real_escape_string($conn, $_POST['availability_hours']);
    $motivation = mysqli_real_escape_string($conn, $_POST['motivation']);

    // SQL query to update mentor details
    $sql = "UPDATE mentor_details SET 
            full_name='$full_name', 
            contact_details='$contact_details', 
            education_degree='$education_degree', 
            education_institution='$education_institution', 
            education_field='$education_field', 
            experience_job_title='$experience_job_title', 
            experience_employer='$experience_employer', 
            experience_dates='$experience_dates', 
            skills='$skills', 
            certifications='$certifications', 
            availability_days='$availability_days', 
            availability_hours='$availability_hours', 
            motivation='$motivation' 
            WHERE gmail='$gmail'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to mentor.php after successful update
        header("Location: mentor.php");
        exit;
    } else {
        echo "Error updating mentor details: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
