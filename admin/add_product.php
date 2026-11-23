<?php
include('auth.php');
include('../connection.php');

$error = '';

if (isset($_POST['add_product'])) {

    $name = trim($_POST['product_name']);
    $price = (float)$_POST['price'];
    $category = (int)$_POST['category_id'];

    if ($name === '' || $price <= 0 || $category <= 0) {
        $error = "Please enter valid product details.";
    } elseif (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK
    ) {
        $error = "Please choose an image.";
    } else {

        $check = mysqli_query($conn, "SELECT id FROM categories WHERE id=$category");

        $tmp = $_FILES['image']['tmp_name'];
        $info = @getimagesize($tmp);
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!$info || !in_array($extension, $allowed)) {
            $error = "Invalid image file.";
        } elseif (mysqli_num_rows($check) == 0) {
            $error = "Please select a valid category.";
        } else {

            $folder = '../images/';

            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = uniqid('product_', true) . '.' . $extension;

            if (move_uploaded_file($tmp, $folder . $filename)) {

                $path = 'images/' . $filename;

                $stmt = mysqli_prepare($conn, "INSERT INTO products(product_name,price,image,category_id) 
                VALUES (?,?,?,?)");

                mysqli_stmt_bind_param($stmt, "sdsi", $name, $price, $path, $category);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location: products.php");
                    exit();
                }

                unlink($folder . $filename);
                $error = "Unable to save product.";
            } else {
                $error = "Image upload failed.";
            }
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
    <title>add-product</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">
                <div class="page-heading">
                    <h1>Add Product</h1>
                    <p>Create a new menu item.</p>
                </div>

                <div class="section-card form-card">

                    <?php if ($error) { ?>
                        <div class="alert error"><?= htmlspecialchars($error) ?></div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">

                        <label>Product Name</label>
                        <input type="text" name="product_name" required>

                        <label>Price (MMK)</label>
                        <input type="number" name="price" min="1" required>

                        <label>Category</label>
                        <select name="category_id" required>
                            <option value="">Select Category</option>
                            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                                <option value="<?= $cat['id'] ?>">
                                    <?= htmlspecialchars($cat['category_name']) ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label>Product Image</label>
                        <input type="file" name="image"
                            accept=".jpg,.jpeg,.png,.webp" required>

                        <div class="form-actions">
                            <button class="primary-btn" name="add_product">Add Product</button>
                            <a href="products.php" class="cancel-btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </section>
        </main>
    </div>
</body>

</html>