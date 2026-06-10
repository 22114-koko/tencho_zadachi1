<?php require 'db.php'; ?>
<h2>Регистрация</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Хеширане на паролата
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Обработка на снимката
    $target_dir = "uploads/";
    $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        // Запис в базата
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, profile_image) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $password_hash, $target_file]);
            echo "<p style='color:green;'>Успешна регистрация! <a href='login.php'>Влезте тук</a>.</p>";
        } catch(PDOException $e) {
            echo "<p style='color:red;'>Това потребителско име вече съществува!</p>";
        }
    } else {
        echo "<p style='color:red;'>Грешка при качване на снимката. Уверихте ли се, че имате папка 'uploads'?</p>";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    Потребител: <input type="text" name="username" required><br><br>
    Парола: <input type="password" name="password" required><br><br>
    Снимка: <input type="file" name="profile_pic" accept="image/*" required><br><br>
    <button type="submit">Регистрирай ме</button>
</form>