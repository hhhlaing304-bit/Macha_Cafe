<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:login.php');
    exit();
}

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



    <?php include("header.php") ?>

    <section class="hero" id="home">

        <!-- <div class="hero-overlay"></div> -->

        <div class="hero-content">

            <div class="hero-text">

                <span class="small-title">
                    <i class="fa-solid fa-leaf"></i>
                    GOOD FOOD, GOOD MOOD
                </span>

                <h1>
                    Matcha Makes
                    <span>Life Better</span>
                </h1>

                <p>
                    Premium matcha drinks, handmade cakes
                    and delicious food. Fresh ingredients,
                    made with love, just for you.
                </p>

                <a href="menu.php" class="btn">
                    Explore Menu
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

            <!-- <label for="sidebar-toggle" class="mobile-menu">☰</label>
    <label for="sidebar-toggle" class="overlay"></label> -->



        </div>

    </section>



    <section class="category-section">

        <div class="container">

            <div class="category-grid">

                <a href="matcha_drink.php" class="category-card">
                    <i class="fa-solid fa-mug-hot"></i>
                    <span>Matcha Drinks</span>
                </a>

                <a href="cakes.php" class="category-card">
                    <i class="fa-solid fa-cake-candles"></i>
                    <span>Cakes</span>
                </a>

                <a href="food.php" class="category-card">
                    <i class="fa-solid fa-utensils"></i>
                    <span>Food</span>
                </a>

                <a href="smoothies.php" class="category-card">
                    <i class="fa-solid fa-glass-water"></i>
                    <span>Smoothies</span>
                </a>

                <a href="desserts.php" class="category-card">
                    <i class="fa-solid fa-ice-cream"></i>
                    <span>Desserts</span>
                </a>

                <a href="specials.php" class="category-card">
                    <i class="fa-solid fa-leaf"></i>
                    <span>Specials</span>
                </a>

            </div>

        </div>

    </section>


    <section class="popular-section" id="menu">

        <div class="container">

            <div class="section-heading">

                <div>
                    <span class="section-subtitle">OUR FAVORITES</span>
                    <h2>Popular Menu</h2>
                </div>

                <a href="menu.php" class="view-all">
                    View All
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            <div class="menu-grid">

                <div class="menu-card">

                    <div class="menu-image">
                        <img src="images/macha1.jpg" alt="Matcha">

                        <span class="menu-tag">Popular</span>

                        <a href="product.php?id=1" class="quick-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>

                    <div class="menu-info">

                        <h3>Macha</h3>

                        <p>Fresh Japanese Matcha</p>

                        <!-- <div class="product-bottom">
                            <span class="menu-price">9000</span>

                            <a href="cart.php" class="add-cart">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div> -->

                    </div>

                </div>


                <div class="menu-card">

                    <div class="menu-image">
                        <img src="images/matcha white chocolate.jpg" alt="matcha white chocolate">

                        <a href="product.php?id=2" class="quick-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>

                    <div class="menu-info">

                        <h3>Matcha White Chocolate</h3>

                        <p>Sweet & Creamy Drink</p>

                        <!-- <div class="product-bottom">
                            <span class="menu-price">20000</span>

                            <a href="cart.php" class="add-cart">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div> -->

                    </div>

                </div>


                <div class="menu-card">

                    <div class="menu-image">
                        <img src="images/cheesecake.jpg"
                            alt="cheesecake">

                        <a href="product.php?id=3" class="quick-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>

                    <div class="menu-info">

                        <h3>Cheesecake</h3>

                        <p>Homemade Fresh Cake</p>

                        <!-- <div class="product-bottom">
                            <span class="menu-price">8000</span>

                            <a href="cart.php" class="add-cart">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div> -->

                    </div>

                </div>

                <div class="menu-card">

                    <div class="menu-image">
                        <img src="images/chocolate cake.jpg"
                            alt="Chocolate Cake">

                        <a href="product.php?id=4" class="quick-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>

                    <div class="menu-info">

                        <h3>Chocolate Cake</h3>

                        <p>Rich Chocolate Flavor</p>

                        <!-- <div class="product-bottom">
                            <span class="menu-price">15000</span>

                            <a href="cart.php" class="add-cart"> <i class="fa-solid fa-plus"></i>
                            </a>
                        </div> -->

                    </div>

                </div>

                <div class="menu-card">

                    <div class="menu-image">
                        <img src="images/matchaProteinPancake.jpg"
                            alt="Chicken Rice Bowl">

                        <a href="product.php?id=5" class="quick-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>

                    <div class="menu-info">

                        <h3>PanCake</h3>

                        <p>Healthy & Delicious Food</p>

                        <!-- <div class="product-bottom">
                            <span class="menu-price">16000</span>

                            <a href="cart.php" class="add-cart"> <i class="fa-solid fa-plus"></i>
                            </a>
                        </div> -->

                    </div>

                </div>

            </div>

        </div>

    </section>


    <section class="about-section" id="about">

        <div class="container about-container">

            <div class="about-image" id="gallery">

                <img src="https://images.unsplash.com/photo-1445116572660-236099ec97a0?w=1000"
                    alt="Macha Cafe Interior">

                <div class="image-caption">
                    <span>Good Food</span>
                    <span>Good Mood</span>
                    <span>Wonderful Life</span>
                </div>

            </div>


            <div class="about-content">

                <span class="section-subtitle">ABOUT MACHA</span>

                <h2>More Than Just Food</h2>

                <p>
                    Welcome to Macha Café, where every cup
                    tells a story. We proudly serve premium
                    matcha drinks, delicious homemade cakes
                    and fresh food made with love.
                </p>

                <p>
                    Our mission is to bring happiness to
                    everyone through fresh ingredients,
                    wonderful flavors and a cozy atmosphere.
                </p>

                <div class="about-features">

                    <div>
                        <i class="fa-solid fa-leaf"></i>
                        <span>Fresh Ingredients</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-heart"></i>
                        <span>Made With Love</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-star"></i>
                        <span>Best Quality</span>
                    </div>

                </div>

                <a href="about.php" class="btn">
                    Discover More
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </section>

    <section class="special-section" id="specials">

        <div class="container special-content">

            <div>
                <span>OUR SPECIAL COLLECTION</span>

                <h2>
                    A Little Matcha,
                    <br>
                    A Lot of Happiness.
                </h2>

                <p>
                    Discover your favorite taste
                    and enjoy every little moment.
                </p>

                <a href="menu.php" class="btn">
                    Order Now
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

    </section>

    <?php include("footer.php") ?>


</body>

</html>