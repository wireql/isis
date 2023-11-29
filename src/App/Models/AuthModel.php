<?php
require_once __DIR__ . '/../../Core/Model.php';
require_once __DIR__ . '/../Services/UserSessions.php';
require_once __DIR__ . '/../Services/Flash.php';

class AuthModel extends Model {
    
    public function login($email = null, $password = null) {
        try {
    
            $stmt = $this->db->db->prepare("SELECT * FROM users WHERE email = :value1;");
            $stmt->bindParam(':value1', $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(isset($result[0])) {
                
                if (password_verify($password, $result[0]['password'])) {

                    $stmt = $this->db->db->prepare("UPDATE users SET in_count = ? WHERE id = ?");   
                    $inValue = $result[0]['in_count'] + 1;                 
                    $stmt->execute([$inValue, $result[0]['id']]);

                    UserSessions::setSessionVar('username', $result[0]['username']);
                    UserSessions::setSessionVar('email', $result[0]['email']);
                    UserSessions::setSessionVar('role', $result[0]['role']);

                    if($_POST['data']['save'] == 1) {
                        //
                    }

                    Flash::setMessage("authMessage", "Вы успешно авторизовались!");

                    header("Location: /");
                    exit();
                } else {
                    Flash::setMessage("authMessage", "Неверный пароль!");
                }

            }else {
                Flash::setMessage("authMessage", "Пользователь с таким email не зарегистрирован.");
            }
        } catch (\Throwable $th) {
            echo $th;
        }

    }

    public function registration($email = null, $password = null, $username = null) {
        try {
    
            $stmt = $this->db->db->prepare("SELECT * FROM users WHERE email = :value1;");
            $stmt->bindParam(':value1', $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!isset($result[0])) {
                $password_encoded = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $this->db->db->prepare("INSERT INTO users (username, email, password) VALUES (:value1, :value2, :value3)");
                $stmt->bindParam(':value1', $username);
                $stmt->bindParam(':value2', $email);
                $stmt->bindParam(':value3', $password_encoded);
                $stmt->execute();

                Flash::setMessage("authMessage", "Вы успешно зарегистрировались!");
            }else {
                Flash::setMessage("authMessage", "Пользователь с таким email уже зарегистрирован!");
            }
        } catch (\Throwable $th) {
            echo $th;
        }        
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

}