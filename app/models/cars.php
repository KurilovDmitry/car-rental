<?php namespace models;

class cars extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function getCars() {
        return $this->_db->select('SELECT C.* FROM CAR C JOIN CAR_MODEL CM ON C.ID = CM.CAR_ID JOIN MODEL M ON CM.MODEL_ID = M.ID');
    }

    public function getAllCars() {
        return $this->_db->select('SELECT C.*, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION) FROM CAR C
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
        return $this->_db->select('SELECT C.*, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION) PROPERTIES FROM CAR C
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
        return $this->_db->select('SELECT C.*, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION) PROPERTIES FROM CAR C
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
        return $this->_db->select('SELECT C.*, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION) FROM CAR C
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
                                        GROUP BY D.CAR_ID
                                        HAVING COUNT(D.ID) > (
                                            SELECT AVG(DealsCount.N) FROM (
                                              SELECT COUNT(ID) AS N
                                              FROM DEAL
                                              GROUP BY CAR_ID
                                            ) DealsCount
                                        )
                                    )');
    }

    public function getCar($id) {
        return $this->_db->select('SELECT C.*, QM.MODEL, GROUP_CONCAT(QP.DESCRIPTION) FROM CAR C
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
                                    AND  C.ID = $id
                                    GROUP BY C.ID');
    }

    public function addCar($car) {
        $carArray = array("COST" => $car["COST"]);
        $carModelArray = array("CAR_ID" => $car["CAR_ID"],
                                "MODEL_ID" => $car["MODEL_ID"]);
        $carPropertyArray = array("CAR_ID" => $car["CAR_ID"],
                                    "PROPERTY" => $car["CAR_PROPERTY"]);
        $this->_db->insert(CAR, $carArray);
        $this->_db->insert(CAR_MODEL, $carModelArray);
        $this->_db->insert(CAR_PROPERTY, $carPropertyArray);

    }
}