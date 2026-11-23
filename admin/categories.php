<?php
include('auth.php');
include('../connection.php');

$categories = mysqli_query($conn, "
    SELECT c.*,
    (SELECT COUNT(*) FROM products p WHERE p.category_id=c.id) AS total_products
    FROM categories c
    ORDER BY c.id DESC");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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
                        <h1>Categories</h1>
                        <p>Manage menu categories.</p>
                    </div>
                    <a href="add_category.php" class="primary-btn">+ Add Category</a>
                </div>

                <div class="section-card">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Total Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (mysqli_num_rows($categories) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
                                        <tr>
                                            <td>#<?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['category_name']) ?></td>
                                            <td><?= $row['total_products'] ?></td>
                                            <td class="action-buttons">
                                                <a class="edit-btn" href="edit_category.php?id=<?= $row['id'] ?>">Edit</a>
                                                <form method="POST" action="delete_category.php"
                                                    onsubmit="return confirm('Delete this category?')">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <button class="delete-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="4" class="empty-row">No Categories Found</td>
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