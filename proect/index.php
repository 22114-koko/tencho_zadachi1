<?php require 'db.php'; ?>
<h2>Списък с продукти / услуги</h2>

<?php
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();

if (count($products) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Име</th><th>Описание</th><th>Цена</th></tr>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>" . htmlspecialchars($product['description']) . "</td>";
        echo "<td>" . htmlspecialchars($product['price']) . " лв.</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Все още няма добавени продукти.</p>";
}
?>