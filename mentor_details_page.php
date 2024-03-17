<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Mentor Details</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding-top: 50px;
            background-image: url('https://www.creativefabrica.com/wp-content/uploads/2022/10/19/Soft-color-mixed-watercolor-background-Graphics-42318122-1-580x386.jpg');
            background-size: cover;
            background-position: center;
        }

        input[type="text"],
        input[type="gmail"],
        textarea,
        input[type="file"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            width: 100%;
            max-width: 400px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .form-row > div {
            width: calc(50% - 10px);
        }

        .form-row > div label {
            display: block;
        }

        .form-row > div input,
        .form-row > div textarea {
            width: 100%;
        }

        @media screen and (max-width: 600px) {
            .form-row > div {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <main>
            <form id="mentorDetailsForm" action="mentor_details_handler.php" method="post" enctype="multipart/form-data">
                <h1>Mentor Details</h1>
                <div class="form-row">
                    <div>
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div>
                        <label for="contact_details">Contact Details:</label>
                        <input type="text" id="contact_details" name="contact_details" required>
                    </div>
                    <div>
                        <label for="gmail">Gmail:</label>
                        <input type="gmail" id="gmail" name="gmail" required>
                    </div>
                    <div>
                        <label for="education_degree">Degree:</label>
                        <input type="text" id="education_degree" name="education_degree">
                    </div>
                    <div>
                        <label for="education_institution">Institution:</label>
                        <input type="text" id="education_institution" name="education_institution">
                    </div>
                    <div>
                        <label for="education_field">Field of Study:</label>
                        <input type="text" id="education_field" name="education_field">
                    </div>
                    <div>
                        <label for="experience_job_title">Job Title:</label>
                        <input type="text" id="experience_job_title" name="experience_job_title">
                    </div>
                    <div>
                        <label for="experience_employer">Employer:</label>
                        <input type="text" id="experience_employer" name="experience_employer">
                    </div>
                    <div>
                        <label for="experience_dates">Dates:</label>
                        <input type="text" id="experience_dates" name="experience_dates">
                    </div>
                    <div>
                        <label for="skills">Skills:</label>
                        <input type="text" id="skills" name="skills">
                    </div>
                    <div>
                        <label for="certifications">Certifications:</label>
                        <input type="text" id="certifications" name="certifications">
                    </div>
                    <div>
                        <label for="availability_days">Days Available:</label>
                        <input type="text" id="availability_days" name="availability_days">
                    </div>
                    <div>
                        <label for="availability_hours">Hours per Week:</label>
                        <input type="text" id="availability_hours" name="availability_hours">
                    </div>
                    <div>
                        <label for="motivation">Motivation:</label>
                        <textarea id="motivation" name="motivation" rows="4"></textarea>
                    </div>
                    
                </div>
                <button type="submit">Submit</button>
            </form>
        </main>
    </div>
</body>
</html>
