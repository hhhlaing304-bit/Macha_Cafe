<?php
session_start();
include('connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['id'];

$sql = "SELECT * FROM orders
        WHERE user_id = $user_id
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Order query failed: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>


<?php  include('header.php') ?>
<div class="container">

    <h1>My Orders</h1>

    <?php if (isset($_GET['success'])) { ?>
        <div class="success-message">
            Your order has been placed successfully!
        </div>
    <?php } ?>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <?php while ($order = mysqli_fetch_assoc($result)) { ?>

            <div class="order-card">

                <h3>Order #<?php echo $order['id']; ?></h3>

                <p>
                    Date:
                    <?php echo htmlspecialchars($order['order_date']); ?>
                </p>

                <p>
                    Total:
                    <?php echo number_format($order['total']); ?> MMK
                </p>

                <p>
                    Status:
                    <strong>
                        <?php echo htmlspecialchars($order['status']); ?>
                    </strong>
                </p>

                <a href="order_detail.php?id=<?php echo $order['id']; ?>"
                   class="btn">
                    View Details
                </a>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="empty">
            <h2>No orders yet</h2>
            <a href="menu.php" class="btn">Start Shopping</a>
        </div>

    <?php } ?>

</div>

<?php  include('footer.php') ?>

</body>
</html>


