<?php
include('auth.php');
include('../connection.php');

$search = mysqli_real_escape_string(
    $conn,
    $_GET['search'] ?? ''
);

$orders = mysqli_query($conn, "
    SELECT o.*,u.user_name
    FROM orders o
    LEFT JOIN users u ON o.user_id=u.id
    WHERE CAST(o.id AS CHAR) LIKE '%$search%'
       OR u.user_name LIKE '%$search%'
       OR o.phone LIKE '%$search%'
    ORDER BY o.id DESC
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order</title>
    <link rel="stylesheet" href="../css/admin.css">


</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">

                <div class="page-heading">
                    <h1>Orders Management</h1>
                    <p>View customer orders and order information.</p>
                </div>

                <div class="section-card">

                    <form method="GET" class="search-form">
                        <input type="search" name="search"
                            placeholder="Search order ID, customer or phone..."
                            value="<?= htmlspecialchars($search) ?>">
                        <button class="primary-btn">Search</button>
                    </form>

                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
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
                                            <td><?= htmlspecialchars($row['user_name'] ?? 'Unknown') ?></td>
                                            <td><?= htmlspecialchars($row['phone']) ?></td>
                                            <td><?= htmlspecialchars($row['region']) ?></td>
                                            <td><?= number_format($row['total']) ?> MMK</td>
                                            <td>
                                                <a class="edit-btn"
                                                    href="order_details.php?id=<?= $row['id'] ?>">Details</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="6" class="empty-row">No Orders Found</td>
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