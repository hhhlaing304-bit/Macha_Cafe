<?php
include('auth.php');
include('../connection.php');

$search = mysqli_real_escape_string(
    $conn,
    $_GET['search'] ?? ''
);

$products = mysqli_query($conn, "
    SELECT p.*, c.category_name,
    (SELECT COUNT(*) FROM popular_products pp
     WHERE pp.product_id=p.id) AS is_popular
    FROM products p
    LEFT JOIN categories c ON p.category_id=c.id
    WHERE p.product_name LIKE '%$search%'
    ORDER BY p.id DESC
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                        <h1>Products</h1>
                        <p>Manage all café products.</p>
                    </div>
                    <a href="add_product.php" class="primary-btn">+ Add Product</a>
                </div>

                <div class="section-card">

                    <form method="GET" class="search-form">
                        <input type="search" name="search"
                            placeholder="Search product..."
                            value="<?= htmlspecialchars($search) ?>">
                        <button class="primary-btn">Search</button>
                    </form>

                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Popular</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (mysqli_num_rows($products) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($products)) { ?>
                                        <tr>
                                            <td>#<?= $row['id'] ?></td>
                                            <td>
                                                <?php
                                                $image = trim($row['image']);

                                                if (strpos($image, 'images/') === 0) {
                                                    $imagePath = '../' . $image;
                                                } else {
                                                    $imagePath = '../images/' . basename($image);
                                                }
                                                ?>

                                                <img class="product-thumb"
                                                    src="<?= htmlspecialchars($imagePath) ?>"
                                                    alt="<?= htmlspecialchars($row['product_name']) ?>">
                                            </td>
                                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                                            <td><?= htmlspecialchars($row['category_name'] ?? 'None') ?></td>
                                            <td><?= number_format($row['price']) ?> MMK</td>
                                            <td>
                                                <?= $row['is_popular'] ? 'Yes' : 'No' ?>
                                            </td>
                                            <td class="action-buttons">
                                                <a class="edit-btn"
                                                    href="edit_product.php?id=<?= $row['id'] ?>">Edit
                                                </a>

                                                <form method="POST" action="delete_product.php"
                                                    onsubmit="return confirm('Delete this product?')">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <button class="delete-btn" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="7" class="empty-row">No Products Found</td>
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