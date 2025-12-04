<?php
// Обработка GET параметров
$course = $_GET['course'] ?? '';

$courses = [
    'web' => [
        'name' => 'Веб-разработка',
        'description' => 'Изучите HTML, CSS, JavaScript и PHP. Создавайте современные веб-приложения.',
        'duration' => '6 месяцев',
        'price' => '25 000 руб.'
    ],
    'data' => [
        'name' => 'Data Science',
        'description' => 'Анализ данных, машинное обучение и визуализация результатов.',
        'duration' => '8 месяцев',
        'price' => '35 000 руб.'
    ],
    'mobile' => [
        'name' => 'Мобильная разработка',
        'description' => 'Создание приложений для iOS и Android на React Native.',
        'duration' => '7 месяцев',
        'price' => '30 000 руб.'
    ],
    'design' => [
        'name' => 'Дизайн',
        'description' => 'UI/UX дизайн, Figma, Adobe Photoshop и Illustrator.',
        'duration' => '5 месяцев',
        'price' => '20 000 руб.'
    ]
];

// Если курс не найден
if (!array_key_exists($course, $courses)) {
    header('Location: index.php');
    exit;
}

$courseData = $courses[$course];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($courseData['name']) ?></title>
</head>

<body>
    <h1><?= htmlspecialchars($courseData['name']) ?></h1>

    <p><strong>Описание:</strong> <?= htmlspecialchars($courseData['description']) ?></p>
    <p><strong>Длительность:</strong> <?= htmlspecialchars($courseData['duration']) ?></p>
    <p><strong>Стоимость:</strong> <?= htmlspecialchars($courseData['price']) ?></p>

    <a href="index.php">← Вернуться к регистрации</a>

    <hr>
</body>

</html>