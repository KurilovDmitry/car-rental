<?php namespace models;

class car_models extends \core\model {

    function __construct() {
        parrent::__construct();
    }

    public function getCarModels() {
        return $this->_db->select('SELECT ID, CAR_ID, MODEL_ID FROM CAR_MODEL');
    }
}