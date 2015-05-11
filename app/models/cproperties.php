<?php namespace models;

class cproperties extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function getProperties() {
        return $this->_db->select('SELECT ID, DESCRIPTION FROM PROPERTY');
    }
}