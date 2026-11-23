<?php
session_start();
include('../connection.php');

$message = "";

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {

        $check = mysqli_query(
            $conn,
            "SELECT id FROM admins
             WHERE username='$username' OR email='$email'"
        );

        if (mysqli_num_rows($check) > 0) {
            $message = "Username or Email already exists!";
        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admins (username, email, password)
                    VALUES ('$username', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {
                header("Location: login.php");
                exit();
            } else {
                $message = "Registration failed!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body class="register-body">

    <div class="register-container">

        <div class="register-icon">🍃</div>

        <h2>Admin Register</h2>
        <p>Create your admin account</p>


        <?php if ($message != "") { ?>
            <p class="error-message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php } ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your full name" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" minlength="8" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Enter your confirm password" minlength="8" required>

            <button type="submit" name="register" class="primary-btn full-btn">
                Register
            </button>


        </form>

        <div class="register-link">
            Already have an account?
            <a href="login.php">Login</a>
        </div>

        <small class="register-footer">Macha Café Management System</small>

    </div>

</body>

</html>