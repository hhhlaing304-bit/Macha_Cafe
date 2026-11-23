<?php
include('auth.php');
include('../connection.php');

$id = (int)($_GET['id'] ?? 0);

$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header("Location: products.php");
    exit();
}

$error = '';

if (isset($_POST['update_product'])) {

    $name = trim($_POST['product_name']);
    $price = (float)$_POST['price'];
    $category = (int)$_POST['category_id'];
    $image = $product['image'];

    $catCheck = mysqli_query(
        $conn,
        "SELECT id FROM categories WHERE id=$category"
    );

    if ($name === '' || $price <= 0 || mysqli_num_rows($catCheck) == 0) {
        $error = "Please enter valid information.";
    } else {

        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $tmp = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (
                $_FILES['image']['error'] !== UPLOAD_ERR_OK ||
                !@getimagesize($tmp) || !in_array($ext, $allowed)
            ) {
                $error = "Invalid image file.";
            } else {

                $filename = uniqid('product_', true) . '.' . $ext;

                if (move_uploaded_file($tmp, '../images/' . $filename)) {
                    $image = 'images/' . $filename;
                } else {
                    $error = "Image upload failed.";
                }
            }
        }

        if ($error === '') {
            $stmt = mysqli_prepare(
                $conn,
                "UPDATE products
                 SET product_name=?,price=?,image=?,category_id=?
                 WHERE id=?"
            );

            mysqli_stmt_bind_param($stmt, "sdsii", $name, $price, $image, $category, $id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: products.php");
                exit();
            }

            $error = "Update failed.";
        }
    }
}

$categories = mysqli_query($conn, "SELECT * FROM categories");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit-product</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>
            <section class="content">

                <div class="page-heading">
                    <h1>Edit Product</h1>
                    <p>Update product information.</p>
                </div>

                <div class="section-card form-card">

                    <?php if ($error) { ?>
                        <div class="alert error"><?= htmlspecialchars($error) ?></div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">

                        <label>Product Name</label>
                        <input type="text" name="product_name"
                            value="<?= htmlspecialchars($product['product_name']) ?>" required>

                        <label>Price (MMK)</label>
                        <input type="number" name="price"
                            value="<?= htmlspecialchars($product['price']) ?>" min="1" required>

                        <label>Category</label>
                        <select name="category_id" required>
                            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['category_name']) ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label>Current Image</label>
                        <img class="preview-image"
                            src="../<?= htmlspecialchars($product['image']) ?>" alt="Product">

                        <label>Change Image (Optional)</label>
                        <input type="file" name="image"
                            accept=".jpg,.jpeg,.png,.webp">

                        <div class="form-actions">
                            <button class="primary-btn" name="update_product">Update Product</button>
                            <a href="products.php" class="cancel-btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </section>
        </main>
    </div>
</body>

</html>