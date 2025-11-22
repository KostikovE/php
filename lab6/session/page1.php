<?php
error_reporting(0);
ini_set('display_errors',0);
include('savepage.inc.php');
session_start();

ini_set("session.use_only_cookies","0");
ini_set("session.use_trans_sid","1");

// Подключаем код для сохранения информации о странице в сессии

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Страница 1</title>
</head>
<body>

<h1>Страница 1</h1>

<?php
// Подключаем меню
include('menu.inc.php');

// Подключаем код для вывода информации обо всех посещенных страницах
include('visited.inc.php');
?>

</body>
</html>
