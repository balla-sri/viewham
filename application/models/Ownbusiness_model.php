<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ownbusiness_model extends CI_Model{
    public function __construct() {
         $this->load->database();
    }
    public function InsertOwnBusines($data = array()) {
	    $insert = $this->db->insert('vh_ownbusiness', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function InsertOwnBusinesInitiate($data = array()) {
	    $insert = $this->db->insert('vh_initiatesall', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function UpdateBusinessIdea($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_ownbusiness', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function UpdateBusinessIdeaInitiate($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_initiatesall', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
    public function singleideaPost($id){   
			$this->db->from('vh_ownbusiness');		
			$this->db->where('id', $id);
			return $qry = $this->db->get()->row_array();
	}
    public function NotificationAdd($data = array()) {
        $insert = $this->db->insert('vh_notification', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function NotificationAddToAll($data = array(),$singleidea) {
			
			$resource = json_decode($singleidea['resource']);
			$consultant = $singleidea['consultant'];
			$mentor = $singleidea['mentor'];
			$industry = $singleidea['industry'];
			
			// send notification for Entrepreneur consultant
			if($consultant=="on"){
			$query = $this->db->get_where('vh_posts', array('post_type' => 1,'industry' =>$industry))->result_array();

			foreach($query as $key=>$val){
					$data['to_id']=$val['posted_by'];
					$data['notification_type']='22';
					$this->NotificationAdd($data);							
			}
		
			}
			// send notification for investor Mentor
			
			if($mentor=="on"){
				$mentorquery = $this->db->get_where('vh_posts', array('post_type' => 2,'industry' =>$industry))->result_array();

			foreach($mentorquery as $k=>$v){
					$data['to_id']=$v['posted_by'];
					$data['notification_type']='23';
					$this->NotificationAdd($data);							
			}
		
			}

			// send notification for Earn Skill Profiles
	
			foreach($resource as $key=>$skill_value){
			$this->db->select('p_id,skill,association,posted_by');       
		 	$post_types= array('3', '4', '5');
			$this->db->where_in('post_type', $post_types);
			$this->db->like('association', $skill_value);
			$this->db->or_where('skill', $skill_value);
			$query = $this->db->get('vh_posts')->result_array();
			foreach($query as $key=>$val){
					$data['to_id']=$val['posted_by'];
					$data['notification_type']='21';
					$this->NotificationAdd($data);			
				}
			}
			return true;
       
    }	
	public function UserOwnBusinessIdeas($id){  
			$this->db->order_by("o.id", "desc");		
			$this->db->select('o.*,i.industry as industry_name');
			$this->db->from('vh_ownbusiness o');		
			$this->db->join('industries i', 'o.industry = i.id','left');
			$this->db->where('o.posted_by', $id);
			$this->db->where('o.status !=', 3);
			return $qry = $this->db->get()->result_array();
	 }
	 public function detailsOwnBusinessIdeas($id){   
			$this->db->select('o.*,i.industry as industry_name');
			$this->db->from('vh_ownbusiness o');		
			$this->db->join('industries i', 'o.industry = i.id','left');
			$this->db->where('o.id', $id);
			return $qry = $this->db->get()->row_array();
	 }




}