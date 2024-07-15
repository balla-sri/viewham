<?php

class Contacts_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function BuyContact($data = array()) {
	    $insert = $this->db->insert('vh_paidcontacts', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

	public function Last7daysPaidContacts($params){   
			$this->db->from('vh_paidcontacts p');		
			$this->db->where('p.post_id', $params['poste_id']);
			$this->db->where('p.post_type', $params['post_type']);
			$this->db->where('p.create_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
			$qry = $this->db->get()->result_array();
			return $qry;
	 }    
	public function PaidContactRemove($id){
 		$delete = $this->db->delete('vh_paidcontacts',array('id' => $id));
        return $delete?true:false;
    }
}
