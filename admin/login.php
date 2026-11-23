<?php
session_start();
include('../connection.php');

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM admins WHERE username='$username' LIMIT 1"
    );

    if ($result && mysqli_num_rows($result) == 1) {

        $admin = mysqli_fetch_assoc($result);

        if (password_verify($password, $admin['password'])) {

            session_regenerate_id(true);

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Admin account not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body class="login-body">

    <div class="login-container">

        <div class="login-icon">🍃</div>

        <h1>Macha Café</h1>
        <p>Admin Panel Login</p>

        <?php if ($error != "") { ?>
            <div class="alert error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>

            <button type="submit" name="login" class="primary-btn full-btn">
                Login to Dashboard
            </button>

        </form>

        <div class="register-link">
            Don't have an admin account?
            <a href="register.php">Register</a>
        </div>

        <small class="login-footer">Macha Café Management System</small>

    </div>

</body>

</html>