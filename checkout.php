<?php
session_start();
include('connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

$total = 0;

foreach ($cart as $id => $item) {

    $id = (int)$id;
    $qty = (int)$item['quantity'];

    $result = mysqli_query(
        $conn,
        "SELECT price FROM products WHERE id = $id"
    );

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $total += (float)$product['price'] * $qty;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>


    <div class="checkout-container">

        <h1>Checkout</h1>
        <p class="subtitle">Complete your delivery information</p>

        <form action="place_order.php" method="POST">

            <label>Phone Number</label>
            <input
                type="tel"
                name="phone"
                placeholder="Enter your phone number"
                required
                maxlength="30">

            <label>Region / City</label>
            <input
                type="text"
                name="region"
                placeholder="Enter your region"
                required
                maxlength="100">

            <label>Full Address</label>
            <textarea
                name="address"
                placeholder="Enter your full address"
                required></textarea>

            <div class="checkout-total">
                <span>Total Amount</span>
                <strong><?php echo number_format($total); ?> MMK</strong>
            </div>

            <button type="submit" name="place_order" class="checkout-btn">
                Place Order
            </button>

        </form>

        <a href="cart.php" class="continue">Back to Cart</a>

    </div>

</body>

</html>