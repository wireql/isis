<?php

require_once __DIR__ . '/DB.php';

class Model {
    
    protected $db;

    public function __construct() {
        $db = new DB();
        $this->db = $db;
    }

}