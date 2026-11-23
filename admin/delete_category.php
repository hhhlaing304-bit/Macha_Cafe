<?php
include('auth.php');
include('../connection.php');

if($_SERVER['REQUEST_METHOD']==='POST') {

    $id = (int)($_POST['id'] ?? 0);

    $check = mysqli_query($conn,
        "SELECT COUNT(*) AS total FROM products WHERE category_id=$id"
    );

    $count = mysqli_fetch_assoc($check)['total'];

    if($id > 0 && $count == 0) {
        mysqli_query($conn,
            "DELETE FROM categories WHERE id=$id"
        );
    }
}

header("Location: categories.php");
exit();
?>