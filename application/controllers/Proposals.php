<?php
class Proposals extends CI_Controller{
    function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Profiles');
    $this->load->model('Notification_model');
    $this->load->model('Contacts_model');
    $this->load->model('Shortlists_model');
    $this->load->model('Skills');
    $this->load->model('Industry');
    $this->load->model('Earn_model');
	$this->load->library('session');
	$this->load->helper('viewham_helper');
	$this->load->helper('crypto_helper');
	$session_user = $this->session->userdata('user'); 
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
        $this->data['skills'] = $this->Skills->getAll();
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
    }

    public function index(){
		$params=array();
		$params['session_user'] = $this->session->userdata('user'); 
        $this->data['proposals'] = $this->Notification_model->Proposals($params);
		$this->template->load('no-menu', 'contents' , 'proposals/proposals', $this->data);
    }
    public function NotificationUpdate(){
		$params=array();
		$params['session_user'] = $this->session->userdata('user');		
		$nData['status']=strip_tags($this->input->post('status'));	
		$id=strip_tags($this->input->post('nid'));	
		$proposalUpdate = $this->Notification_model->ProposalsUpdate($nData,$id);
		$proposals = NotificationsCount();
		if($proposalUpdate){
			$result['totalCount']=$proposals['totalCount'];
			$result['fromYou']=$proposals['fromYou'];
			$result['toYou']=$proposals['toYou'];
			$result['isSuccess']=1;
		}else{
			$result['isSuccess']=0;
			$result['message']="Update failed";
		}
		echo json_encode($result);
    }

    public function PaidContactOrNot(){
		$result=array();
		$params['post_id']=strip_tags($this->input->post('postid'));	
		$params['post_type']=strip_tags($this->input->post('post_type'));	
		$params['session_user'] = $this->session->userdata('user');		
		$view=$this->Notification_model->PaidContactOrNot($params);
		if($view['viewedContact']){
			$u=$view['user'];
			$html='<div id="contactDetails" class="">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> '.$u["name"].'<br>
						   <b>Mobile:</b> '.$u["mobile"].' <br>
						   <b>E-mail:</b> <a href="mailto:'.$u["email"].'" class="link">'.$u["email"].'</a></p>
					</div>';
				$result['html']=$html;
				$result['view']=$view;
				$result['isSuccess']=1;
			}else{
				$html = '<div class="pay">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider">
					<p class="text-right">
						<button id="buy_contact" data-post_by="" data-postid="'.$params['post_id'].'" data-post_type="'.$params['post_type'].'" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>';
				$result['isSuccess']=1;
				$result['message']="Not paid";
				$result['html']=$html;
			}
		echo json_encode($result);
	}
 
}
