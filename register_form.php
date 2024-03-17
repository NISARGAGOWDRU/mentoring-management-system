<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

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
    

    <div id="header">
        <h1>WELCOME TO MENTORING MANAGEMENT SYSTEM</h1>    
    </div>

    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Register Form</h1>
                <form action="register_handler.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="User Name:" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="gmail" placeholder="Gmail:" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password:" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:" required>
                    </div>
                    <div class="form-group">
                        <label for="mentee">Mentee</label>
                        <input type="radio" name="role" value="mentee" id="mentee" required>
                        <label for="mentor">Mentor</label>
                        <input type="radio" name="role" value="mentor" id="mentor" required>
                    </div>
                    <div class="form-btn">
                        <input type="submit" class="btn btn-primary" value="Register" name="submit">
                    </div>
                </form>
                <div>
                    <p>Already Registered <a href="login_form.php">Login Here</a></p>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>
</html>
