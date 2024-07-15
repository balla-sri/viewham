<?php

class Skills extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getAll(){
        $query = $this->db->get('skills');
        return $query->result_array();
    }
    public function getAllCurrencies(){
        $query = $this->db->get('currencies');
        return $query->result_array();
    }
    function skillById($id){   
	    $query = $this->db->get_where('skills', array('id' => $id));
        return $query->row_array();
	}	
	public function UpdateSkillStatus($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_posts', $userData, array('p_id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}

}
?>