<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$isSignup = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../partials/_dbConnector.php";

    // Retrieve data from the POST request
    $full_name   = $_POST['full_name'];
    $roll_number = $_POST['roll_number'];
    $email       = $_POST['email'];
    $username    = $_POST['username'];
    $password    = $_POST['password'];

    $sql = "INSERT INTO `users` (`FullName`, `Roll`, `Email`, `username`, `password`) VALUES ('$full_name', '$roll_number', '$email', '$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $isSignup = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            background-color: white;
            /*#002b77;*/
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .signup-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(38, 132, 255, 0.8);
        }

        .btn-primary {
            background: #2575fc;
            border: none;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-primary:hover {
            background: #1c5bcc;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form id="signup-form" action="signup.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <input type="full-name" id="full-name" class="form-control" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="text" id="roll-number" class="form-control" name="roll_number" placeholder="Roll Number">
            </div>
            <div class="mb-3">
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
                <div id="password-error" class="error"></div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
        <?php
        if ($isSignup) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account has been created successfully! Click <a href="login.php">here</a> to login.
                </button>
            </div>
        <?php
        }
        ?>
    </div>


    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form Validation Script
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const errorDiv = document.getElementById('password-error');

            if (password !== confirmPassword) {
                errorDiv.textContent = "Passwords do not match.";
                return false;
            } else {
                errorDiv.textContent = "";
                return true;
            }
        }
    </script>
</body>

</html>