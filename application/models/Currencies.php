<?php

class Currencies extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getAllCurrencies(){
        $query = $this->db->get('currencies');
        return $query->result_array();
    }


}
?>