<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>mentee Page</title>

<style>
      .container {
            width: 80%;
            margin: auto;
            padding-top: 50px;
            background-image: url('https://tse4.mm.bing.net/th?id=OIP.Ctkm13hpj5CtPUksgSdFXgHaFe&pid=Api&P=0&h=180');
            background-size: cover;
            background-position: center;
        }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
        background-image: url('https://tse4.mm.bing.net/th?id=OIP.Ctkm13hpj5CtPUksgSdFXgHaFe&pid=Api&P=0&h=180');
        background-size: cover;
        background-position: center;
    }

    #header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        position: relative; /* Position relative for absolute positioning of image */
    }

    #header h1 {
        margin: 0;
    }

    #header .profile-image {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 50px; /* Adjust image size as needed */
        height: 50px; /* Adjust image size as needed */
        border-radius: 50%; /* Make the image circular */
        cursor: pointer; /* Add cursor pointer on hover */
    }

    .table-buttons {
        margin: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        grid-gap: 10px;
    }

    .table-buttons button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: block;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }



</style>
</head>
<body>

<div class="container">
    <div id="header">
        <h1>Welcome to the mentee Page</h1>
        <a href="login_form1.php">
            <img class="profile-image" src="https://wallpapercave.com/wp/wp6846698.jpg">
        </a>
    </div>

    <div class="table-buttons">


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

// Function to fetch all tables in the database
function getAllTables($conn, $dbname) {
    $sql = "SHOW TABLES FROM `$dbname`"; // Enclose $dbname within backticks
    $result = $conn->query($sql);
    $tables = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tables[] = $row['Tables_in_' . $dbname];
        }
    }
    return $tables;
}

// Function to display table data
function displayTableData($conn, $table) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) { // Check if the result is not null
        // Output data of each row
        echo "<table border='1'><tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

// Main logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['view_table'])) {
        $tableName = $_POST['table_name'];
        echo "<h2>Table: $tableName</h2>";
        displayTableData($conn, $tableName);
        exit; // Stop further execution after sending table data
    }
}

// Fetch all tables in the database
$tables = @getAllTables($conn, $dbname); // Use error control operator here
// List of tables to exclude
$excludedTables = array("mentee_details");

// Generate buttons for each table, excluding the excluded tables
if ($tables) { // Check if $tables is not null
    foreach ($tables as $table) {
        if (!in_array($table, $excludedTables)) {
            echo '<form method="post">';
            echo '<input type="hidden" name="table_name" value="' . $table . '">';
            echo '<button type="submit" name="view_table">' . $table . '</button>';
            echo '</form>';
        }
    }
}

// Close connection
$conn->close();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // AJAX request when a table button is clicked
    $('button[name="view_table"]').click(function(){
        var tableName = $(this).prev().val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $_SERVER["PHP_SELF"]; ?>', // Send AJAX request to this same PHP file
            data: { view_table: true, table_name: tableName },
            success: function(response){
                $('#table_data').html(response); // Display table data in the div
            }
        });
    });
})