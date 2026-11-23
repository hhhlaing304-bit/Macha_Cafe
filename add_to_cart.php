<?php
session_start();
include('connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if (isset($_SESSION['cart'][$id])) {

            $_SESSION['cart'][$id]['quantity']++;

        } else {

            $_SESSION['cart'][$id] = [
                'quantity' => 1
            ];

        }
    }
}

header("Location: cart.php");
exit();
?>