<?php namespace models;


class customers extends \core\model {
    function __construct() {
        parent::__construct();
    }

    public function getCustomer($id) {

    }

    public function getAllCustomers() {
        return $this->_db->select('SELECT * FROM CLIENT');
    }

    public function getRegularCustomers() {
        return $this->_db->select('SELECT * FROM CLIENT C
                                    WHERE C.ID IN (
                                      SELECT D.CLIENT_ID FROM DEAL D
                                      GROUP BY D.CLIENT_ID
                                      HAVING COUNT(D.ID) > 10
                                    )');
    }

    public function getTheMostProfitableCustomers() {
        return $this->_db->select('SELECT bigJoin.ID, bigJoin.FIRST_NAME, bigJoin.LAST_NAME,
                                            bigJoin.MIDDLE_NAME, bigJoin.PASSPORT, bigJoin.PHONE_NUMBER,
                                            bigJoin.DISCOUNT, bigJoin.summary FROM (
                                      SELECT CLIENT_PAY.*, SUM(CLIENT_PAY.FINAL_COST) AS summary
                                      FROM (
                                        SELECT C.*, P.FINAL_COST FROM CLIENT C
                                        JOIN DEAL D ON C.ID = D.CLIENT_ID
                                        LEFT JOIN PAYMENT P ON D.ID = P.DEAL_ID
                                       ) CLIENT_PAY
                                       GROUP BY CLIENT_PAY.FIRST_NAME
                                       ORDER BY summary
                                     ) bigJoin
                                     WHERE bigJoin.summary > (
                                       SELECT (SUM(PAYMENT.FINAL_COST) / COUNT(CLIENT.ID))
                                       FROM PAYMENT, CLIENT
                                    )');
    }
}