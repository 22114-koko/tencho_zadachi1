<?php
session_start();

// Продуктите са променени на тема Гейминг
$products = [
    1 => ['name' => 'RGB Gaming Mouse', 'price' => 59.99, 'img' => 'images/mouse.png'],
    2 => ['name' => 'Mechanical Keyboard', 'price' => 129.50, 'img' => 'images/keyboard.png'],
    3 => ['name' => '27" 4K Gaming Monitor', 'price' => 349.00, 'img' => 'images/monitor.png'],
];

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadacha 4 - Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo-area">
            <h1>GamerVault.com</h1>
        </div>
        <nav>
            <a href="products.php">Back to Shop</a>
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="cart-wrapper">
        <h2>Your Selected Gear & Upgrades</h2>

        <?php if (!empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($_SESSION['cart'] as $id => $quantity): 
                        // Защита: пропускаме продукта, ако ID-то не съществува в масива с продукти
                        if (!isset($products[$id])) continue;
                        
                        $item_total = $products[$id]['price'] * $quantity;
                        $total_price += $item_total;
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo $products[$id]['img']; ?>" alt="<?php echo $products[$id]['name']; ?>" class="cart-item-img">
                            <?php echo $products[$id]['name']; ?>
                        </td>
                        <td><?php echo $quantity; ?> pcs</td>
                        <td>$<?php echo number_format($products[$id]['price'], 2); ?></td>
                        <td>$<?php echo number_format($item_total, 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">Grand Total: $<?php echo number_format($total_price, 2); ?></div>

            <form method="POST">
                <button type="submit" name="clear_cart" class="btn-clear">Empty Cart</button>
            </form>
        <?php else: ?>
            <div class="empty-msg">Your inventory is empty. Ready to load some epic gear?</div>
        <?php endif; ?>
    </div>
</main>

<footer>
    <p>&copy; 2026 Gamer Vault. All rights reserved.</p>
</footer>

</body>
</html>