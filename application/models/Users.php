<?php

class Users extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
    public function checkEmailOauthprovider($email,$oauth){
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where("login_type !=",$oauth);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function isEmailExist($email,$email_auth = 0){
        $array['email'] = $email;
        if($email_auth!=0){
            $array['email_authenticated'] = $email_auth;
        }
        $query = $this->db->get_where('users', $array);
        return $query->num_rows();
    }
    
    public function isMobileExist($mobile,$mobile_auth=0){
        $array['mobile'] = $mobile;
        if($mobile_auth!=0){
            $array['mobile_authenticated'] = $mobile_auth;
        }
        $query = $this->db->get_where('users', $array);
        return $query->num_rows();
    }
    
    public function InsertUser($array){
        //$array['created']
        $insert = $this->db->insert('users', $array);
        return $this->db->insert_id();
    }
    
    public function getUserDetails($userarray){
        $query = $this->db->get_where('users', $userarray);
        return $query->row_array();
    }
    
    public function sendsmsotp($phone,$msg){
        $textmessage = urlencode($msg);
        $service_url ='https://sms.office24by7.com/API/sms.php?username=9492973688&password=NiN0cPZl&from=VIEWHA&to='.$phone.'&msg='.$textmessage.'&type=1';
        $ch = curl_init($service_url);
        $timeout  =  30;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $content  = curl_exec($ch);
        curl_close($ch);
        return date("Y-m-d H:i:s",time());	
    }
    
    public function sendEmailotp($email,$otpn){
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8'); 
        $this->email->set_header('Content-type', 'text/html'); 

        $this->email->from('ajayviewham@gmail.com', 'Viewham');
        $this->email->to($email);
        $this->email->reply_to($email);
        $this->email->subject('Viewham');
        $message = "Welcome To Viewham. <br><br>  OTP to verify your email id is <b>".$otpn."</b>";
        $this->email->message($message);
        if($this->email->send()) {
            return 1;
        }else{
            return 2; 
        }	
    }
    public function sendEmailVerification($to,$userid){
           $subject = "Email verification : Viewham";
		$message = "Welcome To Viewham. <br><br>  To verify your email id is <b>".base_url('user/UserEmailVerification/').$to.'/'.$userid."</b>";
                
         $header = "From:ajayviewham@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
             return 1;
         }else {
            return 2; 
         }
    }    
    public function insertOTP($details){
        $insert = $this->db->insert('otp_history', $details);
        return $this->db->insert_id();
    }
    
    public function getOTPDetails($array){
        $this->db->select('id,otp');
        $this->db->from('otp_history');
        $this->db->where($array);
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        
        return $query->row_array();
    }
    public function updateOTPstatus($user,$id){
        return $update = $this->db->update('otp_history', $user, array('id'=>$id));
    }    
    public function updateUser($user,$id){
        return $update = $this->db->update('users', $user, array('id'=>$id));
    }
    
    public function checkLogin($username){
        $this->db->select('id,name,email,password,mobile_authenticated,email_authenticated,login_type,profile_picture');
        $this->db->from('users');
        $this->db->where('email', $username);
        /*$this->db->group_start();
        $this->db->where('mobile_authenticated', 1);
        $this->db->or_where('email_authenticated', 1);
        $this->db->group_end();*/
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function checkUser($userData = array()){
        if(!empty($userData)){
 
            $this->db->select('id');

            $query = $this->db->get_where('users', array('email'=>$userData['email']));
            
           /* $query = $this->db->get_where('users', array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));*/
             if($query->num_rows() > 0){
                $prevResult = $query->row_array();
                
                //update user data
                $userData['updated_at'] = date("Y-m-d H:i:s");
                $update = $this->db->update('users', $userData, array('id'=>$prevResult['id']));
                
                //get user ID
                $userID = $prevResult['id'];
            }else{
                //insert user data
                $userData['created_at']  = date("Y-m-d H:i:s");
                $userData['updated_at'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert('users',$userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }
	public function DashbordValues($userid){
		$query['ideas'] = $this->db->get_where('ideas',array('status'=>2))->num_rows();
		$query['saved-ideas'] = $this->db->get_where('ideas_saved', array('user_id'=>$userid))->num_rows();
		$query['initiateAll'] = $this->db->get_where('vh_initiatesall', array('posted_by'=>$userid))->num_rows();
		$query['investAll'] = $this->db->get_where('vh_investall', array('posted_by'=>$userid))->num_rows();
		
		
		$query['entrepreneur'] = $this->db->get_where('vh_posts', array('post_type'=>'1', 'posted_by'=>$userid))->row_array();
		$query['entrepreneur']['proposals'] = $this->db->get_where('vh_interests', array('post_id'=>$query['entrepreneur']['p_id'],'post_type'=>$query['entrepreneur']['post_type']))->num_rows();
		
		
		$query['investor'] = $this->db->get_where('vh_posts', array('post_type'=>'2', 'posted_by'=>$userid))->row_array();
		$query['investor']['proposals'] = $this->db->get_where('vh_interests', array('post_id'=>$query['investor']['p_id'],'post_type'=>$query['investor']['post_type']))->num_rows();
		
		$this->db->select('p.*,s.skill as skill_name');
		$this->db->from('vh_posts p');		
		$this->db->join('skills s', 'p.skill = s.id','left');
		$this->db->where('p.post_type ', 3);
		$this->db->where('p.posted_by ', $userid);
		$query['professional'] = $this->db->get()->row_array();	
		$query['professional']['proposals'] = $this->db->get_where('vh_interests', array('post_id'=>$query['professional']['p_id'],'post_type'=>$query['professional']['post_type']))->num_rows();
		
// feedbacks //
		$pfeedback = $this->db->get_where('vh_feedback', array('postid'=>$query['professional']['p_id'],'post_type'=>$query['professional']['post_type']))->result_array();
		$prate=0;
		foreach($pfeedback as $key=>$val){
			$prate +=$val['rate'];		
		}
		if(!empty($pfeedback)){
		$prate =  $prate / count($pfeedback);	}
		$query['professional']['feedback']=$prate;

		$this->db->select('p.*,s.skill as skill_name');
		$this->db->from('vh_posts p');		
		$this->db->join('skills s', 'p.skill = s.id','left');
		$this->db->where('p.post_type ', 4);
		$this->db->where('p.posted_by ', $userid);
		$query['hobby'] = $this->db->get()->row_array();	
		$query['hobby']['proposals'] = $this->db->get_where('vh_interests', array('post_id'=>$query['hobby']['p_id'],'post_type'=>$query['hobby']['post_type']))->num_rows();
		
		
// feedbacks //
		$hfeedback = $this->db->get_where('vh_feedback', array('postid'=>$query['hobby']['p_id'],'post_type'=>$query['hobby']['post_type']))->result_array();
		$hrate=0;
		foreach($hfeedback as $key=>$val){
			$hrate +=$val['rate'];		
		}
		if(!empty($hfeedback)){
		$hrate =  $hrate / count($hfeedback);	}
		$query['hobby']['feedback']=$hrate;

		
		$this->db->select('p.*,s.skill as skill_name');
		$this->db->from('vh_posts p');		
		$this->db->join('skills s', 'p.skill = s.id','left');
		$this->db->where('p.post_type ', 5);
		$this->db->where('p.posted_by ', $userid);
		$query['mediator'] = $this->db->get()->result_array();	
			foreach($query['mediator'] as $key=>$val){
				$query['mediator'][$key]['proposals']=$this->db->get_where('vh_interests', array('post_id'=>$val['p_id'],'post_type'=>$val['post_type']))->num_rows();
				
				$mfeedback = $this->db->get_where('vh_feedback', array('postid'=>$val['p_id'],'post_type'=>$val['post_type']))->result_array();
		$mrate=0;
		foreach($mfeedback as $keyy=>$val){
			$mrate +=$val['rate'];		
		}
		if(!empty($mfeedback)){
		$mrate =  $mrate / count($mfeedback);	}
		$query['mediator'][$key]['feedback']=$mrate;	
				
			}
    return $query;

    }
    public function InsertUserSessionLog($array){
        $insert = $this->db->insert('vh_login_session', $array);
        return $this->db->insert_id();
    }	
    public function UpdateUserSessionLog($user,$id){
        return $update = $this->db->update('vh_login_session', $user, array('id'=>$id));
    }    
    public function getUserSessionDetails($userarray){
        $query = $this->db->get_where('vh_login_session', $userarray);
        return $query->row_array();
    }
}