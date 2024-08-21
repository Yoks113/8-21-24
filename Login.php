<?php
// Include the database connection file
include 'db_connect.php';

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Direct comparison if passwords are stored as plain text
        if ($password === $row['password']) {
            // Store username in the session and redirect to Homepage.html
            $_SESSION['username'] = $username;
            header("Location: Homepage.html");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #343a40; /* Dark background */
            color: #f8f9fa; /* Light text color */
            font-family: Arial, sans-serif;
        }
        .login-container {
            margin-top: 100px;
            padding: 30px;
            background-color: #495057; /* Darker gray */
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        }
        .btn-primary {
            background-color: #343a40; /* Dark button */
            border-color: #343a40;
        }
        .btn-primary:hover {
            background-color: #23272b; /* Even darker on hover */
            border-color: #1d2124;
        }
        .form-control {
            background-color: #6c757d; /* Gray form fields */
            color: #f8f9fa; /* Light text color */
            border-color: #343a40; /* Dark border */
        }
        .form-control:focus {
            background-color: #5a6268; /* Darker gray when focused */
            color: #f8f9fa;
            border-color: #343a40;
            box-shadow: none; /* Remove the default Bootstrap focus shadow */
        }
        .alert {
            color: #f8f9fa;
            background-color: #dc3545; /* Bootstrap danger color */
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-container">
                    <h2 class="text-center">Login</h2>
                    <?php
                    // Display error message if it exists
                    if (isset($error_message)) {
                        echo "<div class='alert alert-danger'>$error_message</div>";
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
