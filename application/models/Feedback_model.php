<?php

class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	public function FeedbackByPostId($id){   
	    
			$this->db->order_by("f.id", "desc");	
			$this->db->select('f.*,u.name');
			$this->db->from('vh_feedback f');
			$this->db->join('users u', 'f.posted_by = u.id','left');
			$this->db->where('f.postid', $id);
        return $this->db->get()->result_array();
	}	


}
?>