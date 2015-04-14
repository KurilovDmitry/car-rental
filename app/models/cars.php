<?php namespace models;

class cars extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function getCars() {
        return $this->_db->select('SELECT Id, Model, Cost, RentPrice FROM car');
    }
}