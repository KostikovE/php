<?php
namespace MyProject\Classes;

class User
{
  
    public $name;
    public $login;
    
  
    private $password;
    
   
    public function __construct($name, $login, $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }
    
 
    public function __destruct()
    {
        echo "Пользователь {$this->login} удален.<br>";
    }
    
 
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