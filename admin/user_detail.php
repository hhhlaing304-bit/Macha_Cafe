<?php
include('auth.php');
include('../connection.php');

$id = (int)($_GET['id'] ?? 0);

$result = mysqli_query($conn, "
    SELECT * FROM users WHERE id=$id
");

$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: users.php");
    exit();
}

$orders = mysqli_query($conn, "
    SELECT * FROM orders
    WHERE user_id=$id
    ORDER BY id DESC
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user-details</title>
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
                        <h1>Customer Details</h1>
                        <p>Customer account and order history.</p>
                    </div>
                    <a href="users.php" class="cancel-btn">Back</a>
                </div>

                <div class="section-card">
                    <h3>Customer Information</h3>

                    <div class="detail-item">
                        <strong>User ID</strong>
                        <span>#<?= $user['id'] ?></span>
                    </div>

                    <div class="detail-item">
                        <strong>Username</strong>
                        <span><?= htmlspecialchars($user['user_name']) ?></span>
                    </div>

                    <div class="detail-item">
                        <strong>Email</strong>
                        <span><?= htmlspecialchars($user['email']) ?></span>
                    </div>

                    <div class="detail-item">
                        <strong>Created At</strong>
                        <span><?= htmlspecialchars($user['created_at']) ?></span>
                    </div>
                </div>

                <div class="section-card">
                    <h3>Order History</h3>

                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Phone</th>
                                    <th>Region</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (mysqli_num_rows($orders) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
                                        <tr>
                                            <td>#<?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['phone']) ?></td>
                                            <td><?= htmlspecialchars($row['region']) ?></td>
                                            <td><?= number_format($row['total']) ?> MMK</td>
                                            <td>
                                                <a href="order_details.php?id=<?= $row['id'] ?>"
                                                    class="edit-btn">View Order</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="empty-row">No Orders Yet</td>
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