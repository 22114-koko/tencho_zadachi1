<?php require 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    die("Достъпът е отказан! Моля, <a href='login.php'>влезте в профила си</a>.");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<h2>Моят Профил</h2>
<p>Здравей, <b><?php echo htmlspecialchars($user['username']); ?></b>!</p>

<p>Твоята профилна снимка:</p>
<img src="<?php echo htmlspecialchars($user['profile_image']); ?>" width="200" alt="Снимка" style="border: 1px solid #ccc; padding: 5px;">