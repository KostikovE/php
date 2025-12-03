<?php
namespace MyProject\Classes;


class SuperUser extends User
{

    public $role;
    
   
    public function __construct($name, $login, $password, $role)
    {
        
        parent::__construct($name, $login, $password);
        
   
        $this->role = $role;
    }
    

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