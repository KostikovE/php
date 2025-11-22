<?php
error_reporting(0);
ini_set('display_errors',0);
include('savepage.inc.php');
// Открываем сессию
ini_set("session.use_only_cookies","0");
ini_set("session.use_trans_sid","1");
session_start();


?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Страница 3</title>
</head>
<body>

<h1>Страница 3</h1>

<?php
// Подключаем меню
include('menu.inc.php');

// Подключаем код для вывода информации обо всех посещенных страницах
include('visited.inc.php');
?>

</body>
</html>
