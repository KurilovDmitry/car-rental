<?php namespace models;


class benefits extends \core\model {
    function __construct() {
        parent::__construct();
    }

    public function getTotalCash() {
        return $this->_db->select('SELECT SUM(FINAL_COST) FROM PAYMENT');
    }

    public function testPunishmentSystem() {
        return $this->_db->select('SELECT Q1.COUNT1, Q2.COUNT2 FROM
                                    (
                                        SELECT COUNT(WARNING_ONLY.ID) COUNT1 FROM
                                        (
                                        SELECT WAR.ID
                                        FROM
                                        (
                                          SELECT C.ID, COUNT(F.FINE_TYPE) WAR_COUNT FROM CLIENT C, DEAL D, PAYMENT P, FINE F
                                          WHERE C.ID = D.CLIENT_ID
                                          AND D.ID = P.DEAL_ID
                                          AND P.FINE_ID = F.ID
                                          AND F.FINE_TYPE = "WARNING"
                                          GROUP BY C.ID
                                        ) WAR,
                                        (
                                          SELECT COUNT(F.FINE_TYPE) ALL_FINES FROM CLIENT C, DEAL D, PAYMENT P, FINE F
                                          WHERE C.ID = D.CLIENT_ID
                                          AND D.ID = P.DEAL_ID
                                          AND P.FINE_ID = F.ID
                                          GROUP BY C.ID
                                        ) FINES
                                        WHERE WAR.WAR_COUNT = FINES.ALL_FINES
                                        GROUP BY WAR.ID
                                        ) WARNING_ONLY
                                    ) Q1,
                                    (
                                        SELECT COUNT(Q.ID) COUNT2 FROM
                                        (
                                            SELECT DD.* FROM
                                            (
                                              SELECT C.ID, COUNT(F.FINE_TYPE) ONLY_FINES, D.ID DEAL_ID, D.FINISH_DATE FROM CLIENT C, DEAL D, PAYMENT P, FINE F
                                              WHERE C.ID = D.CLIENT_ID
                                              AND D.ID = P.DEAL_ID
                                              AND P.FINE_ID = F.ID
                                              AND F.FINE_TYPE = "FINE"
                                              GROUP BY C.ID
                                              HAVING COUNT(F.FINE_TYPE) = 1
                                            ) F,
                                            (
                                              SELECT * FROM DEAL D
                                            ) DD
                                            WHERE F.ID = DD.CLIENT_ID
                                            AND F.FINISH_DATE < DD.FINISH_DATE
                                        ) Q
                                    ) Q2');
    }
}