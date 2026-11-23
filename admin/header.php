<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>


    <header class="topbar">

        <div>
            <h3>Welcome Back, Admin!</h3>
            <p>Manage your Macha Café business</p>
        </div>

        <div class="topbar-right">
            <span class="online-status">● Online</span>
            <div class="admin-avatar">
                <?php if (!empty($_SESSION['admin_image'])) { ?>
                    <img src="../images/<?= htmlspecialchars($_SESSION['admin_image']) ?>"
                        alt="Admin Profile">
                <?php } else { ?>
                    <?= strtoupper(substr($_SESSION['admin_name'], 0, 1)) ?>
                <?php } ?>
            </div>
        </div>

    </header>
</body>

</html>