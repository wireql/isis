<?php

require_once __DIR__ . '/../Core/View.php';

class Controller {

    protected $view;

    public function __construct() {
        $this->view = new View();
    }

}