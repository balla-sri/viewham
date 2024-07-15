<?php

class Gain_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getAll(){
        $query = $this->db->get('industries');
        return $query->result_array();
    }
    function checkEntrepreneur_byuser($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>1));
        return $query->row_array();
	 }
	 function checkInvestor_byuser($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>2));
        return $query->row_array();
	 }
	function InsertEnerprenur($data = array()) {
		
	 $insert = $this->db->insert('vh_posts', $data);
	 
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	function feedback($id){
 			$query = $this->db->get_where('vh_review', array('keyid'=>$id));
            return $query->result_array();
    }	

}
?>