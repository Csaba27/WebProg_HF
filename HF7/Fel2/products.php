<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = &$_SESSION['cart'];

$products = [
    1 => [
        'name' => 'Product A',
        'price' => 10.99
    ],
    2 => [
        'name' => 'Product B',
        'price' => 14.99
    ],
    3 => [
        'name' => 'Product C',
        'price' => 19.99
    ],
];

if (isset($_GET['cart'])) {

    if (isset($_GET['remove'], $_GET['product'])) {
        $productId = intval($_GET['product']);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        header('Location: ?cart');
        die;
    } else if (isset($_GET['quantity'], $_GET['product'])) {
        $newQuantity = intval($_GET['quantity']);
        $productId = intval($_GET['product']);
        if (isset($cart[$productId]) && $newQuantity > 0) {
            $cart[$productId]['quantity'] = $newQuantity;
        }
        header('Location: ?cart');
        die;
    }

    $totalPrice = 0;
    ?>

    <h1>Shopping Cart</h1>

    <ul>
        <?php foreach ($cart as $id => $product) {
            $totalPrice += $products[$id]['price'] * $product['quantity'];
            ?>
            <li>

                <?php echo htmlspecialchars($products[$id]['name']) . ' - $' . number_format($products[$id]['price'], 2); ?>
                <form id="quantityForm" method="get" style="display: inline;">
                    <input type="hidden" name="cart">
                    <input type="hidden" name="product" value="<?php echo $id; ?>">
                    (Quantity: <input type="number" min="1" style="width: 80px;" name="quantity"
                                      value="<?php echo $product['quantity']; ?>"> )
                </form>

                <form method="get" style="display: inline;">
                    <input type="hidden" name="cart">
                    <input type="hidden" name="product" value="<?php echo $id; ?>">
                    <button type="submit" name="remove">Remove from Cart</button>
                </form>
            </li>
        <?php } ?>
    </ul>

    <p>Total Price: $<?php echo number_format($totalPrice, 2); ?></p>

    <form method="get">
        <button type="submit" name="home">View Products</button>
    </form>

    <?php

    die;
}

if (isset($_GET['add_cart'], $_GET['product'])) {

    $productId = intval($_GET['product']);

    if (isset($cart[$productId])) {
        $cart[$productId]['quantity']++;
    } else {
        if (isset($products[$productId])) {
            $cart[$productId] = ['quantity' => 1];
        } else {
            throw new RuntimeException("Product not exists!");
        }
    }

    echo '<h2>Added: "' . htmlspecialchars($products[$productId]['name']) . '" - Quantity: ' . $cart[$productId]['quantity'] . ' </h2>';
}

?>

<h1>Product list</h1>

<ul>
    <?php foreach ($products as $id => $product) { ?>
        <li>
            <form method="get">
                <?php echo htmlspecialchars($product['name']) . ' - $' . number_format($product['price'], 2); ?>
                <input type="hidden" name="product" value="<?php echo $id; ?>">
                <button type="submit" name="add_cart">Add to Cart</button>
            </form>
        </li>
    <?php } ?>
</ul>
<form method="get">
    <button type="submit" name="cart">View Cart</button>
</form>


