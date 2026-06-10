<?php require 'db.php'; ?>
<h2>Вход</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Проверка на хешираната парола
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: profile.php");
        exit;
    } else {
        echo "<p style='color:red;'>Грешно име или парола!</p>";
    }
}
?>

<form method="POST">
    Потребител: <input type="text" name="username" required><br><br>
    Парола: <input type="password" name="password" required><br><br>
    <button type="submit">Вход</button>
</form>