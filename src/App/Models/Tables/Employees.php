<?php

require_once __DIR__ . '/../../../Core/Model.php';

class Employees extends Model {
    
    public function add() {
        try {
            $stmt = $this->db->db->prepare("INSERT INTO employees (name, post) VALUES (:value1, :value2)");
            $stmt->bindParam(':value1', $_POST['name']);
            $stmt->bindParam(':value2', $_POST['post']);
            $stmt->execute();

            header('Location: /datas?table=employees');

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function update() {
        try {
            $stmt = $this->db->db->prepare("UPDATE products SET product_name = :value1, company = :value2, model = :value3, characteristics = :value4, guarantee = :value5, img = :value6 WHERE id = :id");
            $stmt->bindParam(':value1', $_POST['data']['product_name']);
            $stmt->bindParam(':value2', $_POST['data']['company']);
            $stmt->bindParam(':value3', $_POST['data']['model']);
            $stmt->bindParam(':value4', $_POST['data']['characteristics']);
            $stmt->bindParam(':value5', $_POST['data']['guarantee']);
            $stmt->bindParam(':value6', $_POST['data']['img']);
            $stmt->bindParam(':id', $_POST['id']);
    
            $stmt->execute();
            return;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function get() {
        try {
            $stmt = $this->db->db->prepare("SELECT * FROM employees");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete() {
        try {
            $stmt = $this->db->db->prepare("DELETE FROM employees WHERE id = :id");
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th;
        }
    }

}