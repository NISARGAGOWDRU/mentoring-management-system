<?php
// Include database connection
include 'db_connection.php';

// Check if form is submitted and table is selected
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $id = $_GET['id'];
    // Fetch record based on ID
    $sql = "SELECT * FROM $table WHERE id = $id";
    $result = $conn->query($sql);
    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display edit form
        echo "<h2>Edit Data in $table</h2>";
        echo "<form method='post' action='update.php'>";
        echo "<input type='hidden' name='table_name' value='$table'>";
        echo "<input type='hidden' name='id' value='$id'>";
        // Populate form fields with existing values
        foreach ($row as $key => $value) {
            echo "<label for='$key'>$key:</label>";
            echo "<input type='text' name='$key' id='$key' value='$value'><br>";
        }
        echo "<input type='submit' name='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "Record not found.";
    }
}
?>
