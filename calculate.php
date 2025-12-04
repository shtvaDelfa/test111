<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operation = $_POST['operation'] ?? 'add';

    $result = '';

    // Проверяем, что введены числа
    if (is_numeric($num1) && is_numeric($num2)) {
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        // Выполняем операцию
        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = 'Ошибка: деление на ноль!';
                }
                break;
        }
    } else {
        $result = 'Пожалуйста, введите числа!';
    }

    // Перенаправляем обратно на калькулятор только с результатом
    header('Location: calc.php?result=' . urlencode($result));
    //header() - функция PHP для отправки HTTP-заголовков

    // Location: - специальный заголовок для перенаправления

    // calc.php?result=... - куда перенаправляем пользователя

    // urlencode($result) - безопасно кодирует результат для URL
    exit; // останавливает код 
} else {
    // Если кто-то попытался зайти напрямую
    header('Location: calc.php');
    exit;
}
