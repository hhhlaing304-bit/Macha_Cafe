
<?php
session_start();
include('connection.php');

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<link rel="stylesheet" href="css/style1.css">

<body>

<div class="cart-container">

    <h1>My Shopping Cart</h1>

    <?php if (empty($cart)) { ?>

        <div class="empty">
            <h2>Your cart is empty</h2>
            <a href="menu.php" class="btn">Continue Shopping</a>
        </div>

    <?php } else { ?>

        <div class="cart-layout">

            <div class="cart-items">

                <?php foreach ($cart as $id => $item) {

                    $id = (int)$id;
                    $qty = (int)$item['quantity'];

                    $result = mysqli_query(
                        $conn,
                        "SELECT * FROM products WHERE id = $id"
                    );

                    if (!$result || mysqli_num_rows($result) == 0) {
                        continue;
                    }

                    $product = mysqli_fetch_assoc($result);

                    $subtotal = (float)$product['price'] * $qty;
                    $total += $subtotal;
                ?>

                    <div class="cart-item">

                        <img
                            src="images/<?php echo htmlspecialchars($product['image']); ?>"
                            alt="Product">

                        <div class="item-info">

                            <h3>
                                <?php echo htmlspecialchars($product['product_name']); ?>
                            </h3>

                            <p>
                                <?php echo number_format($product['price']); ?> MMK
                            </p>

                            <p class="subtotal">
                                Subtotal:
                                <?php echo number_format($subtotal); ?> MMK
                            </p>

                            <form action="update_cart.php" method="POST">

                                <input type="hidden" name="id"
                                    value="<?php echo $id; ?>">

                                <input
                                    type="number"
                                    name="quantity"
                                    value="<?php echo $qty; ?>"
                                    min="1"
                                    max="99"
                                    required>

                                <button type="submit" class="update-btn">
                                    Update
                                </button>

                            </form>

                            <a
                                href="remove_cart.php?id=<?php echo $id; ?>"
                                class="remove-btn">
                                Remove
                            </a>

                        </div>

                    </div>

                <?php } ?>

            </div>

            <div class="summary">

                <h2>Order Summary</h2>

                <p>
                    Total:
                    <strong>
                        <?php echo number_format($total); ?> MMK
                    </strong>
                </p>

                <a href="checkout.php" class="checkout-btn">
                    Proceed to Checkout
                </a>

                <a href="menu.php" class="continue">
                    Continue Shopping
                </a>

            </div>

        </div>

    <?php } ?>

</div>

</body>
</html>
