<?php namespace models;
namespace models;


class deals extends \core\model {

    function __construct() {
        parent::__construct();
    }

    public function getDeals() {
        return $this->_db->select('SELECT * FROM DEAL');
    }

    public function getDeal($id) {
        return $this->_db->select("SELECT * FROM DEAL WHERE DEAL.id = $id");
    }

    public function addDeal($deal) {
        return $this->_db->insert(DEAL, $deal);
    }

    public function updateDeal($deal) {
        $dealArray = array('CAR_ID' => $deal['CAR_ID'],
                            'CLIENT_ID' => $deal['CLIENT_ID'],
                            'PREFERENCE_ID' => $deal['PREFERENCE_ID'],
                            'START_DATE' => $deal('START_DATE'),
                            'FINISH_DATE' => $deal('FINISH_DATE'),
                            'RETURN_DATE' => $deal('RETURN_DATE'));
        $where = array('ID' => $deal['ID']);
        return $this->_db->update(DEAL, $dealArray, $where);
    }
}