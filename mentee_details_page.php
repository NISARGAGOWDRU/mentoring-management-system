<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentee Details</title>
    <style>
        .container {
            width: 80%; /* Adjust as needed */
            margin: auto;
            padding-top: 50px;
            background-image: url('https://wallpaperaccess.com/full/1567831.jpg');
            background-size: cover; /* Cover the entire container */
            background-position: center; /* Center the background image */
        }

        input[type="text"],
        input[type="email"],
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
            margin-bottom: 20px;
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

        .form-submit {
            text-align: center;
        }

        .form-submit button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-submit button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <main>
            <form id="menteeDetailsForm" action="mentee_details_handler.php" method="post">
                <h1>Mentee Details</h1>
                <div class="form-row" id="formFields">
                    <!-- Form fields will be inserted here dynamically -->
                </div>
                <div class="form-submit">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </main>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const formFields = [
                { label: 'Name:', id: 'name', type: 'text', required: true },
                { label: 'College:', id: 'college', type: 'text', required: true },
                { label: 'Department:', id: 'department', type: 'text', required: true },
                { label: 'Semester:', id: 'semester', type: 'text', required: true },
                { label: 'Contact Number:', id: 'contact_number', type: 'text', required: true },
                { label: 'Weaknesses:', id: 'weaknesses', type: 'text', required: true },
                { label: 'FreeTime Activities:', id: 'free_time_activities', type: 'text', required: true },
                { label: 'PreferredCommunication Channels:', id: 'communication_channels', type: 'text', required: true },
                { label: 'Gmail:', id: 'gmail', type: 'text', required: true },
                { label: 'Interests:', id: 'interests', type: 'text', required: true },
                { label: 'Goals & Expectations:', id: 'goals_and_expectations', type: 'textarea', required: true },
                { label: 'LearningStyle & Preferences:', id: 'learning_style_and_preferences', type: 'textarea', required: true }
            ];

            formFields.sort((a, b) => a.label.length - b.label.length);

            const formContainer = document.getElementById('formFields');

            formFields.forEach(field => {
                const div = document.createElement('div');
                const label = document.createElement('label');
                label.setAttribute('for', field.id);
                label.textContent = field.label;
                div.appendChild(label);
                if (field.type === 'textarea') {
                    const textarea = document.createElement('textarea');
                    textarea.setAttribute('id', field.id);
                    textarea.setAttribute('name', field.id);
                    textarea.setAttribute('class', 'form-textarea');
                    if (field.required) {
                        textarea.setAttribute('required', 'true');
                    }
                    div.appendChild(textarea);
                } else {
                    const input = document.createElement('input');
                    input.setAttribute('type', field.type);
                    input.setAttribute('id', field.id);
                    input.setAttribute('name', field.id);
                    input.setAttribute('class', 'form-input');
                    if (field.required) {
                        input.setAttribute('required', 'true');
                    }
                    div.appendChild(input);
                }
                formContainer.appendChild(div);
            });
        });
    </script>
</body>
</html>
