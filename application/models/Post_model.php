<?php

class Post_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		$this->load->database();
    }
	function getTags(){
	        $query = $this->db->get_where('vh_tags');
	        return $query->result_array();
	}
	
	function sendEmailotp($email,$otpn){
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8'); 
		$this->email->set_header('Content-type', 'text/html'); 

		$this->email->from('ajayviewham@gmail.com', 'Viewham');
		$this->email->to($email);
		$this->email->reply_to($email);
		$this->email->subject('Viewham');
		$lnki = 'https://viewham.com/User/Verifyemail/'.$otpn;
                $this->email->message('Welcome To Viewham. <br><br>  veification link <a href="https://viewham.com/User/Verifyemail/'.$otpn.'">Verify Here</a> ');
               if($this->email->send()) {
				   return 'sent';
			   }else{
				  return 'not sent'; 
			   }	
	}
	function sendsmsotp($phone,$otpn){

		$textmessage = urlencode($otpn);
		$service_url ='https://sms.office24by7.com/API/sms.php?username=9492973688&password=NiN0cPZl&from=VIEWHA&to='.$phone.'&msg='.$textmessage.'&type=1';
		$ch = curl_init($service_url);
		$timeout  =  30;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
		$content  = curl_exec($ch);
		curl_close($ch);
		return $service_url;	
	}
    function getindustry(){
        $query = $this->db->get_where('vh_master_data', array('REFGRP' => 'INDSTY'));
        return $query->result_array();
    }

    function getindustryby($id){
        $query = $this->db->get_where('vh_master_data', array('ID' => $id));
        return $query->row_array();
    }
    function franchize_offers($id=''){
		if(!empty($id)){
			$query = $this->db->get_where('vh_franchize', array('id' => $id));
			return $query->row_array();
		}else{
		if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['investment_currency'])){
			$investment_currency=$_GET['investment_currency'];
			$this->db->where('investment_currency ', $investment_currency);
		}
		if(!empty($_GET['min_invest'])){
			$min_invest=$_GET['min_invest'];
			$this->db->where('min_invest >=', $min_invest);
		}
		if(!empty($_GET['max_invest'])){
			$max_invest=$_GET['max_invest'];
			$this->db->where('max_invest <=', $max_invest);
		}
		if(!empty($_GET['income_min'])){
			$income_min=$_GET['income_min'];
			$this->db->where('income_min >=', $income_min);
		}
		if(!empty($_GET['income_max'])){
			$income_max=$_GET['income_max'];
			$this->db->where('income_max <=', $income_max);
		}
		if(!empty($_GET['income_type'])){
			$income_type=$_GET['income_type'];
			$this->db->where('income_type ', $income_type);
		}
		if(!empty($_GET['break_even_type'])){
			$break_even_type=$_GET['break_even_type'];
			$this->db->where('break_even_type ', $break_even_type);
		}
		if(!empty($_GET['min_break_even'])){
			$min_break_even=$_GET['min_break_even'];
			$this->db->where('min_break_even >=', $min_break_even);
		}
		if(!empty($_GET['max_break_even'])){
			$max_break_even=$_GET['max_break_even'];
			$this->db->where('max_break_even <=', $max_break_even);
		}
		}	
        $query = $this->db->get_where('vh_franchize');
        return $query->result_array();
		}
    }
    function Outsource_offers($id=''){
		if(!empty($id)){
			$query = $this->db->get_where('vh_outsource_work', array('id' => $id));
			return $query->row_array();
		}else{
		if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
	
		if(!empty($_GET['duration_min'])){
			$duration_min=$_GET['duration_min'];
			$this->db->where('duration_min >=', $duration_min);
		}
		if(!empty($_GET['duration_max'])){
			$duration_max=$_GET['duration_max'];
			$this->db->where('duration_max <=', $duration_max);
		}
		if(!empty($_GET['min_invest'])){
			$min_invest=$_GET['min_invest'];
			$this->db->where('min_invest >=', $min_invest);
		}
		if(!empty($_GET['max_invest'])){
			$max_invest=$_GET['max_invest'];
			$this->db->where('max_invest <=', $max_invest);
		}
		if(!empty($_GET['investment_currency'])){
			$investment_currency=$_GET['investment_currency'];
			$this->db->where('currency_type ', $investment_currency);
		}
		if(!empty($_GET['duration_type'])){
			$duration_type=$_GET['duration_type'];
			$this->db->where('duration_type ', $duration_type);
		}
		}	
        $query = $this->db->get_where('vh_outsource_work');
        return $query->result_array();
		}
    } 
	function reuest_works($id=''){
		if(!empty($id)){
			$query = $this->db->get_where('vh_request_work', array('id' => $id));
			return $query->row_array();
		}else{
        $query = $this->db->get_where('vh_request_work');
        return $query->result_array();
		}
    }
	function responsesFranchize($id,$type){
		
        $query = $this->db->get_where('vh_notification', array('post_id' => $id,'notification_type' => $type,));
        return $query->result_array();
		
    } 
	function Work_offers($id=''){
		if(!empty($id)){
			$query = $this->db->get_where('vh_offer_a_work', array('id' => $id));
			return $query->row_array();
		}else{
		if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('skills', $industrkey[$i]);
			
			}else{
			$this->db->or_where('skills', $industrkey[$i]);
			}
			}
		}
		if(!empty($_GET['experience'])){
			$experience=$_GET['experience'];
			$this->db->where('experience', $experience);
		}
		if(!empty($_GET['work_type'])){
			$work_type=$_GET['work_type'];
			$this->db->where('work_type', $work_type);
		}
		if(!empty($_GET['min_sal'])){
			$min_sal=$_GET['min_sal'];
			$this->db->where('min_sal >=', $min_sal);
		}
		if(!empty($_GET['max_sal'])){
			$max_sal=$_GET['max_sal'];
			$this->db->where('max_sal <=', $max_sal);
		}
	  }	
        $query = $this->db->get_where('vh_offer_a_work');
        return $query->result_array();
		}
    }
	function getlocation(){
        $query = $this->db->get_where('vh_country');
        return $query->result_array();
    }
    function getlocationbyid($id){
        $query = $this->db->get_where('vh_country', array('c_code' => $id));
        return $query->row_array();
    }
	function getskils(){
        $query = $this->db->get_where('vh_master_data', array('REFGRP' => 'SKILL'));
        $master_skills = $query->result_array();
        $query = $this->db->get_where('vh_skills_list', array('status' => 1));
        $new_skills = $query->result_array();
        $newarray = array();
        if(is_array($new_skills)){
            foreach ($new_skills as $key=>$skill){
                $newarray[$key]['ID'] = 'S-'.$skill['id'];
                $newarray[$key]['SDESC'] = $skill['skill_name'];
            }
        }
        $final_array = array_merge($master_skills,$newarray);
        return $final_array;
        
    }
	function getskilsbyid($id=''){
        $query = $this->db->get_where('vh_master_data', array('REFGRP' => 'SKILL','ID'=>$id));
        return $query->row_array();
    }
	function AjaxSkillsByKeyword($key=''){
		$this->db->limit(5); 
		$this->db->from('vh_master_data');
		$this->db->like('SDESC', $key, 'after');
		return $this->db->get()->result_array();

    }
	/*
     * Insert POst  data
     */
	function Postfeedback_byId($id){
        $query = $this->db->get_where('vh_idea_impress', array('idea_id' =>$id));
        return $query->result_array();
    } 
	function checkFeedbackIdea($uid,$ideaid){
        $query = $this->db->get_where('vh_idea_impress', array('posted_by' => $uid,'idea_id' => $ideaid));
        return $query->row_array();
    }
	function checkLikeComment($uid,$ideaid){
        $query = $this->db->get_where('vh_comments_likes', array('posted_by' => $uid,'comment_id' => $ideaid));
        return $query->row_array();
    }
	function idea_check_saved($ideaid,$uid,$saved){
        $query = $this->db->get_where('vh_saved_ideas', array('uid' => $uid,'idea_id' => $ideaid,'saved' => $saved));
        return $query->row_array();
    }
	function idea_check_savedcount($uid,$saved){
        $query = $this->db->get_where('vh_saved_ideas', array('uid' => $uid,'saved' => $saved));
        return $query->result_array();
    } 
	function idea_check_savedbyuser($uid,$saved){
        $query = $this->db->get_where('vh_saved_ideas', array('uid' => $uid,'saved' => $saved));
        return $query->result_array();
    } 
	function getIdeasPostedPagenation($uid,$limit, $start){
		$this->db->limit($limit, $start);
		$this->db->order_by("ID","desc");
		if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['ret_min'])){
			$ret_min=$_GET['ret_min'];
			$this->db->where('MIN_RETURNS >=', $ret_min);
		}
		if(!empty($_GET['ret_max'])){
			$ret_max=$_GET['ret_max'];
			$this->db->where('MAX_RETURNS <=', $ret_max);
		}
		if(!empty($_GET['min_inv'])){
			$min_inv=$_GET['min_inv'];
			$this->db->where('MIN_INVESTMENT >=', $min_inv);
		}
		if(!empty($_GET['max_inv'])){
			$max_inv=$_GET['max_inv'];
			$this->db->where('MAX_INVESTMENT <=', $max_inv);
		}
		if(!empty($_GET['break_min'])){
			$break_min=$_GET['break_min'];
			$this->db->where('MIN_BREAKEVEN >=', $break_min);
		}
		if(!empty($_GET['break_max'])){
			$break_max=$_GET['break_max'];
			$this->db->where('MAX_BREAKEVEN <=', $break_max);
		}
			
		 
	 }
        $query = $this->db->get_where('vh_idea_hub', array('POSTED_BY' => $uid,'post_type !=' => 'ownbusiness'));
        $ideas =  $query->result_array();
        $ideaswithtags= $this->getIdeasTagsAndSkills($ideas);
        return $ideaswithtags;
    }
	function getIdeasPosted($uid){
			 if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['ret_min'])){
			$ret_min=$_GET['ret_min'];
			$this->db->where('MIN_RETURNS >=', $ret_min);
		}
		if(!empty($_GET['ret_max'])){
			$ret_max=$_GET['ret_max'];
			$this->db->where('MAX_RETURNS <=', $ret_max);
		}
		if(!empty($_GET['min_inv'])){
			$min_inv=$_GET['min_inv'];
			$this->db->where('MIN_INVESTMENT >=', $min_inv);
		}
		if(!empty($_GET['max_inv'])){
			$max_inv=$_GET['max_inv'];
			$this->db->where('MAX_INVESTMENT <=', $max_inv);
		}
		if(!empty($_GET['break_min'])){
			$break_min=$_GET['break_min'];
			$this->db->where('MIN_BREAKEVEN >=', $break_min);
		}
		if(!empty($_GET['break_max'])){
			$break_max=$_GET['break_max'];
			$this->db->where('MAX_BREAKEVEN <=', $break_max);
		}
			
		 
	 }
		$this->db->order_by("ID","desc");
        $query = $this->db->get_where('vh_idea_hub', array('POSTED_BY' => $uid));
        return $query->result_array();
    }
	function idea_get_intiatedidea($ideaid,$uid){
        $query = $this->db->get_where('vh_initiate_idea', array('idea_id'=>$ideaid,'POSTED_BY' => $uid));
        return $query->row_array();
    }
	function idea_get_investedidea($ideaid,$uid){
        $query = $this->db->get_where('vh_invest_idea', array('idea_id'=>$ideaid,'POSTED_BY' => $uid));
        return $query->row_array();
    }
	function getIdeasInitia($uid){
				 if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('vh_idea_hub.INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('vh_idea_hub.INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['ret_min'])){
			$ret_min=$_GET['ret_min'];
			$this->db->where('vh_idea_hub.MIN_RETURNS >=', $ret_min);
		}
		if(!empty($_GET['ret_max'])){
			$ret_max=$_GET['ret_max'];
			$this->db->where('vh_idea_hub.MAX_RETURNS <=', $ret_max);
		}
		if(!empty($_GET['min_inv'])){
			$min_inv=$_GET['min_inv'];
			$this->db->where('vh_idea_hub.MIN_INVESTMENT >=', $min_inv);
		}
		if(!empty($_GET['max_inv'])){
			$max_inv=$_GET['max_inv'];
			$this->db->where('vh_idea_hub.MAX_INVESTMENT <=', $max_inv);
		}
		if(!empty($_GET['break_min'])){
			$break_min=$_GET['break_min'];
			$this->db->where('vh_idea_hub.MIN_BREAKEVEN >=', $break_min);
		}
		if(!empty($_GET['break_max'])){
			$break_max=$_GET['break_max'];
			$this->db->where('vh_idea_hub.MAX_BREAKEVEN <=', $break_max);
		}
			
		 
	 }
		
		$this->db->join('vh_idea_hub', 'vh_initiate_idea.idea_id = vh_idea_hub.ID');
		$this->db->where('vh_initiate_idea.posted_by', $uid);
        $query = $this->db->get('vh_initiate_idea');
        return $query->result_array();
    } 
	function getIdeasInvest($uid){
				 if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('vh_idea_hub.INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('vh_idea_hub.INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['ret_min'])){
			$ret_min=$_GET['ret_min'];
			$this->db->where('vh_idea_hub.MIN_RETURNS >=', $ret_min);
		}
		if(!empty($_GET['ret_max'])){
			$ret_max=$_GET['ret_max'];
			$this->db->where('vh_idea_hub.MAX_RETURNS <=', $ret_max);
		}
		if(!empty($_GET['min_inv'])){
			$min_inv=$_GET['min_inv'];
			$this->db->where('vh_idea_hub.MIN_INVESTMENT >=', $min_inv);
		}
		if(!empty($_GET['max_inv'])){
			$max_inv=$_GET['max_inv'];
			$this->db->where('vh_idea_hub.MAX_INVESTMENT <=', $max_inv);
		}
		if(!empty($_GET['break_min'])){
			$break_min=$_GET['break_min'];
			$this->db->where('vh_idea_hub.MIN_BREAKEVEN >=', $break_min);
		}
		if(!empty($_GET['break_max'])){
			$break_max=$_GET['break_max'];
			$this->db->where('vh_idea_hub.MAX_BREAKEVEN <=', $break_max);
		}
			
		 
	 }		
		$this->db->join('vh_idea_hub', 'vh_invest_idea.idea_id = vh_idea_hub.ID');
		$this->db->where('vh_invest_idea.posted_by', $uid);
        $query = $this->db->get('vh_invest_idea');
        return $query->result_array();
    } 
	function getComments($uid){
		$this->db->order_by("comment_id","desc");
		  $query = $this->db->get_where('vh_comments', array('post_id'=>$uid,'parent_id'=>'0'));
        return $query->result_array();
    } 
	function getSubComments($uid){
		$this->db->order_by("comment_id","desc");
		  $query = $this->db->get_where('vh_comments', array('parent_id'=>$uid));
        return $query->result_array();
    } 
	function getCommentbyid($uid){
		$this->db->order_by("comment_id","desc");
		  $query = $this->db->get_where('vh_comments', array('comment_id'=>$uid));
        return $query->row_array();
    }
	function investorsByIdea($id){
	$query = $this->db->get_where('vh_invest_idea', array('idea_id'=>$id));
    return $query->result_array();
    }
	function initiatersByIdea($id){
	$query = $this->db->get_where('vh_initiate_idea', array('idea_id'=>$id));
    return $query->result_array();
    }
	function initiatersByOwnBusiness($id){
	$query = $this->db->get_where('vh_initiatesall', array('post_id'=>$id));
    return $query->result_array();
    } 		
    public function InsertComment($data = array()) {
	   $insert = $this->db->insert('vh_comments', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function Insertearnprofile($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_utimings', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function Insert_franchize($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_franchize', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	
	public function Insert_outsource($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_outsource_work', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function Insert_offer_work($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_offer_a_work', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function Insert_funding($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['CREATED_DATE'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_funding', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function Insert_request_work($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['CREATED_DATE'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_request_work', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InsertinvestIdea($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_invest_idea', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InsertInitiateIdea($data = array()) {
		
        $insert = $this->db->insert('vh_initiate_idea', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function idea_saved($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_saved_ideas', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InsertReportIdea($data = array()) {
		$insert = $this->db->insert('vh_report_idea', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InsertFeedbackIdea($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_idea_impress', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InsertCommentLike($data = array()) {
		
        $insert = $this->db->insert('vh_comments_likes', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function idea_check_unsave($ideaid,$uid,$saved){
        $delete = $this->db->delete('vh_saved_ideas',array('uid' => $uid,'idea_id' => $ideaid,'saved' => $saved));
        return $delete?true:false;
    }
	public function deleteIdeaByuser($ideaid,$uid){
        $delete = $this->db->delete('vh_idea_hub',array('ID' => $ideaid,'POSTED_BY' => $uid));
        return $delete?true:false;
    }
	public function IgnoreReportIdea($ideaid,$uid){
        $delete = $this->db->delete('vh_initiate_idea',array('posted_by' => $uid,'idea_id' => $ideaid));
        return $delete?true:false;
    }
    function usertimings($id = "",$from){
 			$query = $this->db->get_where('vh_utimings', array('u_id' => $id,'from_from' => $from));
            return $query->result_array();
    }
    function usertimingsByday($id,$from,$day){
 			$query = $this->db->get_where('vh_utimings', array('u_id' => $id,'from_from' => $from,'day' => $day));
            return $query->result_array();
    }
    function skills_profiles($id = ""){
 			$where='(post_type="Mediator" or post_type = "Profile" or post_type = "Hobby")';
			$query = $this->db->where('posted_by',$id);
			$query = $this->db->where($where);			
 			$query = $this->db->get('vh_posts');
            return $query->result_array();
    }
    function skill_byid($id,$profileskil){
 			$query = $this->db->get_where('vh_posts', array('posted_by' => $id,'p_id'=>$profileskil));
            return $query->row_array();
    }
	function skill_byskill($id,$profileskil){
 			$query = $this->db->get_where('vh_posts', array('posted_by' => $id,'skill'=>$profileskil));
            return $query->row_array();
    } 
	function skill_bygainid($id,$profileskil){
 			$query = $this->db->get_where('vh_posts', array('posted_by' => $id,'post_type'=>$profileskil));
            return $query->row_array();
    }
    function checkskill_byuser($userid,$profileskil){
 			$query = $this->db->get_where('vh_posts', array('posted_by' => $userid,'skill'=>$profileskil));
            return $query->row_array();
    }
	function checkEntrepreneur_byuser($userid,$profileskil){
 			$query = $this->db->get_where('vh_posts', array('posted_by' => $userid,'post_type'=>$profileskil));
            return $query->row_array();
    }
    public function Insertgain($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modified_date', $data)){
			$data['modified_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_posts', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	
	public function Updateusertiming($id,$userData){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_utimings', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function UpdateEarnprofile($id,$userData){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_posts', $userData, array('p_id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function updateInitiateIdea($userData,$ideaid,$postinid){
		 if(!empty($userData) && !empty($ideaid)&& !empty($postinid)){
            $update = $this->db->update('vh_initiate_idea', $userData, array('id'=>$postinid,'idea_id'=>$ideaid));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function updateInvesteIdea($userData,$ideaid,$postinid){
		 if(!empty($userData) && !empty($ideaid)&& !empty($postinid)){
			 
            $update = $this->db->update('vh_invest_idea', $userData, array('id'=>$postinid,'idea_id'=>$ideaid));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function UpdateFeedbackIdea($userData,$session_user,$ideaid){
		 if(!empty($userData) && !empty($session_user)){
         $update = $this->db->update('vh_idea_impress', $userData, array('posted_by'=>$session_user,'idea_id'=>$ideaid));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function UpdateCommentLike($userData,$session_user,$ideaid){
		 if(!empty($userData) && !empty($session_user)){
         $update = $this->db->update('vh_comments_likes', $userData, array('posted_by'=>$session_user,'comment_id'=>$ideaid));
            return $update?true:false;
        }else{
            return false;
        }
	}
	public function DeleteUserday($id,$day){
        $delete = $this->db->delete('vh_utimings',array('id'=>$day,'u_id'=>$id));
        return $delete?true:false;
    }
    public function insertSkill($skill,$user){
        $data['skill_name'] = $skill;
        $data['status'] = '2'; //pending
        $data['created_by'] = $user;
        
        $insert = $this->db->insert('vh_skills_list', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function getIdeasTagsAndSkills($ideas){
        $ideaswithtags = array();
	foreach($ideas as $idea){
            $tagstext = '';
            if(isset($idea['TAGS']) && strlen($idea['TAGS'])>0){
                $tags = explode(",",$idea['TAGS']);
                foreach($tags as $tagid){
                    $query = $this->db->get_where('vh_tags', array('id' => $tagid));
                    $tagsdata = $query->row_array();
                    $tagurl = base_url("tag/".$tagsdata['slug']);
                    $tagstext = $tagstext."<a href='".$tagurl."' class='tag'>".$tagsdata['name']."</a>&nbsp;&nbsp;";
                }
            }
            $idea['TAGS'] = $tagstext;
            
            
            $a = $idea['resources'];
            $cats = explode(",", $a);
            $skills = array();
            foreach($cats as $key=>$val){
                if(is_numeric($val)){
                    $CI =& get_instance();
                    $skill = $CI->Skill($val);
                    $skill_name = array($skill['SDESC']);
                }else{
                    $skill_name = '';
                    if($val!=''){ 
                        $catid = explode('-', $val)[1];
                        $query = $this->db->get_where('vh_skills_list',array('id'=>$catid));
                        $result = $query->row_array();
                        $skill_name = array($result['skill_name'],$result['status'],$result['created_by']);
                    }
                }
                $skills[] = $skill_name;
            }
            $idea['SKILLS'] = $skills;
            $ideaswithtags[] = $idea;
        }
        return $ideaswithtags;
    }
function Fundingdetails($id=''){
		$query = $this->db->get_where('vh_funding', array('ID' => $id));
			return $query->row_array();
	}
	function FundingsByIndustry($id=''){
		if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY_ID', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY_ID', $industrkey[$i]	);
			}
			}
		}
		if(!empty($_GET['currency_id'])){
			$currency_id=$_GET['currency_id'];
			$this->db->where('CURRENCY_ID >=', $currency_id);
		}
		if(!empty($_GET['min_amount'])){
			$min_amount=$_GET['min_amount'];
			$this->db->where('MIN_AMOUNT >=', $min_amount);
		}
		if(!empty($_GET['max_amount'])){
			$max_amount=$_GET['max_amount'];
			$this->db->where('MAX_AMOUNT <=', $max_amount);
		}
		if(!empty($_GET['min_share'])){
			$min_share=$_GET['min_share'];
			$this->db->where('SHARE_MIN >=', $min_share);
		}
		if(!empty($_GET['max_share'])){
			$max_share=$_GET['max_share'];
			$this->db->where('SHARE_MAX <=', $max_share);
		}
	   }
		if(!empty($id)){
			$query = $this->db->get_where('vh_funding', array('INDUSTRY_ID' => $id));
			return $query->result_array();
		}else{
		$query = $this->db->get_where('vh_funding');
        return $query->result_array();
		}
    }
	function FundingsById($id=''){
				$query = $this->db->get_where('vh_funding', array('ID' => $id));
			return $query->row_array();
		
    }

	function OutSourceByIndustry($id=''){
				if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
	
		if(!empty($_GET['duration_min'])){
			$duration_min=$_GET['duration_min'];
			$this->db->where('duration_min >=', $duration_min);
		}
		if(!empty($_GET['duration_max'])){
			$duration_max=$_GET['duration_max'];
			$this->db->where('duration_max <=', $duration_max);
		}
		if(!empty($_GET['min_invest'])){
			$min_invest=$_GET['min_invest'];
			$this->db->where('min_invest >=', $min_invest);
		}
		if(!empty($_GET['max_invest'])){
			$max_invest=$_GET['max_invest'];
			$this->db->where('max_invest <=', $max_invest);
		}
		if(!empty($_GET['investment_currency'])){
			$investment_currency=$_GET['investment_currency'];
			$this->db->where('currency_type ', $investment_currency);
		}
		if(!empty($_GET['duration_type'])){
			$duration_type=$_GET['duration_type'];
			$this->db->where('duration_type ', $duration_type);
		}
		}	
		if(!empty($id)){

			$query = $this->db->get_where('vh_outsource_work', array('industry' => $id));
			return $query->result_array();
		}else{
		
        $query = $this->db->get_where('vh_outsource_work');
        return $query->result_array();
		}
    }
	function FranchiseByIndustry($id=''){
	if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['investment_currency'])){
			$investment_currency=$_GET['investment_currency'];
			$this->db->where('investment_currency ', $investment_currency);
		}
		if(!empty($_GET['min_invest'])){
			$min_invest=$_GET['min_invest'];
			$this->db->where('min_invest >=', $min_invest);
		}
		if(!empty($_GET['max_invest'])){
			$max_invest=$_GET['max_invest'];
			$this->db->where('max_invest <=', $max_invest);
		}
		if(!empty($_GET['income_min'])){
			$income_min=$_GET['income_min'];
			$this->db->where('income_min >=', $income_min);
		}
		if(!empty($_GET['income_max'])){
			$income_max=$_GET['income_max'];
			$this->db->where('income_max <=', $income_max);
		}
		if(!empty($_GET['income_type'])){
			$income_type=$_GET['income_type'];
			$this->db->where('income_type ', $income_type);
		}
		if(!empty($_GET['break_even_type'])){
			$break_even_type=$_GET['break_even_type'];
			$this->db->where('break_even_type ', $break_even_type);
		}
		if(!empty($_GET['min_break_even'])){
			$min_break_even=$_GET['min_break_even'];
			$this->db->where('min_break_even >=', $min_break_even);
		}
		if(!empty($_GET['max_break_even'])){
			$max_break_even=$_GET['max_break_even'];
			$this->db->where('max_break_even <=', $max_break_even);
		}
		}
		if(!empty($id)){
			
			$query = $this->db->get_where('vh_franchize', array('industry' => $id));
			return $query->result_array();
		}else{
			
        $query = $this->db->get_where('vh_franchize');
        return $query->result_array();
		}
    }
	function EntrepreneursList($id='',$post_type){
		if(!empty($id)){
			$query = $this->db->get_where('vh_posts', array('p_id' => $id,'post_type' => $post_type));
			return $query->result_array();
		}else{
	if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('INDUSTRY', $industrkey[$i]);
			}else{
			$this->db->or_where('INDUSTRY', $industrkey[$i]	);
			}
			}
			
		}
		if(!empty($_GET['association'])){
			$association=$_GET['association'];
			foreach($association as $key=>$value){
			$this->db->like('association', $value);
			}
		}	
		if(!empty($_GET['location'])){
			$location=$_GET['location'];
			$this->db->like('location', $location);
		}
		if(!empty($_GET['min_invest'])){
			$min_invest=$_GET['min_invest'];
			$this->db->where('min_invest >=', $min_invest);
		}
		if(!empty($_GET['max_invest'])){
			$max_invest=$_GET['max_invest'];
			$this->db->where('max_invest <=', $max_invest);
		}
		if(!empty($_GET['min_share'])){
			$min_share=$_GET['min_share'];
			$this->db->where('min_share >=', $min_share);
		}
		if(!empty($_GET['max_share'])){
			$max_share=$_GET['max_share'];
			$this->db->where('max_share <=', $max_share);
		}
		if(!empty($_GET['share_currency'])){
			$share_currency=$_GET['share_currency'];
			$this->db->where('share_currency ', $share_currency);
		}
		if(!empty($_GET['investment_currency'])){
			$investment_currency=$_GET['investment_currency'];
			$this->db->where('investment_currency ', $investment_currency);
		}
		if(!empty($_GET['budget_currency'])){
			$budget_currency=$_GET['budget_currency'];
			$this->db->where('currency', $budget_currency);
		}
		if(!empty($_GET['min_budget'])){
			$min_budget=$_GET['min_budget'];
			$this->db->where('min_budget >=', $min_budget);
		}
		if(!empty($_GET['max_budget'])){
			$max_budget=$_GET['max_budget'];
			$this->db->where('max_budget <=', $max_budget);
		}
		}
		$query = $this->db->get_where('vh_posts', array('post_type' => $post_type));
        return $query->result_array();
		}
    }
	function EearnProfilesList($id=''){
				if(!empty($_GET)){
		if(!empty($_GET['industrkey'])){
			
			$industrkey=$_GET['industrkey'];
			$length = count($industrkey);
			for ($i = 0; $i < $length; $i++) {
			if($i==0){
			$this->db->where('skill', $industrkey[$i]);
			}else{
			$this->db->or_where('skill', $industrkey[$i]	);
			}
			}
		}
		if(!empty($_GET['investment_currency'])){
			$investment_currency=$_GET['investment_currency'];
			$this->db->where('investment_currency', $investment_currency);
		}
		if(!empty($_GET['min_as_employee'])){
			$min_as_employee=$_GET['min_as_employee'];
			$this->db->where('min_as_employee >=', $min_as_employee);
		}
		if(!empty($_GET['max_as_employee'])){
			$max_as_employee=$_GET['max_as_employee'];
			$this->db->where('max_as_employee <=', $max_as_employee);
		}
		if(!empty($_GET['min_as_partner'])){
			$min_as_partner=$_GET['min_as_partner'];
			$this->db->where('min_as_partner >=', $min_as_partner);
		}
		if(!empty($_GET['max_as_partner'])){
			$max_as_partner=$_GET['max_as_partner'];
			$this->db->where('max_as_partner <=', $max_as_partner);
		}
		}
		$array= array('Profile', 'Mediator', 'Hobby');
		$this->db->where_in('post_type', $array);
		$query = $this->db->get('vh_posts');
		
        return $query->result_array();
		//echo $this->db->last_query(); exit;
    }
	public function ShortlistAdd($data = array()) {
        $insert = $this->db->insert('vh_shortlistprofiles', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function ShortlistByIdsFranchize($id,$user) {
        $query = $this->db->get_where('vh_franchize', array('id' => $id,'posted_by' => $user));
        return $query->row_array();
    }
	public function ShortlistByIdsOutsource($id,$user) {
        $query = $this->db->get_where('vh_outsource_work', array('id' => $id,'posted_by' => $user));
        return $query->row_array();
    }
	public function ShortlistByIds($id,$user,$postType) {
        $query = $this->db->get_where('vh_shortlistprofiles', array('pid' => $id,'posted_by' => $user,'post_type' => $postType));
        return $query->row_array();
    }
	public function initiates($id,$user,$postType) {
        $query = $this->db->get_where('vh_initiatesall', array('post_id' => $id,'posted_by' => $user,'post_type' => $postType));
		return $query->row_array();
    }
	public function inivests($id,$user,$postType) {
        $query = $this->db->get_where('vh_investall', array('post_id' => $id,'posted_by'=> $user,'post_type' => $postType));
		return $query->row_array();
    }
	public function ShortlistByUser($user) {
		 $this->db->from('vh_shortlistprofiles as s');

		if(!empty($_GET)){
		if(!empty($_GET['Entrepreneur'])){
			$this->db->where('p.post_type', 'Entrepreneur');
			}
		if(!empty($_GET['Investor'])){
			$this->db->where('p.post_type', 'Investor');
			}
			}
     $this->db->where('s.posted_by', $user);
     $this->db->join('vh_posts as p', 's.pid = p.p_id', 'LEFT');
     $query = $this->db->get()->result_array();
	//echo $this->db->last_query(); exit;		
        return $query;
    }
	public function InitiatesAll($data = array()) {
	
        $insert = $this->db->insert('vh_initiatesall', $data);
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
	public function InsertOwnBusines($data = array()){
		
        $insert = $this->db->insert('vh_idea_hub', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function allinitiations($id = ""){
	$query = $this->db->get_where('vh_initiatesall', array('industry' => $id));
	return $query->result_array();
	}
	public function allinitiationsidea($id = ""){
	$query = $this->db->get('vh_initiate_idea');
	return $query->result_array();
 	}
	public function allinvestables($id = ""){
	$query = $this->db->get_where('vh_investall', array('industry' => $id));
	return $query->result_array();
	}
	public function allinvestidea($id = ""){
	$query = $this->db->get('vh_invest_idea');
	return $query->result_array();
 	}
	public function Ownbusiness($id = ""){
	$query = $this->db->get_where('vh_idea_hub', array('industry' => $id,'post_type' => 'ownbusiness'));
	return $query->result_array();
 	}
	function skill_byskils($id){
 			$query = $this->db->get_where('vh_posts', array('skill' => $id));
            return $query->result_array();
    }
	function IdeazoneById($id){
 			$query = $this->db->get_where('vh_idea_hub', array('ID' => $id));
            return $query->row_array();
    }
	function postsById($id){
 			$query = $this->db->get_where('vh_posts', array('p_id' => $id));
            return $query->row_array();
    }
	function outSource($id){
 			$query = $this->db->get_where('vh_outsource_work', array('id' => $id));
            return $query->row_array();
    }
	function ShortlistRemove($id){
 			$delete = $this->db->delete('vh_shortlistprofiles',array('id' => $id));
        return $delete?true:false;
    }
	function Profile_details($id){
 			$query = $this->db->get_where('vh_posts', array('p_id'=>$id));
            return $query->row_array();
    } 
	function NotificationsByMe($id,$session_user){
 			$query = $this->db->get_where('vh_notification', array('post_id'=>$id,'from_id'=>$session_user));
            return $query->row_array();
    } 
	function Proposals($id){
 			$query = $this->db->get_where('vh_notification', array('skill_id'=>$id,'notification_type'=>'offer-a-work'));
            return $query->result_array();

    }
	function feedback($id){
 			$query = $this->db->get_where('vh_review', array('KEYID'=>$id));
            return $query->result_array();
    }
	function ProposalsSendOrNot($post_id){
	$userid = $this->session->userdata('user');
	$query = $this->db->get_where('vh_notification', array('post_id'=>$post_id,'from_id'=>$userid,'notification_type'=>'request-for-work-sent'));
     return $query->result_array();
    } 
	public function FeedbackAddToSkill($data = array()) {
		$insert = $this->db->insert('vh_review', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	
	public function NotificationsAdd($data = array()) {
		$insert = $this->db->insert('vh_notification', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function DashbordValues(){
	$userid = $this->session->userdata('user');
	$query['ideas'] = $this->db->get_where('vh_idea_hub')->num_rows();
	$query['saved-ideas'] = $this->db->get_where('vh_saved_ideas', array('uid'=>$userid))->num_rows();
	$query['initiatesall'] = $this->db->get_where('vh_initiatesall', array('posted_by'=>$userid))->num_rows();
	$query['investall'] = $this->db->get_where('vh_investall', array('posted_by'=>$userid))->num_rows();
	$query['Professional'] = $this->db->get_where('vh_posts', array('post_type'=>'Profile', 'posted_by'=>$userid))->row_array();
	$query['Hobby'] = $this->db->get_where('vh_posts', array('post_type'=>'Hobby', 'posted_by'=>$userid))->row_array();
	$query['Mediator'] = $this->db->get_where('vh_posts', array('post_type'=>'Mediator', 'posted_by'=>$userid))->result_array();


    return $query;

    }
	public function initiateById($postId){
		$query = $this->db->get_where('vh_initiatesall', array('post_id'=>$postId));
    return $query->result_array();	
	}
	public function ProfileByIdea($user,$resources){
		$this->db->where_in('posted_by', $user);
		$this->db->where_in('skill', $resources);
		$query = $this->db->get_where('vh_posts');
		return $query->row_array();	
	}
	public function ProfileByUser($user){
		$this->db->select('skill,association');
		$this->db->where('posted_by', $user);
		$query = $this->db->get_where('vh_posts');
		return $query->result_array();	
	}
	
	
	
	

	////////////// Learn Model ///////////////
	
	
	
		public function insert_post($data)
    {
    	//print_r($data);exit;
        $this->db->insert('posts',$data);
        return $this->db->insert_id();
    }
	
	public function insert_ans($data){
        $this->db->insert('answers',$data);
        $inserted_id = $this->db->insert_id();
        if ($inserted_id > 0) {
            $query = $this->db->query('SELECT bc.id as comment_id, bc.post_id, 
                    bc.reply_id, bc.answer, bc.created_date, bc.user_id
                    FROM answers bc WHERE bc.id=' . $inserted_id);
            return $query->result();
        }
        return NULL;
        
    }
	
	 public function get_posts($slug = NULL)
    {
        if ($slug == NULL)
        {
		
            $this->db->select('pl.userid as liked_by,pl.type,p.question ,p.created_date,p.tags,p.user_id,p.id,p.id as post_id,u.ID as userid,u.NAME as username');
		$this->db->from('posts p'); 
		//$this->db->join('attachments a', 'a.post_id = p.id', 'left outer');
		$this->db->join('users u', 'u.id = p.user_id', 'left');
		$this->db->join('post_like pl', 'pl.postid = p.id AND pl.userid = p.user_id','left');
		 $this->db->order_by('p.id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
        }
 
 
		$this->db->select('pl.userid as liked_by,pl.type,p.question ,p.created_date,p.tags,p.user_id,p.id,p.id as post_id,u.ID as userid,u.NAME as username');
		$this->db->from('posts p'); 
		//$this->db->join('attachments a', 'a.post_id = p.id', 'left outer');
		$this->db->join('users u', 'u.ID = p.user_id', 'left');
		$this->db->join('post_like pl', 'pl.postid = p.id AND pl.userid = p.user_id','left');
		$this->db->where('p.user_id',$slug);
                $this->db->order_by('p.id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
    }
    
     public function get_attachments($post_id)
    {
       $this->db->select('a.att_id,a.post_id,a.name,a.type,a.size,a.addedby,a.dateofadded');
       $this->db->from('attachments a'); 
       $this->db->where('a.post_id',$post_id);
        $query = $this->db->get();
        return $query->result_array();
    }
	
    public function get_answers($post_id)
    {
        if ($post_id != '')
        {
            $query = $this->db->where('post_id',$post_id)->get('answers');
			if ($query->num_rows() > 0) {
            $items = array();
            foreach ($query->result() as $row) {
                $items[] = $row;
            }
							//echo '<pre>';print_r($items);exit;
            //return $items;
            $comments = $this->format_comments($items);
			return $comments;
        }
			return '<ul class="comment"></ul>';
            //return $query->row_array();
        }
 
 
		$this->db->select('pl.type,p.question ,p.tags,p.user_id,p.id,a.att_id,a.name,a.post_id,u.ID as userid,u.NAME as username');
		$this->db->from('posts p'); 
		$this->db->join('attachments a', 'a.post_id = p.id', 'left');
		$this->db->join('vh_usr u', 'u.ID = p.user_id', 'left');
		$this->db->join('post_like pl', 'pl.postid = p.id AND pl.userid = p.user_id','left');
		$this->db->where('p.user_id',$post_id);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	//format comments for display on blog and article
    private function format_comments($comments) {
        $html = array();
        $root_id = 0;
        foreach ($comments as $comment)
            $children[$comment->reply_id][] = $comment;

        // loop will be false if the root has no children (i.e., an empty comment!)
        $loop = !empty($children[$root_id]);

        // initializing $parent as the root
        $parent = $root_id;
        $parent_stack = array();

        // HTML wrapper for the menu (open)
        $html[] = '<ul class="comment">';

        foreach ($children[$parent] as $option => $value) {
    	//while ($loop && ( ( $option = each($children[$parent]) ) || ( $parent > $root_id ) )) {
            if ($option === false) {
                $parent = array_pop($parent_stack);

                // HTML for comment item containing childrens (close)
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2) . '</ul>';
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1) . '</li>';
            } elseif (!empty($children[$value->id])) {
                $tab = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1);

                $name = $value->created_date;
				$postid = $value->post_id;
                // HTML for comment item containing childrens (open)
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>', $tab, // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
						$value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
						$postid// %6$s  = post_id 
                        
                );
                //$check_status = "";
                $html[] = $tab . '<ul class="comment">';

                array_push($parent_stack, $value->reply_id);
                $parent = $value->id;
            } else {
                $name = $value->created_date;
				$postid = $value->post_id;
                // HTML for comment item with no children (aka "leaf") 
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>' .
                        '%1$s</li>', str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1), // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
						$value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
						$postid// %6$s  = post_id
                );
            }
        }

        // HTML wrapper for the comment (close)
        $html[] = '</ul>';
		return implode(" ", $html);
    }

	
	public function feedget_answers($post_id)
    {
        if ($post_id != '')
        {
            $query = $this->db->where('post_id',$post_id)->get('answers');
			if ($query->num_rows() > 0) {
            $items = array();
            foreach ($query->result() as $row) {
                $items[] = $row;
            }
							//echo '<pre>';print_r($items);exit;
            //return $items;
            $comments = $this->feedformat_comments($items);
			return $comments;
        }
			return '<ul class="comment"></ul>';
            //return $query->row_array();
        }
 
 
		$this->db->select('pl.type,p.question ,p.tags,p.user_id,p.id,a.att_id,a.name,a.post_id,u.ID as userid,u.NAME as username');
		$this->db->from('posts p'); 
		$this->db->join('attachments a', 'a.post_id = p.id', 'left');
		$this->db->join('vh_usr u', 'u.ID = p.user_id', 'left');
		$this->db->join('post_like pl', 'pl.postid = p.id AND pl.userid = p.user_id','left');
		$this->db->where('p.user_id',$post_id);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	//format comments for display on blog and article
    private function feedformat_comments($comments) {
        $html = array();
        $root_id = 0;
        foreach ($comments as $comment)
            $children[$comment->reply_id][] = $comment;

        // loop will be false if the root has no children (i.e., an empty comment!)
        $loop = !empty($children[$root_id]);

        // initializing $parent as the root
        $parent = $root_id;
        $parent_stack = array();

        // HTML wrapper for the menu (open)
        $html[] = '<ul class="comment">';
        foreach ($children[$parent] as $option => $value) {
            if ($option === false) {
                $parent = array_pop($parent_stack);

                // HTML for comment item containing childrens (close)
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2) . '</ul>';
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1) . '</li>';
            } elseif (!empty($children[$value->id])) {
                $tab = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1);

                $name = $value->created_date;
				$postid = $value->post_id;
                // HTML for comment item containing childrens (open)
                $html[] = sprintf(
                        '%1$s<li id="feedli_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="feedreply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>', $tab, // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
						$value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
						$postid// %6$s  = post_id 
                        
                );
                //$check_status = "";
                $html[] = $tab . '<ul class="comment">';

                array_push($parent_stack, $value->reply_id);
                $parent = $value->id;
            } else {
                $name = $value->created_date;
				$postid = $value->post_id;
                // HTML for comment item with no children (aka "leaf") 
                $html[] = sprintf(
                        '%1$s<li id="feedli_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="feedreply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>' .
                        '%1$s</li>', str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1), // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
						$value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
						$postid// %6$s  = post_id
                );
            }
        }

        // HTML wrapper for the comment (close)
        $html[] = '</ul>';
		return implode(" ", $html);
    }

}
?>