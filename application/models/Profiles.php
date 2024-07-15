<?php

class Profiles extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
	public function getAll($params=array()){   	
			$result=array();
			$feedback=array();
			$contacts=array();
			$this->db->order_by("p.p_id", "desc");	
			$this->db->select('p.*,s.skill as skill_name,in.industry as industry_name,u.*');
			$this->db->from('vh_posts p');		
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$params['industry'] = (isset($params['industry']) && is_array($params['industry']))? $params['industry']:array();
			if(is_array($params['industry']) && count($params['industry']) > 0){
				$this->db->where_in('p.industry', $params['industry']);
			}
			if(!empty($params['ptype'])){
				$this->db->where('p.post_type ', $params['ptype']);
			}
			if(!empty($params['key'])){
				$this->db->like('s.skill', $params['key']);
			}			
			$qry = $this->db->get()->result_array();
			foreach($qry as $key=>$val){
				$pid=$val['p_id'];
				$post_type=$val['post_type'];
			if(!empty($params['session_user'])){
					$this->db->from('vh_shortlistprofiles');
					$this->db->where('pid', $pid);
					$this->db->where('post_type', $post_type);
					$this->db->where('posted_by',$params['session_user']);
					$whereStatus=array('0','1');
					$this->db->where_in('status', $whereStatus);
					$shortlists = $this->db->get()->result_array();
					$result[$pid] =$shortlists;
				}

				$feed = $this->db->get_where('vh_feedback', array('postid' => $pid));
				$feedbacks=$feed->result_array();			
				$feedback[$pid] =$feedbacks;
			if(!empty($params['session_user'])){
				$contact = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id' => $pid,'post_type' => $post_type));
				$paidContacts=$contact->row_array();
				$qry[$key]['paid'] =$paidContacts;
			}else{
				$qry[$key]['paid'] ='';
			}
				}	
			$data['profiles']=$qry;
			$data['shortlists']=$result;
			$data['feedback']=$feedback;
			return $data;
			 
	 }
	public function EntrepreneurProfile($params=array()){   	
			$result=array();
			$feedback=array();
			$contacts=array();
			$this->db->order_by("p.p_id", "desc");	
			$this->db->select('p.*,s.skill as skill_name,in.industry as industry_name,u.*');
			$this->db->from('vh_posts p');		
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$params['industry'] = (isset($params['industry']) && is_array($params['industry']))? $params['industry']:array();
			if(is_array($params['industry']) && count($params['industry']) > 0){
				$this->db->where_in('p.industry', $params['industry']);
			}
			if(!empty($params['post_type'])){
				$this->db->where('p.post_type', $params['post_type']);
			}
			if(!empty($params['location'])){
				$this->db->like('p.location', $params['location']);
			}
			if(!empty($params['currency'])){
				$this->db->like('p.currency', $params['currency']);
			}
			if(!empty($params['min_budget'])){
				$this->db->where('p.min_budget >=', $params['min_budget']);
			}
			if(!empty($params['max_budget'])){
				$this->db->where('p.max_budget <=', $params['max_budget']);
			}		
			if(!empty($params['investment_currency'])){
				$this->db->like('p.investment_currency', $params['investment_currency']);
			}
			if(!empty($params['min_invest'])){
				$this->db->where('p.min_invest >=', $params['min_invest']);
			}
			if(!empty($params['max_invest'])){
				$this->db->where('p.max_invest <=', $params['max_invest']);
			}		
			if(!empty($params['share_currency'])){
				$this->db->like('p.share_currency', $params['share_currency']);
			}
			if(!empty($params['min_invest'])){
				$this->db->where('p.min_share >=', $params['min_share']);
			}
			if(!empty($params['max_share'])){
				$this->db->where('p.max_share <=', $params['max_share']);
			}
			if(!empty($params['key'])){
					$this->db->like('in.industry', $params['key']);			
			}

			$qry = $this->db->get()->result_array();
			foreach($qry as $key=>$val){
				$pid=$val['p_id'];
				$post_type=$val['post_type'];
			if(!empty($params['session_user'])){
					$this->db->from('vh_shortlistprofiles');
					$this->db->where('pid', $pid);
					$this->db->where('post_type', $post_type);
					$this->db->where('posted_by', $params['session_user']);
					$whereStatus=array('0','1');
					$this->db->where_in('status', $whereStatus);
					$shortlists = $this->db->get()->result_array();
					$result[$pid] =$shortlists;
					$qry[$key]['shortlists'] =$shortlists;
				}

				$feed = $this->db->get_where('vh_feedback', array('postid' => $pid));
				$feedbacks=$feed->result_array();			
				$feedback[$pid] =$feedbacks;

			if(!empty($params['session_user'])){
				$contact = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id' => $pid,'post_type' => $post_type));
				$paidContacts=$contact->row_array();
				$qry[$key]['paid'] =$paidContacts;
			}else{
				$qry[$key]['paid'] ='';
			}


				}	
			$data['profiles']=$qry;
			$data['shortlists']=$result;
			$data['feedback']=$feedback;
			return $data;
			 
	 }
	 public function SkillProfiles($id){   	
			$this->db->order_by("p.p_id", "desc");	
			$this->db->select('p.*,s.skill as skill_name,in.industry as industry_name,u.id as uid, u.*');
			$this->db->from('vh_posts p');		
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.p_id ', $id);
			return $qry = $this->db->get()->row_array();
	}
	public function insertFeedback($data = array()) {
     $insert = $this->db->insert('vh_feedback', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function SearchProfiles($params){ 
		$result['skill'] = $this->SearchSkillProfiles($params);
		$params['post_type'] =$params['e_post_type'];
		$result['entrepreneurs'] = $this->EntrepreneurProfile($params);
		$params['post_type'] =$params['inv_post_type'];
		$result['investors'] = $this->EntrepreneurProfile($params);
		$result['ideas'] = $this->SearchIdeas($params);
//		echo "<pre>";print_r($result); exit;
		return $result;
	
	}
	public function SearchIdeas($params){ 

			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.*,in.industry as industry_name,u.id as uid, u.name, u.login_type, u.profile_picture');
			$this->db->from('ideas i');		
			$this->db->join('industries in', 'i.industry = in.id','left');
			$this->db->join('users u', 'i.posted_by = u.id','left');
			$this->db->like('i.idea_title', $params['key']);
			$this->db->limit('10');
			return $qry = $this->db->get()->result_array();	
		
 }
	public function SearchSkillProfiles($params){ 

			$this->db->order_by("p.p_id", "desc");	
			$this->db->select('p.*,s.skill as skill_name,in.industry as industry_name,u.id as uid, u.*');
			$this->db->from('vh_posts p');		
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->like('s.skill', $params['key']);
			$qry = $this->db->get()->result_array();	
			foreach($qry as $key=>$val){
				$pid = $val['p_id'];
				$post_type = $val['post_type'];
				$qry[$key]['paid'] = array();
				$qry[$key]['feedback'] = array();
				$feed = $this->db->get_where('vh_feedback', array('postid' => $pid));
				$feedbacks=$feed->result_array();
				$qry[$key]['feedback']=$feedbacks;				
			if(!empty($params['session_user'])){
				$contact = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id' => $pid,'post_type' => $post_type));
				$paidContacts=$contact->row_array();
				$qry[$key]['paid'] =$paidContacts;
			}
			$qry[$key]['shortlists'] =array();
			if(!empty($params['session_user'])){
					$this->db->from('vh_shortlistprofiles');
					$this->db->where('pid', $pid);
					$this->db->where('post_type', $post_type);
					$this->db->where('posted_by',$params['session_user']);
					$whereStatus=array('0','1');
					$this->db->where_in('status', $whereStatus);
					$shortlists = $this->db->get()->row_array();
					$result[$pid] =$shortlists;
					if(!empty($shortlists)){
						$qry[$key]['shortlists'] =$shortlists;						
					}

			}
			
			}
			return $qry; 
	}
	public function FeedbacksById($postid){
		return $this->db->get_where('vh_feedback', array('postid' => $postid))->result_array();
	}

}
?>