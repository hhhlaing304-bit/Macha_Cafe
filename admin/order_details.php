<?php
include('auth.php');
include('../connection.php');

$id = (int)($_GET['id'] ?? 0);

$orderResult = mysqli_query($conn, "
    SELECT o.*,u.user_name,u.email
    FROM orders o
    LEFT JOIN users u ON o.user_id=u.id
    WHERE o.id=$id
");

$order = mysqli_fetch_assoc($orderResult);

if (!$order) {
    header("Location: orders.php");
    exit();
}

$items = mysqli_query($conn, "
    SELECT * FROM order_items
    WHERE order_id=$id
    ORDER BY id ASC
");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order-details</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">

                <div class="page-heading heading-flex">
                    <div>
                        <h1>Order #<?= $order['id'] ?></h1>
                        <p>Customer order details.</p>
                    </div>
                    <a href="orders.php" class="cancel-btn">Back to Orders</a>
                </div>

                <div class="details-grid">

                    <div class="section-card">
                        <h3>Customer Information</h3>
                        <div class="detail-item">
                            <strong>Customer</strong>
                            <span><?= htmlspecialchars($order['user_name'] ?? 'Unknown') ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Email</strong>
                            <span><?= htmlspecialchars($order['email'] ?? 'N/A') ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Phone</strong>
                            <span><?= htmlspecialchars($order['phone']) ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Region</strong>
                            <span><?= htmlspecialchars($order['region']) ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Address</strong>
                            <span><?= nl2br(htmlspecialchars($order['address'])) ?></span>
                        </div>
                    </div>

                    <div class="section-card">
                        <h3>Order Summary</h3>
                        <div class="detail-item">
                            <strong>Order ID</strong>
                            <span>#<?= $order['id'] ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Total</strong>
                            <span class="total-price">
                                <?= number_format($order['total']) ?> MMK
                            </span>
                        </div>
                    </div>

                </div>

                <div class="section-card">
                    <h3>Ordered Products</h3>

                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (mysqli_num_rows($items) > 0) { ?>
                                    <?php while ($item = mysqli_fetch_assoc($items)) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                                            <td><?= number_format($item['price']) ?> MMK</td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= number_format($item['subtotal']) ?> MMK</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="4" class="empty-row">No Order Items</td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </main>
    </div>
</body>
</html>

