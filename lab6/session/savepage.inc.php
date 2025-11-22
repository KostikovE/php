<?php
// savepage.inc.php - Сохранение страниц

// Включаем сессию ПЕРВЫМ делом
session_start();

// Настройки для передачи ID сессии через URL
ini_set("session.use_only_cookies", "0");
ini_set("session.use_trans_sid", "1");

// Создаем массив если его нет
if (empty($_SESSION['visited_pages'])) {
    $_SESSION['visited_pages'] = array();
}

// Добавляем текущую страницу
$current_page = basename($_SERVER['PHP_SELF']);
$_SESSION['visited_pages'][] = $current_page;

// Отладочная информация
echo "<!-- Текущая страница: $current_page -->";
echo "<!-- Всего в списке: " . count($_SESSION['visited_pages']) . " -->";
?>