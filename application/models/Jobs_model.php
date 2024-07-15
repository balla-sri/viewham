<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobs_model extends CI_Model{
    public function __construct() {
         $this->load->database();
    }
    public function Insert_offerWork($data = array()) {
	    $insert = $this->db->insert('vh_offerwork', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function UpdatePostOfferWork($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_offerwork', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function jobOffers($params=array()){
		$this->db->order_by("f.id", "desc");	
		$this->db->select('f.*,i.skill as skill_name,u.name,u.email,u.mobile');
		$this->db->from('vh_offerwork f');
		$this->db->join('skills i', 'f.skill = i.id','left');
		$this->db->join('users u', 'f.posted_by = u.id','left');
        $params['skill'] = (isset($params['skill']) && is_array($params['skill']))? $params['skill']:array();
        if(is_array($params['skill']) && count($params['skill']) > 0){
            $this->db->where_in('f.skill', $params['skill']);
        }
		if(!empty($params['currency'])){
			$this->db->where('f.currency', $params['currency']);
		}
		if(!empty($params['work_type'])){
			$this->db->where('f.work_type', $params['work_type']);
		}
		if(!empty($params['experience'])){
			$this->db->where('f.experience', $params['experience']);
		}
		if(!empty($params['min_salary'])){			
			$this->db->where('f.min_salary >=', $params['min_salary']);
		}		
		if(!empty($params['max_salary'])){
			$this->db->where('f.max_salary <=', $params['max_salary']);
		}
		if(!empty($params['income_min'])){
			$this->db->where('f.income_min >=', $params['income_min']);
		}
		if(!empty($params['income_max'])){
			$this->db->where('f.income_max <=', $params['income_max']);
		}
		if(!empty($params['income_type'])){
			$this->db->where('f.income_type ', $params['income_type']);
		}
		if(!empty($params['break_even_type'])){
			$this->db->where('f.break_even_type ', $params['break_even_type']);
		}
		if(!empty($params['min_break_even'])){
			$this->db->where('f.min_break_even >=', $params['min_break_even']);
		}
		if(!empty($params['max_break_even'])){
			$this->db->where('f.max_break_even <=', $params['max_break_even']);
		}		
		$query = $this->db->get();
		$result= $query->result_array();
		foreach($result as $key=>$val){
			$pid=$val['id']; 
			$post_type=10;
			$intrest = $this->db->get_where('vh_interests', array('post_id' => $pid,'post_type' => $post_type));
			$intrestss=$intrest->row_array();
			$intrests[$pid] =$intrestss;
			
			if(!empty($params['session_user'])){
				$contact = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id' => $pid,'post_type' => $post_type));
				$paidContacts=$contact->row_array();
				$result[$key]['paid'] =$paidContacts;
			}else{
				$result[$key]['paid'] =array();
			}
		
		}
			$data1['job']=$result;
			$data1['intrest']=$intrests;
			$data1['contacts']=$contacts;
		return $data1;
	}
	public function ProfileByUser($user){
		$this->db->select('p_id,post_type,skill,association');
		$this->db->where('posted_by', $user);
		$post_types= array('3', '4', '5');
		$this->db->where_in('post_type', $post_types);		
		$query = $this->db->get_where('vh_posts');
		return $query->result_array();	
	}
    public function SingleOfferWork($id){   
			$this->db->select('r.*,s.skill as skill_name');
			$this->db->from('vh_offerwork r');		
			$this->db->join('skills s', 'r.skill = s.id','left');
			$this->db->where('r.id', $id);
			return $qry = $this->db->get()->row_array();
	 }
	public function OfferWorksByUser($id){   	
			$this->db->order_by("r.id", "desc");	
			$this->db->select('r.*,s.skill as skill_name');
			$this->db->from('vh_offerwork r');		
			$this->db->join('skills s', 'r.skill = s.id','left');
			$this->db->where('r.posted_by', $id);
			return $qry = $this->db->get()->result_array();
	 }
	public function PostNotifications($array){   	
			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.*,u.id as uid,u.name,u.email,u.mobile');
			$this->db->from('vh_interests i');		
			$this->db->join('users u', 'i.posted_by = u.id','left');
			$this->db->where($array);
			$qry = $this->db->get()->result_array();
			foreach($qry as $key=>$val){
				$params['session_user']=$this->session->userdata('user');
				if(!empty($params['session_user'])){
					$contact = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id' => $val['p_id'],'post_type' => $val['profile_type']));
					$paidContacts=$contact->row_array();
					$qry[$key]['paid'] =$paidContacts;
				}else{
					$qry[$key]['paid'] ='';
				}
			}
//		echo "<pre>";print_r($qry);exit;	
		return $qry;	
	 }
    public function NotificationAdd($data = array()) {
        $insert = $this->db->insert('vh_notification', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function NotificationAddToAllProfiles($data = array(),$skill) {
			$this->db->select('p_id,skill,association,posted_by');       
		 	$post_types= array('3', '4', '5');
			$this->db->where_in('post_type', $post_types);
			$this->db->like('association', $skill);
			$this->db->or_where('skill', $skill);
			$query = $this->db->get('vh_posts')->result_array();
			foreach($query as $key=>$val){
					$data['to_id']=$val['posted_by'];
					$this->NotificationAdd($data);			
			}
			return $query;
       
    }



}