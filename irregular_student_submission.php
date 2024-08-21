<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_number = $_POST['student_number'];
    $year_level = $_POST['year_level'];
    $subject_code = $_POST['subject_code'];
    $subject_name = $_POST['subject_name'];
    $units = $_POST['units'];
    $schedule = $_POST['schedule'];

    // Insert the data into the database
    $sql = "INSERT INTO irregular_students (student_number, year_level, subject_code, subject_name, units, schedule)
    VALUES ('$student_number', '$year_level', '$subject_code', '$subject_name', '$units', '$schedule')";

    if ($conn->query($sql) === TRUE) {
        echo "Subject added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
