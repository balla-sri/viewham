<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shortlists_model extends CI_Model{
    public function __construct() {
        $this->load->database();
    }

	public function insertShortlists($data = array()) {
     $insert = $this->db->insert('vh_shortlistprofiles', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }     

	public function SaveInrest($data = array()) {
		//	echo json_encode($data); exit;	
     $insert = $this->db->insert('vh_interests', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    } 
	public function ShortlistProfiles($params=''){   	
			$result=array();
			$feedback=array();
			$session_id = $this->session->userdata('user');
			$this->db->order_by("sp.id", "desc");	
			$this->db->select('sp.id as sid, p.*,s.skill as skill_name,in.industry as industry_name,u.*');
			$this->db->from('vh_shortlistprofiles sp');		
			$this->db->join('vh_posts p', 'p.p_id = sp.pid','left');
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('sp.posted_by', $params['session_id']);
			$this->db->where('sp.status',1);
			$params['post_type'] = (isset($params['post_type']) && is_array($params['post_type']))? $params['post_type']:array();
			if(is_array($params['post_type']) && count($params['post_type']) > 0){
				$this->db->where_in('p.post_type', $params['post_type']);
			}
			$params['skill'] = (isset($params['skill']) && is_array($params['skill']))? $params['skill']:array();
			if(is_array($params['skill']) && count($params['skill']) > 0){
				$this->db->where_in('p.skill', $params['skill']);
			}
			$qry = $this->db->get()->result_array();

			foreach($qry as $key=>$val){
				$pid=$val['p_id'];
				$post_type=$val['post_type'];
				$feed = $this->db->get_where('vh_feedback', array('postid' => $pid));
				$feedbacks=$feed->result_array();			
				$feedback[$pid] =$feedbacks;
				
				$contact = $this->db->get_where('vh_paidcontacts', array('post_id' => $pid,'post_type' => $post_type));
				$paidContacts=$contact->result_array();
				$qry[$key]['paid'] =$paidContacts;
				
			}
			$data['shortlist']=$qry;
			$data['feedback']=$feedback;
			return $data;

	}
	public function ShortlistRemove($id){
 		$delete = $this->db->delete('vh_shortlistprofiles',array('id' => $id));
        return $delete?true:false;
    }
    public function ByPostTypeById($pid,$post_type){   
		$this->db->order_by("id", "desc");
        $query = $this->db->get_where('vh_shortlistprofiles', array('pid' => $pid,'post_type' =>$post_type));
        return $query->result_array();
	 }
	public function ShortlistUpdate($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_shortlistprofiles', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function checkShortList($params){
		$this->db->from('vh_shortlistprofiles');
		$this->db->where($params);
		return $short = $this->db->get()->row_array();
	}
}