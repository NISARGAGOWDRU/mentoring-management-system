<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details Page</title>
    <style>
        .container {
            width: 80%; /* Adjust as needed */
            margin: auto;
            padding-top: 50px;
            background-image: url('https://static.vecteezy.com/system/resources/previews/000/275/465/original/vector-abstract-design-background.jpg');
            background-size: cover; /* Cover the entire container */
            background-position: center; /* Center the background image */
        }
        /* Body styles */
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
            <h1>Welcome to the User Details Page</h1>
        </div>

        <div id="user_details">
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

            // Retrieve logged-in user's gmail
            $gmail = $_SESSION['gmail'];

            // Function to get details based on gmail
            function getUserDetails($table, $gmail, $conn) {
                $sql = "SELECT * FROM $table WHERE gmail = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $gmail);
                $stmt->execute();
                $result = $stmt->get_result();
                $details = $result->fetch_assoc();
                $stmt->close();
                return $details;
            }

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

            // Fetch mentor or mentee details based on user role
            if ($userRole === "mentor") {
                $details = getUserDetails("mentor_details", $gmail, $conn);
            } elseif ($userRole === "mentee") {
                $details = getUserDetails("mentee_details", $gmail, $conn);
            }

            // Close database connection
            $conn->close();
            ?>

            <?php if (isset($details)): ?>
                <h2>User Details</h2>
                <div class="user-details">
                    <p><strong>Role:</strong> <?php echo ucfirst($userRole); ?></p>
                    <?php foreach ($details as $key => $value): ?>
                        <p><strong><?php echo ucfirst($key); ?>:</strong> <?php echo $value; ?></p>
                    <?php endforeach; ?>
                    <!-- Edit button -->
                    <a href="edit_details.php" style="margin-right: 20px;">Edit Details</a>
                </div>
            <?php else: ?>
                <div class="message">
                    <p>No details found for the logged-in user.</p>
                    <p>Please fill out the registration form below:</p>
                    <?php if ($userRole === "mentor"): ?>
                        <a href="mentor_details_page.php" style="margin-right: 20px;">Mentor Registration</a>
                    <?php elseif ($userRole === "mentee"): ?>
                        <a href="mentee_details_page.php">Mentee Registration</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
