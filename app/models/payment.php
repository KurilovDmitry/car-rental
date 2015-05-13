<?php
/**
 * Created by PhpStorm.
 * User: Red
 * Date: 13.05.2015
 * Time: 4:04
 */

namespace models;


class payment extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function addPayment($payment) {
        $this->_db->insert(PAYMENT, $payment);
    }
}