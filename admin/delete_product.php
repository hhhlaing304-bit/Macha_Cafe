<?php
include('auth.php');
include('../connection.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = (int)($_POST['id'] ?? 0);

    if($id > 0) {

        mysqli_begin_transaction($conn);

        $a = mysqli_query($conn,
            "DELETE FROM popular_products WHERE product_id=$id"
        );

        $b = mysqli_query($conn,
            "DELETE FROM products WHERE id=$id"
        );

        if($a && $b) {
            mysqli_commit($conn);
        } else {
            mysqli_rollback($conn);
        }
    }
}

header("Location: products.php");
exit();
?>