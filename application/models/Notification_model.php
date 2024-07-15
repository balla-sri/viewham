<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification_model extends CI_Model{
    public function __construct() {
        $this->load->database();
    }
    public function insertNotification($data = array()) {
     $insert = $this->db->insert('vh_notification', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function EarnProfileNotificatons($array){
            $this->db->order_by("n.id", "desc");    
            $this->db->select('n.*,s.skill,u.id as buyerid,u.name,u.email,u.mobile');
            $this->db->from('vh_notification n');
            $this->db->join('users u', 'n.from_id = u.id','left');
            $this->db->join('skills s', 'n.skill_id = s.id','left');
            $this->db->where('n.to_id', $array['session_id']);
            $this->db->where('n.skill_id',$array['id']);
            $this->db->where('n.notification_type ',$array['n_type']);
            $query = $this->db->get();
        $qry = $query->result_array();
        foreach($qry as $key=>$val){
            if(!empty($array['session_id'])){
                $paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$array['session_id'],'post_id'=>$val['post_id'],'post_type'=>10))->row_array();   
                $qry[$key]['paid']=$paid;
                $initiate = $this->db->get_where('vh_interests', array('posted_by'=>$array['session_id'],'post_id'=>$val['id'],'post_type'=>10))->row_array(); 
                $qry[$key]['paid']=$paid;       
                $qry[$key]['initiate']=$initiate;       
            }else{
                $qry[$key]['paid']='';  
                $qry[$key]['initiate']='';  
            }
        }
		
      return $qry;      
    }

   function NotificationSendEnterprenurs($data = array(),$industry) {
	$query = $this->db->get_where('vh_posts', array('industry' => $industry,'post_type' => '1'))->result_array();
	foreach($query as $key=>$val){	
		$data['to_id']=$val['posted_by'];
		$insert = $this->insertNotification($data);
		$result[$key]=$insert;
	}
	return $result;
	}
	function NotificationSendinvestors($data = array(),$industry) {
	$query = $this->db->get_where('vh_posts', array('industry' => $industry,'post_type' => '2'))->result_array();
	foreach($query as $key=>$val){	
		$data['to_id']=$val['posted_by'];
		$insert = $this->insertNotification($data);
		$result[$key]=$insert;
	}
	return $result;
	}
	public function Proposals($params){
		$result['shortlist_skill'] = $this->ShortlistsSkills($params);
		$result['viewedContacts_skill'] = $this->PaidContactsSkill($params);
		$params['post_type']='(s.post_type="1")';
		$result['shortlist_entreprenuer'] = $this->ShortlistsIndustry($params);
		$result['viewcontacts_entreprenuer'] = $this->PaidContactsEntreprenuerInvestor($params);
		$params['post_type']='(s.post_type="2")';
		$result['shortlist_investor'] = $this->ShortlistsIndustry($params);
		$result['viewcontacts_investor'] = $this->PaidContactsEntreprenuerInvestor($params);
		$result['requirementForSkillName'] = $this->requirementForSkillName($params);
		$result['requestForInvestmentFund'] = $this->requestForInvestmentFund($params);
		$result['requireForOwnBusiness'] = $this->requestForInvestmentFund($params);
		$result['requestOutsourceWork'] = $this->requestOutsourceWork($params);
		$result['requestOfferaFranchise'] = $this->requestOfferaFranchise($params);
		$result['YourBusinessIdea'] = $this->YourBusinessIdea($params);
		$result['YouInitiatedaBusiness'] = $this->YouInitiatedaBusiness($params);
		$result['YouInvestedaBusinessideas'] = $this->YouInvestedaBusinessideas($params);
		
		//to You 
		$result['requirementForSkillNameToYo'] = $this->requirementForSkillNameToYo($params);
		$result['gainEntrepreneurToYo'] = $this->gainEntrepreneurToYo($params);
		$result['gainInvestorToYo'] = $this->gainInvestorToYo($params);
		return $result;
		//echo "<pre>"; print_r($result); exit;
	}
	private function IntresrOrNot($params){

			$this->db->select('s.*');
			$this->db->from('vh_interests s');
			$this->db->where('s.post_id', $params['post_id']);
			$this->db->where('s.post_type', $params['post_type']);
			$this->db->where('s.posted_by', $params['posted_by']);
			return $inrest = $this->db->get()->row_array();
			
	}
	private function gainEntrepreneurToYo($params){

			$this->db->select('p.p_id, p.industry,p.association, p.post_type,in.industry as industry_name');
			$this->db->from('vh_posts p');		
			$this->db->join('industries in', 'p.industry = in.id','left');
			$post_types= array('1');
			$this->db->where_in('p.post_type', $post_types);
			$this->db->where('p.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();
		foreach($result as $key=>$val){
			
				$this->db->order_by("o.id", "desc");	
				$this->db->select('o.id,o.industry,in.industry as industry_name, u.id as uid, u.name');
				$this->db->from('ideas o');
				$this->db->join('industries in', 'o.industry = in.id','left');
				$this->db->join('users u', 'o.posted_by = u.id','left');
				$this->db->where('o.industry ', $val['industry']);
				$this->db->where('o.posted_by !=', $params['session_user']);
				$businessIdeas = $this->db->get()->result_array();
				$result[$key]['businessIdeas']=$businessIdeas;

				// Your skill Shortlist 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_shortlistprofiles s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.pid', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);
				$resultshorlists= $this->db->get()->result_array();
				$result[$key]['gain_shortlist'] = $resultshorlists;
				//interest
				foreach($resultshorlists as $sis=>$vs){
					$dataparams['post_id']=$vs['pid'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_shortlist'][$sis]['interest'] = $this->IntresrOrNot($dataparams);
				}	
				// Your skill Viewed Contact 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('users u', 's.buyerId = u.id','left');
				$this->db->where('s.post_id', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.buyerId !=', $params['session_user']);
				$skill_viewedContacts= $this->db->get()->result_array();
				$result[$key]['gain_viewedContacts'] = $skill_viewedContacts;
				//interest
				foreach($skill_viewedContacts as $sis=>$vs){
					$dataparams['post_id']=$vs['post_id'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_viewedContacts'][$sis]['interest'] = $this->IntresrOrNot($dataparams);
				}	
				// Your skill Feedbacks 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_feedback s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.postid', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$skill_Feedbacks= $this->db->get()->result_array();
				$result[$key]['gain_Feedbacks'] = $skill_Feedbacks;

				// request outsource works by industry

				$this->db->select('s.id,s.post_type, s.create_date, u.name,u.id as uid');
				$this->db->from('vh_outsource_work s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.industry', $val['industry']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$gain_outsource= $this->db->get()->result_array();
				$result[$key]['gain_outsource'] = $gain_outsource;
				//interest
				foreach($gain_outsource as $sis=>$vs){
					$dataparams['post_id']=$vs['id'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_outsource'][$sis]['interest'] = $this->IntresrOrNot($dataparams);
				}	
				// request franchise by industry

				$this->db->select('s.id,s.post_type, s.create_date ,u.name,u.id as uid');
				$this->db->from('vh_franchise s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.industry', $val['industry']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$gain_franchise= $this->db->get()->result_array();
				$result[$key]['gain_franchise'] = $gain_franchise;
				//interest
				foreach($gain_franchise as $sis=>$vs){
					$dataparams['post_id']=$vs['id'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_franchise'][$sis]['interest'] = $this->IntresrOrNot($dataparams);
				}				
		}
		return $result;
	}
	private function gainInvestorToYo($params){

			$this->db->select('p.p_id, p.industry,p.association, p.post_type,in.industry as industry_name');
			$this->db->from('vh_posts p');		
			$this->db->join('industries in', 'p.industry = in.id','left');
			$post_types= array('2');
			$this->db->where_in('p.post_type', $post_types);
			$this->db->where('p.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();
		foreach($result as $key=>$val){
			
				$this->db->order_by("o.id", "desc");	
				$this->db->select('o.id,o.industry,in.industry as industry_name, u.id as uid, u.name');
				$this->db->from('ideas o');
				$this->db->join('industries in', 'o.industry = in.id','left');
				$this->db->join('users u', 'o.posted_by = u.id','left');
				$this->db->where('o.industry ', $val['industry']);
				$this->db->where('o.posted_by !=', $params['session_user']);
				$businessIdeas = $this->db->get()->result_array();
				$result[$key]['businessIdeas']=$businessIdeas;

				// Your skill Shortlist 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_shortlistprofiles s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.pid', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);				$resultshorlists= $this->db->get()->result_array();
				$result[$key]['gain_inv_shortlist'] = $resultshorlists;
				//interest
				foreach($resultshorlists as $si=>$vs){
					$dataparams['post_id']=$vs['pid'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_inv_shortlist'][$si]['interest'] = $this->IntresrOrNot($dataparams);
				}
				// Your skill Viewed Contact 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('users u', 's.buyerId = u.id','left');
				$this->db->where('s.post_id', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.buyerId !=', $params['session_user']);
				$skill_viewedContacts= $this->db->get()->result_array();
				$result[$key]['gain_inv_viewedContacts'] = $skill_viewedContacts;
				//interest
				foreach($skill_viewedContacts as $si=>$vs){
					$dataparams['post_id']=$vs['post_id'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_inv_viewedContacts'][$si]['interest'] = $this->IntresrOrNot($dataparams);
				}

				// Your skill Feedbacks 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_feedback s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.postid', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$skill_Feedbacks= $this->db->get()->result_array();
				$result[$key]['gain_inv_Feedbacks'] = $skill_Feedbacks;


				// request Fundings by industry

				$this->db->select('s.id,s.post_type,s.create_date,u.name,u.id as uid');
				$this->db->from('vh_funding s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.industry', $val['industry']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$gain_fund= $this->db->get()->result_array();
				$result[$key]['gain_fund'] = $gain_fund;
				//interest
				foreach($gain_fund as $sis=>$vs){
					$dataparams['post_id']=$vs['id'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['gain_fund'][$sis]['interest'] = $this->IntresrOrNot($dataparams);
				}
				
		}
	return $result;
	}
	private function requirementForSkillNameToYo($params){
			$this->db->select('p.p_id, p.skill,p.association, p.post_type,sk.skill as skill_name');
			$this->db->from('vh_posts p');		
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$post_types= array('3', '4', '5');
			$this->db->where_in('p.post_type', $post_types);
			$this->db->where('p.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();
			$skills=array();
			foreach($result as $key=>$val){
				//$ass= json_decode($val['association']);
				
				$this->db->order_by("o.id", "desc");	
				$this->db->select('o.id,o.skill,o.work_type,o.post_type, o.create_date,sk.skill as skill_name, u.id as uid, u.name');
				$this->db->from('vh_offerwork o');
				$this->db->join('skills sk', 'o.skill = sk.id','left');
				$this->db->join('users u', 'o.posted_by = u.id','left');
				$this->db->where('o.skill ', $val['skill']);
				$this->db->where('o.posted_by !=', $params['session_user']);
				$othersjobs = $this->db->get()->result_array();
				$result[$key]['othersjobs']=$othersjobs;
				//interest
				foreach($othersjobs as $i=>$v){
					$dataparams['post_id']=$v['id'];
					$dataparams['post_type']=$v['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['othersjobs'][$i]['interest'] = $this->IntresrOrNot($dataparams);
				}	
				
				// Your skill Shortlist 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_shortlistprofiles s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.pid', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);				$resultshorlists= $this->db->get()->result_array();
				$result[$key]['skill_shortlist'] = $resultshorlists;
				//interest
				foreach($resultshorlists as $si=>$vs){
					$dataparams['post_id']=$vs['pid'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['skill_shortlist'][$si]['interest'] = $this->IntresrOrNot($dataparams);
				}	
				// Your skill Viewed Contact 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('users u', 's.buyerId = u.id','left');
				$this->db->where('s.post_id', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.buyerId !=', $params['session_user']);
				$skill_viewedContacts= $this->db->get()->result_array();
				$result[$key]['skill_viewedContacts'] = $skill_viewedContacts;
				//interest
				foreach($skill_viewedContacts as $si=>$vs){
					$dataparams['post_id']=$vs['post_id'];
					$dataparams['post_type']=$vs['post_type'];
					$dataparams['posted_by']=$params['session_user'];
					$result[$key]['skill_viewedContacts'][$si]['interest'] = $this->IntresrOrNot($dataparams);
				}	
				// Your skill Feedbacks 
				
				$this->db->select('s.*,u.name,u.id as uid');
				$this->db->from('vh_feedback s');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.postid', $val['p_id']);
				$this->db->where('s.post_type', $val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$skill_Feedbacks= $this->db->get()->result_array();
				$result[$key]['skill_Feedbacks'] = $skill_Feedbacks;

				// Your skill Feedbacks 
				
				$this->db->select('r.*');
				$this->db->from('idea_resources r');
				$this->db->where('r.skill_id', $val['skill']);
				$skill_ideasrequirment= $this->db->get()->result_array();
				$result[$key]['skill_ideasrequirment'] = $skill_ideasrequirment;
				
				
				

			}
			
		return $result;
		echo "<pre>";print_r($result);exit;

	}
	private function YouInvestedaBusinessideas($params){
			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.id,i.idea_id,i.post_type,idea.industry,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_invest_idea i');
			$this->db->join('ideas idea', 'i.idea_id = idea.id','left');
			$this->db->join('industries in', 'idea.industry = in.id','left');
			$this->db->where('i.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();

			foreach($result as $key=>$val){
				
				// Viewd Contacts
				$this->db->order_by("s.id", "desc");	
				$this->db->select('s.*,u.id as uid, u.name');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('users u', 's.buyerId = u.id','left');
				$this->db->where('s.post_id',$val['id']);
				$this->db->where('s.post_type',$val['post_type']);
				$this->db->where('s.buyerId !=', $params['session_user']);

				$otherviewed = $this->db->get()->result_array();
				$result[$key]['otherviewed']=$otherviewed;
				// 	Shortlists profiles
				$this->db->order_by("s.id", "desc");	
				$this->db->select('s.*,u.id as uid, u.name');
				$this->db->from('vh_shortlistprofiles s');
				$this->db->join('vh_posts p', 's.pid = p.p_id','left');
				$this->db->join('skills sk', 'p.skill = sk.id','left');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.pid',$val['id']);
				$this->db->where('s.post_type',$val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);
				$othershort = $this->db->get()->result_array();
				$result[$key]['othershort']=$othershort;


			}
		return $result; 
	}
	private function YouInitiatedaBusiness($params){
			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.id, i.idea_id, i.post_type ,idea.industry,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_initiate_idea i');
			$this->db->join('ideas idea', 'i.idea_id = idea.id','left');
			$this->db->join('industries in', 'idea.industry = in.id','left');
			$this->db->where('i.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();

			foreach($result as $key=>$val){
				$this->db->order_by("i.id", "desc");	
				$this->db->select('i.*,u.id as uid, u.name');
				$this->db->from('vh_invest_idea i');
				$this->db->join('users u', 'i.posted_by = u.id','left');
				$this->db->where('i.idea_id',$val['idea_id']);
				$this->db->where('i.posted_by !=', $params['session_user']);
				$result[$key]['invest_idea'] = $this->db->get()->result_array();

				$this->db->order_by("i.id", "desc");	
				$this->db->select('i.*,u.id as uid, u.name');
				$this->db->from('vh_initiate_idea i');
				$this->db->join('users u', 'i.posted_by = u.id','left');
				$this->db->where('i.idea_id',$val['idea_id']);
				$this->db->where('i.posted_by !=', $params['session_user']);
				$result[$key]['initiate_idea'] = $this->db->get()->result_array();
				
				// Viewd Contacts
				$this->db->order_by("s.id", "desc");	
				$this->db->select('s.*,u.name');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('users u', 's.buyerId = u.id','left');
				$this->db->where('s.post_id',$val['id']);
				$this->db->where('s.post_type',$val['post_type']);
				$this->db->where('s.buyerId !=', $params['session_user']);

				$otherviewed = $this->db->get()->result_array();
				$result[$key]['otherviewed']=$otherviewed;
				// 	Shortlists profiles
				$this->db->order_by("s.id", "desc");	
				$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name,u.name');
				$this->db->from('vh_shortlistprofiles s');
				$this->db->join('vh_posts p', 's.pid = p.p_id','left');
				$this->db->join('skills sk', 'p.skill = sk.id','left');
				$this->db->join('users u', 's.posted_by = u.id','left');
				$this->db->where('s.pid',$val['id']);
				$this->db->where('s.post_type',$val['post_type']);
				$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);
				$othershort = $this->db->get()->result_array();
				$result[$key]['othershort']=$othershort;


			}
			return $result;	

	}
	private function YourBusinessIdea($params){
			$this->db->order_by("i.id", "desc");	
			$this->db->select('i.id,i.industry,in.id as industry_id,in.industry as industry_name');
			$this->db->from('ideas i');
			$this->db->join('industries in', 'i.industry = in.id','left');
			$this->db->where('i.posted_by', $params['session_user']);
			$this->db->where('i.status', 2);
			$result = $this->db->get()->result_array();
			foreach($result as $key=>$val){
				$this->db->order_by("i.id", "desc");	
				$this->db->select('i.*,u.id as uid, u.name');
				$this->db->from('vh_invest_idea i');
				$this->db->join('users u', 'i.posted_by = u.id','left');
				$this->db->where('i.idea_id',$val['id']);
				$this->db->where('i.posted_by !=', $params['session_user']);
				$result[$key]['invest_idea'] = $this->db->get()->result_array();

				$this->db->order_by("i.id", "desc");	
				$this->db->select('i.*,u.id as uid, u.name');
				$this->db->from('vh_initiate_idea i');
				$this->db->join('users u', 'i.posted_by = u.id','left');
				$this->db->where('i.idea_id',$val['id']);
				$this->db->where('i.posted_by !=', $params['session_user']);
				$result[$key]['initiate_idea'] = $this->db->get()->result_array();

			}
			
			return $result; 
	}
	private function requestOfferaFranchise($params){
			$this->db->order_by("f.id", "desc");	
			$this->db->select('f.id, f.post_type, f.industry,in.id as industry_id, in.industry as industry_name');
			$this->db->from('vh_franchise f');
			$this->db->join('industries in', 'f.industry = in.id','left');
			$this->db->where('f.posted_by', $params['session_user']);
					$result = $this->db->get()->result_array();
		 // sub notifications others Viewed Contacts same Skill
		 foreach($result as $key=>$val){
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*, u.name');
			$this->db->from('vh_initiatesall s');
			$this->db->join('industries in', 's.industry = in.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);

			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$key]['invest']=$othershort;
			}else{
				$result[$key]['invest']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,u.name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$key]['otherviewed']=$otherviewed;
			}else{
				$result[$key]['otherviewed']=array();
			}
		 }
		 return $result; 
	}
	private function requestOutsourceWork($params){
			$this->db->order_by("o.id", "desc");	
			$this->db->select('o.id,o.post_type ,o.industry,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_outsource_work o');
			$this->db->join('industries in', 'o.industry = in.id','left');
			$this->db->where('o.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();
		 // sub notifications others Viewed Contacts same Skill
		 foreach($result as $key=>$val){
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*, u.name');
			$this->db->from('vh_initiatesall s');
			$this->db->join('industries in', 's.industry = in.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);

			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$key]['invest']=$othershort;
			}else{
				$result[$key]['invest']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,u.name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$key]['otherviewed']=$otherviewed;
			}else{
				$result[$key]['otherviewed']=array();
			}
		 }
		 return $result; 
	}
	private function requestForInvestmentFund($params){
			$this->db->order_by("f.id", "desc");	
			$this->db->select('f.id,f.industry,f.post_type,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_funding f');
			$this->db->join('industries in', 'f.industry = in.id','left');
			$this->db->where('f.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();
		 // sub notifications others Viewed Contacts same Skill
		 foreach($result as $key=>$val){
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*, u.name');
			$this->db->from('vh_investall s');
			$this->db->join('industries in', 's.industry = in.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);

			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$key]['invest']=$othershort;
			}else{
				$result[$key]['invest']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,u.name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$key]['otherviewed']=$otherviewed;
			}else{
				$result[$key]['otherviewed']=array();
			}
		 }
		 return $result; 
	}
	private function requireForOwnBusiness($params){
			$this->db->order_by("f.id", "desc");	
			$this->db->select('f.id,f.industry,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_ownbusiness f');
			$this->db->join('industries in', 'f.industry = in.id','left');
			$this->db->where('f.posted_by', $params['session_user']);
			$qry = $this->db->get()->result_array();
			return $qry; 
	}
	private function requirementForSkillName($params){
			$this->db->order_by("o.id", "desc");	
			$this->db->select('o.id,o.post_type,o.skill,o.work_type,sk.id as skill_id,sk.skill as skill_name');
			$this->db->from('vh_offerwork o');
			$this->db->join('skills sk', 'o.skill = sk.id','left');
			$this->db->where('o.posted_by', $params['session_user']);
			$result = $this->db->get()->result_array();
		 // sub notifications others Viewed Contacts same Skill
		 foreach($result as $key=>$val){
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name,u.name');
			$this->db->from('vh_interests s');
			$this->db->join('vh_posts p', 's.p_id = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('sk.id',$val['skill_id']);
//			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);

			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$key]['interest']=$othershort;
			}else{
				$result[$key]['interest']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,u.name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$key]['otherviewed']=$otherviewed;
			}else{
				$result[$key]['otherviewed']=array();
			}
		 }
		 return $result; 
		
	}

	private function PaidContactsEntreprenuerInvestor($params){
			$paid=array();
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->where($params['post_type']);
			$this->db->where('s.buyerId', $params['session_user']);
			$paid = $this->db->get()->result_array();
			$result=array();
			foreach($paid as $key=>$value){
				$industry_id =  $value['industry_id'];
				$industry_name =  $value['industry_name'];
				$this->db->select('s.*,in.id as industry_id,in.industry as industry_name,u.id as posted_by,u.name as posted_name,');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
				$this->db->join('industries in', 'p.industry = in.id','left');
				$this->db->join('users u', 'p.posted_by = u.id','left');
				$this->db->where($params['post_type']);
				$this->db->where('p.industry', $industry_id);
				$this->db->where('s.buyerId', $params['session_user']);
				$resultViewedProfiles =  $this->db->get()->result_array();
				$result[$industry_id]= $resultViewedProfiles ;

		// sub notifications others ViewdContacts By same Industry
		
		 foreach($resultViewedProfiles as $key=>$val){
			$otherviewed=array();
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name, u.name');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.pid',$val['post_id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);
			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$industry_id][$key]['shortlist']=$othershort;
			}else{
				$result[$industry_id][$key]['shortlist']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name, u.name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['post_id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$industry_id][$key]['otherviewed']=$otherviewed;
			}else{
				$result[$industry_id][$key]['otherviewed']=array();
			}
		 }
				
				
				
			}
			return $result;
	}
	private function PaidContactsSkill($params){
			$paid=array();
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$post_type='(s.post_type="3" or s.post_type = "4" or s.post_type = "5")';
			$this->db->where($post_type);
			$this->db->where('s.buyerId', $params['session_user']);
			$paid = $this->db->get()->result_array();
			$result=array();
			foreach($paid as $key=>$value){
				$skill_id =  $value['skill_id'];
				$skill_name =  $value['skill_name'];
				$this->db->select('s.*,sk.id as skill_id, sk.skill as skill_name,u.id as posted_by,u.name as posted_name,');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
				$this->db->join('skills sk', 'p.skill = sk.id','left');
				$this->db->join('users u', 'p.posted_by = u.id','left');
				$this->db->where('p.skill', $skill_id);
				$this->db->where('s.buyerId', $params['session_user']);
				$resultViewedContacts = $this->db->get()->result_array();
				$result[$skill_id]= $resultViewedContacts;
		 // sub notifications others Viewed Contacts same Skill
		 foreach($resultViewedContacts as $key=>$val){
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name,u.name');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.pid',$val['post_id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);
				$whereStatus=array('0','1');
				$this->db->where_in('s.status', $whereStatus);
			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$skill_id][$key]['shortlist']=$othershort;
			}else{
				$result[$skill_id][$key]['shortlist']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name,u.name');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['post_id']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$skill_id][$key]['otherviewed']=$otherviewed;
			}else{
				$result[$skill_id][$key]['otherviewed']=array();
			}
		 }

		 }
			return $result;
	}
	private function ShortlistsSkills($params){

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$post_type='(s.post_type="3" or s.post_type = "4" or s.post_type = "5")';
			$this->db->where($post_type);
			$this->db->where('s.posted_by', $params['session_user']);
			$whereStatus=array('0','1');
			$this->db->where_in('s.status', $whereStatus);
			$fromYou = $this->db->get()->result_array();
		$result= array();	
		$mrg = array_filter($fromYou);
		foreach($mrg as $k=>$value){
			$othershort=array();
			$skill_id =  $value['skill_id'];
			$skill_name =  $value['skill_name'];
			$this->db->select('s.*,sk.id as skill_id, sk.skill as skill_name,u.id as posted_by,,u.name as posted_name,u.email,u.mobile');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.skill', $skill_id);
			$this->db->where('s.posted_by ', $params['session_user']);
			$whereStatus=array('0','1');
			$this->db->where_in('s.status', $whereStatus);
		 $resultshorlists= $this->db->get()->result_array();
		 $result[$skill_id] = $resultshorlists;
		 // sub notifications others Shortlists same Skill
		 foreach($resultshorlists as $key=>$val){
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name, u.name, u.email, u.mobile');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.pid',$val['pid']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);
			$whereStatus=array('0','1');
			$this->db->where_in('s.status', $whereStatus);
			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$skill_id][$key]['shortlist']=$othershort;
			}else{
				$result[$skill_id][$key]['shortlist']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,sk.id as skill_id,sk.skill as skill_name,u.name ,u.email, u.mobile');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
			$this->db->join('skills sk', 'p.skill = sk.id','left');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['pid']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$skill_id][$key]['otherviewed']=$otherviewed;
			}else{
				$result[$skill_id][$key]['otherviewed']=array();
			}

			$this->db->select('s.*');
			$this->db->from('vh_notification s');
			$this->db->where('s.post_id',$val['pid']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.to_id', $params['session_user']);
			$notific=array('45','46','47');
			$this->db->where_in('s.notification_type', $notific);
			$noValid = $this->db->get()->result_array();
			if(!empty($noValid)){
				$result[$skill_id][$key]['noValid']=$noValid;
			}else{
				$result[$skill_id][$key]['noValid']=array();
			}




		 }

		}
		return $result;
		
	}
	private function ShortlistsIndustry($params){
		
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->where($params['post_type']);
			$this->db->where('s.posted_by', $params['session_user']);
			$whereStatus=array('0','1');
			$this->db->where_in('s.status', $whereStatus);
			$fromYou = $this->db->get()->result_array();
		$result= array();	
		$mrg = array_filter($fromYou);
		foreach($mrg as $k=>$value){
			$industry_id =  $value['industry_id'];
			$industry_name =  $value['industry_name'];
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name,u.id as posted_by,,u.name as posted_name,u.email,u.mobile');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 'p.posted_by = u.id','left');
			$this->db->where('p.industry', $industry_id);
			$this->db->where($params['post_type']);
			$this->db->where('s.posted_by', $params['session_user']);
			$whereStatus=array('0','1');
			$this->db->where_in('s.status', $whereStatus);
			$resultshorlists =  $this->db->get()->result_array();
			$result[$industry_id]=$resultshorlists;

		// sub notifications others Shortlists By same Industry
		
		 foreach($resultshorlists as $key=>$val){
			$otherviewed=array();
			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name, u.name');
			$this->db->from('vh_shortlistprofiles s');
			$this->db->join('vh_posts p', 's.pid = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 's.posted_by = u.id','left');
			$this->db->where('s.pid',$val['pid']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.posted_by !=', $params['session_user']);
			$whereStatus=array('0','1');
			$this->db->where_in('s.status', $whereStatus);
			$othershort = $this->db->get()->result_array();
			if(!empty($othershort)){
				$result[$industry_id][$key]['shortlist']=$othershort;
			}else{
				$result[$industry_id][$key]['shortlist']=array();
			}

			$this->db->order_by("s.id", "desc");	
			$this->db->select('s.*,in.id as industry_id,in.industry as industry_name, u.name ,u.email,u.mobile');
			$this->db->from('vh_paidcontacts s');
			$this->db->join('vh_posts p', 's.post_id = p.p_id','left');
			$this->db->join('industries in', 'p.industry = in.id','left');
			$this->db->join('users u', 's.buyerId = u.id','left');
			$this->db->where('s.post_id',$val['pid']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.buyerId !=', $params['session_user']);

			$otherviewed = $this->db->get()->result_array();
			if(!empty($otherviewed)){
				$result[$industry_id][$key]['otherviewed']=$otherviewed;
			}else{
				$result[$industry_id][$key]['otherviewed']=array();
			}
			$this->db->select('s.*');
			$this->db->from('vh_notification s');
			$this->db->where('s.post_id',$val['pid']);
			$this->db->where('s.post_type',$val['post_type']);
			$this->db->where('s.to_id', $params['session_user']);
			$notific=array('43','44');
			$this->db->where_in('s.notification_type', $notific);
			$noValid = $this->db->get()->result_array();
			if(!empty($noValid)){
				$result[$industry_id][$key]['noValid']=$noValid;
			}else{
				$result[$industry_id][$key]['noValid']=array();
			}

			}

		}
		return $result;
	}
	public function Proposalsold($params){
		$this->db->order_by("n.id", "desc");	
		$this->db->select('n.*,u.name,u.email,u.mobile');
		$this->db->from('vh_notification n');
		$this->db->join('users u', 'n.from_id = u.id','left');
		$this->db->where('n.from_id', $params['session_user']);
		$this->db->where('n.to_id', $params['session_user']);
		$where_status='(n.status="2" or n.status = "1")';
		$this->db->where($where_status);
		$query = $this->db->get();
		$fromYou = $query->result_array();

		$this->db->order_by("n.id", "desc");	
		$this->db->select('n.*,u.name,u.email,u.mobile');
		$this->db->from('vh_notification n');
		$this->db->join('users u', 'n.from_id = u.id','left');
		$this->db->where('n.from_id !=', $params['session_user']);
		$this->db->where('n.to_id', $params['session_user']);
		$query = $this->db->get();
		$toYou = $query->result_array();
	
		$result['fromYou']	=$fromYou;
		$result['toYou']	=$toYou;
		$result['viewham']	=array();
		return $result;
	}    

 	public function ProposalsUpdate($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_notification', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}   
 	public function PaidContactOrNot($params){
				$this->db->select('s.*,u.name,u.id as uid, u.email, u.mobile');
				$this->db->from('vh_paidcontacts s');
				$this->db->join('users u', 's.buyerId = u.id','left');
				$this->db->where('s.post_id', $params['post_id']);
				$this->db->where('s.post_type', $params['post_type']);
				$this->db->where('s.buyerId', $params['session_user']);
				$viewedContact= $this->db->get()->row_array();
				$user = $this->Userdeatilspaid($params);
				$result['viewedContact']=$viewedContact;
				$result['user']=$user;
				return $result;
	}
private function interests($params){
				$this->db->select('t.*');
				$this->db->from('vh_interests t');
				$this->db->where('post_id', $params['post_id']);
				$this->db->where('post_type', $params['post_type']);
				$this->db->where('posted_by', $params['session_user']);
				$user = $this->db->get()->row_array();
				 return $user;
	
}
private function Userdeatilspaid($params){
	$post_type = $params['post_type'];
	$table= array(
	'1'=>'vh_posts t',
	'2'=>'vh_posts t',
	'3'=>'vh_posts t',
	'4'=>'vh_posts t',
	'5'=>'vh_posts t',
	'6'=>'vh_outsource_work t',
	'7'=>'vh_franchise t',
	'8'=>'vh_funding t',
	'9'=>'vh_request_work t',
	'10'=>'vh_offerwork t',
	'11'=>'vh_ownbusiness t',
	'12'=>'ideas t',
	'13'=>'vh_initiate_idea t',
	'14'=>'vh_invest_idea t',
	);
	
	$dbtable=$table[$post_type];
	if($dbtable=='vh_posts t'){
			$where='t.p_id';
	}else{
			$where='t.id';
	}

	$this->db->select('t.*,u.name,u.id as uid, u.email, u.mobile');
				$this->db->from($dbtable);
				$this->db->join('users u', 't.posted_by = u.id','left');
				$this->db->where($where, $params['post_id']);
				$user = $this->db->get()->row_array();
				 return $user;
	
}
}