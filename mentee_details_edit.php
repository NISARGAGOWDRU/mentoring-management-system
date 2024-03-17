<style>
  .container {
            width: 80%; /* Adjust as needed */
            margin: auto;
            padding-top: 50px;
            background-image: url('https://tse4.mm.bing.net/th?id=OIP.2scMKHASXrUMiDHQSfYPaAHaEK&pid=Api&P=0&h=180');
            background-size: cover; /* Cover the entire container */
            background-position: center; /* Center the background image */
        }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
        background-image: url('https://static.vecteezy.com/system/resources/previews/000/275/465/original/vector-abstract-design-background.jpg');
  
        background-size: cover;
        background-position: center;
    }

    .container {
        width: 80%;
        margin: auto;
        padding-top: 50px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }

    #header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    #header h1 {
        margin: 0;
    }

    #user_details {
        float: left;
        margin-left: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    #table_buttons {
        float: left;
        margin: 20px;
    }

    #table_buttons button {
        display: block;
        margin-bottom: 5px;
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #333;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>
</head>
<body>
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

// Fetch mentee details
$sql = "SELECT * FROM mentee_details WHERE gmail = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $gmail);
$stmt->execute();
$result = $stmt->get_result();
$menteeDetails = $result->fetch_assoc();
$stmt->close();

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mentee Details</title>
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
        input[type="text"] {
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
        <h1>Edit Mentee Details</h1>
        <form action="update_mentee_details.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $menteeDetails['name']; ?>">

            <label for="college">College:</label>
            <input type="text" id="college" name="college" value="<?php echo $menteeDetails['college']; ?>">

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo $menteeDetails['department']; ?>">

            <label for="semester">Semester:</label>
            <input type="text" id="semester" name="semester" value="<?php echo $menteeDetails['semester']; ?>">

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" value="<?php echo $menteeDetails['contact_number']; ?>">

            <label for="interests">Interests:</label>
            <input type="text" id="interests" name="interests" value="<?php echo $menteeDetails['interests']; ?>">

            <label for="weaknesses">Weaknesses:</label>
            <input type="text" id="weaknesses" name="weaknesses" value="<?php echo $menteeDetails['weaknesses']; ?>">

            <label for="free_time_activities">Free Time Activities:</label>
            <input type="text" id="free_time_activities" name="free_time_activities" value="<?php echo $menteeDetails['free_time_activities']; ?>">

            <label for="communication_channels">Communication Channels:</label>
            <input type="text" id="communication_channels" name="communication_channels" value="<?php echo $menteeDetails['communication_channels']; ?>">

            <label for="goals_and_expectations">Goals and Expectations:</label>
            <input type="text" id="goals_and_expectations" name="goals_and_expectations" value="<?php echo $menteeDetails['goals_and_expectations']; ?>">

            <label for="learning_style_and_preferences">Learning Style and Preferences:</label>
            <input type="text" id="learning_style_and_preferences" name="learning_style_and_preferences" value="<?php echo $menteeDetails['learning_style_and_preferences']; ?>">

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
