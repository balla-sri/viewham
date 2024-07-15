<?php

class Idea extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function getIdeas() {
        $query = $this->db->get('ideas');
        return $query->result_array();
    }
    
    public function savedIdeasList($user){
        $this->db->select('idea_id');
        $this->db->from('ideas_saved');
        $this->db->where('user_id', $user);
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    
    public function isSavedIdea($ideaid,$userid){
        $this->db->select('idea_id');
        $this->db->from('ideas_saved');
        $this->db->where('user_id', $userid);
        $this->db->where('idea_id', $ideaid);
        $query = $this->db->get();
        $result = $query->result_array();
        if(count($result)>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteSavedIdea($array){
        return $this->db->delete('ideas_saved', $array);  
    }
    
    public function insertSavedIdea($array){
        return $this->db->insert('ideas_saved', $array);
    }
    
    public function getIdea($params=array()){

        $params['id'] = isset($params['id'])? $params['id']:0;
        $params['industry'] = (isset($params['industry']) && is_array($params['industry']))? $params['industry']:array();
        $params['slug'] = isset($params['slug'])? $params['slug']:'';
        $params['posted_by'] = isset($params['posted_by'])? $params['posted_by']:0;
        $params['in_query'] = isset($params['in_query'])?$params['in_query']:'';
        $params['saved_ideas'] = (isset($params['saved_ideas']) && is_array($params['saved_ideas']))? $params['saved_ideas']:array();
        $params['status'] = isset($params['status'])? $params['status']:0;
        
        $params['page'] = isset($params['page'])? $params['page']:0;
        $params['per_page'] = isset($params['per_page'])? $params['per_page']:0;
        
        
        $this->db->select('i.id as idea_id, i.idea_title, i.description,i.status,i.currency,i.min_investment,i.max_investment,i.returns_type,i.min_returns,i.max_returns,i.breakeven_type,i.min_breakeven,i.max_breakeven,in.id as industry_id, in.industry, i.posted_by, u.name,u.email, u.profile_picture, u.login_type, group_concat(t.tag_name) as tag_name, group_concat(t.slug) as slug, format(avg(feedback),1) as rating');

        $this->db->from('ideas i');
        $this->db->join('currencies c', 'i.currency = c.id','left');
        $this->db->join('industries in', 'i.industry = in.id','left');
        $this->db->join('users u', 'i.posted_by = u.id','left');
        $this->db->join('idea_tags it', 'i.id = it.idea_id','left');
        $this->db->join('tags t', 'it.tag_id = t.id','left');
        $this->db->join('idea_impress ii', 'i.id = ii.idea_id','left');
        if($params['id']!=0){
            $this->db->where('i.id', $params['id']);
        }
        if(is_array($params['industry']) && count($params['industry']) > 0){
            $this->db->where_in('in.id', $params['industry']);
        }
        if($params['slug']!=''){
            $this->db->where('t.slug', $params['slug']);
        }
        if($params['posted_by']!=0){
            $this->db->where('i.posted_by', $params['posted_by']);
        }
        if(is_array($params['saved_ideas']) && count($params['saved_ideas']) > 0){
            $this->db->where_in('i.id', $params['saved_ideas']);
        }
        if($params['per_page']!=0){
            $this->db->limit($params['per_page'], $params['page']);
        }
        if($params['status']!=0){
            $this->db->where('i.status', $params['status']);
        }
		if(!empty($params['currency'])){
			$this->db->where('i.currency ', $params['currency']);
		}
		if(!empty($params['min_investment'])){			
			$this->db->where('i.min_investment >=', $params['min_investment']);
		}		
		if(!empty($params['max_investment'])){
			$this->db->where('i.max_investment <=', $params['max_investment']);
		}        
		if(!empty($params['returns_type'])){
			$this->db->where('i.returns_type ', $params['returns_type']);
		}
		if(!empty($params['min_returns'])){			
			$this->db->where('i.min_returns >=', $params['min_returns']);
		}		
		if(!empty($params['max_returns'])){
			$this->db->where('i.max_returns <=', $params['max_returns']);
		}        
		if(!empty($params['breakeven_type'])){
			$this->db->where('i.breakeven_type ', $params['breakeven_type']);
		}
		if(!empty($params['min_breakeven'])){			
			$this->db->where('i.min_breakeven >=', $params['min_breakeven']);
		}		
		if(!empty($params['max_breakeven'])){
			$this->db->where('i.max_breakeven <=', $params['max_breakeven']);
		}        
        $this->db->order_by('i.created_at','DESC');
        $this->db->group_by('i.id');
        
        $query = $this->db->get()->result_array();

        //echo $this->db->last_query();exit;
        if(isset($params['session_user']))
		foreach($query as $k=>$val){
			$query[$k]['is_invest']=	$this->investedOrNot($val['idea_id'],$params['session_user']);
			$query[$k]['is_initiate']=	$this->initiateOrNot($val['idea_id'],$params['session_user']);
		}        
        return $query;

    }
    
    private function investedOrNot($idea_id,$session_user){
        $this->db->from('vh_invest_idea i');
        $this->db->where('i.idea_id', $idea_id);
        $this->db->where('i.posted_by', $session_user);
        $query = $this->db->get();
        return $query->row_array();
	}
    private function initiateOrNot($idea_id,$session_user){
        $this->db->from('vh_initiate_idea i');
        $this->db->where('i.idea_id', $idea_id);
        $this->db->where('i.posted_by', $session_user);
        $query = $this->db->get();
        return $query->row_array();
	}
    public function getIdeaDetails($id){
		$session_user = $this->session->userdata('user'); 
        $this->db->select('i.id as idea_id, i.idea_title,c.currency,c.notation, i.min_investment, i.max_investment, i.returns_type, i.min_returns, i.max_returns, i.breakeven_type, i.min_breakeven, i.max_breakeven, i.industry,i.posted_by');
        $this->db->from('ideas i');
        $this->db->join('currencies c', 'i.currency = c.id','left');
        //$this->db->join('industries in', 'i.industry = in.id','left');
        //$this->db->join('users u', 'i.posted_by = u.id','left');
        $this->db->where('i.id', $id);
        $query = $this->db->get()->row_array();
		$query['is_invest']=	$this->investedOrNot($id,$session_user);
		$query['is_initiate']=	$this->initiateOrNot($id,$session_user);
        return $query;
    }
    
    public function getResourceDetails($id){
        $this->db->select('i.id as idea_id,s.skill,ir.quantity');
        $this->db->from('ideas i');
        $this->db->join('idea_resources ir', 'i.id = ir.idea_id');
        $this->db->join('skills s', 'ir.skill_id = s.id','left');
        $this->db->where('i.id', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function InsertIdea($array){
        $created_at = date("Y-m-d H:i:s",time());
        
        $idea['idea_title'] = $array['title'];
        $idea['description'] = $array['description'];
        $idea['industry'] = $array['industry'];
        $idea['currency'] = $array['currency'];
        $idea['min_investment'] = $array['min_invest'];
        $idea['max_investment'] = $array['max_invest'];
        $idea['returns_type'] = $array['returns_type'];
        $idea['min_returns'] = $array['min_return'];
        $idea['max_returns'] = $array['max_return'];
        $idea['breakeven_type'] = $array['breakeven_type'];
        $idea['min_breakeven'] = $array['breakeven_min'];
        $idea['max_breakeven'] = $array['breakeven_max'];
        $idea['posted_by'] = $array['posted_by'];
        $idea['status'] = 1;
        $idea['created_at'] = $created_at;
        $idea['updated_at'] = $created_at;
        
        $this->db->trans_begin();
        
        $this->db->insert('ideas', $idea);
        $ideaid = $this->db->insert_id();

        
        if(is_array($array['resourse'])){
            foreach($array['resourse'] as $key=>$resource){
                $res['idea_id'] = $ideaid;
                $res['skill_id'] = $resource;
                $res['quantity'] = $array['rs_qnty'][$key];
                $res['created_at'] = $created_at;
                $res['updated_at'] = $created_at;
                $this->db->insert('idea_resources', $res);
            }
        }
        
        if(is_array($array['tags'])){
            foreach($array['tags'] as $key1=>$tag){
                $tags['idea_id'] = $ideaid;
                $tags['tag_id'] = $tag;
                $tags['created_at'] = $created_at;
                $tags['updated_at'] = $created_at;
                $this->db->insert('idea_tags', $tags);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function getComments($uid){
        $this->db->order_by("comment_id","desc");
        $query = $this->db->get_where('comments', array('post_id'=>$uid,'parent_id'=>'0'));
        return $query->result_array();
    }
    
    public function InsertReportIdea($data = array()) {
        $insert = $this->db->insert('report_idea', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    
    public function checkFeedbackIdea($uid,$ideaid){
        $query = $this->db->get_where('idea_impress', array('posted_by' => $uid,'idea_id' => $ideaid));
        return $query->row_array();
    }
    
    public function UpdateFeedbackIdea($userData,$session_user,$ideaid){
        if(!empty($userData) && !empty($session_user)){
            $update = $this->db->update('idea_impress', $userData, array('posted_by'=>$session_user,'idea_id'=>$ideaid));
            return $update?true:false;
        }else{
            return false;
        }
    }
    
    public function InsertFeedbackIdea($data = array()) {
        if(!array_key_exists('created', $data)){
                $data['create_date'] = date("Y-m-d H:i:s");
        }
        $insert = $this->db->insert('idea_impress', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    public function Postfeedback_byId($id){
        $this->db->select('format(avg(feedback),1) as rating');
        $this->db->from('idea_impress');
        $this->db->where('idea_id', $id);
        $this->db->group_by('idea_id');
        $query = $this->db->get();
        return $query->row_array();
    } 
    public function ignoreIdea($data = array()) {
        $insert = $this->db->insert('vh_ideas_ignore', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function initiates($params){ 
			$resources=array();
			$skillProfiles=array();
	        $this->db->order_by('i.id','DESC');
			$this->db->group_by('idea.id');
			$this->db->select('i.id as ini_id,i.*, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type, idea.*,idea.industry as industry_id, in.industry, format(avg(feedback),1) as rating');
			$this->db->from('vh_initiate_idea i');
			$this->db->join('ideas idea', 'i.idea_id = idea.id','left');
			$this->db->join('industries in', 'idea.industry = in.id','left');
			$this->db->join('users u', 'idea.posted_by = u.id','left');
            $this->db->join('idea_impress ii', 'i.id = ii.idea_id','left');
			$qry = $this->db->get()->result_array();
            $result = array();
			foreach($qry as $key=>$value){
				$result[$key]=$value;
				$resource= $this->db->get_where('idea_resources', array('idea_id'=>$value['idea_id']))->result_array();
			
				foreach($resource as $k=>$skill){
					$skill_id=$skill['skill_id'];
					$resources[$skill_id] = $this->db->get_where('skills', array('id'=>$skill['skill_id']))->row_array();					
					$this->db->select('p.*,s.id as skill_id,s.skill as skill_name, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type');
					$this->db->from('vh_posts p');
					$this->db->join('skills s', 'p.skill = s.id','left');
					$this->db->join('users u', 'p.posted_by = u.id','left');
					$this->db->where('p.skill', $skill_id);					
					$skillProfiles[$skill_id] = $this->db->get()->result_array();		
						foreach($skillProfiles[$skill_id] as $k=>$val){
							if(!empty($params['session_user'])){
								$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['p_id'],'post_type'=>$val['post_type']))->row_array();	
								$skillProfiles[$skill_id][$k]['paid']=$paid;
								$shortlist = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$val['p_id'],'post_type'=>$val['post_type']))->row_array();	
								$skillProfiles[$skill_id][$k]['shortlist']=$shortlist;
						}else{
								$skillProfiles[$skill_id]['paid']='';
								$skillProfiles[$skill_id]['shortlist']='';
							}
						}
					}
				$this->db->order_by('p.id','DESC');
				$this->db->select('p.*, u.id as uid,u.name,s.skill as skill_name, u.email, u.mobile,u.login_type');
				$this->db->from('vh_initiate_idea p');
				$this->db->join('skills s', 'p.role = s.id','left');
				$this->db->join('users u', 'p.posted_by = u.id','left');
				$this->db->where('p.idea_id', $value['idea_id']);					
				$Profiles = $this->db->get()->result_array();		
				$result[$key]['iniProfiles']=$Profiles;
				foreach($Profiles as $k=>$val){
					if(!empty($params['session_user'])){
						$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
						$result[$key]['iniProfiles'][$k]['paid']=$paid;
						$shortlist = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
						$result[$key]['iniProfiles'][$k]['shortlist']=$shortlist;
					}else{
						$result[$key]['iniProfiles'][$k]['paid']='';
						$result[$key]['iniProfiles'][$k]['shortlist']='';
					}
				}
				$this->db->order_by('p.id','DESC');
				$this->db->select('p.*, u.id as uid,u.name,s.skill as skill_name, u.email, u.mobile,u.login_type');
				$this->db->from('vh_invest_idea p');
				$this->db->join('skills s', 'p.role = s.id','left');
				$this->db->join('users u', 'p.posted_by = u.id','left');
				$this->db->where('p.idea_id', $value['idea_id']);					
				$investProfiless = $this->db->get()->result_array();		
				$result[$key]['investProfiles']=$investProfiless;
				foreach($investProfiless as $k=>$val){
					if(!empty($params['session_user'])){
						$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
						$result[$key]['investProfiles'][$k]['paid']=$paid;
						$shortlist = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
						$result[$key]['investProfiles'][$k]['shortlist']=$shortlist;
					}else{
						$result[$key]['investProfiles'][$k]['paid']='';
						$result[$key]['investProfiles'][$k]['shortlist']='';
						}
				}
			
				$result[$key]['resources']=$resources;
				$result[$key]['skillProfiles']=$skillProfiles;
    		}
    //		echo "<pre>"; print_r($result); exit;
    		return $result;
	}
	public function investAll($params){ 
			$resources='';
			$skillProfiles='';
	        $this->db->order_by('i.id','DESC');
			$this->db->select('i.id as inv_id,i.*, u.id as uid,u.name, u.email, u.mobile, u.profile_picture, u.login_type, idea.*,idea.industry as industry_id,in.industry, format(avg(feedback),1) as rating');
			$this->db->from('vh_invest_idea i');
			$this->db->join('ideas idea', 'i.idea_id = idea.id','left');
			$this->db->join('industries in', 'idea.industry = in.id','left');
			$this->db->join('users u', 'i.posted_by = u.id','left');
            $this->db->join('idea_impress ii', 'i.id = ii.idea_id','left');
			$qry = $this->db->get()->result_array();
            $result = array();
			foreach($qry as $key=>$value){
				$result[$key]=$value;
				$this->db->select('p.*, u.id as uid,u.name,s.skill as skill_name, u.email, u.mobile,u.login_type');
				$this->db->from('vh_initiate_idea p');
				$this->db->join('skills s', 'p.role = s.id','left');
				$this->db->join('users u', 'p.posted_by = u.id','left');
				$this->db->where('p.idea_id', $value['idea_id']);					
				$Profiles = $this->db->get()->result_array();		
				$result[$key]['Initiators']=$Profiles;
					foreach($Profiles as $k=>$val){
					if(!empty($params['session_user'])){
						$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
						$result[$key]['Initiators'][$k]['paid']=$paid;
						$shortlist = $this->db->get_where('vh_shortlistprofiles', array('posted_by'=>$params['session_user'],'pid'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
						$result[$key]['Initiators'][$k]['shortlist']=$shortlist;						
					}else{
						$result[$key]['Initiators'][$k]['paid']='';
						$result[$key]['Initiators'][$k]['shortlist']=$shortlist;
					}
				}
			}
		return $result;
	}	
    public function InsertInitiateIdea($data = array()) {
        $insert = $this->db->insert('vh_initiate_idea', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function InsertInvestIdea($data = array()) {
        $insert = $this->db->insert('vh_invest_idea', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function InsertInitiatAll($data = array()) {
        $insert = $this->db->insert('vh_initiatesall', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function InsertInvestAll($data = array()) {
        $insert = $this->db->insert('vh_investall', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
}
?>