<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📸 Моя фото-галерея</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .upload-form {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px dashed #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="file"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
            font-size: 16px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 30px;
        }

        .photo {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .photo:hover {
            transform: scale(1.05);
        }

        .photo img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            font-size: 12px;
            text-align: center;
        }

        .empty-gallery {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .file-info {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📸 Моя фото-галерея</h1>

        <!-- Форма загрузки -->
        <form class="upload-form" action="uploadPhoto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Выберите фотографии:</label>
                <input type="file" name="photos[]" multiple
                    accept=".jpg,.jpeg,.png,.gif" required>
                <div class="file-info">Можно выбрать несколько файлов (только JPG, PNG, GIF, макс. 2MB каждый)</div>
            </div>

            <button type="submit">📤 Загрузить фотографии</button>
        </form>

        <?php
        // Простая проверка и вывод результатов
        if (!empty($_GET['results'])) {
            // Декодируем результаты
            $results = json_decode(urldecode($_GET['results']), true);

            if (!empty($results)) {
                echo '<div class="results">';
                echo '<h3>Результаты загрузки:</h3>';
                foreach ($results as $result) {
                    echo '<p>' . htmlspecialchars($result) . '</p>';
                }
                echo '</div>';
            }
        }
        ?>
        <!-- Галерея -->
        <h2>🖼️ Загруженные фотографии</h2>
        <div class="gallery">
            <?php
            // Показываем загруженные фото
            $uploadDir = 'uploads/';
            if (file_exists($uploadDir)) {
                // Ищем все изображения в папке uploads
                $photos = glob($uploadDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                if (empty($photos)) {
                    echo '<div class="empty-gallery">Пока нет загруженных фотографий</div>';
                } else {
                    foreach ($photos as $photo) {
                        $fileName = basename($photo); // Получаем только имя файла без пути
                        echo '
                        <div class="photo">
                            <img src="' . $uploadDir . $fileName . '" alt="' . $fileName . '">
                            <div class="photo-name">' . $fileName . '</div>
                        </div>';
                    }
                }
            } else {
                echo '<div class="empty-gallery">Папка для загрузок не найдена</div>';
            }
            ?>
        </div>
    </div>

    </div>
    </div>
</body>

</html>