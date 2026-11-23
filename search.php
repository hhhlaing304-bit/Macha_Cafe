<?php
session_start();

include('connection.php');

$keyword = trim($_GET['keyword'] ?? '');

if ($keyword == '') {
    header("Location: menu.php");
    exit();
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM products
     WHERE product_name LIKE ?
     ORDER BY id DESC"
);

$search = "%" . $keyword . "%";

mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Search Error: " . mysqli_error($conn));
}
?>


<link rel="stylesheet" href="css/style1.css">

<body>

    <h2>
        <a href="menu.php">🏠 Search Results:</a>  
        <?php echo htmlspecialchars($keyword); ?>
    </h2>

    <div class="product-grid">

        <?php if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php
                $image = trim($row['image']);

                if (strpos($image, 'images/') === 0) {
                    $imagePath = $image;
                } else {
                    $imagePath = 'images/' . basename($image);
                }
                ?>

                <div class="product-card">

                    <img
                        src="<?php echo htmlspecialchars($imagePath); ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>">

                    <div class="product-info">

                        <h3>
                            <?php echo htmlspecialchars($row['product_name']); ?>
                        </h3>

                        <div class="price">

                            <strong>
                                <?php echo number_format($row['price']); ?>
                            </strong>

                            <a href="add_to_cart.php?id=<?php echo (int)$row['id']; ?>">
                                +
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p>No products found.</p>

        <?php } ?>

    </div>

</body>

<?php
mysqli_stmt_close($stmt);
?>