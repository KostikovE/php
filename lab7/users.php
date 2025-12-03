<?php
/**
 * users.php - решение всех пунктов задания
 */

// ================================================
// ЗАДАНИЕ: Добавление автозагрузки классов
// ================================================
spl_autoload_register(function ($className) {
    // Преобразуем namespace в путь к файлу
    // MyProject\Classes\User -> MyProject/Classes/User.php
    $filePath = str_replace('\\', '/', $className) . '.php';
    
    // Если файл существует - подключаем
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});


use MyProject\Classes\User;
use MyProject\Classes\SuperUser;





$user1 = new User("Sova Morskaya", "sova111", "qwerty123");
$user2 = new User("Дональд Трампов", "usa_president", "password456");
$user3 = new User("Егор Костиков", "kostikov_e", "securepasswd789");




echo "<h2>2. Вывод информации о пользователях</h2>";

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();


echo "<h2>3. Создание суперпользователя</h2>";

$superUser = new SuperUser("Администратор", "admin", "admin123", "Главный администратор");


echo "<h2>4. Информация о суперпользователе</h2>";

$superUser->showInfo();
echo "<h3>Удаление объектов:</h3>";

unset($user1);
unset($user2);
unset($user3);
unset($superUser);

?>