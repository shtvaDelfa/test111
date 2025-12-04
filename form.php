<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация - GET vs POST</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        form {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            margin-bottom: 15px;
            padding: 5px;
        }

        .get-form {
            background-color: #d4edda;
        }

        /* Светло-зеленый для GET */
        .post-form {
            background-color: #f8d7da;
        }

        /* Светло-красный для POST */
    </style>
</head>

<body>

    <h1>Форма регистрации пользователя</h1>
    <p>Попробуйте отправить данные разными методами и посмотрите на разницу.</p>

    <!-- Форма с методом GET -->
    <form class="get-form" action="process.php" method="GET">
        <h2>Метод GET</h2>
        <label>Логин:
            <input type="text" name="username">
        </label>
        <label>Пароль:
            <input type="password" name="password">
        </label>
        <label>Email:
            <input type="email" name="email">
        </label>
        <br>
        <button type="submit">Зарегистрироваться (GET)</button>
    </form>

    <!-- Форма с методом POST -->
    <form class="post-form" action="process.php" method="POST">
        <h2>Метод POST</h2>
        <label>Логин:
            <input type="text" name="username">
        </label>
        <label>Пароль:
            <input type="password" name="password">
        </label>
        <label>Email:
            <input type="email" name="email">
        </label>
        <br>
        <button type="submit">Зарегистрироваться (POST)</button>
    </form>

</body>

</html>