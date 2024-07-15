<?php

class SkillsTrustFactor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
    function getAllProfiles(){   
        $query = $this->db->get_where('vh_posts');
        return $query->result_array();
    }
    function skillByIdTrustFactor($id){   
	    $query = $this->db->get_where('vh_skill_trust_factor', array('postid' => $id));
        return $query->row_array();
	}	
	public function UpdateSkillTrustFactor($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_skill_trust_factor', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
    public function insertTrustFactor($data = array()){
     $insert = $this->db->insert('vh_skill_trust_factor', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
}
?>