<?php

require_once __DIR__ . '/../../Core/Controller.php';
require_once __DIR__ . '/../Models/AuthModel.php';

class authController extends Controller {

    public function login() {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];

        if(isset($email) || isset($password)) {

            $user = new AuthModel();
            $user->login($email, $password);

        }elseif (isset($email) || isset($password) || isset($username)) {
            $user = new AuthModel();
            $user->login($email, $password, $username);
        }

        $this->view->render(__DIR__ . '/../Views/Auth/login.php');
    }

    public function registration() {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];

        if (isset($email) || isset($password) || isset($username)) {
            $user = new AuthModel();
            $user->registration($email, $password, $username);
        }

        $this->view->render(__DIR__ . '/../Views/Auth/registration.php');
    }

    public function logout() {

        if (isset($_SESSION['username'])) {
            $user = new AuthModel();
            $user->logout();
        }

        $this->view->render(__DIR__ . '/../Views/Auth/registration.php');
    }

}