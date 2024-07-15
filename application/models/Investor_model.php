<?php

class Investor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	public function checkInvestor_byuser($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>2));
        return $query->row_array();
	}
	public function feedback($id){
 			$query = $this->db->get_where('vh_review', array('keyid'=>$id));
            return $query->result_array();
    }
	public function FundingRequestsByIndustry($industry,$params){
			
			$this->db->select('f.*,in.industry as industry_name,u.name,u.email,u.mobile');
			$this->db->from('vh_funding f');
			$this->db->join('industries in', 'f.industry = in.id','left');
			$this->db->join('users u', 'f.posted_by = u.id','left');
			$this->db->where('f.industry', $industry);
			$params['expected_role'] = (isset($params['expected_role']) && is_array($params['expected_role']))? $params['expected_role']:array();
			if(is_array($params['expected_role']) && count($params['expected_role']) > 0){
				$this->db->where_in('f.expected_role', $params['expected_role']);
			}
			if(!empty($params['post_type'])){
				$this->db->where('f.post_type', $params['post_type']);
			}
			if(!empty($params['location'])){
				$this->db->like('f.location', $params['location']);
			}
			if(!empty($params['currency'])){
				$this->db->like('f.currency', $params['currency']);
			}
			if(!empty($params['share_min'])){
				$this->db->where('f.share_min >=', $params['share_min']);
			}
			if(!empty($params['share_max'])){
				$this->db->where('f.share_max <=', $params['share_max']);
			}
			if(!empty($params['min_amount'])){
				$this->db->where('f.min_amount >=', $params['min_amount']);
			}
			if(!empty($params['max_amount'])){
				$this->db->where('f.max_amount <=', $params['max_amount']);
			}
		$query = $this->db->get();
		$qry = $query->result_array();
		foreach($qry as $key=>$val){
			if(!empty($params['session_user'])){
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
				$qry[$key]['paid']=$paid;
				$invest = $this->db->get_where('vh_investall', array('posted_by'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
				$qry[$key]['paid']=$paid;		
				$qry[$key]['initiate']=$invest;		
			}else{
				$qry[$key]['paid']='';	
				$qry[$key]['initiate']='';	
			}
		}
		return $qry;
	}
	public function allInvests($params){
			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.*,in.status as ignore_status,in.idea_id,in.user_id');
			$this->db->from('vh_investall i');
			$this->db->join('vh_ideas_ignore in', 'i.id = in.idea_id','left');
			$this->db->where('i.industry', $params['industry']);
			$this->db->where('i.status !=', 3);
			$invests =  $this->db->get()->result_array();	
			
		foreach($invests as $key=>$val){
			if($val['post_type']==8){
			$result[$key]=$val;
			$this->db->select('f.*,f.id as post_id, in.industry as industry_name, u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('vh_funding f');
			$this->db->join('industries in', 'f.industry = in.id','left');
			$this->db->join('users u', 'f.posted_by = u.id','left');
			$this->db->where('f.id', $val['post_id']);
			$qry = $this->db->get()->result_array();
				foreach($qry as $k=>$value){
				$result[$key]['data']=$value;	
				}
			$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['post_id'],'post_type'=>$val['post_type']))->row_array();
			
			$result[$key]['paid']=$paid;		
			}elseif($val['post_type']==12){
				$result[$key]=$val;	
			$resources='';
			$skillProfiles='';
			$this->db->select('i.*,in.id as industry_id, in.industry as industry_name, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('ideas i');
			$this->db->join('industries in', 'i.industry = in.id','left');
			$this->db->join('users u', 'i.posted_by = u.id','left');
			$this->db->where('i.id', $val['post_id']);
			$qry = $this->db->get()->result_array();
			foreach($qry as $k=>$value){
			$result[$key]['data']=$value;	
			$this->db->select('p.*, u.id as uid,u.name,s.skill as skill_name, u.email, u.mobile,u.login_type');
			$this->db->from('vh_initiate_idea p');
			$this->db->join('skills s', 'p.role = s.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.idea_id', $val['post_id']);					
			$Profiles = $this->db->get()->result_array();		
			$result[$key]['Profiles']=$Profiles;
			
			foreach($Profiles as $invkey=>$inval){
				$result[$key]['Profiles'][$invkey]['paid']=array();
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$inval['id'],'post_type'=>$inval['post_type']))->row_array();
				
				$result[$key]['Profiles'][$invkey]['paid']=$paid;
				
				$shortlist_skill = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$inval['id'],'post_type'=>$inval['post_type']))->row_array();

				$result[$key]['Profiles'][$invkey]['shortlist']=$shortlist_skill;
				
			}
				
				}			
			}elseif($val['post_type']==8){
			
			}
		}	
		return $result;
	}
	public function UpdateProfile($id,$userData){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_posts', $userData, array('p_id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
    public function BuyContact($data = array()) {
	    $insert = $this->db->insert('vh_paidcontacts', $data);
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
	public function InvestAll($data = array()) {
	   $insert = $this->db->insert('vh_investall', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }		
	public function proposalsFundings($id,$pid){
			$this->db->order_by("n.id", "desc");	
			$this->db->select('n.*, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('vh_notification n');
			$this->db->join('users u', 'n.from_id = u.id','left');
			$this->db->where('n.to_id', $id);					
			$array= array('17', '24', '26','41');
			$this->db->where_in('n.notification_type',$array);					
			return $result = $this->db->get()->result_array();
	}
	public function InvestorDetails($id){

			$this->db->select('p.*,in.industry as industry_name');
			$this->db->from('vh_posts p');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->where('p.p_id', $id);					
			return $result = $this->db->get()->row_array();
	}
}
?>