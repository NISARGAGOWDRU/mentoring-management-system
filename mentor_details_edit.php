<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Mentor Details</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding-top: 50px;
            background-image: url('https://www.creativefabrica.com/wp-content/uploads/2022/10/19/Soft-color-mixed-watercolor-background-Graphics-42318122-1-580x386.jpg');
            background-size: cover;
            background-position: center;
        }

        input[type="text"],
        input[type="gmail"],
        textarea,
        input[type="file"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            width: 100%;
            max-width: 400px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .form-row > div {
            width: calc(50% - 10px);
        }

        .form-row > div label {
            display: block;
        }

        .form-row > div input,
        .form-row > div textarea {
            width: 100%;
        }

        @media screen and (max-width: 600px) {
            .form-row > div {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['gmail'])) {
    header("Location: login_form1.php");
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

// Fetch mentor details based on email
$sql = "SELECT * FROM mentor_details WHERE gmail = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $gmail);
$stmt->execute();
$result = $stmt->get_result();

// Check if mentor details exist
if ($result->num_rows > 0) {
    $mentorDetails = $result->fetch_assoc();
} else {
    // Handle case where mentor details are not found
    echo "Mentor details not found.";
    exit;
}

$stmt->close();

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mentor Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
            padding-top: 50px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Mentor Details</h1>
        <form action="update_mentor_details.php" method="post">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo isset($mentorDetails['Full_name']) ? $mentorDetails['Full_name'] : ''; ?>">

            <label for="contact_details">Contact Details:</label>
            <input type="text" id="contact_details" name="contact_details" value="<?php echo isset($mentorDetails['Contact_details']) ? $mentorDetails['Contact_details'] : ''; ?>">

            <label for="education_degree">Education Degree:</label>
            <input type="text" id="education_degree" name="education_degree" value="<?php echo isset($mentorDetails['Education_degree']) ? $mentorDetails['Education_degree'] : ''; ?>">

            <label for="education_institution">Education Institution:</label>
            <input type="text" id="education_institution" name="education_institution" value="<?php echo isset($mentorDetails['Education_institution']) ? $mentorDetails['Education_institution'] : ''; ?>">

            <label for="education_field">Education Field:</label>
            <input type="text" id="education_field" name="education_field" value="<?php echo isset($mentorDetails['Education_field']) ? $mentorDetails['Education_field'] : ''; ?>">

            <label for="experience_job_title">Experience Job Title:</label>
            <input type="text" id="experience_job_title" name="experience_job_title" value="<?php echo isset($mentorDetails['Experience_job_title']) ? $mentorDetails['Experience_job_title'] : ''; ?>">

            <label for="experience_employer">Experience Employer:</label>
            <input type="text" id="experience_employer" name="experience_employer" value="<?php echo isset($mentorDetails['Experience_employer']) ? $mentorDetails['Experience_employer'] : ''; ?>">

            <label for="experience_dates">Experience Dates:</label>
            <input type="text" id="experience_dates" name="experience_dates" value="<?php echo isset($mentorDetails['Experience_dates']) ? $mentorDetails['Experience_dates'] : ''; ?>">

            <label for="skills">Skills:</label>
            <input type="text" id="skills" name="skills" value="<?php echo isset($mentorDetails['Skills']) ? $mentorDetails['Skills'] : ''; ?>">

            <label for="certifications">Certifications:</label>
            <input type="text" id="certifications" name="certifications" value="<?php echo isset($mentorDetails['Certifications']) ? $mentorDetails['Certifications'] : ''; ?>">

            <label for="availability_days">Availability Days:</label>
            <input type="text" id="availability_days" name="availability_days" value="<?php echo isset($mentorDetails['Availability_days']) ? $mentorDetails['Availability_days'] : ''; ?>">

            <label for="availability_hours">Availability Hours:</label>
            <input type="text" id="availability_hours" name="availability_hours" value="<?php echo isset($mentorDetails['Availability_hours']) ? $mentorDetails['Availability_hours'] : ''; ?>">

            <label for="motivation">Motivation:</label>
            <textarea id="motivation" name="motivation"><?php echo isset($mentorDetails['Motivation']) ? $mentorDetails['Motivation'] : ''; ?></textarea>

            
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>

