<?php
$host = 'localhost'; // Адрес сервера БД
$dbname = 'my_database'; // Имя вашей базы данных
$user = 'root'; // Имя пользователя БД
$pass = ''; // Пароль пользователя БД

try {
    // Создаем новый объект PDO (подключение к БД)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Устанавливаем режим ошибок: PDO будет генерировать исключения при ошибках
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Подключение к БД успешно!"; // Раскомментируйте для проверки
} catch (PDOException $e) {
    // Если подключение не удалось, выводим ошибку (в реальном проекте лучше логировать)
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

