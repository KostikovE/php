<?php
namespace MyProject\Classes;

class User
{
    /**
     * Имя пользователя
     * @var string $name Полное имя пользователя
     * @access public
     */
    public $name;
    
    /**
     * Логин пользователя
     * @var string $login Логин пользователя
     * @access public
     */
    public $login;
    
    /**
     * Пароль пользователя
     * @var string $password Пароль пользователя
     * @access private
     */
    private $password;
    
    /**
     * Конструктор класса User
     * @param string $name Полное имя пользователя
     * @param string $login Логин пользователя 
     * @param string $password Пароль пользователя
     * 
     * @return void
     * @access public
     */
    public function __construct($name, $login, $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }
    
    /**
     * Деструктор класса User
     * @return void
     * @access public
     */
    public function __destruct()
    {
        echo "Пользователь {$this->login} удален.<br>";
    }
    
    /**
     * Метод для отображения информации о пользователе
     * @return void
     * @access public
     * 
     * @example
     * $user = new User("Иван Иванов", "ivanov", "secret123");
     * $user->showInfo();
    
     */
    public function showInfo()
    {
        echo "--- Информация о пользователе ---<br>";
        echo "Имя: {$this->name}<br>";
        echo "Логин: {$this->login}<br>";
        echo "Пароль: [скрыто]<br>";
        echo "--------------------------------<br><br>";
    }
}
?>
