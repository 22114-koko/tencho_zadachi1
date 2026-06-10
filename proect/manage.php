<?php require 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    die("Достъпът е отказан! Моля, <a href='login.php'>влезте в профила си</a>.");
}

// Изтриване на продукт
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: manage.php");
    exit;
}

// Добавяне на продукт
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $desc, $price]);
    header("Location: manage.php");
    exit;
}
?>

<h2>Управление на продукти</h2>

<h3>Добави нов:</h3>
<form method="POST">
    Име: <input type="text" name="name" required><br><br>
    Описание: <textarea name="description" required></textarea><br><br>
    Цена: <input type="number" step="0.01" name="price" required><br><br>
    <button type="submit" name="add_product">Добави продукт</button>
</form>

<h3>Текущи продукти:</h3>
<?php
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
while ($row = $stmt->fetch()) {
    echo "<p>";
    echo "<b>" . htmlspecialchars($row['name']) . "</b> - " . $row['price'] . " лв. ";
    // Бутон за изтриване с потвърждение
    echo "<a href='manage.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Сигурни ли сте?\")' style='color:red;'>[Изтрий]</a>";
    echo "</p>";
}
?>