<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
        integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>



<body>
    <aside class="sidebar">

        <div class="brand">
            <span class="brand-icon">🍃</span>
            <div>
                <h2>Macha Café</h2>
                <small>ADMIN PANEL</small>
            </div>
        </div>

        <p class="menu-title">MAIN MENU</p>

        <nav class="side-menu">
            <a href="dashboard.php">🏠<span>Dashboard</span></a>
            <a href="products.php">🛍️<span>Products</span></a>
            <a href="categories.php">📂<span>Categories</span></a>
            <a href="popular_products.php">⭐<span>Popular Products</span></a>
            <a href="orders.php">📦 <span>Orders</span></a>
            <a href="users.php">👥<span>Customers</span></a>
        </nav>

        <p class="menu-title">OTHER</p>

        <nav class="side-menu">
            <a href="settings.php">⚙️<span>Settings</span></a>
            <a href="logout.php" class="logout">↪️<span>Logout</span></a>
        </nav>

        <div class="sidebar-bottom">

            <div class="admin-avatar">
                <?php if (!empty($_SESSION['admin_image'])) { ?>
                    <img src="../images/<?= htmlspecialchars($_SESSION['admin_image']) ?>"
                        alt="Admin Profile">
                <?php } else { ?>
                    <?= strtoupper(substr($_SESSION['admin_name'], 0, 1)) ?>
                <?php } ?>
            </div>

            <div class="admin-info">
                <strong>
                    <?= htmlspecialchars($_SESSION['admin_name']) ?>
                </strong>
                <small>Administrator</small>
            </div>

        </div>

    </aside>
</body>

</html>