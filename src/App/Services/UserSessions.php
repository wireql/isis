<?php

class UserSessions {
    
    static public function setSessionVar($name, $arg) {
        $_SESSION[$name] = $arg;
    }

    static public function getSessionVar($name) {
        return $_SESSION[$name];
    }
    
    static public function deleteSessionVar($name) {
        unset($_SESSION[$name]);
    }

    static public function checkSessionVar($name) {
        return isset($_SESSION[$name]) ? true : false;
    }

    static public function check_auth(){
        return isset($_SESSION['username']) ? true : false;
    }

}