<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    protected $data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Users');
        $this->load->model('Earn_model');
        $this->load->library('session');
        $this->load->helper('viewham_helper');
        
        $this->data['session_exist'] = 0;
        $session_user = $this->session->userdata('user'); 
        if($session_user){
            $userdetails = $this->Users->getUserDetails(array('id'=>$session_user));
            if($userdetails['login_type']==1){
                $profile_pic = (isset($userdetails['profile_picture']) && $userdetails['profile_picture']!= NULL)?$userdetails['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $userdetails['profile_picture'];
            }
            
            $this->data['user'] = $userdetails;
            $this->data['user']['profile_picture'] = $prof_pic;
            $this->data['session_exist'] = 1;
        }
        
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
        
    }
    
    public function signup()
    {
        if($this->data['session_exist'] == 1){
            redirect('/businessideas');
        }
        
        $this->template->set('title', 'Signup');
        $this->template->load('plain', 'contents' , 'signup', $this->data);
    }

    public function register(){
        
        $array = $this->input->post();
        $array['mobile'] = $this->input->post('phone');
        $array['password'] = md5($array['password']);
        $array['created_at'] = date("Y-m-d H:i:s");
        
        unset($array['phone']);
        
        //input data validation
        $validate = $this->validateSignupData();
        //check if email and mobile already exist
        if($validate){
            $email_exist = $this->Users->isEmailExist($array['email']);
            $mobile_exist = $this->Users->isMobileExist($array['mobile']);
            
            if($email_exist == 0 && $mobile_exist == 0){
                $user_id = $this->Users->InsertUser($array);
                $userdetails = $this->Users->getUserDetails(array('id'=>$user_id));
                $final_data['issuccess'] = 1;
                $final_data['user'] = $userdetails;
            }else if($email_exist > 0){
                $final_data['issuccess'] = 3;
                $final_data['error_message'] = 'Email already exists'; 
            }else if($mobile_exist > 0){
                $final_data['issuccess'] = 4;
                $final_data['error_message'] = 'Mobile number already exists'; 
            }
        }else{
            $final_data['issuccess'] = 2;
            $final_data['error_message'] = 'Invalid data'; 
        }
        
        echo json_encode($final_data);
        
    }
    
    public function signin()
    {
        if($this->data['session_exist'] == 1){
            redirect('/businessideas');
        }
        $data = array();
        $this->template->set('title', 'Signin');
        $this->template->load('plain', 'contents' , 'signin', $this->data);
    }
    
    public function login(){
        
        
        $array['username'] = $this->input->post('username');
        $array['password'] = $this->input->post('password');
        
        $validate = $this->validateSigninData();
        
        if($validate){
            $checkuser = $this->Users->checkLogin($array['username']);
            if(md5($array['password']) == $checkuser['password']){
                
                
                /*if($checkuser['email_authenticated'] == 0){
                    $final_data['issuccess'] = 3;
                    $final_data['error_message'] = 'Email not verified yet';
                }else*/
                if($checkuser['mobile_authenticated']== 1 || $checkuser['email_authenticated']== 1){
                    $this->session->set_userdata('user', $checkuser['id']);
                    $this->session->set_userdata('username', $checkuser['name']);
                    $this->session->set_userdata('useremail', $checkuser['email']);
                    $session_user = $this->session->userdata('user');
                    $final_data['issuccess'] = 1;
                    $final_data['user'] = $checkuser;
					$this->SessionLogsInsert();
                    if($checkuser['login_type']==1){
                        $profile_pic = (isset($checkuser['profile_picture']) && $checkuser['profile_picture']!= NULL)?$checkuser['profile_picture']:'svg.svg';
                        $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
                    }else{
                        $prof_pic = $checkuser['profile_picture'];
                    }
                    $final_data['user']['profile_picture'] = $prof_pic;
                } else {
                    $final_data['issuccess'] = 3;
                    $final_data['error_message'] = 'Mobile number and Email are not verified yet'; 
                }
            }else{
                $final_data['issuccess'] = 2;
                $final_data['error_message'] = 'Invalid Email/Password'; 
            }
        }else{
            $final_data['issuccess'] = 2;
            $final_data['error_message'] = 'Invalid Email/Password'; 
        }
        
        echo json_encode($final_data);
        
    }
    
    public function sendSmsotp(){
        $array = $this->input->post();
        $id = $array['userid'];
        $userdetails = $this->Users->getUserDetails(array('id'=>$id));
        $phone = $userdetails['mobile'];
        $otp_rndm = mt_rand(100000, 999999);
        if (is_numeric($phone))
        {	
            $msg='Welcome to Viewham Business Ideas. OTP : '.$otp_rndm;
            $send_otp = $this->Users->sendsmsotp($phone,$msg);
            $otp_details = array(
                'user_id' => $id,
                'source' => $phone,
                'otp' => $otp_rndm,
                'status' => 0,
                'created_at' => $send_otp,
                'type' =>'phone'    
            );
            $insert = $this->Users->insertOTP($otp_details);
            $array['issuccess'] = 1;
            $array['user'] = $userdetails;
            
        }else{
            //return code if phone number is invalid
            $array['issuccess'] = 0;
        }
        echo json_encode($array);
    }

    public function verifyOtp(){
        $id = $this->input->post('id');
        $otp = $this->input->post('otp');
        
        $get_otp_details = $this->Users->getOTPDetails(array('user_id'=>$id,'type'=>'phone','status'=>0));
        
        if($get_otp_details['otp'] == $otp){
            $upateOTP['status']=1;
            $otpId=$get_otp_details['id'];
            $updateOTP = $this->Users->updateOTPstatus($upateOTP,$otpId);
            $array['issuccess'] = 1;
            $array['success_message'] = "Successfully Mobile verified! Welcome to VIEWHAM";
          
            $updatedetails['mobile_authenticated'] = '1';
            $updatedetails['updated_at'] = date("Y-m-d H:i:s",time());
            $updateusers = $this->Users->updateUser($updatedetails,$id);
            
            $userdets = $this->Users->getUserDetails(array('id'=>$id));
            $array['user'] = $userdets;
            if($userdets['login_type']==1){
                $profile_pic = (isset($userdets['profile_picture']) && $userdets['profile_picture']!= NULL)?$userdets['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $userdets['profile_picture'];
            }
            $array['user']['profile_picture'] = $prof_pic;
            
            $this->session->set_userdata('user', $userdets['id']);
            $this->session->set_userdata('username', $userdets['name']);
            $this->session->set_userdata('useremail', $userdets['email']);
        }else{
            $array['issuccess'] = 0;
            $array['message'] = "Wrong OTP";
        }
        echo json_encode($array);
    }
    
    public function VerifyForgotpasswordOTP(){
        $source = $this->input->post('source');
        $otp = $this->input->post('otp');
        $type = $this->input->post('type');
        $get_otp_details = $this->Users->getOTPDetails(array('source'=>$source,'type'=>$type));
        
        if($get_otp_details['otp'] == $otp){
            $array['issuccess'] = 1;
            $array['source'] = $source;
            $array['type'] = $type;
        }else{
            $array['issuccess'] = 0;
            $array['message'] = "Wrong OTP";
        }
        echo json_encode($array);
        
    }
    
    public function updatePassword(){
        
        $password= $this->input->post('password');
        $type= $this->input->post('type');
        $source= $this->input->post('source');
        if($type=='email'){
            $userarray = array('email'=>$source);
        }else if($type == 'phone'){
            $userarray = array('mobile'=>$source);
        }
        $userdetails = $this->Users->getUserDetails($userarray);
        $id = $userdetails['id'];
        $userData = array(
            'password' => md5($password),
            'updated_at' => date("Y-m-d H:i:s")
        );
        
        $update = $this->Users->updateUser($userData,$id);
	$array['issuccess'] = 1;
        $userdets = $this->Users->getUserDetails(array('id'=>$id));
        $this->session->set_userdata('user', $userdets['id']);
        $this->session->set_userdata('username', $userdets['name']);
        $this->session->set_userdata('useremail', $userdets['email']);
        echo json_encode($array);
	
    }
    
    public function validateSignupData(){
        return true;
    }
    
    public function validateSigninData(){
        return true;
    }
    
    public function logout(){
		$this->SessionLogsUpdate();
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('/businessideas');
        
    }
    
    public function checkSession(){
        
        if($this->data['session_exist'] = 1){
            $data['session_exist'] = 1;
        }else{
            $data['session_exist'] = 0;
        }
        echo json_encode($data);
    }
    
    public function LinkedinLogin(){
        $this->load->config('linkedin');
        include_once APPPATH."libraries/linkedin-oauth-client/http.php";
        include_once APPPATH."libraries/linkedin-oauth-client/oauth_client.php";
        $userData = array();
        $oauthStatus = $this->session->userdata('oauth_status');
        $sessUserData = $this->session->userdata('userData');
        if(isset($oauthStatus) && $oauthStatus == 'verified'){
            $userData = $sessUserData;
        }else if((isset($_GET["oauth_init"]) && $_GET["oauth_init"] == 1) || (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier']))){
            $client = new oauth_client_class;
            $client->client_id = $this->config->item('linkedin_api_key');
            $client->client_secret = $this->config->item('linkedin_api_secret');
            $client->redirect_uri = base_url().$this->config->item('linkedin_redirect_url');
            $client->scope = $this->config->item('linkedin_scope');
            $client->debug = false;
            $client->debug_http = true;
            $application_line = __LINE__;
            
            if($success = $client->Initialize()){
                if(($success = $client->Process())){
                    if(strlen($client->authorization_error)){
                        $client->error = $client->authorization_error;
                        $success = false;
                    }elseif(strlen($client->access_token)){
                        $success = $client->CallAPI('http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
                                        'GET',
                                        array('format'=>'json'),
                                        array('FailOnAccessError'=>true), $userInfo);
                    }
                }
                $success = $client->Finalize($success);
            }
            
            if($client->exit) exit;
            if($success){
                
				//Preparing data for database insertion
                $first_name = !empty($userInfo->firstName)?$userInfo->firstName:'';
                $last_name = !empty($userInfo->lastName)?$userInfo->lastName:'';
				$name=$first_name.'&nbsp'.$last_name;
                $userData = array(
                    'login_type'=> '3',
                    'oauth_provider'=> 'linkedin',
                    'oauth_uid' 	=> $userInfo->id,
                    'name' 	=> $name,
                    'email' 		=> $userInfo->emailAddress,
                    'profile_picture' 	=> $userInfo->pictureUrl
                );
                $oauth = ($userData['oauth_provider']=='facebook'? 1:($userData['oauth_provider']=='linkedin'?3:1));
                $email_exist = $this->Users->checkEmailOauthprovider($userData['email'],$oauth);
                if($email_exist == 0){
                    $userID = $this->Users->checkUser($userData);
                    if($userID){
                        $user_id = $userID;
                        $user_name = $userData['name'];
                        $user_email = $userData['email'];
                        $this->session->set_userdata('user', $user_id);
                        $this->session->set_userdata('username', $user_name);
                        $this->session->set_userdata('useremail', $user_email);	
                        redirect('/businessideas');
                    }
                }else{
                    $this->data['error_msg'] = 'A user with same email id exists!';
                }
                
            }else{
                $this->data['error_msg'] = 'Some problem occurred, please try again later!';
            }
        }elseif(isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> ""){
            $this->data['error_msg'] = $_GET["oauth_problem"];
        }else{
            $this->data['oauthURL'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
        }
	$this->data['userData'] = $userData;
	$this->template->load('plain', 'contents' , 'signin', $this->data);
    }
    
    public function forgotPassword(){
        $type= $this->input->post('type');
        if($type === 'phone'){
            $phone = $this->input->post('phone');
        }else{
            $email = $this->input->post('email');
        }
        
        if(!empty($phone)){
            $phone_exist = $this->Users->getUserDetails(array('mobile'=>$phone));
            if(isset($phone_exist) && is_array($phone_exist)){
                $otp_rndm = mt_rand(100000, 999999);
                $msg='OTP to rest password for your Viewham account is '.$otp_rndm;
                $data = $this->Users->sendsmsotp($phone,$msg);
                $userData = array(
                    'user_id'=>$phone_exist['id'],
                    'type'=>'phone',
                    'source' => $phone,
                    'otp' => $otp_rndm,
                    'status' => 0,
                    'created_at' => date("Y-m-d H:i:s"),
                );
                $insert = $this->Users->InsertOtp($userData);
                $array['issuccess'] =1;
            }else{
                $array['issuccess'] =0;
                $array['message'] = 'A user with given phone number do not exist';
            }
        }else if(!empty($email)){
            $email_exist = $this->Users->getUserDetails(array('email'=>$email));
            if(is_array($email_exist)){
                $otp_email_rndm = mt_rand(100000, 999999);
                $data = $this->Users->sendEmailotp($email,$otp_email_rndm);
                if($data){
                    $userData = array(
                        'user_id'=>$email_exist['id'],
                        'type'=>'email',
                        'source' => $email,
                        'otp' => $otp_email_rndm,
                        'status' => 0,
                        'created_at' => date("Y-m-d H:i:s"),
                    );
                    $insert = $this->Users->InsertOtp($userData);
                    $array['issuccess'] =1;
                }else{
                    $array['issuccess'] =2;
                    $array['message'] = 'A technical issue! could not send a email! Please try again alter';
                }
            }else{
                $array['issuccess'] =0;
                $array['message'] = 'A user with given email do no exist';
            }
        }
        echo json_encode($array);
    }
    
    public function Editprofile(){
        if(!empty($_POST)){
            if(!empty($_POST['profile_image_url'])){
                $picture = $_POST['profile_image_url'];//$this->UploadImage();
            }else{
                $picture = "";
            }
            
            $userData = array(
                'name' => strip_tags($this->input->post('name')),
                'linkedin_id' =>  strip_tags($this->input->post('Linkedin')),
                'gender' =>  strip_tags($this->input->post('GENDER')),
                'age' =>  strip_tags($this->input->post('age')),
            );
            if(($this->data['user']['login_type']==1 || 1==1) && $picture){
               $userData['profile_picture'] = str_replace("../",base_url(),$picture); 
            }
            
            $Updates = $this->Users->updateUser($userData, $this->data['user']['id']);
            if($Updates){
                $this->session->set_flashdata('success', 'This is my message');
                redirect('User/Editprofile');
            }else{
                echo "Update failed "; exit;
            }
	}
        
        $this->data['title'] = 'Edit Profile';
        $this->data['sub_title'] = '';
        $this->template->load('profile', 'contents' , 'users/edit_profile', $this->data);
    }

    function removeProfilepic(){
        
        $session_user = $this->session->userdata('user'); 
        $userData = array(
            'profile_picture' => ''
        );
        $update = $this->Users->UpdateUser($userData,$session_user);
	return json_encode($update);
    }
    
    public function UploadImage(){
        $config['upload_path'] = 'assets/images/uploads';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = time().$_FILES['avatar']['name'];
                
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('avatar')){
            $uploadData = $this->upload->data();
            $picture = $uploadData['file_name'];
        }else{
            echo $picture = 'not upload'; exit; 
        }
        return $picture;
    }
    public function sendPhoneSmsotp(){
        $session_user = $this->session->userdata('user'); 
        $phone = $this->input->post('phone');
        $otp_rndm = mt_rand(100000, 999999);
        if (is_numeric($phone))
        {   
            $msg='Welcome to Viewham Business Ideas. OTP : '.$otp_rndm;
            $send_otp = $this->Users->sendsmsotp($phone,$msg);
            $otp_details = array(
                'user_id' => $session_user,
                'source' => $phone,
                'otp' => $otp_rndm,
                'status' => 0,
                'created_at' => $send_otp,
                'type' =>'phone'    
            );
            $insert = $this->Users->insertOTP($otp_details);
            $array['issuccess'] = 1;
        }else{
            //return code if phone number is invalid
            $array['issuccess'] = 0;
        }
        echo json_encode($array);
    }
    public function emailVerificationLinkSend(){
         $session_user = $this->session->userdata('user'); 
         $email = $this->input->post('email');
         $send_email = $this->Users->sendEmailVerification($email,$session_user);
         if($send_email){
            $array['issuccess'] = 1;
            $array['message'] = 'Email Sent. Please Verify Your Email';
         }else{
            $array['issuccess'] = 0;
            $array['message'] = 'Oops Wrong';
         }
          echo json_encode($array);

    }
    public function VerifyOtpReferMobile(){
        $id = $this->session->userdata('user');
        $otp = $this->input->post('otp');
        $postid = $this->input->post('postid');
        $phone = $this->input->post('phone');
        $get_otp_details = $this->Users->getOTPDetails(array('user_id'=>$id,'type'=>'phone','status'=>0));
        
        if($get_otp_details['otp'] == $otp){
            $upateOTP['status']=1;
            $otpId=$get_otp_details['id'];
            $updateOTP = $this->Users->updateOTPstatus($upateOTP,$otpId);
            $array['issuccess'] = 1;
            $array['message'] = "Successfully Reference Mobile verified";
          
            $updatedetails['mobile'] = $phone;
            $updatedetails['r_mobile_auth'] = '1';
            $updatedetails['modified_date'] = date("Y-m-d H:i:s",time());
            $updateusers = $this->Earn_model->UpdateProfile($postid,$updatedetails);
            
        }else{
            $array['issuccess'] = 0;
            $array['message'] = "Wrong OTP";
        }
        echo json_encode($array);
    }
	public function verifyOtpMobile(){
        $id = $this->session->userdata('user');
        $otp = $this->input->post('otp');
        $phone = $this->input->post('phone');
        $get_otp_details = $this->Users->getOTPDetails(array('user_id'=>$id,'type'=>'phone','status'=>0));
        
        if($get_otp_details['otp'] == $otp){
            $upateOTP['status']=1;
            $otpId=$get_otp_details['id'];
            $updateOTP = $this->Users->updateOTPstatus($upateOTP,$otpId);
            $array['issuccess'] = 1;
            $array['success_message'] = "Successfully Mobile verified! Welcome to VIEWHAM";
          
            $updatedetails['mobile'] = $phone;
            $updatedetails['mobile_authenticated'] = '1';
            $updatedetails['updated_at'] = date("Y-m-d H:i:s",time());
            $updateusers = $this->Users->updateUser($updatedetails,$id);
            $array['user'] = $userdets;
            

        }else{
            $array['get_otp_details'] = $get_otp_details;
            $array['issuccess'] = 0;
            $array['failure_message'] = "Wrong OTP";
        }
        echo json_encode($array);
    }
    public function UpdateEmailVerificationLinkSend(){
         $session_user = $this->session->userdata('user'); 
         $email = $this->input->post('email');
		 $updatedetails['email'] = $email;
         $updatedetails['updated_at'] = date("Y-m-d H:i:s");
         $updatedetails['email_authenticated'] = 0;
         $send_email = $this->Users->sendEmailVerification($email,$session_user);
         if($send_email){
         $updateusers = $this->Users->updateUser($updatedetails,$session_user);
            $array['issuccess'] = 1;
            $array['message'] = 'Email Sent. Please Verify Your Email';
         }else{
            $array['issuccess'] = 0;
            $array['message'] = 'Oops Wrong';
         }
          echo json_encode($array);

    }	
    public function SessionLogsInsert(){
		$session_user = $this->session->userdata('user'); 
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
	public function UserEmailVerification() {
		$email = 	$this->uri->segment(3);	
		$session_user = $this->uri->segment(4); 
		$updatedetails['email'] = $email;
		$updatedetails['email_authenticated'] = 1;
        $updatedetails['updated_at'] = date("Y-m-d H:i:s");
        $updateusers = $this->Users->updateUser($updatedetails,$session_user);
		if($updateusers){
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			$this->session->set_flashdata('msg', '<h4 class="alert-success text-center"> Successfully email Updated</h4>');
			redirect("user/signin");
		}else{
			$this->session->set_flashdata('msg', '<h4 class="alert-danger text-center"> Email Updated failed</h4>');
			redirect("user/signin");
		}
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
public function img_crop_to_file(){

$imgUrl = $_POST['imgUrl'];
// original sizes
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
// resized sizes
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
// offsets
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
// crop box
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];
// rotation angle
$angle = $_POST['rotation'];

$jpeg_quality = 100;
$rand=rand();
$output_filename = "/assets/images/uploads/croppedImg_".$rand;

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

$what = getimagesize($imgUrl);

switch(strtolower($what['mime']))
{
    case 'image/png':
        $img_r = imagecreatefrompng($imgUrl);
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpeg':
        $img_r = imagecreatefromjpeg($imgUrl);
		$source_image = imagecreatefromjpeg($imgUrl);
		error_log("jpg");
		$type = '.jpeg';
        break;
    case 'image/gif':
        $img_r = imagecreatefromgif($imgUrl);
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: die('image type not supported');
}


//Check write Access to Directory

if(!is_writable(dirname($output_filename))){
	$response = Array(
	    "status" => 'error',
	    "message" => 'Can`t write cropped File'
    );	
}else{

    // resize the original image to size of editor
    $resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    // rotate the rezized image
    $rotated_image = imagerotate($resizedImage, -$angle, 0);
    // find new width & height of rotated image
    $rotated_width = imagesx($rotated_image);
    $rotated_height = imagesy($rotated_image);
    // diff between rotated & original sizes
    $dx = $rotated_width - $imgW;
    $dy = $rotated_height - $imgH;
    // crop rotated image to fit into original rezized rectangle
	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
	imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
	// crop image into selected area
	$final_image = imagecreatetruecolor($cropW, $cropH);
	imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
	// finally output png image
	//imagepng($final_image, $output_filename.$type, $png_quality);
	imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
	$output_filenamepath='/assets/images/uploads/croppedImg_'.$rand;
	$output_filename='croppedImg_'.$rand;
	$response = Array(
	    "status" => 'success',
	    "filename" => $output_filename.$type,
	    "url" => $output_filenamepath.$type
    );
}
print json_encode($response);
}
public function img_save_to_file(){
	 $imagePath = "../assets/images/uploads/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access'
		);
		print json_encode($response);
		return;
	}
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );

		  move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
		  $imagePathsss=base_url().'assets/images/uploads/';
		  $response = array(
			"status" => 'success',
			"url" => $imagePathsss.$_FILES["img"]["name"],
			"width" => $width,
			"height" => $height,
			"custom" => 1
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'The uploaded file is not a valid format. Please upload only image formats ',
		);
	  }
	  
	  print json_encode($response);
}

}
