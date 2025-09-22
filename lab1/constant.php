<?php

define('ZOMBIE', 'Зомби');
define('ZOMBIE_HEALTH', 100);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Константы</title>
</head>
<body>
	<h1>Константы</h1>
	<?php


	if (defined('ZOMBIE')) {
		echo "<p>Поприветствуйте: " . ZOMBIE . "</p>";
	}
	
	if (defined('MAX_USERS')) {
		echo "<p>Его здоровье: " . ZOMBIE_HEALTH . "</p>";
	}
	


	echo "<p>Текущая версия PHP: " . PHP_VERSION . "</p>";
	echo "<p>Директория скрипта: " . __DIR__ . "</p>";
	

	echo "<p>Полный путь к файлу: " . __FILE__ . "</p>";
	echo "<p>Текущая строка кода: " . __LINE__ . "</p>";
	?>
</body>
</html>
