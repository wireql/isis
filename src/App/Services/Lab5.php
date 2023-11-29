<?php

abstract class AUser {
    abstract function showInfo();
}

class User extends AUser {
    private $login;
    private $password;
    private $email;
    
    public function __construct($login = "guest", $password = "qwerty", $email = "") {
        if (empty($login) || empty($password) || empty($email)) {
            throw new Exception("Не все данные введены");
        }
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    public function showInfo() {
        echo "Логин: " . $this->login . "<br>";
        echo "Пароль: " . $this->password . "<br>";
        echo "Email: " . $this->email . "<br>";
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getLogin() {
        return $this->login;
    }
    
    public function __clone() {
        $this->login = "Guest";
        $this->password = "qwerty";
        $this->email = "";
    }
}

class SuperUser extends User {
    private $role;
    
    public function __construct($login = "admin", $password = "admin_password", $email = "", $role = "admin") {
        parent::__construct($login, $password, $email);
        $this->role = $role;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function showInfo() {
        parent::showInfo();
        echo "Роль: " . $this->role . "<br>";
    }
}

try {
    $user = new User("john", "secret", "john@example.com");
    $user->showInfo();
    echo "<hr>";

    $clonedUser = clone $user;
    $clonedUser->showInfo();
    echo "<hr>";

    $superUser = new SuperUser();
    $superUser->showInfo();
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
