<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Обработка данных</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .info-box {
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
        }

        .method-info {
            background-color: #e9ecef;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .data {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>

<body>

    <h1>Обработка данных формы</h1>

    <?php
    // Получаем метод запроса
    $method = $_SERVER['REQUEST_METHOD'];

    // //$_SERVER: 
    // echo $_SERVER['SERVER_NAME']; // НАЗВАНИЕ СЕРВЕРА 
    // echo $_SERVER['REQUEST_METHOD'];  // МЕТОД 
    // echo $_SERVER['REQUEST_URI'];      // /products/index.php?category=books&sort=price // URL 
    // echo $_SERVER['QUERY_STRING'];     // category=books&sort=price // Данные
    // echo $_SERVER['PHP_SELF'];         // /products/index.php // Путь до файла 
    // echo $_SERVER['REMOTE_ADDR'];      // 192.168.1.55 (IP пользователя)

    echo "<div class='info-box method-info'><b>Метод запроса:</b> $method</div>";

    // Получаем данные в зависимости от метода
    $data = $method == 'GET' ? $_GET : $_POST;
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    $email = $data['email'] ?? '';

    // Проверка данных
    $errors = [];
    if (empty($username)) $errors[] = "Логин не заполнен.";
    if (empty($password)) $errors[] = "Пароль не заполнен.";
    if (empty($email)) $errors[] = "Email не заполнен.";


    // Вывод ошибок
    if (!empty($errors)) {
        echo "<div class='info-box error'><h3>Ошибки:</h3>";
        foreach ($errors as $error) echo "<p>- $error</p>";
        echo "</div>";

        // Показываем введенные данные
        echo "<div class='info-box data'><h3>Введенные данные:</h3>";
        echo "<p><b>Логин:</b> " . htmlspecialchars($username) . "</p>";
        echo "<p><b>Email:</b> " . htmlspecialchars($email) . "</p></div>";
    } else {
        // Сохранение в CSV
        $filename = 'users.csv';
        $file = fopen($filename, 'a');

        // Добавляем заголовок если файл новый
        if (filesize($filename) == 0) {
            fwrite($file, "\xEF\xBB\xBF"); // BOM для UTF-8
            fputcsv($file, ["Username", "Password", "Email", "Method", "Registration Date"], ';');
        }

        // // Записываем данные
        fputcsv($file, [
            htmlspecialchars($username),
            htmlspecialchars($password),
            htmlspecialchars($email),
            $method,
            date('Y-m-d H:i:s')
        ], ';');

        fclose($file);

        // Сообщение об успехе
        echo "<div class='info-box success'>";
        echo "<h3>✅ Регистрация прошла успешно!</h3>";
        echo "<p>Данные сохранены в файл.</p></div>";

        echo "<div class='info-box data'><h3>Сохраненные данные:</h3>";
        echo "<p><b>Логин:</b> " . htmlspecialchars($username) . "</p>";
        echo "<p><b>Пароль:</b> " . htmlspecialchars($password) . "</p>";
        echo "<p><b>Email:</b> " . htmlspecialchars($email) . "</p>";
        echo "<p><b>Метод:</b> $method</p></div>";
    }
    ?>

    <br>
    <a href="./form.php">Вернуться к форме регистрации</a>
    <br><br>
    <a href="users.csv" download>Скачать файл с данными (CSV)</a>

</body>

</html>