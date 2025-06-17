<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$showAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../partials/_dbConnector.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT `password` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] != $password) {
            $showAlert = true;
        } else {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: ../index.php");
        }
    } else {
        $showAlert = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            background: white;
            /*#002b77;*/
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(38, 132, 255, 0.8);
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .btn-primary {
            background: #6a11cb;
            border: none;
        }

        .btn-primary:hover {
            background: #4d0fad;
        }

        .btn-secondary {
            background: #2575fc;
            border: none;
        }

        .btn-secondary:hover {
            background: #1c5bcc;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <div class="error">
                    <?php
                    if ($showAlert) {
                        echo "Invalid credentials";
                    }
                    ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
        </form>
        <p>Don't have an account?</p>
        <a href="signup.php" class="btn btn-secondary w-100">Sign Up</a>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>