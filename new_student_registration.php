<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO new_students (
        first_name, middle_initial, last_name, birth_month, birth_day, birth_year, 
        gender, phone_number, email, house_number, lot_number, subdivision, 
        city, province, postal_code, emergency_name, relationship, emergency_contact
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "ssssssssssssssssss", // Data types for each parameter: s = string
        $first_name, $middle_initial, $last_name, $birth_month, $birth_day, $birth_year,
        $gender, $phone_number, $email, $house_number, $lot_number, $subdivision, 
        $city, $province, $postal_code, $emergency_name, $relationship, $emergency_contact
    );

    // Assign values from POST data
    $first_name = $_POST['first-name'];
    $middle_initial = $_POST['middle-initial'];
    $last_name = $_POST['last-name'];
    $birth_month = $_POST['birth-month'];
    $birth_day = $_POST['birth-day'];
    $birth_year = $_POST['birth-year'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone-number'];
    $email = $_POST['email'];
    $house_number = $_POST['house-number'];
    $lot_number = $_POST['lot-number'];
    $subdivision = $_POST['subdivision'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal-code'];
    $emergency_name = $_POST['emergency-name'];
    $relationship = $_POST['relationship'];
    $emergency_contact = $_POST['emergency-contact'];

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to homepage.html with success message
        header("Location: homepage.html?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
