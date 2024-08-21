<?php
$host = "localhost";
$user = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "student_registration"; // Ensure this is the correct database

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
