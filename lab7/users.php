<?php

/**
 * Автозагрузчик классов
 * Преобразует пространства имен в путь к файлу.
 * @param string $className Полное имя класса 
 * @return void
 */
spl_autoload_register(function ($className) {
    
    $filePath = str_replace('\\', '/', $className) . '.php';
    
  
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});


use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

/**
 * Создание объектов пользователей
 * @var User $user1 Первый пользователь
 * @var User $user2 Второй пользователь
 * @var User $user3 Третий пользователь
 */
$user1 = new User("Sova Morskaya", "sova111", "qwerty123");
$user2 = new User("Дональд Трампов", "usa_president", "password456");
$user3 = new User("Егор Костиков", "kostikov_e", "securepasswd789");

/**
 * Вывод информации о пользователях
 * 
 * Отображает заголовок и вызывает метод showInfo() для каждого пользователя.
 * Метод showInfo() выводит информацию в отформатированном виде.
 */
echo "<h2>2. Вывод информации о пользователях</h2>";
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

/**
 * Создание суперпользователя
 * 
 * Создает экземпляр класса SuperUser, который наследует от User
 * и добавляет дополнительное свойство - роль.
 * 
 * @var SuperUser $superUser Суперпользователь с правами администратора
 */
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
