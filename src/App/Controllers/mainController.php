<?php

require_once __DIR__ . '/../../Core/Controller.php';
require_once __DIR__ . '/../Models/ReportModel.php';

require_once __DIR__ . '/../Models/Tables/Products.php';
require_once __DIR__ . '/../Models/Tables/Employees.php';
require_once __DIR__ . '/../Models/Tables/Orders.php';

class mainController extends Controller {

    public function index() {
        $this->view->render(__DIR__ . '/../Views/index.php');
    }

    public function report() {

        if(!isset($_SESSION['username']) || $_SESSION['role'] == 0) {
            header('Location: /');
            ob_end_flush();
            die;
        }

        $rmodel = new ReportModel();

        $data = [
            "settings" => [
                "month" => $_GET['month'] ?? 1,
                "year" => $_GET['year'] ?? 2023
            ],
        ];

        $resultReport = $rmodel->getReport($data['settings']['month'], $data['settings']['year']);
        $resultUser = $rmodel->getUserInfo($_SESSION['email']);

        $this->view->render(__DIR__ . '/../Views/report.php', [$data, $resultReport, $resultUser]);

    }

    public function datas() {
        $table = $_GET['table'];
        $table = ucfirst($table);

        $tableModel = new $table();

        $datas = $tableModel->get();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if($_POST['formName'] == 'add') {
                $tableModel->add();
            }

            if($_POST['formName'] == 'delete') {
                $tableModel->delete();
            }

            if($_POST['formName'] == 'update') {
                $tableModel->update();
            }

            if($_POST['formName'] == 'getProductId') {
                echo $tableModel->getProductId();
            }

        }

        $this->view->render(__DIR__ . '/../Views/Tables/' . $table . '.php', [$table, $datas]);


    }

}