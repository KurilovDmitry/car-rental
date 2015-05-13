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
        return $this->_db->select("SELECT * FROM DEAL WHERE DEAL.ID = $id");
    }

    public function addDeal($deal) {
        return $this->_db->insert(DEAL, $deal);
    }

    public function updateDeal($id, $deal) {
        $where = array('ID' => $id);
        return $this->_db->update(DEAL, $deal, $where);
    }
}