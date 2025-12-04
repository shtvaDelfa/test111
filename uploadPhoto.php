<?php
// Обработка загрузки файлов
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photos'])) {
    $uploadDir = 'uploads/';

    // Создаем папку если нет (с правами 0755)
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true); // true создает все вложенные папки
    }

    // Разрешенные форматы изображений
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxSize = 2 * 1024 * 1024; // 2MB в байтах

    $results = []; // Массив для хранения результатов загрузки

    // Обрабатываем каждый загруженный файл
    foreach ($_FILES['photos']['name'] as $key => $name) {
        $error = $_FILES['photos']['error'][$key];
        $tmpName = $_FILES['photos']['tmp_name'][$key];
        $size = $_FILES['photos']['size'][$key];
        $type = $_FILES['photos']['type'][$key];

        // Пропускаем пустые файлы (когда не выбрали файл)
        if ($error === UPLOAD_ERR_NO_FILE) continue;

        // Проверяем ошибки загрузки
        if ($error !== UPLOAD_ERR_OK) {
            $results[] = "❌ Ошибка загрузки: $name";
            continue;
        }

        // Проверяем тип файла (только изображения)
        if (!in_array($type, $allowedTypes)) {
            $results[] = "❌ $name - недопустимый формат (только JPG, PNG, GIF)";
            continue;
        }

        // Проверяем размер файла (не более 2MB)
        if ($size > $maxSize) {
            $results[] = "❌ $name - слишком большой (макс. 2MB)";
            continue;
        }

        // Создаем безопасное имя файла для предотвращения перезаписи
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION)); // в нижний регистр
        // pathinfo($name, PATHINFO_EXTENSION) - Извлекает расширение файла из оригинального имени
        // Например "photo.JPG" → "JPG"
        // strtolower - переводит в нижний регистр "jpg"

        // Зачем разные системы, могут быть чувствительны к регистру
        $newName = uniqid() . '.' . $extension; // Уникальное имя + расширение
        //Генерирует уникальный ID на основе текущего времени в микросекундах
        // Пример: "658f7a9c8a12c"
        // Зачем: Чтобы избежать конфликтов имен если два пользователя загрузят файлы с одинаковыми именами
        $targetPath = $uploadDir . $newName;



        // Сохраняем файл на сервер
        if (move_uploaded_file($tmpName, $targetPath)) {
            $results[] = "✅ $name - успешно загружен";
        } else {
            $results[] = "❌ $name - ошибка сохранения на сервер";
        }
    }

    // Перенаправляем обратно с результатами в безопасном JSON формате
    if (!empty($results)) {
        header('Location: photo.php?results=' . urlencode(json_encode($results)));
        // urlencode(...) - Кодирует специальные символы для безопасной передачи в URL
        //"["✅ file1.jpg"]" → "%5B%22%E2%9C%85+file1.jpg%22%5D"
        // Преобразует PHP-массив в JSON-строку
    } else {
        header('Location: photo.php');
    }
    exit;
} else {
    // Если кто-то попытался напрямую зайти на uploadPhoto.php без отправки формы
    header('Location: photo.php');
    exit;
}
