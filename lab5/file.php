<?php
/*
ЗАДАНИЕ 1
- Установите константу для хранения имени файла
- Проверьте, отправлялась ли форма и корректно ли отправлены данные из формы
- В случае, если форма была отправлена, отфильтруйте полученные значения 
  с помощью функций trim(), strip_tags(), htmlspecialchars()
- Сформируйте строку для записи с файл
- Откройте соединение с файлом и запишите в него сформированную строку
- Используя функцию header() выполните перезапрос текущей страницы 
  (чтобы избавиться от данных, отправленных методом POST)
*/


define('DATA_FILE', 'db/users.txt');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    if (!empty($_POST['fname']) && !empty($_POST['lname'])) {
        
       
        $fname = trim($_POST['fname']);
        $fname = strip_tags($fname);
        $fname = htmlspecialchars($fname);
        
        $lname = trim($_POST['lname']);
        $lname = strip_tags($lname);
        $lname = htmlspecialchars($lname);
        
       
        $data = "$fname  $lname ". PHP_EOL;
        
    
        $file = fopen(DATA_FILE, 'a');
        if ($file) {
            fwrite($file, $data);
            fclose($file);
        }
        
       
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Работа с файлами</title>
</head>
<body>

<h1>Заполните форму</h1>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>">

Имя: <input type="text" name="fname"><br>
Фамилия: <input type="text" name="lname"><br>

<br>

<input type="submit" value="Отправить!">

</form>

<?php
/*
ЗАДАНИЕ 2
- Проверьте, существует ли файл с информацией о пользователях
- Если файл существует, получите все содержимое файла в виде массива строк 
  с помощью функции file()
- В цикле выведите все строки данного файла с порядковым номером строки
- После этого выведите размер файла в байтах.
*/

// Проверяем существование файла
if (file_exists(DATA_FILE)) {
    echo '<h2>Список пользователей:</h2>';
    
   
    $lines = file(DATA_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    if ($lines) {
        echo '<ol>';
        
        foreach ($lines as $index => $line) {
            $lineNumber = $index + 1;
            echo "<li>$line</li>";
        }
        echo '</ol>';
        
       
        $fileSize = filesize(DATA_FILE);
        echo "<p><strong>Размер файла:</strong> $fileSize байт</p>";
    } else {
        echo '<p>Файл пуст</p>';
    }
} else {
    echo '<p>Файл с данными пользователей еще не создан</p>';
}
?>

</body>
</html>