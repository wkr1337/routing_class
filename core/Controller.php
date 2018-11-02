<?php 

class Controller {
    protected $_controller, $_action, $_db;
    public $view;

    public function __construct($controller, $action) {
        $this->_db = DB::getInstance();

        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View();
    }
    
    
}