<?php
include('connection.php');
session_start();

if (isset($_POST['btnreg'])) {
    $username = $_POST['txtuname'];
    $email = $_POST['txtemail'];
    $pwd = $_POST['txtpwd'];
    $cpwd = $_POST['txtcpwd'];

    if ($pwd != $cpwd) {
        echo "<script>alert('Password and Confirm Password should be the SAME');</script>";
    } else {
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

            $insert_stmt = $conn->prepare("INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($insert_stmt->execute()) {
                header('location: login.php');
                exit();
            } else {
                echo "<script>alert('Registration failed. Please try again.');</script>";
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
    <title>Register - Macha Café</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>


    <div class="auth-page">
        <div class="auth-container">
            <section class="auth-visual">
                <div class="brand">
                    🍃 Macha .
                </div>

                <h1>Your New <br> Favorite Café</h1>

                <p>Join Macha Café to explore refreshing
                    macha drinks, delicious cakes, and your
                    favorite meals.
                </p>

                <div class="visual-note">
                    FRESH INGREDIENTS . HAPPY MOMENTS
                </div>
            </section>

            <section class="auth-form">
                <div class="form-heading">
                    <h2>Create Account</h2>
                    <p>Join us and make every day a little sweeter.</p>
                </div>

                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="name" name="txtuname" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="txtemail" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="txtpwd" placeholder="At least 8 characters" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="txtcpwd" placeholder="Enter password again" required>
                    </div>

                    <button type="submit" class="submit-btn" name="btnreg">Create My Account</button>
                </form>

                <div class="auth-switch">
                    Already have an account?
                    <a href="login.php">Login</a>
                </div>

                <div class="back-home">
                    <a href="login.php">Macha Café . Fresh & Delicious</a>
                </div>
            </section>
        </div>
    </div>
</body>

</html>