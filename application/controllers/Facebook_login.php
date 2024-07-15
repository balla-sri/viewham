<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_login extends CI_Controller {
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
   public function linkedin(){
   $this->load->view('facebook_login/linkedin');
   }
    public function saveUserData() {
       // Decode json data and get user profile data
        $postData = json_decode($_POST['userData']);

        // Preparing data for database insertion
        $first_name = $postData->first_name;
        $last_name = $postData->last_name;

        $userData['login_type'] = 2;
        $userData['oauth_provider'] = $_POST['oauth_provider'];
        $userData['oauth_uid']         = $postData->id;
        $userData['name']    		   = $first_name.'&nbsp'.$last_name;
        $userData['email']             = $postData->email;
        $userData['profile_picture']   = $postData->picture->data->url;
        
        $oauth = ($userData['oauth_provider']=='facebook'? 2:($userData['oauth_provider']=='linkedin'?3:1));
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
}