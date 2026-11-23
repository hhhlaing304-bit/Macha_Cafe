<?php
session_start();
include('connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' ||
    !isset($_POST['place_order'])) {
    header("Location: checkout.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

$user_id = (int)$_SESSION['id'];

$phone = trim($_POST['phone'] ?? '');
$region = trim($_POST['region'] ?? '');
$address = trim($_POST['address'] ?? '');

if ($phone == '' || $region == '' || $address == '') {
    die("Please fill in all delivery information.");
}

$phone = mysqli_real_escape_string($conn, $phone);
$region = mysqli_real_escape_string($conn, $region);
$address = mysqli_real_escape_string($conn, $address);

$total = 0;
$order_products = [];

foreach ($cart as $id => $item) {

    $id = (int)$id;
    $qty = (int)($item['quantity'] ?? 0);

    if ($id <= 0 || $qty < 1 || $qty > 99) {
        die("Invalid cart quantity. Please return to your cart.");
    }

    $result = mysqli_query(
        $conn,
        "SELECT id, product_name, price
         FROM products
         WHERE id = $id"
    );

    if (!$result || mysqli_num_rows($result) == 0) {
        die("A product in your cart is no longer available.");
    }

    $product = mysqli_fetch_assoc($result);

    $price = (float)$product['price'];
    $subtotal = $price * $qty;

    $total += $subtotal;

    $order_products[] = [
        'id' => $id,
        'name' => $product['product_name'],
        'price' => $price,
        'quantity' => $qty,
        'subtotal' => $subtotal
    ];
}

if ($total <= 0 || empty($order_products)) {
    die("Your cart has no valid products.");
}

mysqli_begin_transaction($conn);

try {

    $sql = "INSERT INTO orders
            (user_id, phone, region, address, total, status)
            VALUES
            ($user_id, '$phone', '$region', '$address',
             $total, 'Pending')";

    if (!mysqli_query($conn, $sql)) {
        throw new Exception(mysqli_error($conn));
    }

    $order_id = mysqli_insert_id($conn);

    foreach ($order_products as $product) {

        $product_id = (int)$product['id'];
        $product_name = mysqli_real_escape_string(
            $conn,
            $product['name']
        );
        $price = (float)$product['price'];
        $quantity = (int)$product['quantity'];
        $subtotal = (float)$product['subtotal'];

        $sql = "INSERT INTO order_items
                (order_id, product_id, product_name,
                 price, quantity, subtotal)
                VALUES
                ($order_id, $product_id, '$product_name',
                 $price, $quantity, $subtotal)";

        if (!mysqli_query($conn, $sql)) {
            throw new Exception(mysqli_error($conn));
        }
    }

    mysqli_commit($conn);

    unset($_SESSION['cart']);

    header("Location: orders.php?success=1");
    exit();

} catch (Exception $e) {

    mysqli_rollback($conn);

    // Temporary debugging message
    die("Order failed: " . htmlspecialchars($e->getMessage()));
}
?>