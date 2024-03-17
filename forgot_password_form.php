<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        .container {
            width: 80%; /* Adjust as needed */
            margin: auto;
            padding-top: 50px;
            background-image: url('https://static.vecteezy.com/system/resources/previews/000/275/465/original/vector-abstract-design-background.jpg');
            background-size: cover; /* Cover the entire container */
            background-position: center; /* Center the background image */
        }
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-btn {
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <main>
            <form id="forgotPasswordForm" action="forgot_password_handler.php" method="post">
                <h1>Forgot Password</h1>
                <div class="form-group">
                    <input type="email" name="gmail" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="new_password" placeholder="New Password" required>
                </div>
                <div class="form-btn">
                    <button type="submit" class="btn">Reset Password</button>
                </div>
            </form>
            <p><a href="login_form.php">Back to Login</a></p>
        </main>
    </div>
</body>
</html>
