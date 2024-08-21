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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];

    // Debugging output
    error_log("Received student_id: " . $student_id);

    // Prepare the SQL statement
    $sql = "SELECT subject_code, subject_name, units, schedule FROM regular_students WHERE TRIM(student_id) = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
    }

    // Return the result as JSON
    echo json_encode($subjects);

    // Close statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
