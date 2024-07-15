<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {
    function __construct() {
        parent::__construct();
        // Load user model
        $this->load->model('Users');
        $this->load->library('session');
    }
    
    public function index(){
        // Load login & profile view
        $this->load->view('facebook_login/index');
    }
    public function saveUserData() {
       // Decode json data and get user profile data
        $postData = json_decode($_POST['userData']);
		//print_r($postData); exit;

        // Preparing data for database insertion
		if($_POST['oauth_page']=='signin'){
			$first_name = $postData->ig; 
			$userData['login_type'] = 2;
			$userData['oauth_provider'] = $_POST['oauth_provider'];
			$userData['oauth_uid']         = $postData->Eea;
			$userData['name']    		   = $first_name;
			$userData['email']             = $postData->U3;
			$userData['profile_picture']   = $postData->Paa;
		}else{
			$first_name = $postData->name;
			$userData['login_type'] = 2;
			$userData['oauth_provider'] = $_POST['oauth_provider'];
			$userData['oauth_uid']         = $postData->id;
			$userData['name']    		   = $first_name;
			$userData['email']             = $postData->email;
			$userData['profile_picture']   = $postData->picture;
		}
        
        $oauth = ($userData['oauth_provider']=='Google'? 1:($userData['oauth_provider']=='linkedin'?3:1));
        $email_exist = $this->Users->checkEmailOauthprovider($userData['email'],$oauth);
        
        // Insert or update user data
        $userID = $this->Users->checkUser($userData);
	if($userID){
            $user_id = $userID;
            $user_name = $userData['name'];
            $user_email = $userData['email'];
            $this->session->set_userdata('user', $user_id);
            $this->session->set_userdata('username', $user_name);
            $this->session->set_userdata('useremail', $user_email);
            $session_user = $this->session->userdata('user');
            $user_details = $this->Users->getUserDetails(array('id'=>$userID));
            $final_data['issuccess'] = 1;
            $final_data['user'] = $user_details;
			$this->SessionLogsInsert();
            if($user_details['login_type']==1){
                $profile_pic = (isset($user_details['profile_picture']) && $user_details['profile_picture']!= NULL)?$user_details['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $user_details['profile_picture'];
            }
            $final_data['user']['profile_picture'] = $prof_pic;
            $final_data['session_user'] = $session_user;
	}else{
            $final_data['session_user'] = $session_user=false;
	}
        echo json_encode($final_data);
    }
    public function SessionLogsInsert(){
		$session_user = $this->session->userdata('user'); 
		$sData= $this->Users->getUserSessionDetails(array('uid'=>$session_user,'status'=>1));
		if($sData){
			$this->SessionLogsUpdate();
		}
		$userData['uid']=$session_user;
		$userData['login_time']=date("Y-m-d H:i:s");
		$userData['device']= $this->get_client_ip();
		$this->Users->InsertUserSessionLog($userData);
	}
    public function SessionLogsUpdate(){
		$session_user = $this->session->userdata('user'); 
		$sData= $this->Users->getUserSessionDetails(array('uid'=>$session_user,'status'=>1));

		$userData['status']=0;
		$userData['logout_time']=date("Y-m-d H:i:s");
		$this->Users->UpdateUserSessionLog($userData,$sData['id']);
	}
	private function get_client_ip() {
      $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
	}
}