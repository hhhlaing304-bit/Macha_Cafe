<?php
include('auth.php');
include('../connection.php');

$id = (int)($_GET['id'] ?? 0);

$result = mysqli_query($conn, "SELECT * FROM categories WHERE id=$id");
$category = mysqli_fetch_assoc($result);

if (!$category) {
    header("Location: categories.php");
    exit();
}

$error = '';

if (isset($_POST['update_category'])) {

    $name = trim($_POST['category_name']);

    if ($name === '') {
        $error = "Category name is required.";
    } else {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE categories SET category_name=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "si", $name, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: categories.php");
            exit();
        }

        $error = "Unable to update category.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit-category</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">
                <div class="page-heading">
                    <h1>Edit Category</h1>
                    <p>Update category name.</p>
                </div>

                <div class="section-card form-card">
                    <?php if ($error) { ?>
                        <div class="alert error"><?= htmlspecialchars($error) ?></div>
                    <?php } ?>

                    <form method="POST">
                        <label>Category Name</label>
                        <input type="text" name="category_name"
                            value="<?= htmlspecialchars($category['category_name']) ?>" required>

                        <div class="form-actions">
                            <button class="primary-btn" name="update_category">Update</button>
                            <a href="categories.php" class="cancel-btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>

</html>