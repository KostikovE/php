<?php
ini_set("session.use_only_cookies","0");
ini_set("session.use_trans_sid","1");
// Код для всех страниц - сохранение информации о посещенных страницах


/*
ЗАДАНИЕ 1
- Создайте в сессии либо 
	- массив для хранения всех посещенных страниц и сохраните в качестве его очередного элемента путь к текущей странице. 
	- строку с уникальным разделителем и последовательно её дополняйте*/

if (!isset($_SESSION['visited_pages'])) {
    $_SESSION['visited_pages'] = array();
}

// Сохраняем текущую страницу в массив
$current_page = $_SERVER['PHP_SELF'];
if (!in_array($current_page, $_SESSION['visited_pages'])) {
    $_SESSION['visited_pages'][] = $current_page;
}
?>

