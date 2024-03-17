CREATE TABLE mentorship_programs (
 id INT AUTO_INCREMENT PRIMARY KEY,
 program_name VARCHAR(255) NOT NULL,
 start_date DATE,
 end_date DATE,
 description TEXT);

CREATE TABLE sessions (
 id INT AUTO_INCREMENT PRIMARY KEY,
 mentor_id INT NOT NULL,
 mentee_id INT NOT NULL,
 session_date DATETIME,
 duration_minutes INT,
 notes TEXT);

CREATE TABLE skills (
 id INT AUTO_INCREMENT PRIMARY KEY,
 skill_name VARCHAR(255) NOT NULL);
CREATE TABLE user_skills (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 skill_id INT NOT NULL);

CREATE TABLE messages (
 id INT AUTO_INCREMENT PRIMARY KEY,
 sender_id INT NOT NULL,
 receiver_id INT NOT NULL,
 message TEXT,
 sent_at DATETIME);

CREATE TABLE notifications (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 message TEXT,
 created_at DATETIME);

CREATE TABLE reviews (
 id INT AUTO_INCREMENT PRIMARY KEY,
 mentor_id INT NOT NULL,
 mentee_id INT NOT NULL,
 rating DECIMAL(3, 1),
 review TEXT);

CREATE TABLE program_applications (
 id INT AUTO_INCREMENT PRIMARY KEY,
 program_id INT NOT NULL,
 user_id INT NOT NULL,
 application_date DATE,
 status ENUM('pending', 'approved', 'rejected'));

CREATE TABLE program_participants (
 id INT AUTO_INCREMENT PRIMARY KEY,
 program_id INT NOT NULL,
 user_id INT NOT NULL);

CREATE TABLE program_feedback (
 id INT AUTO_INCREMENT PRIMARY KEY,
 program_id INT NOT NULL,
 user_id INT NOT NULL,
 feedback TEXT);

CREATE TABLE availability (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 day_of_week ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
 start_time TIME,
 end_time TIME);

CREATE TABLE interests (
 id INT AUTO_INCREMENT PRIMARY KEY,
 interest_name VARCHAR(255) NOT NULL);
CREATE TABLE user_interests (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 interest_id INT NOT NULL);

CREATE TABLE mentor_details (
 id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(255) NOT NULL,
 contact_details VARCHAR(255) NOT NULL,
 gmail VARCHAR(255) NOT NULL,
 education_degree VARCHAR(255),
 education_institution VARCHAR(255),
 education_field VARCHAR(255),
 experience_job_title VARCHAR(255),
 experience_employer VARCHAR(255),
 experience_dates VARCHAR(255),
 skills VARCHAR(255),
 certifications VARCHAR(255),
 availability_days VARCHAR(255),
 availability_hours VARCHAR(255),
 motivation TEXT);

CREATE TABLE mentee_details (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(255) NOT NULL,
 college VARCHAR(255) NOT NULL,
 department VARCHAR(255) NOT NULL,
 semester VARCHAR(255) NOT NULL,
 contact_number VARCHAR(20) NOT NULL,
 weaknesses TEXT NOT NULL,
 free_time_activities TEXT NOT NULL,
 communication_channels TEXT NOT NULL,
 gmail VARCHAR(255) NOT NULL,
 interests TEXT NOT NULL,
 goals_and_expectations TEXT NOT NULL,
 learning_style_and_preferences TEXT NOT NULL);
 
CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(255) NOT NULL,
 gmail VARCHAR(255) NOT NULL,
 password VARCHAR(255) NOT NULL,
 role VARCHAR(10) NOT NULL);