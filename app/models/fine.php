<?php
/**
 * Created by PhpStorm.
 * User: Red
 * Date: 13.05.2015
 * Time: 4:04
 */

namespace models;


class fine extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function addFine($fine) {
        $this->_db->insert(FINE, $fine);
    }
}