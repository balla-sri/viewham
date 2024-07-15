<?php

class Industry extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getAll(){
        $query = $this->db->get('industries');
        return $query->result_array();
    }

    function getIndustry($id){   
	    $query = $this->db->get_where('industries', array('id' => $id));
        return $query->row_array();
	 }


    public function getIndustrySlug($industry){
        $this->db->select('*');
        $this->db->from('industries');
        $this->db->where('slug', $industry);
        $query = $this->db->get();
        $row = $query->row_array();
        
        return $row;
        
    }
}
?>