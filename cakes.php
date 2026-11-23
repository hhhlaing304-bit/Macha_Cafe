<?php
include('connection.php');
session_start();

$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}

$sql = "SELECT * FROM products
        WHERE category_id = 2";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
        integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>



    <input type="checkbox" id="sidebar-toggle">

    <aside class="sidebar">

        <div class="brand">🍃 Macha</div>

        <p class="nav-title">MENU</p>

        <nav class="side-nav">
            <a href="menu.php">✦ <span>Popular Menu</span></a>
            <a href="matcha_drink.php">🍵 <span>Matcha Drinks</span></a>
            <a href="cakes.php" class="active">🧁 <span>Cakes</span></a>
            <a href="food.php">🍽️ <span>Food</span></a>
            <a href="smoothies.php">🥤 <span>Smoothies</span></a>
            <a href="desserts.php">🍮 <span>Desserts</span></a>
            <a href="specials.php">🌿 <span>Specials</span></a>
        </nav>

        <div class="divider"></div>

        <p class="nav-title">DISCOVER</p>

        <nav class="side-nav">
            <a href="index.php">🏠Home</a>
            <a href="about.php">👥About Us</a>
            <a href="orders.php">📦Order</a>
            <a href="contact.php">☎️Contact</a>
        </nav>

        <div class="promo">
            <div>🍵</div>
            <h3>Love Matcha?</h3>
            <p>Discover your favorite drinks and sweet treats.</p>
        </div>

    </aside>

    <label for="sidebar-toggle" class="mobile-menu">☰</label>
    <label for="sidebar-toggle" class="overlay"></label>


    <main class="main-content">

        <div class="top-content">
            <div>
                <span class="sub-title">FRESH & NATURAL</span>
                <h1>Explore Our Menu</h1>
                <p>Fresh ingredients, beautiful flavors, made with love.</p>
            </div>

            <div class="top-actions">
                <form class="search-box" action="search.php" method="GET">


                    <input
                        type="search"
                        name="keyword"
                        placeholder="Search menu..."
                        value="<?php echo ($_GET['keyword'] ?? ''); ?>"
                        required>

                    <a href="search.php"><button type="submit">⌕</button></a>

                </form>
                <a href="cart.php" class="cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php if ($cartCount > 0) { ?>
                        <span class="cart-count">
                            <?= $cartCount ?>
                        </span>
                    <?php } ?>
                </a>
            </div>
        </div>





        <section class="menu-section" id="popular">

            <div class="section-title">
                <div>
                    <span class="sub-title">CUSTOMER FAVORITES</span>
                    <h2>Cakes</h2>
                </div>
            </div>

            <div class="product-grid">

                <?php

                while ($row = mysqli_fetch_assoc($result)) {

                ?>

                    <div class="product-card">
                        <?php $image = trim($row['image']);

                        if (strpos($image, 'images/') === 0) {
                            $imagePath = $image;
                        } else {
                            $imagePath = 'images/' .
                                basename($image);
                        }

                        ?>

                        <img src="<?= htmlspecialchars($imagePath) ?>" 
                        alt="<?= htmlspecialchars($row['product_name']) ?>">



                        <div class="product-info">
                            <h3><?php echo $row['product_name']; ?></h3>

                            <div class="price">
                                <strong><?php echo number_format($row['price']); ?></strong>
                                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">+</a>
                            </div>
                        </div>
                    </div>
                <?php  } ?>



            </div>


            </div>
        </section>

        <?php include('footer.php') ?>


    </main>


</body>

</html>