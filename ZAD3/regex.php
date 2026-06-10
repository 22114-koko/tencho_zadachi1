<?php
$username = "";
$email = "";
$user_error = "";
$email_error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";

    // 1. Валидация на Потребителско име (Букви, цифри, долна черта | 3-16 символа)
    $username_regex = "/^[a-zA-Z0-9_]{3,16}$/";

    if (empty($username)) {
        $user_error = "Потребителското име е задължително.";
    } elseif (!preg_match($username_regex, $username)) {
        $user_error = "Потребителското име трябва да е между 3 и 16 символа и да съдържа само букви, цифри или '_'.";
    }

    // 2. Валидация на Имейл чрез прецизен Regex
    $email_regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (empty($email)) {
        $email_error = "Имейл адресът е задължителен.";
    } elseif (!preg_match($email_regex, $email)) {
        $email_error = "Моля, въведете валиден имейл адрес (напр. name@domain.com).";
    }

    // Проверка за успешен запис
    if (empty($user_error) && empty($email_error)) {
        $success = "Регистрацията е успешна! Добре дошли, " . htmlspecialchars($username) . ".";
        // Изчистваме полетата при успех
        $username = "";
        $email = "";
    }
}
?>