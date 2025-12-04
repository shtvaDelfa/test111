<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <h3>Форма ввода данных</h3>
    <form method="GET">
        <p>User 1: <input type="text" name="users[]" require /></p>
        <p>User 2: <input type="text" name="users[]" require /></p>
        <p>User 3: <input type="text" name="users[]" require /></p>
        <input type="submit" value="Отправить">
    </form> -->
    <?php
    // if (isset($_GET["users"])) {

    //     $users = $_GET["users"];
    //     echo "В массиве " . count($users) . " элементa/ов<br>";
    //     foreach ($users as $user) echo "$user<br>";
    // }
    ?>

    <?php
    // if (isset($_POST["course"])) {
    //     $course = $_POST["course"];
    //     echo "Текущий курс: " . $course;
    // }
    ?>
    <!-- <h3>Форма ввода данных</h3>
    <form method="POST">
        <label><input type="radio" name="course" value="HTML И CSS" /><span>HTML И CSS</span></label> <br>
        <label><input type="radio" name="course" value="PHP" /><span>PHP</span> <br></label>
        <label><input type="radio" name="course" value="JS" /><span>JS</span> <br></label>
        <input type="submit" value="Отправить">
    </form> -->

    <!-- <?php
            if (isset($_POST["courses"])) {
                $courses = $_POST["courses"];
                foreach ($courses as $item) echo "$item<br>";
            }
            ?>
    <h3>Форма ввода данных</h3>
    <form method="POST">
        <select name="courses[]" multiple="multiple">
            <option value="ASP.NET">ASP.NET</option>
            <option value="PHP">PHP</option>
            <option value="Ruby">RUBY</option>
            <option value="Python">Python</option>
        </select>
        <input type="submit" value="Отправить">
    </form> -->


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        // Проверяем, был ли загружен файл
        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] === UPLOAD_ERR_OK) {

            $file = $_FILES['userfile'];
            $uploadDir = 'uploads/';

            // Создаем директорию, если ее нет
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir);
            }

            // Безопасное имя файла
            $fileName = basename($file['name']);
            $targetPath = $uploadDir . $fileName;

            // Перемещаем файл
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                echo "<div style='color: green; text-align: center;'>
                    ✅ Файл успешно загружен!
                  </div>";
            } else {
                echo "<div style='color: red; text-align: center;'>
                    ❌ Ошибка при загрузке файла
                  </div>";
            }
        }
    }
    ?>
    <form class="upload-form" method="post" enctype="multipart/form-data">
        <h2>📁 Загрузка файла</h2>
        <input type="file" name="userfile" required>
        <br>
        <input type="submit" value="📤 Загрузить файл">
    </form>

    <!-- <a href="./uploads/1756020547_users (2).csv" download>Скачать   </a> -->

    <a href="./photo.php">Фото</a>
    <a href="./calc.php">Калькулятор</a>
</body>

</html>