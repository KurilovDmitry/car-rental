<?php namespace models;

class cmodels extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function getModels() {
        return $this->_db->select('SELECT ID, MODEL FROM MODEL');
    }
}