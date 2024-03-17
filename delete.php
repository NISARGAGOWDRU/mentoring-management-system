<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Page</title>

<style>
    .container {
            width: 80%; /* Adjust as needed */
            margin: auto;
            padding-top: 50px;
            background-image: url('https://tse1.mm.bing.net/th?id=OIP.03FIJmIrrHKrBq8TYm73oAHaHa&pid=Api&P=0&h=180');
            background-size: cover; /* Cover the entire container */
            background-position: center; /* Center the background image */
        }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
        background-image: url('https://tse4.mm.bing.net/th?id=OIP.2scMKHASXrUMiDHQSfYPaAHaEK&pid=Api&P=0&h=180'); /* Replace 'your_image_url.jpg' with the URL of your image */
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

<div class="container">
    <div id="header">
        <h1>Welcome to the delete Page</h1>
    </div>

    <div id="user_details">
<?php
// Database connection
$servername = "localhost"; // Change this to your database server name if it's different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "database"; // Change this to your database name

// Create connection
$conn = @new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'table' and 'id' parameters are set in the URL
if(isset($_GET['table']) && isset($_GET['id'])) {
    // Escape the parameters to prevent SQL injection
    $table = $conn->real_escape_string($_GET['table']);
    $id = $conn->real_escape_string($_GET['id']);

    // Delete related rows from user_skills table
    $sql_delete_user_skills = "DELETE FROM user_skills WHERE user_id = $id";
    if ($conn->query($sql_delete_user_skills) === TRUE) {
        // Now it's safe to delete the row from the users table
        $sql_delete_user = "DELETE FROM $table WHERE id = $id";
        if ($conn->query($sql_delete_user) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error deleting related records: " . $conn->error;
    }
} else {
    echo "Table or ID not provided.";
}

