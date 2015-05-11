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
            'ID' => '1',
            'START_DATE' => '1.01.2001',
            'RENT_DURATION' => 5,
            'PROPERTIES' => 'Ля-ля, тополя, тудак-судак',
            'Client_FirstName' => 'Сергей',
            'Client_LastName' => 'Костров',
            'DEAL_ID' => NULL));    // NULL если сделки еще нет
    }

    public function getPreference($id) {

    }

    public function addPreference($preference) {

    }
}