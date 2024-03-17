<?php
// Database connection
$servername = "localhost"; // Change this to your database server name if it's different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "database"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $table = $_POST['table_name'];
    
    // Fetch table structure to dynamically construct insert query
    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);
    $columns = array();
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }

    // Build the INSERT query
    $values = array();
    foreach ($columns as $column) {
        if (isset($_POST[$column])) {
            $values[] = "'" . $conn->real_escape_string($_POST[$column]) . "'";
        } else {
            // If the form doesn't provide a value for a column, insert NULL
            $values[] = "NULL";
        }
    }
    $sql = "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch table name from GET parameter
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['table'])) {
    $table = $_GET['table'];
    
    // Fetch table structure to dynamically generate form fields
    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);

    // Display form for inserting data into the selected table
    echo "<h2>Insert Data into $table</h2>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='table_name' value='$table'>";
    while ($row = $result->fetch_assoc()) {
        echo "<label for='" . $row['Field'] . "'>" . $row['Field'] . "</label>: ";
        echo "<input type='text' name='" . $row['Field'] . "'><br>";
    }
    echo "<input type='submit' name='submit' value='Insert'>";
    echo "</form>";
}

// Close connection
$conn->close();
?>

