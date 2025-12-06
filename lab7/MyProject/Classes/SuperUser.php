<?php
namespace MyProject\Classes;


class SuperUser extends User
{
    /**
     * Роль суперпользователя в системе
     * @var string $role Роль пользователя в системе
     * @access public
     */
    public $role;
    
    /**
     * Конструктор SuperUser
     * @param string $name Полное имя суперпользователя
     * @param string $login Логин суперпользователя
     * @param string $password Пароль суперпользователя
     * @param string $role Роль суперпользователя в системе
     * 
     * @return void
     * @access public
     * 
     * @uses User::__construct() Для инициализации базовых свойств
     */
    public function __construct($name, $login, $password, $role)
    {
        // Вызов конструктора родительского класса
        parent::__construct($name, $login, $password);
        
        // Установка дополнительного свойства
        $this->role = $role;
    }
    
    /**
     * Переопределенный метод для отображения информации о суперпользователе
     * 
     * Выводит расширенную информацию о суперпользователе,
     * включая его роль. 
     * @return void
     * @access public
     * @override
     * 
     * @see User::showInfo() 
     * 
     * @example
     * $admin = new SuperUser("Админ", "admin", "pass123", "Главный администратор");
     * $admin->showInfo();
     * // Выведет информацию с указанием роли пользователя
     */
    public function showInfo()
    {
        echo "=== Информация о суперпользователе ===<br>";
        echo "Имя: {$this->name}<br>";
        echo "Логин: {$this->login}<br>";
        echo "Роль: {$this->role}<br>";
        echo "Пароль: [скрыто]<br>";
        echo "====================================<br><br>";
    }
}
?>
