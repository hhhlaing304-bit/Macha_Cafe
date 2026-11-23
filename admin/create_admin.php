<?php
include('../connection.php');

$username = "";
$email = "";
$password = password_hash("", PASSWORD_DEFAULT);

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO admins (username,email,password) VALUES (?,?,?)"
);

mysqli_stmt_bind_param(
    $stmt, "sss", $username, $email, $password
);

if (mysqli_stmt_execute($stmt)) {
    echo "Admin account created successfully!";
} else {
    echo "Admin already exists or could not be created.";
}
?>