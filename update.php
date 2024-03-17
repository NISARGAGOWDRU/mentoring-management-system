<?php
// Include database connection
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve table name and ID from form
    $tableName = $_POST['table_name'];
    $id = $_POST['id'];
    
    // Prepare SQL query to update record
    $sql = "UPDATE $tableName SET ";
    foreach ($_POST as $key => $value) {
        if ($key != 'table_name' && $key != 'id' && $key != 'submit') {
            $sql .= "$key = '$value', ";
        }
    }
    // Remove trailing comma and space
    $sql = rtrim($sql, ", ");
    $sql .= " WHERE id = $id";

    // Execute the update query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>


