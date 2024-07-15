<?php

class Earn_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getAll(){
        $query = $this->db->get('industries');
        return $query->result_array();
    }
    public function GetMyProfile($id){   

			$this->db->select('p.*,p.mobile as mediator_mobile, s.skill as skill_name,u.name,u.email,u.mobile');
			$this->db->from('vh_posts p');		
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.p_id', $id);
			return $qry = $this->db->get()->row_array();

		}	
	public function GetAllUserProfiles($id){   

			$this->db->select('p.*,s.skill as skill_name');
			$this->db->from('vh_posts p');		
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->where('p.posted_by', $id);
			$post_types= array('3', '4', '5');
			$this->db->where_in('p.post_type', $post_types);
			return $qry = $this->db->get()->result_array();

		}	
    public function checkProfessional_Profile($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>3));
        return $query->row_array();
	 }
	public function checkHobby_Profile($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>4));
        return $query->row_array();
	 }
	public function checkMediator_Profile($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>5));
        return $query->num_rows();
	 }
	public function InsertEnerprenur($data = array()) {
		
	 $insert = $this->db->insert('vh_posts', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	function usertimings($id,$from){
 			$query = $this->db->get_where('vh_timings', array('u_id' => $id,'from_from' => $from));
            return $query->result_array();
    }
    public function usertimingsByday($id,$from,$day){
 			$query = $this->db->get_where('vh_timings', array('u_id' => $id,'from_from' => $from,'day' => $day));
            return $query->result_array();
    }
	public function DeleteUserday($id,$day){
        $delete = $this->db->delete('vh_timings',array('id'=>$day,'u_id'=>$id));
        return $delete?true:false;
    }
	public function Updateusertiming($id,$userData){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_timings', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
    public function Insertearnprofile($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_timings', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function InsertRequestWork($data = array()) {
        $insert = $this->db->insert('vh_request_work', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function NotificationAdd($data = array()) {
        $insert = $this->db->insert('vh_notification', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function UpdateProfile($id,$userData){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_posts', $userData, array('p_id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}	
	public function UpdatePostRequestWork($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_request_work', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}	
    public function SingleRequestWork($id){   
			$this->db->select('r.*,s.skill as skill_name');
			$this->db->from('vh_request_work r');		
			$this->db->join('skills s', 'r.skill = s.id','left');
			$this->db->where('r.id', $id);
			return $qry = $this->db->get()->row_array();
	 }
	public function RequestWorksByUser($id){   
			$this->db->select('r.*,s.skill as skill_name');
			$this->db->from('vh_request_work r');		
			$this->db->join('skills s', 'r.skill = s.id','left');
			$this->db->where('r.posted_by', $id);
			return $qry = $this->db->get()->result_array();
	 }
	

}
?>