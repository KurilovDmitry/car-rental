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
        return $this->_db->select('SELECT * FROM DEAL WHERE DEAL.id = $id');
    }

    public function addDeal($deal) {
        $this->_db->insert(DEAL, $deal);
    }

//    public function updateDeal($deal) {
//
//        $this->_db->update(DEAL, $deal, );
//    }
}