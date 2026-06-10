<?php
// Променлива, в която ще пазим резултата
$result = '';

// Проверка дали формата е изпратена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Вземане и изчистване на въведените данни
    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    $ans = '';
    $op_symbol = '';

    // Извършване на калкулацията
    switch ($operation) {
        case 'add':
            $ans = $num1 + $num2;
            $op_symbol = '+';
            break;
        case 'subtract':
            $ans = $num1 - $num2;
            $op_symbol = '-';
            break;
        case 'multiply':
            $ans = $num1 * $num2;
            $op_symbol = '*';
            break;
        case 'divide':
            if ($num2 != 0) {
                $ans = $num1 / $num2;
                $op_symbol = '/';
            } else {
                $ans = "Грешка (деление на нула)";
                $op_symbol = '/';
            }
            break;
        default:
            $ans = "Невалидна операция";
            $op_symbol = '?';
    }

    $result = $ans;

    // ✅ ЗАПИСВАНЕ ВЪВ ФАЙЛ
    // Форматиране на реда, който ще се запише (напр: "2026-06-10 23:47:30 | 5 + 3 = 8")
    $log_entry = date('Y-m-d H:i:s') . " | $num1 $op_symbol $num2 = $ans" . PHP_EOL;
    
    // Записваме във файл history.txt (FILE_APPEND добавя на нов ред, без да трие старото)
    file_put_contents("history.txt", $log_entry, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Калкулатор</title>
    <style>
        /* === ТУК МОЖЕШ ДА ПРОМЕНЯШ ДИЗАЙНА === */
        :root {
            /* Промени тези цветове за уникален дизайн */
            --bg-color: #f4f7f6;
            --calc-bg: #ffffff;
            --primary-color: #4CAF50; /* Зелен бутон - смени го напр. с #ff5722 (оранжево) или #2196f3 (синьо) */
            --text-color: #333333;
            --border-radius: 12px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .calculator {
            background-color: var(--calc-bg);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }

        .calculator h2 {
            margin-top: 0;
            color: var(--text-color);
        }

        input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            filter: brightness(0.9);
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border-radius: 6px;
            font-size: 20px;
            font-weight: bold;
            color: #2e7d32;
        }
    </style>
</head>
<body>

    <div class="calculator">
        <h2>Калкулатор</h2>
        <form method="POST" action="">
            <input type="number" step="any" name="num1" placeholder="Въведи първо число" required value="<?php echo isset($_POST['num1']) ? $_POST['num1'] : ''; ?>">
            
            <select name="operation" required>
                <option value="add" <?php if(isset($_POST['operation']) && $_POST['operation']=='add') echo 'selected'; ?>>+ (Събиране)</option>
                <option value="subtract" <?php if(isset($_POST['operation']) && $_POST['operation']=='subtract') echo 'selected'; ?>>- (Изваждане)</option>
                <option value="multiply" <?php if(isset($_POST['operation']) && $_POST['operation']=='multiply') echo 'selected'; ?>>* (Умножение)</option>
                <option value="divide" <?php if(isset($_POST['operation']) && $_POST['operation']=='divide') echo 'selected'; ?>>/ (Деление)</option>
            </select>

            <input type="number" step="any" name="num2" placeholder="Въведи второ число" required value="<?php echo isset($_POST['num2']) ? $_POST['num2'] : ''; ?>">

            <button type="submit">Пресметни</button>
        </form>

        <?php if ($result !== ''): ?>
            <div class="result">
                Резултат: <?php echo htmlspecialchars($result); ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>