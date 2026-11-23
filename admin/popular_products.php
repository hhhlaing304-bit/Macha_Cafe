<?php
include('auth.php');
include('../connection.php');

$message = '';

if (isset($_POST['add_popular'])) {

    $product_id = (int)$_POST['product_id'];

    $check = mysqli_query(
        $conn,
        "SELECT id FROM popular_products WHERE product_id=$product_id"
    );

    if (mysqli_num_rows($check) == 0) {

        $productCheck = mysqli_query(
            $conn,
            "SELECT id FROM products WHERE id=$product_id"
        );

        if (mysqli_num_rows($productCheck) > 0) {
            mysqli_query(
                $conn,
                "INSERT INTO popular_products (product_id)
                 VALUES ($product_id)"
            );
            $message = "Popular product added.";
        }
    } else {
        $message = "This product is already popular.";
    }
}

if (isset($_POST['remove_popular'])) {

    $popular_id = (int)$_POST['popular_id'];

    mysqli_query(
        $conn,
        "DELETE FROM popular_products WHERE id=$popular_id"
    );

    $message = "Popular product removed.";
}

$available = mysqli_query($conn, "
    SELECT p.*
    FROM products p
    LEFT JOIN popular_products pp
    ON p.id=pp.product_id
    WHERE pp.id IS NULL
    ORDER BY p.product_name
");

$popular = mysqli_query($conn, "
    SELECT pp.id AS popular_id,p.*
    FROM popular_products pp
    INNER JOIN products p ON pp.product_id=p.id
    ORDER BY pp.id DESC
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>popular_products</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">

                <div class="page-heading">
                    <h1>Popular Products</h1>
                    <p>Choose products to display in Popular Menu.</p>
                </div>

                <div class="section-card">

                    <?php if ($message) { ?>
                        <div class="alert success"><?= htmlspecialchars($message) ?></div>
                    <?php } ?>

                    <h3>Add Popular Product</h3>

                    <form method="POST" class="popular-form">
                        <select name="product_id" required>
                            <option value="">Select Product</option>
                            <?php while ($p = mysqli_fetch_assoc($available)) { ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= htmlspecialchars($p['product_name']) ?>
                                </option>
                            <?php } ?>
                        </select>

                        <button class="primary-btn" name="add_popular">Add Popular</button>
                    </form>

                </div>

                <div class="section-card">
                    <h3>Current Popular Products</h3>

                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (mysqli_num_rows($popular) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($popular)) { ?>
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
                                            <td><?= number_format($row['price']) ?> MMK</td>
                                            <td>
                                                <form method="POST"
                                                    onsubmit="return confirm('Remove from popular?')">
                                                    <input type="hidden" name="popular_id"
                                                        value="<?= $row['popular_id'] ?>">
                                                    <button name="remove_popular" class="delete-btn">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="empty-row">No Popular Products</td>
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