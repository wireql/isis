<?php

require_once __DIR__ . '/../../../Core/Model.php';
require_once __DIR__ .'/../../../Libs/rb-mysql.php';

class Orders extends Model {

    public function __construct() {
        R::setup('mysql:host=127.0.0.1; port=3307; dbname=repair','root','');
        
        if (!R::testConnection() ){
    
            exit ('Нет соединения с базой данных');
    
        }
    }
    
    public function add() {
        try {
            $guarantee_value = isset($_POST['guarantee']) ? 1 : 0;

            $item = R::dispense('orders');

            $item->client_name = $_POST['client_name'];
            $item->product_id = $_POST['product_id'];
            $item->guarantee = $guarantee_value;
            $item->date_order = $_POST['date_order'];

            R::store($item);

            header('Location: /datas?table=orders');

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function update() {
        try {
            
            
            $item = R::load('orders', $_POST['id']);

            $item->client_name = $_POST['data']['client_name'];
            $item->product_id = $_POST['data']['product_id'];
            $item->guarantee = $_POST['data']['guarantee'];
            $item->date_order = $_POST['data']['date_order'];

            R::store($item);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function get() {
        try {
            return R::getAll('SELECT * FROM orders');
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete() {
        try {
            $item = R::load('orders', $_POST['id']);
            R::trash($item);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getProductId() {
        $result = R::getAll('SELECT * FROM products');

        echo json_encode($result);
        exit;
    }

}