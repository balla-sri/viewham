<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Notification_model');
    $this->load->model('Industry');
    $this->load->model('Skills');
	$this->load->library('session');
	$this->load->helper('viewham_helper');
	$this->load->helper('crypto_helper');
	$session_user = $this->session->userdata('user'); 
	if(!$session_user){		redirect('User/SignIn');}
	$this->data['session_exist'] = 0;
	if($session_user){
            $userdetails = $this->Users->getUserDetails(array('id'=>$session_user));
            if($userdetails['login_type']==1){
                $profile_pic = (isset($userdetails['profile_picture']))?$userdetails['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $userdetails['profile_picture'];
            }
            $this->data['user'] = $userdetails;
            $this->data['user']['profile_picture'] = $prof_pic;
            $this->data['session_exist'] = 1;
        }
        $this->data['industries'] = $this->Industry->getAll();
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
    }
	public function index()
	{
		$session_user = $this->session->userdata('user'); 
		$this->data['dashboard'] = $this->Users->DashbordValues($session_user);
//		echo "<pre>"; print_r($this->data['dashboard']); exit;
		$this->template->load('no-menu', 'contents' , 'dashboard/dashboard', $this->data);
	}
	private	function creditCoins(){
		$session_user = $this->session->userdata('user'); 	
		return 	$this->Coins_model->creditCoins($session_user);
	}
	private function debitCoins(){
		$session_user = $this->session->userdata('user'); 
		return $this->Coins_model->debitCoins($session_user);
	}
	public function UpdateSkillStatus(){

		$userData['status'] = strip_tags($this->input->post('status'));
		$post_id = strip_tags($this->input->post('post_id'));
		$update = $this->Skills->UpdateSkillStatus($userData,$post_id);
		if($userData){
			$data['status']=1;
		}else{
			$data['status']=0;
		}
	echo json_encode($data);	
	}	
}
