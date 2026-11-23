<?php
session_start();
include('connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['id'];
$order_id = (int)($_GET['id'] ?? 0);

if ($order_id <= 0) {
    die("Invalid order ID.");
}

$sql = "SELECT * FROM orders
        WHERE id = $order_id AND user_id = $user_id";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Order not found.");
}

$order = mysqli_fetch_assoc($result);

$item_sql = "SELECT * FROM order_items
             WHERE order_id = $order_id";

$items = mysqli_query($conn, $item_sql);

if (!$items) {
    die("Unable to load order items.");
}
?>


<link rel="stylesheet" href="css/style1.css">
<body>

<div class="container">

    <h1>Order Details</h1>

    <div class="order-card">

        <h2>Order #<?php echo $order['id']; ?></h2>

        <p>Phone: <?php echo htmlspecialchars($order['phone']); ?></p>

        <p>Region: <?php echo htmlspecialchars($order['region']); ?></p>

        <p>Address: <?php echo nl2br(htmlspecialchars($order['address'])); ?></p>

        <p>Date: <?php echo htmlspecialchars($order['order_date']); ?></p>

        <p>Status:
            <strong><?php echo htmlspecialchars($order['status']); ?></strong>
        </p>

    </div>

    <h2>Ordered Products</h2>

    <?php while ($item = mysqli_fetch_assoc($items)) { ?>

        <div class="order-item">

            <h3><?php echo htmlspecialchars($item['product_name']); ?></h3>

            <p>
                Price: <?php echo number_format($item['price']); ?> MMK
            </p>

            <p>Quantity: <?php echo $item['quantity']; ?></p>

            <p>
                Subtotal:
                <?php echo number_format($item['subtotal']); ?> MMK
            </p>

        </div>

    <?php } ?>

    <div class="checkout-total">
        Total:
        <strong><?php echo number_format($order['total']); ?> MMK</strong>
    </div>

    <a href="orders.php" class="btn">Back to My Orders</a>

</div>

</body>
