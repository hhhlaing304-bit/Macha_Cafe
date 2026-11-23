<?php
include('auth.php');
include('../connection.php');

$error = '';

if (isset($_POST['add_category'])) {

    $name = trim($_POST['category_name']);

    if ($name === '') {
        $error = "Enter category name.";
    } else {

        $stmt = mysqli_prepare($conn, "INSERT INTO categories (category_name) VALUES (?)");

        mysqli_stmt_bind_param($stmt, "s", $name);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: categories.php");
            exit();
        } else {
            $error = "Category already exists or could not be added.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add-category</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php
        include('sidebar.php');
        ?>
        <main class="main-content">
            <?php
            include('header.php');
            ?>
            <section class="content">

                <div class="page-heading">
                    <h1>Add Category</h1>
                    <p>Create a new menu category.</p>
                </div>

                <div class="section-card form-card">
                    <?php if ($error) { ?>
                        <div class="alert error">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <label>Category Name</label>
                        <input type="text" name="category_name"
                            placeholder="Enter category name" required>

                        <div class="form-actions">
                            <button class="primary-btn" name="add_category">Save Category</button>
                            <a href="categories.php" class="cancel-btn">Cancel</a>
                        </div>
                    </form>
                </div>

            </section>
        </main>
    </div>
</body>

</html>