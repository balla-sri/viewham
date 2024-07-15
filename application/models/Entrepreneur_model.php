<?php

class Entrepreneur_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
    function checkEntrepreneur_byuser($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>1));
        return $query->row_array();
	 }
	function checkInvestor_byuser($id){   
	    $query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type' =>2));
        return $query->row_array();
	}
	function feedback($id){
 			$query = $this->db->get_where('vh_review', array('keyid'=>$id));
            return $query->result_array();
    }
	function Initiates($params){
			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.*,in.status as ignore_status,in.idea_id,in.user_id');
			$this->db->from('vh_initiatesall i');
			$this->db->join('vh_ideas_ignore in', 'i.id = in.idea_id','left');
			$this->db->where('i.industry', $params['industry']);
			$this->db->where('i.status !=', 3);
		//	$this->db->where('in.user_id !=', 212);
			$initiates =  $this->db->get()->result_array();
		foreach($initiates as $key=>$val){
			if($val['post_type']==6){
			$result[$key]=$val;
			$this->db->select('o.id as post_id, o.description, o.location,in.id as industry_id, in.industry, u.name, u.email, u.mobile, u.profile_picture, u.login_type, o.currency_type, o.min_invest, o.max_invest, o.duration_type, o.duration_min, o.duration_max, o.posted_by');
			$this->db->from('vh_outsource_work o');
			$this->db->join('industries in', 'o.industry = in.id','left');
			$this->db->join('users u', 'o.posted_by = u.id','left');
			$this->db->where('o.id', $val['post_id']);
			$qry = $this->db->get()->result_array();
				foreach($qry as $k=>$value){
				$result[$key]['data']=$value;	
				}
			$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['post_id'],'post_type'=>$val['post_type']))->row_array();
			
			$result[$key]['paid']=$paid;		
		}elseif($val['post_type']==7){
			$result[$key]=$val;	
			$this->db->select('o.id as post_id, o.description, o.location,in.id as industry_id, in.industry, u.name, u.email, u.mobile, u.profile_picture, u.login_type, o.currency_type, o.min_invest, o.max_invest, o.posted_by');
			$this->db->from('vh_franchise o');
			$this->db->join('industries in', 'o.industry = in.id','left');
			$this->db->join('users u', 'o.posted_by = u.id','left');
			$this->db->where('o.id', $val['post_id']);
			$qry = $this->db->get()->result_array();
				foreach($qry as $k=>$value){
				$result[$key]['data']=$value;	
				}
			$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['post_id'],'post_type'=>$val['post_type']))->row_array();	
			$result[$key]['paid']=$paid;					
			}elseif($val['post_type']==11){
			$result[$key]=$val;	
			$resources=array();
			$skillProfiles=array();
			$this->db->select('o.*,in.id as industry_id, in.industry as industry_name, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('vh_ownbusiness o');
			$this->db->join('industries in', 'o.industry = in.id','left');
			$this->db->join('users u', 'o.posted_by = u.id','left');
			$this->db->where('o.id', $val['post_id']);
			$qry = $this->db->get()->result_array();
				foreach($qry as $k=>$value){
				$result[$key]['data']=$value;	
				$resource = json_decode($value['resource']);
				
				foreach($resource as $k=>$skill){
					$resources[$skill] = $this->db->get_where('skills', array('id'=>$skill))->row_array();
					
			$this->db->select('p.*,s.id as skill_id,s.skill as skill_name, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('vh_posts p');
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.skill', $skill);					
			$qryss = $this->db->get()->result_array();		
			$skillProfiles[$skill] = $qryss;		
			}
					$result[$key]['resources']=$resources;
					$result[$key]['skillProfiles']=$skillProfiles;
				}
			}
		elseif($val['post_type']==12){
			$result[$key]=$val;	
			$resources=array();
			$skillProfiles=array();
			$this->db->select('i.*,in.id as industry_id, in.industry as industry_name, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('ideas i');
			$this->db->join('industries in', 'i.industry = in.id','left');
			$this->db->join('users u', 'i.posted_by = u.id','left');
			$this->db->where('i.id', $val['post_id']);
			$qry = $this->db->get()->result_array();
			foreach($qry as $k=>$value){
			$result[$key]['data']=$value;	
			$resource= $this->db->get_where('idea_resources', array('idea_id'=>$val['post_id']))->result_array();
			
			$this->db->select('p.*, u.id as uid,u.name,s.skill as skill_name, u.email, u.mobile,u.login_type');
			$this->db->from('vh_initiate_idea p');
			$this->db->join('skills s', 'p.role = s.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.idea_id', $val['post_id']);					
			$initiateProfiles = $this->db->get()->result_array();		
			$result[$key]['iniProfiles']=$initiateProfiles;	
			foreach($initiateProfiles as $inkey=>$inival){
				$result[$key]['iniProfiles'][$inkey]['paid']=array();
				$result[$key]['iniProfiles'][$inkey]['shortlist']=array();
				
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$inival['id'],'post_type'=>$inival['post_type']))->row_array();
				$result[$key]['iniProfiles'][$inkey]['paid']=$paid;				
				
				$shortlist_skill = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$inival['id'],'post_type'=>$inival['post_type']))->row_array();
				$result[$key]['iniProfiles'][$inkey]['shortlist']=$shortlist_skill;
				
			}
			$this->db->select('p.*, u.id as uid,u.name,s.skill as skill_name, u.email, u.mobile,u.login_type');
			$this->db->from('vh_invest_idea p');
			$this->db->join('skills s', 'p.role = s.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.idea_id', $val['post_id']);					
			$investProfiles = $this->db->get()->result_array();		
			$result[$key]['investProfiles']=$investProfiles;				

			foreach($investProfiles as $invkey=>$inval){
				$result[$key]['investProfiles'][$invkey]['paid']=array();
				$result[$key]['investProfiles'][$invkey]['shortlist']=array();
				
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$inval['id'],'post_type'=>$inval['post_type']))->row_array();
				$result[$key]['investProfiles'][$invkey]['paid']=$paid;				
				
				$shortlist_skill = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$inval['id'],'post_type'=>$inval['post_type']))->row_array();
				$result[$key]['investProfiles'][$invkey]['shortlist']=$shortlist_skill;
				
			}
			
			foreach($resource as $k=>$skill){
					$skill_id=$skill['skill_id'];
					$resources[$skill_id] = $this->db->get_where('skills', array('id'=>$skill['skill_id']))->row_array();
					
			$this->db->select('p.*,s.id as skill_id,s.skill as skill_name, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('vh_posts p');
			$this->db->join('skills s', 'p.skill = s.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.skill', $skill_id);					
			$skillProfilesbyid = $this->db->get()->result_array();	
			$skillProfiles[$skill_id] = $skillProfilesbyid;	

			foreach($skillProfilesbyid as $skey=>$sval){
				$skillProfiles[$skill_id][$skey]['paid']=array();
				$skillProfiles[$skill_id][$skey]['shortlist']=array();
				
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$sval['p_id'],'post_type'=>$sval['post_type']))->row_array();
				
				$shortlist_skill = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$sval['p_id'],'post_type'=>$sval['post_type']))->row_array();

				$skillProfiles[$skill_id][$skey]['paid']=$paid;
				$skillProfiles[$skill_id][$skey]['shortlist']=$shortlist_skill;
				

				
			}
			
					
			}	
				
				$result[$key]['resources']=$resources;
				$result[$key]['skillProfiles']=$skillProfiles;
				}
	
			}
		}	
//echo "<pre>"; print_r($result); exit;
		return $result;
	}
	public function proposalsOursourceFrancise($id){
			$this->db->order_by("n.id", "desc");	
			$this->db->select('n.*, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
			$this->db->from('vh_notification n');
			$this->db->join('users u', 'n.from_id = u.id','left');
			$this->db->where('n.to_id', $id);					
			$array= array('15','16','24','26','32','42');
			$this->db->where_in('n.notification_type',$array);						return $result = $this->db->get()->result_array();
	}
	public function UpdateProfile($id,$userData){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_posts', $userData, array('p_id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function EntrepreneurDetails($id){
		$this->db->select('p.*,in.industry as industry_name');
		$this->db->from('vh_posts p');
		$this->db->join('industries in', 'p.industry = in.id','left');
		$this->db->where('p.p_id', $id);					
		return $result = $this->db->get()->row_array();
	}	
}
?>