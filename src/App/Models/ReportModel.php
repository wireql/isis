<?php

require_once __DIR__ . '/../../Core/Model.php';

class ReportModel extends Model {

    public function getReport($month, $year) {
        
        try {
            $query = "SELECT a.model FROM a WHERE YEAR(`Дата исполнения заказа`) = :one AND MONTH(`Дата исполнения заказа`) = :two GROUP BY a.model";
        
            $stmt = $this->db->db->prepare($query);
            $stmt->bindParam(':one', $year);
            $stmt->bindParam(':two', $month);
        
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        } catch (\Throwable $th) {
            echo $th; 
        }

    }

    public function getReportPosition($model) {
        $query = "SELECT a.id, a.`ФИО клиента`, a.`Наименование товара`, a.`company`, a.`model`, a.`Дата поступления заказа`, a.`Дата исполнения заказа`, a.`Срок ремонта, дней` FROM a WHERE a.model = :model;";
        $stmt = $this->db->db->prepare($query);
        $stmt->bindParam(':model', $model);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserInfo($email) {
        $stmt = $this->db->db->prepare("SELECT * FROM users WHERE email = :value1;");
        $stmt->bindParam(':value1', $email);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}