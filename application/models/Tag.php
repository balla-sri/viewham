<?php

class Tag extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getAll(){
        $query = $this->db->get('tags');
        return $query->result_array();
    }
    
    
    public function getTagInfo($slug){
        $this->db->select('tag_name,slug,title,description');
        $this->db->from('tags');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }


}
?>