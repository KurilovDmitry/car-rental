<?php
/**
 * Created by PhpStorm.
 * User: Red
 * Date: 30.04.2015
 * Time: 8:38
 */

namespace models;


class preferences extends \core\model {

    function __construct() {
        parent::__construct();
    }

    // получить список заказов/предпочтений
    public function getPreferences() {
        return array(array(
            'Id' => '1',
            'StartDate' => '1.01.2001',
            'RentDuration' => 5,
            'Client_FirstName' => 'Сергей',
            'Client_LastName' => 'Костров'));
    }

    public function getPreference($id) {

    }

    public function addPreference($preference) {

    }
}