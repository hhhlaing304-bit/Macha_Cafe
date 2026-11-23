<?php
include('auth.php');
include('../connection.php');

function countTable($conn, $table)
{
    $allowed = ['users', 'products', 'categories', 'orders'];

    if (!in_array($table, $allowed)) return 0;

    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `$table`");
    return $result ? mysqli_fetch_assoc($result)['total'] : 0;
}

$users = countTable($conn, 'users');
$products = countTable($conn, 'products');
$categories = countTable($conn, 'categories');
$orders = countTable($conn, 'orders');

$revenue = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(total) AS total FROM orders")
)['total'] ?? 0;

$recent = mysqli_query($conn, "
    SELECT o.*, u.user_name
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.id
    ORDER BY o.id DESC LIMIT 5
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>

    <div class="admin-layout">

        <?php include('sidebar.php'); ?>

        <main class="main-content">

            <?php include('header.php'); ?>

            <section class="content">

                <div class="page-heading">
                    <div>
                        <h1>Dashboard Overview</h1>
                        <p>Welcome to your Macha Café management system.</p>
                    </div>
                </div>

                <div class="stats-grid">

                    <div class="stat-card">
                        <div class="stat-icon">🛍️</div>
                        <div>
                            <p>Total Products</p>
                            <h2><?= $products ?></h2>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">📦</div>
                        <div>
                            <p>Total Orders</p>
                            <h2><?= $orders ?></h2>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div>
                            <p>Total Customers</p>
                            <h2><?= $users ?></h2>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">📂</div>
                        <div>
                            <p>Categories</p>
                            <h2><?= $categories ?></h2>
                        </div>
                    </div>

                    <div class="stat-card revenue-card">
                        <div class="stat-icon">💰</div>
                        <div>
                            <p>Total Revenue</p>
                            <h2><?= number_format($revenue) ?> MMK</h2>
                        </div>
                    </div>

                </div>

                <div class="section-card">
                    <h3>Recent Orders</h3>

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

                                <?php if (mysqli_num_rows($recent) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($recent)) { ?>
                                        <tr>
                                            <td>#<?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['user_name'] ?? 'Unknown') ?></td>
                                            <td><?= htmlspecialchars($row['phone']) ?></td>
                                            <td><?= htmlspecialchars($row['region']) ?></td>
                                            <td><?= number_format($row['total']) ?> MMK</td>
                                            <td>
                                                <a class="edit-btn"
                                                    href="order_details.php?id=<?= $row['id'] ?>">
                                                    View
                                                </a>
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

                <div class="quick-actions">
                    <a href="add_product.php">＋ Add Product</a>
                    <a href="add_category.php">＋ Add Category</a>
                    <a href="orders.php">View Orders</a>
                    <a href="popular_products.php">Manage Popular Products</a>
                </div>

            </section>
        </main>
    </div>
</body>

</html>