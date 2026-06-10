<?php
session_start();

$host = 'localhost';
$db   = 'my_website';
$user = 'root'; // Стандартен потребител за XAMPP
$pass = 'kokopkl99';     // Стандартна парола за XAMPP (празна)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Грешка при връзка с базата: " . $e->getMessage());
}
?>

<nav style="background: #eee; padding: 10px; margin-bottom: 20px;">
    <a href="index.php">Начало / Продукти</a> |
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="manage.php">Управление на продукти</a> |
        <a href="profile.php">Моят Профил</a> |
        <a href="logout.php">Изход</a>
    <?php else: ?>
        <a href="login.php">Вход</a> |
        <a href="register.php">Регистрация</a>
    <?php endif; ?>
</nav>
<hr>