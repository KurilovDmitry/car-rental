<?php namespace models;

class cars extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function getCars() {
        return $this->_db->select('SELECT C.* FROM CAR C JOIN CAR_MODEL CM IN C.ID = CM.CAR_ID JOIN MODEL M IN CM.MODEL_ID = M.ID');
    }

    public function getAllCars() {
        return $this->_db->select('SELECT C.ID, C.PRICE, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION SEPARATOR) PROPERTIES FROM CAR C
                                    JOIN (
                                      SELECT M.MODEL, CM.CAR_ID CAR_ID FROM MODEL M
                                      JOIN CAR_MODEL CM ON M.ID = CM.MODEL_ID
                                    ) AS QM
                                    JOIN (
                                      SELECT P.DESCRIPTION DESCRIPTION, CP.CAR_ID CAR_ID FROM PROPERTY P
                                      JOIN CAR_PROPERTY CP ON P.ID = CP.PROPERTY_ID
                                    ) AS QP
                                    WHERE C.ID = QM.CAR_ID
                                    AND C.ID = QP.CAR_ID
                                    GROUP BY C.ID');
    }

    public function getRentedCars() {
        return $this->_db->select('SELECT C.ID, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION SEPARATOR) PROPERTIES FROM CAR C
                                    JOIN (
                                      SELECT M.MODEL, CM.CAR_ID CAR_ID FROM MODEL M
                                      JOIN CAR_MODEL CM ON M.ID = CM.MODEL_ID
                                    ) AS QM
                                    JOIN (
                                      SELECT P.DESCRIPTION DESCRIPTION, CP.CAR_ID CAR_ID FROM PROPERTY P
                                      JOIN CAR_PROPERTY CP ON P.ID = CP.PROPERTY_ID
                                    ) AS QP
                                    WHERE C.ID = QM.CAR_ID
                                    AND C.ID = QP.CAR_ID
                                    AND C.ID IN (
                                      SELECT D.CAR_ID FROM DEAL D
                                      WHERE D.FINISH_DATE > CURRENT_TIMESTAMP
                                    )
                                    GROUP BY C.ID');
    }

    public function getNotRentedCars() {
        return $this->_db->select('SELECT C.ID, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION SEPARATOR) PROPERTIES FROM CAR C
                                    JOIN (
                                      SELECT M.MODEL, CM.CAR_ID CAR_ID FROM MODEL M
                                      JOIN CAR_MODEL CM ON M.ID = CM.MODEL_ID
                                    ) AS QM
                                    JOIN (
                                      SELECT P.DESCRIPTION DESCRIPTION, CP.CAR_ID CAR_ID FROM PROPERTY P
                                      JOIN CAR_PROPERTY CP ON P.ID = CP.PROPERTY_ID
                                    ) AS QP
                                    WHERE C.ID = QM.CAR_ID
                                    AND C.ID = QP.CAR_ID
                                    AND C.ID NOT IN (
                                      SELECT D.CAR_ID FROM DEAL D
                                      WHERE D.FINISH_DATE > CURRENT_TIMESTAMP
                                    )
                                    GROUP BY C.ID');
    }

    public function getPopularCars($car) {

    }

    public function getCar($id) {

    }

    public function addCar($car) {

    }
}