<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


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

// Retrieve logged-in user's gmail
$gmail = $_SESSION['gmail'];

// Function to get user role
function getUserRole($gmail, $conn) {
    $sql = "SELECT role FROM users WHERE gmail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $role = $row['role'];
    $stmt->close();
    return $role;
}

// Fetch user role
$userRole = getUserRole($gmail, $conn);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
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
        .edit-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Details</h1>
        <?php if ($userRole === "mentor"): ?>
            <p>You are a Mentor. Click below to edit Mentor Details:</p>
            <div class="edit-link">
                <a href="mentor_details_edit.php">Edit Mentor Details</a>
            </div>
        <?php elseif ($userRole === "mentee"): ?>
            <p>You are a Mentee. Click below to edit Mentee Details:</p>
            <div class="edit-link">
                <a href="mentee_details_edit.php">Edit Mentee Details</a>
            </div>
        <?php else: ?>
            <p>No details found for the logged-in user.</p>
        <?php endif; ?>
    </div>
</body>
</html>
