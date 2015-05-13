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
        return $this->_db->select("SELECT P.*, C.FIRST_NAME, C.LAST_NAME, PROPERTIES.ALLP AS PROPERTIES, MODELS.ALLM AS MODELS, D.ID AS DEAL_ID
                                    FROM PREFERENCE P

                                    LEFT JOIN CLIENT_PREFERENCE P_C ON P.ID = P_C.PREFERENCE_ID
                                    LEFT JOIN CLIENT C ON C.ID = P_C.CLIENT_ID
									LEFT JOIN DEAL D ON D.PREFERENCE_ID = P.ID

                                    JOIN (SELECT P1.ID PREF_ID, GROUP_CONCAT(PROP.DESCRIPTION) ALLP
                                          FROM PREFERENCE P1
                                          JOIN PREFERENCE_PROPERTY P_P ON P1.ID = P_P.PREFERENCE_ID
                                          JOIN PROPERTY PROP ON P_P.PROPERTY_ID = PROP.ID
                                          GROUP BY P1.ID) PROPERTIES
                                    ON P.ID = PROPERTIES.PREF_ID

                                    JOIN (SELECT P2.ID PREF_ID, GROUP_CONCAT(M.MODEL) ALLM
                                          FROM PREFERENCE P2
                                          JOIN PREFERENCE_MODEL P_M ON P2.ID = P_M.PREFERENCE_ID
                                          JOIN MODEL M ON P_M.MODEL_ID = M.ID
                                          GROUP BY P2.ID) MODELS
                                    ON P.ID = MODELS.PREF_ID");
    }

    public function getPreference($id) {
        return $this->_db->select("SELECT P.*, C.FIRST_NAME, C.LAST_NAME, PROPERTIES.ALLP AS PROPERTIES, MODELS.ALLM AS MODELS, D.ID AS DEAL_ID
                                    FROM PREFERENCE P

                                    LEFT JOIN CLIENT_PREFERENCE P_C ON P.ID = P_C.PREFERENCE_ID
                                    LEFT JOIN CLIENT C ON C.ID = P_C.CLIENT_ID
									LEFT JOIN DEAL D ON D.PREFERENCE_ID = P.ID

                                    LEFT JOIN (SELECT P1.ID PREF_ID, GROUP_CONCAT(PROP.DESCRIPTION) ALLP
                                          FROM PREFERENCE P1
                                          JOIN PREFERENCE_PROPERTY P_P ON P1.ID = P_P.PREFERENCE_ID
                                          JOIN PROPERTY PROP ON P_P.PROPERTY_ID = PROP.ID
                                          GROUP BY P1.ID) PROPERTIES
                                    ON P.ID = PROPERTIES.PREF_ID

                                    LEFT JOIN (SELECT P2.ID PREF_ID, GROUP_CONCAT(M.MODEL) ALLM
                                          FROM PREFERENCE P2
                                          JOIN PREFERENCE_MODEL P_M ON P2.ID = P_M.PREFERENCE_ID
                                          JOIN MODEL M ON P_M.MODEL_ID = M.ID
                                          GROUP BY P2.ID) MODELS
                                    ON P.ID = MODELS.PREF_ID

                                    WHERE P.ID = $id
                                    ");
    }

    public function addPreference($preference) {
        $preferences = array('START_DATE' => $preference['START_DATE'],
                                'RENT_DURATION' => $preference['RENT_DURATION'],
                                'MAXIMAL_COST' => $preference['MAXIMAL_COST']);
        $preferenceId = $this->_db->insert(PREFERENCE, $preferences);

        $prefClient = array('PREFERENCE_ID' => $preferenceId,
                            'CLIENT_ID' => $preference['CLIENT_ID']);
        $this->_db->insert(CLIENT_PREFERENCE, $prefClient);

        foreach ($preference['PROPERTIES'] as $value) {
            $data = array('PREFERENCE_ID' => $preferenceId,
                'PROPERTY_ID' => $value);
            $this->_db->insert(PREFERENCE_PROPERTY, $data);
        }

        foreach ($preference['MODELS'] as $value) {
            $data = array('PREFERENCE_ID' => $preferenceId,
                            'MODEL_ID' => $value);
            $this->_db->insert(PREFERENCE_MODEL, $data);
        }

    }
}