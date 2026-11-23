<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "macha_cafe"
);

if (!$conn) {
    die("Database Connection Failed");
}

mysqli_set_charset($conn, "utf8mb4");
?>