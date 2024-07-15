<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		//load database library
        $this->load->database();
    }
	/*
     * Fetch Admin_login data
     */
    function User_login($usn,$pwd){
        $query = $this->db->get_where('vh_usr', array('email' => $usn,'MOB_AUTHENTICATED' => 1, 'password' => md5($pwd)));
        return $query->row_array();
    }
    function user_details($userid){
        $query = $this->db->get_where('users', array('id' => $userid));
        return $query->row_array();
    } 
    function phone_exist($phone){
        $query = $this->db->get_where('vh_usr', array('MOBILENO' => $phone,'MOB_AUTHENTICATED'=>1));
        return $query->row_array();
    }
    function email_exist($email){
        $query = $this->db->get_where('vh_usr', array('EMAIL' => $email,'EMAIL_AUTHENTICATED'=>1));
        return $query->row_array();
    }
    function phone_existnotauth($phone){
        $query = $this->db->get_where('vh_usr', array('MOBILENO' => $phone,'MOB_AUTHENTICATED'=>0));
        return $query->row_array();
    }
    function email_existnotauth($email){
        $query = $this->db->get_where('vh_usr', array('EMAIL' => $email,'EMAIL_AUTHENTICATED'=>0));
        return $query->row_array();
    }
	function VerifyOtp($phone,$otp){
		 $startTime = date("Y-m-d H:i:s");
		$d = date('Y-m-d H:i:s',strtotime('-10 minutes',strtotime($startTime))); //exit;
        $query = $this->db->get_where('vh_otp_history', array('PHONE' => $phone,'OTP' => $otp,'STATUS' => 0,'GENERATED_DATE >'=>$d));
       return $query->row_array();
    } 
	function user_timngs($userid){
        $query = $this->db->get_where('vh_utimings', array('u_id' => $userid));
        return $query->result_array();
    }
	/*
     * Fetch Category data
     */
    function getShopname($id){
	    $query = $this->db->get_where('vh_usr', array('id' => $id));
        $rowname = $query->row_array();
		echo $rowname['name']; 
    }
	
	function getIndusrty($id = ""){
		$sessid = $this->session->userdata['Shopid']; //exit;
        if(!empty($id)){
            $query = $this->db->get_where('vh_usr', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get_where('vh_usr');
            return $query->result_array();
        }
		}
		
    function getbussinessIdeasPage($limit,$start,$id = ""){
        $this->db->limit($limit, $start);
        $this->db->order_by("ID","desc");
        if(!empty($_GET) && empty($id)){
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
        $session_user = $this->session->userdata('user');
        $this->db->where('status',2);
        $this->db->or_where('POSTED_BY',$session_user);
		$this->db->where_in('post_type', '');
        $query = $this->db->get('vh_idea_hub');
        $ideas = $query->result_array(); 
        $ideaswithtags= $this->getIdeasTagsAndSkills($ideas);
        return $ideaswithtags;
    }
	function bussinessIdeasall($id=''){
		
		$this->db->order_by("ID","desc");
	 if(!empty($_GET) && empty($id)){
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
        
		if(!empty($id)){
            $query = $this->db->get_where('vh_idea_hub', array('id' => $id));
            return $query->row_array();
        }else{
            $session_user = $this->session->userdata('user');
            $this->db->where('status',2);
            $this->db->or_where('POSTED_BY',$session_user);
			$this->db->where_in('post_type ', '');
            $query = $this->db->get('vh_idea_hub');
            
             return $query->result_array();
			
        }
    }
	function getbussinessIdeas($id = ""){
		$limit=10;
		if(!empty($_GET['page'])){
			$start=($_GET['page']-1)*$limit;
		}else{
			$start=0;
		}
		$this->db->limit($limit, $start);
		$this->db->order_by("ID","desc");
	 if(!empty($_GET) && empty($id)){
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
		if(!empty($id)){
            $query = $this->db->get_where('vh_idea_hub', array('id' => $id));
            return $query->row_array();
        }else{
           $query = $this->db->get('vh_idea_hub');
			$this->db->where_in('post_type ', '');
			$ideas = $query->result_array(); 
	
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
			$ideaswithtags[] = $idea;
		}
         return $ideaswithtags;
        }
    }
    
    
    function getbussinessIdeasWithTag($tagid = 0){
        $sql = "select * from vh_idea_hub where find_in_set(".$tagid.",TAGS) <> 0 ORDER BY `vh_idea_hub`.`ID` DESC";
        $ideas = $this->db->query($sql)->result_array();
        $ideaswithtags= $this->getIdeasTagsAndSkills($ideas);
	return $ideaswithtags;
    }
	function getbussinessIdeassaved($id = ""){
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
			$this->db->order_by("vh_saved_ideas.id","desc");
			$query = $this->db->where('vh_saved_ideas.uid',$id);
			$query = $this->db->join('vh_saved_ideas', 'vh_saved_ideas.idea_id = vh_idea_hub.ID');
            $query = $this->db->get('vh_idea_hub');
            $ideas = $query->result_array();
            $ideaswithtags= $this->getIdeasTagsAndSkills($ideas);
             return $ideaswithtags;
       
    }
	/*
     * Insert User  data
     */
    public function InsertOtp($data = array()) {
		
        $insert = $this->db->insert('vh_otp_history', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InsertUser($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['create_date'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modefied_date', $data)){
			$data['modefied_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_usr', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	/*
     * Fetch User data
     */
    function getUsers($id = ""){
		$sessid = $this->session->userdata['Shopid']; //exit;
        if(!empty($id)){
            $query = $this->db->get_where('vh_usr', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get_where('vh_usr');
            return $query->result_array();
        }
    }
	/*
     * Update User data
     */
    public function UpdateUser($data, $id) {
        if(!empty($data) && !empty($id)){
			
            $update = $this->db->update('vh_usr', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
	 public function Phone_update($data, $id) {
        if(!empty($data) && !empty($id)){
			
            $update = $this->db->update('vh_usr', $data, array('ID'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
	/*
     * Update User data
     */
    public function UpdateOtpStatus($data, $id) {
        if(!empty($data) && !empty($id)){
			
            $update = $this->db->update('vh_otp_history', $data, array('ID'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
	/*
     * Update User data
     */
    public function UpdatePassword($data, $phone) {
        if(!empty($data) && !empty($phone)){
			if (is_numeric($phone))
		{
			$update = $this->db->update('vh_usr', $data, array('MOBILENO'=>$phone));
			} else {
			$update = $this->db->update('vh_usr', $data, array('EMAIL'=>$phone));
			}
           
            return $update?true:false;
        }else{
            return false;
        }
    }
	/*
     * Update Idea-zone data
     */
    public function UpdatePostIdea($data, $id) {
        if(!empty($data) && !empty($id)){
			$update = $this->db->update('vh_idea_hub', $data, array('ID'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
	/*
     * Insert User Idea-zone data
     */
    public function InsertIdea($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['POSTED_DATE'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modefied_date', $data)){
			//$data['modefied_date'] = date("Y-m-d H:i:s");
		}
        $insert = $this->db->insert('vh_idea_hub', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	
    /*
     * Delete user data
     */
    public function delete($id){
        $delete = $this->db->delete('ts_restaurant',array('id'=>$id));
        return $delete?true:false;
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
            $skills = array();
            if($a!=''){
                $cats = explode(",", $a);
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
            }
            $idea['SKILLS'] = $skills;
            $ideaswithtags[] = $idea;
        }
        return $ideaswithtags;
    }

}
?>