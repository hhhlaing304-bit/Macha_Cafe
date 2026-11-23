<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (int)($_POST['id'] ?? 0);
    $qty = (int)($_POST['quantity'] ?? 1);

    if ($id > 0 && isset($_SESSION['cart'][$id])) {

        if ($qty < 1) {
            $qty = 1;
        }

        if ($qty > 99) {
            $qty = 99;
        }

        $_SESSION['cart'][$id]['quantity'] = $qty;
    }
}

header("Location: cart.php");
exit();
?>