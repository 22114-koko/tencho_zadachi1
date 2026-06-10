<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Модерен Формуляр с Валидация</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }

        /* Стилизиране при фокус */
        .form-group input:focus {
            border-color: #667eea;
        }

        /* Стилове за грешка и успех */
        .form-group.error input {
            border-color: #e53e3e;
            background-color: #fff5f5;
        }

        .form-group.success input {
            border-color: #38a169;
            background-color: #f0fff4;
        }

        .form-group .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .form-group.error .error-message {
            display: block;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #5a67d8;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Регистрация</h2>
    <form id="registrationForm" novalidate>
        
        <div class="form-group" id="usernameGroup">
            <label for="username">Потребителско име</label>
            <input type="text" id="username" placeholder="Позволени: букви, цифри и _">
            <div class="error-message">Потребителското име трябва да е между 3 и 16 символа и да не съдържа специални знаци.</div>
        </div>

        <div class="form-group" id="emailGroup">
            <label for="email">Имейл адрес</label>
            <input type="email" id="email" placeholder="primer@mail.com">
            <div class="error-message">Моля, въведете валиден имейл адрес.</div>
        </div>

        <button type="submit" class="submit-btn">Изпрати</button>
    </form>
</div>

<script>
    const form = document.getElementById('registrationForm');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');

    // REGEX дефиниции
    // ^[a-zA-Z0-9_]{3,16}$ - Букви (латиница), цифри и долна черта, дължина 3-16 символа
    const usernameRegex = /^[a-zA-Z0-9_]{3,16}$/;
    
    // Стандартен Regex за валидация на имейл структура
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Функция за визуализиране на състоянието (успех/грешка)
    function validateField(input, regex, groupElement) {
        if (regex.test(input.value.trim())) {
            groupElement.classList.remove('error');
            groupElement.classList.add('success');
            return true;
        } else {
            groupElement.classList.remove('success');
            groupElement.classList.add('error');
            return false;
        }
    }

    // Валидация в реално време при писане (input)
    usernameInput.addEventListener('input', () => {
        validateField(usernameInput, usernameRegex, document.getElementById('usernameGroup'));
    });

    emailInput.addEventListener('input', () => {
        validateField(emailInput, emailRegex, document.getElementById('emailGroup'));
    });

    // Валидация при изпращане на формата
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Спира презареждането на страницата

        const isUsernameValid = validateField(usernameInput, usernameRegex, document.getElementById('usernameGroup'));
        const isEmailValid = validateField(emailInput, emailRegex, document.getElementById('emailGroup'));

        if (isUsernameValid && isEmailValid) {
            alert('Формулярът е изпратен успешно!');
            form.reset();
            // Премахва класовете за успех след ресет
            document.getElementById('usernameGroup').classList.remove('success');
            document.getElementById('emailGroup').classList.remove('success');
        }
    });
</script>

</body>
</html>