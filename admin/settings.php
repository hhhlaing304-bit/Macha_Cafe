<?php
include('auth.php');
include('../connection.php');

$id = (int)$_SESSION['admin_id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM admins WHERE id=$id"
);

$admin = mysqli_fetch_assoc($result);

$message = '';
$error = '';

if (isset($_POST['update_profile'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if ($username === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter valid username and email.";
    } else {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE admins SET username=?,email=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['admin_name'] = $username;
            $message = "Profile updated successfully.";

            $admin['username'] = $username;
            $admin['email'] = $email;
        } else {
            $error = "Username or email may already exist.";
        }
    }
}

if (isset($_POST['change_password'])) {

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if (!password_verify($current, $admin['password'])) {
        $error = "Current password is incorrect.";
    } elseif (strlen($new) < 8) {
        $error = "New password must be at least 8 characters.";
    } elseif ($new !== $confirm) {
        $error = "New passwords do not match.";
    } else {

        $hash = password_hash($new, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE admins SET password=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "si", $hash, $id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Password changed successfully.";
            $admin['password'] = $hash;
        } else {
            $error = "Unable to change password.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>settings</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">

                <div class="page-heading">
                    <h1>Admin Settings</h1>
                    <p>Manage your administrator account.</p>
                </div>

                <?php if ($message) { ?>
                    <div class="alert success"><?= htmlspecialchars($message) ?></div>
                <?php } ?>

                <?php if ($error) { ?>
                    <div class="alert error"><?= htmlspecialchars($error) ?></div>
                <?php } ?>

                <div class="settings-grid">

                    <div class="section-card form-card">
                        <h3>Profile Information</h3>

                        <form method="POST">

                            <label>Username</label>
                            <input type="text" name="username"
                                value="<?= htmlspecialchars($admin['username']) ?>" required>

                            <label>Email</label>
                            <input type="email" name="email"
                                value="<?= htmlspecialchars($admin['email']) ?>" required>

                            <button class="primary-btn" name="update_profile">
                                Update Profile
                            </button>

                        </form>
                    </div>

                    <div class="section-card form-card">
                        <h3>Change Password</h3>

                        <form method="POST">

                            <label>Current Password</label>
                            <input type="password" name="current_password" required>

                            <label>New Password</label>
                            <input type="password" name="new_password" minlength="8" required>

                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" minlength="8" required>

                            <button class="primary-btn" name="change_password">
                                Change Password
                            </button>

                        </form>
                    </div>

                </div>
            </section>
        </main>
    </div>
</body>

</html>