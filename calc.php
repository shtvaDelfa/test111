
<!DOCTYPE html>
<html>

<head>
    <title>Калькулятор</title>
</head>

<body>
    <h2>Калькулятор</h2>

    <!-- Форма отправляет данные в calculate.php -->
    <form method="POST" action="calculate.php">
        <input type="number" name="num1" step="any" required>

        <select name="operation">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">×</option>
            <option value="divide">÷</option>
        </select>

        <input type="number" name="num2"  required>

        <button type="submit">=</button>
    </form>

    <?php
    // Получаем результат из GET параметра
    $result = $_GET['result'] ?? '';
    if ($result !== '') {
        $getRes = htmlspecialchars($result);
        echo "<h3>Результат: $getRes</h3>";
    }

    ?>
</body>

</html>