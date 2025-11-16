<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Загрузка файла на сервер</title>
</head>
<body>
  <div>
   <?php
/*
ЗАДАНИЕ
- Проверьте, отправлялся ли файл на сервер
- В случае, если файл был отправлен, выведите: имя файла, размер, имя временного файла, тип, код ошибки
- Для проверки типа файла используйте функцию mime_content_type() из модуля Fileinfo
- Если загружен файл типа "image/jpeg", то с помощью функции move_uploaded_file() переместите его в каталог upload. В качестве имени файла используйте его MD5-хеш.
*/


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fupload'])) {
    
    $file = $_FILES['fupload'];
    
    
    if ($file['error'] !== UPLOAD_ERR_NO_FILE) {
        
        echo '<h2>Информация о загруженном файле:</h2>';
        echo '<ul>';
        echo '<li><strong>Имя файла:</strong> ' . htmlspecialchars($file['name']) . '</li>';
        echo '<li><strong>Размер:</strong> ' . $file['size'] . ' байт</li>';
        echo '<li><strong>Временный файл:</strong> ' . htmlspecialchars($file['tmp_name']) . '</li>';
        echo '<li><strong>Тип:</strong> ' . htmlspecialchars($file['type']) . '</li>';
        echo '<li><strong>Код ошибки:</strong> ' . $file['error'] . '</li>';
        
       
        if ($file['tmp_name'] && file_exists($file['tmp_name'])) {
            $mimeType = mime_content_type($file['tmp_name']);
            echo '<li><strong>MIME-тип:</strong> ' . htmlspecialchars($mimeType) . '</li>';
            
            
            if ($mimeType === 'image/jpeg') {
                echo '<li> Файл является изображением JPEG</li>';
                
               
                
                
                // Генерируем MD5-хеш для имени файла
                $fileHash = md5_file($file['tmp_name']);
                $newFileName = $fileHash . '.jpg';
                $destination = 'upload/' . $newFileName;
                
                // Перемещаем файл в каталог upload
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    echo '<li>Файл успешно загружен как ' . htmlspecialchars($newFileName) . '</li>';
                    
                    
                    // Показываем превью изображения
                   
                    echo '<img src="' . htmlspecialchars($destination) . '" alt="Загруженное изображение" style="max-width: 300px; max-height: 300px;"></li>';
                } else {
                    echo '<li><strong>Результат:</strong> Ошибка при перемещении файла</li>';
                }
            } else {
                echo '<li><strong>Статус:</strong> Файл не является изображением JPEG</li>';
            }
        } else {
            echo '<li><strong>MIME-тип:</strong> Не удалось определить</li>';
        }
        
        echo '</ul>';
    }
}
   ?>
  </div>
  <form enctype="multipart/form-data"
        action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <p>
      <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
      <input type="file"   name="fupload"><br>
      <button type="submit">Загрузить</button>
    </p>
   </form>
 </body>
</html>