<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER DETAILS</title>
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Background image */
        body {
            background-image: url('https://wallpapercave.com/wp/wp2903078.jpg');
            background-size: cover;
            background-position: center;
        }

        /* Main container styles */
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Form styles */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 300px;
        }

        h1 {
            margin-bottom: 20px;
            color: orange;
            text-shadow: 0 0 5px orange; /* Outline effect */
        }

        input[type="gmail"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <h1>TO SEE USER DETAILS YOU HAVE TO ENTER GMAIL & PASSWORD </h1>
        <form id="loginForm" action="login_handler1.php" method="post">
            <input type="gmail" name="gmail" placeholder="Gmail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">ENTER</button>
        </form>
    </main>
</body>
</html>
