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

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitize_input($data, $conn) {
        return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
    }

    // Validate and sanitize user inputs
    $full_name = isset($_POST['full_name']) ? sanitize_input($_POST['full_name'], $conn) : "";
    $contact_details = isset($_POST['contact_details']) ? sanitize_input($_POST['contact_details'], $conn) : "";
    $gmail = isset($_POST['gmail']) ? sanitize_input($_POST['gmail'], $conn) : "";
    $education_degree = isset($_POST['education_degree']) ? sanitize_input($_POST['education_degree'], $conn) : "";
    $education_institution = isset($_POST['education_institution']) ? sanitize_input($_POST['education_institution'], $conn) : "";
    $education_field = isset($_POST['education_field']) ? sanitize_input($_POST['education_field'], $conn) : "";
    $experience_job_title = isset($_POST['experience_job_title']) ? sanitize_input($_POST['experience_job_title'], $conn) : "";
    $experience_employer = isset($_POST['experience_employer']) ? sanitize_input($_POST['experience_employer'], $conn) : "";
    $experience_dates = isset($_POST['experience_dates']) ? sanitize_input($_POST['experience_dates'], $conn) : "";
    $skills = isset($_POST['skills']) ? sanitize_input($_POST['skills'], $conn) : "";
    $certifications = isset($_POST['certifications']) ? sanitize_input($_POST['certifications'], $conn) : "";
    $availability_days = isset($_POST['availability_days']) ? sanitize_input($_POST['availability_days'], $conn) : "";
    $availability_hours = isset($_POST['availability_hours']) ? sanitize_input($_POST['availability_hours'], $conn) : "";
    $motivation = isset($_POST['motivation']) ? sanitize_input($_POST['motivation'], $conn) : "";

    // SQL Injection safe query to insert mentor details into the database
    $sql = "INSERT INTO mentor_details (full_name, contact_details, gmail, education_degree, education_institution, education_field, experience_job_title, experience_employer, experience_dates, skills, certifications, availability_days, availability_hours, motivation) VALUES ('$full_name', '$contact_details', '$gmail', '$education_degree', '$education_institution', '$education_field', '$experience_job_title', '$experience_employer', '$experience_dates', '$skills', '$certifications', '$availability_days', '$availability_hours', '$motivation')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Display a success message to the user
        $success_message = "Thank you for submitting your mentor details!";
    } else {
        // Display an error message if insertion fails
        $error_message = "Error: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Details Submission</title>
</head>
<body>
    <?php if(isset($success_message)): ?>
    <h1><?php echo $success_message; ?></h1>
    <p>We appreciate your interest in being a mentor.</p>
    <form action="mentor_details_page.php" method="post">
        <button type="submit">Submit Again</button>
    </form>
    <form action="login_form.php">
        <button type="submit">Login</button>
    </form>
    <?php elseif(isset($error_message)): ?>
    <h1><?php echo $error_message; ?></h1>
    <?php endif; ?>
</body>
</html>
