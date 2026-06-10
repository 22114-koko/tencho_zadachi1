<?php
session_start();

// Продуктите са променени на тема Гейминг (съвпадат с тези в cart.php)
$products = [
    1 => ['name' => 'RGB Gaming Mouse', 'price' => 59.99, 'img' => 'images/mouse.png'],
    2 => ['name' => 'Mechanical Keyboard', 'price' => 129.50, 'img' => 'images/keyboard.png'],
    3 => ['name' => '27" 4K Gaming Monitor', 'price' => 349.00, 'img' => 'images/monitor.png'],
];

if (isset($_POST['add_to_cart'])) {
    $product_id = (int)$_POST['product_id'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    header("Location: products.php");
    exit();
}

$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadacha 4 - Gaming Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo-area">
            <h1>GamerVault.com</h1>
        </div>
        <nav>
            <a href="cart.php">Shopping Cart (<?php echo $cart_count; ?>)</a>
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="products-grid">
        <?php foreach ($products as $id => $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" class="product-img">
                <h3><?php echo $product['name']; ?></h3>
                <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <button type="submit" name="add_to_cart" class="btn-add">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer>
    <p>&copy; 2026 Gamer Vault. All rights reserved.</p>
</footer>

</body>
</html>