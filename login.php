<?php

session_start();
include('connection.php');

$error_msg = "";

if (isset($_POST['btnlog'])) {
    $email = $_POST['txtemail'];
    $pwd = $_POST['txtpwd'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($pwd, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header('location:index.php');
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No account found with this email!";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <div class="auth-page">
        <div class="auth-container">
            <section class="auth-visual">
                <div class="brand">
                    🍃 Macha .
                </div>

                <h1>Matcha Makes <br> Life Better</h1>

                <p>Fresh matcha drinks,homemade cakes,
                    and delicious food.Your cozy Café
                    experience starts here.
                </p>

                <div class="visual-note">
                    GOOD FOOD . GREAT MOOD
                </div>
            </section>

            <section class="auth-form">
                <div class="form-heading">
                    <h2>WELCOME BACK!</h2>
                    <p>Log in to discover your favorite treats.</p>
                </div>

                <?php if (!empty($error_msg)) { ?>
                    <div><?php echo $error_msg; ?></div>
                <?php } ?>

                <form action="login.php" method="POST">


                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="txtemail" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="txtpwd" placeholder="At least 8 characters" required>
                    </div>

                    <button type="submit" class="submit-btn" name="btnlog">Login to Your Account</button>
                </form>

                <div class="auth-switch">
                    Don't have an account?
                    <a href="register.php">Create Accont</a>
                </div>

                <div class="back-home">
                    <a href="login.php">Macha Café . Fresh & Delicious</a>
                </div>
            </section>
        </div>
    </div>
</body>

</html>