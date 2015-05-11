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
        $this->_db->select('SELECT P.*, P_C.CLIENT_ID, GROUP_CONCAT(PROP.DESCRIPTION), GROUP_CONCAT(M.MODEL) FROM PREFERENCE P
                            JOIN (
                              SELECT * FROM CLIENT_PREFERENCE
                            ) P_C
                            JOIN (
                              SELECT * FROM PREFERENCE_PROPERTY
                            ) P_P
                            JOIN (
                              SELECT * FROM PROPERTY
                            ) PROP
                            JOIN (
                              SELECT * FROM PROPERTY_MODEL
                            ) P_M
                            JOIN (
                              SELECT * FROM MODEL
                            ) M
                            WHERE P.ID = P_C.PREFERENCE_ID
                            AND P.ID = P_P.PREFERENCE_ID
                            AND P_P.PROPERTY_ID = PROP.ID
                            AND P.ID = P_M.PREFERENCE_ID
                            AND P_M.MODEL_ID = M.ID
                            AND P.ID = $id
                            GROUP BY P.ID');
    }

    public function addPreference($preference) {
        $preferences = array('START_DATE' => $preference['START_DATE'],
                                'RENT_DURATION' => $preference['RENT_DURATION'],
                                'MAXIMAL_COST' => $preference['MAXIMAL_COST']);
        $prefClient = array('PREFERENCE_ID' => $preference['PREFERENCE_ID'],
                            'CLIENT_ID' => $preference['CLIENT_ID']);
        $prefProp = array('PREFERENCE_ID' => $preference['PREFERENCE_ID'],
                            'PROPERTY_ID' => $preference['PROPERTY_ID']);
        $prefModel = array('PREFERENCE_ID' => $preference['PREFERENCE_ID'],
                            'MODEL_ID' => $preference['MODEL_ID']);
        $this->_db->insert(PREFERENCE, $preferences);
        $this->_db->insert(CLIENT_PREFERENCE, $prefClient);
        foreach ($prefProp as $value) {
            $data = array('PREFERENCE_ID' => $prefProp['PREFERENCE_ID'],
                            'PROPERTY_ID' => $value);
            $this->_db->insert(PREFERENCE_PROPERTY, $data);
        }
        foreach ($prefModel as $value) {
            $data = array('PREFERENCE_ID' => $prefProp['PREFERENCE_ID'],
                            'MODEL_ID' => $value);
            $this->_db->insert(PREFERENCE_MODEL, $data);
        }

    }
}