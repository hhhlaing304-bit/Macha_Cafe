<?php
include('auth.php');
include('../connection.php');

$search = mysqli_real_escape_string(
    $conn,
    $_GET['search'] ?? ''
);

$users = mysqli_query($conn, "
    SELECT u.*,
    (SELECT COUNT(*) FROM orders o WHERE o.user_id=u.id) AS total_orders
    FROM users u
    WHERE u.user_name LIKE '%$search%'
       OR u.email LIKE '%$search%'
    ORDER BY u.id DESC
");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="admin-layout">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <?php include('header.php'); ?>

            <section class="content">

                <div class="page-heading">
                    <h1>Customers</h1>
                    <p>Manage registered café customers.</p>
                </div>

                <div class="section-card">

                    <form method="GET" class="search-form">
                        <input type="search" name="search"
                            placeholder="Search customer..."
                            value="<?= htmlspecialchars($search) ?>">
                        <button class="primary-btn">Search</button>
                    </form>

                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Joined Date</th>
                                    <th>Total Orders</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (mysqli_num_rows($users) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                                        <tr>
                                            <td>#<?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['user_name']) ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                                            <td><?= $row['total_orders'] ?></td>
                                            <td>
                                                <a href="user_detail.php?id=<?= $row['id'] ?>"
                                                    class="edit-btn">View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="6" class="empty-row">No Customers Found</td>
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