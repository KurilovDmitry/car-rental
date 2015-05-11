<?php namespace models;


class benefits extends \core\model {
    function __construct() {
        parent::__construct();
    }

    public function getTotalCash() {
        return $this->_db->select('SELECT SUM(FINAL_COST) FROM PAYMENT');
    }
}