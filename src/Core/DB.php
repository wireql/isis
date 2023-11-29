<?php 

class DB
{

    private $db_host = '127.0.0.1';
    private $db_name = 'repair';
    private $db_username = 'root';
    private $port = "3307";
    private $db_password = '';

    public $db;

    public function __construct() {

        $this->dbConnect();
        
    }

    public function dbConnect()
    {
        try{
            $this->db = new PDO('mysql:host='.$this->db_host.'; port='.$this->port.'; dbname='.$this->db_name,$this->db_username,$this->db_password);
        }catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
    }

    // public function getTable($tablename = null) {
    //     try {

    //         $stmt = $this->db->prepare("SELECT * FROM " . $tablename);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (\Throwable $e) {
    //         echo "Connection error ".$e->getMessage(); 
    //         exit;
    //     }
    // }

    // public function updateTable($sql = "", $arr = []) {
    //     try {
    //         $stmt = $this->db->prepare($sql);
    //         return $stmt->execute($arr);
    //     } catch (\Throwable $e) {
    //         echo "Connection error ".$e->getMessage(); 
    //         exit;
    //     }
    // }
}
