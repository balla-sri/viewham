<?php
class Skill extends CI_Controller{
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
    $this->load->model('Feedback_model');
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
		$session_user = $this->session->userdata('user');
		$params=array();
		if(!empty($_GET)){ $params =($_GET);}
		$params['session_user']=$session_user;
        $this->data['profile'] = $this->Profiles->getAll($params);
		$this->template->load('no-menu', 'contents' , 'profiles/skill-profiles', $this->data);
    }

    public function search(){
		$params=array();
		$session_user = $this->session->userdata('user'); 			
		$params['session_user']=$session_user;
		if(!empty($_GET)){
			$params['key']=$_GET['key'];
		}
		$params['e_post_type']=1;
		$params['inv_post_type']=2;
		$this->data['results'] = $this->Profiles->SearchProfiles($params);
//		echo "<pre>";print_r($this->data['results']); exit;
		$this->data['params']=$params;
		$this->template->load('no-menu', 'contents' , 'search/search', $this->data);
	}
    public function details($id){
        $SkillProfiles = $this->Profiles->SkillProfiles($id);
		$this->data['feedback'] = $this->Feedback_model->FeedbackByPostId($id); 
        $this->data['timings'] = $this->usertimings($SkillProfiles['posted_by'],$SkillProfiles['post_type']);
        $this->data['profile'] = $SkillProfiles;
		$this->template->load('no-menu', 'contents' , 'profiles/skill-details', $this->data);
    }
    public function FeedbackAddToSkill(){
		 $session_user = $this->session->userdata('user');
		 $userData = array(
                'postid' => strip_tags($this->input->post('keyid')),
                'rate' => strip_tags($this->input->post('impress')),
				'feedback' => strip_tags($this->input->post('feedback')),
				'post_type' => strip_tags($this->input->post('profile_type')),
                'posted_by' => $session_user,
                'created_date' => date("Y-m-d H:i:s")
	        );
		$insert = $this->Profiles->insertFeedback($userData);
		if($insert){
			$data['status']=1;
			$postid=strip_tags($this->input->post('keyid'));
			$toid=strip_tags($this->input->post('toid'));
			$this->saveNotificationsFeedback($postid,$toid);
		}else{
			$data['status']=2;	
		}
	echo json_encode($data); 
	}
    public function candidateprofile($id){
        $SkillProfiles = $this->Profiles->SkillProfiles($id);
        $this->data['timings'] = $this->usertimings($SkillProfiles['posted_by'],$SkillProfiles['post_type']);
        $this->data['profile'] = $SkillProfiles;
		$this->template->load('no-menu', 'contents' , 'profiles/candidate-profile', $this->data);
    }
    private function userTimings($user,$post_type){
		return $this->Earn_model->usertimings($user,$post_type);
	}
    public function ShortlistAdd(){
		$session_id = $this->session->userdata('user');
		if($session_id){
			$DataList = array(
					'pid' => strip_tags($this->input->post('pid')),
					'post_type' => strip_tags($this->input->post('post_type')),
					'status' => 1,
					'posted_by' => $session_id,
					'create_date' => date("Y-m-d H:i:s"),
				);
			$whereShortlist=array(
					'pid' => strip_tags($this->input->post('pid')),
					'post_type' => strip_tags($this->input->post('post_type')),
					'posted_by' => $session_id
				);	
			$shortList = $this->Shortlists_model->checkShortList($whereShortlist);
			if($shortList){
				$Insert = $this->Shortlists_model->ShortlistUpdate($DataList,$shortList['id']);
			}else{
				$Insert = $this->Shortlists_model->insertShortlists($DataList);
			}
			if($Insert){
				$response['insert']=1;
				$postid=strip_tags($this->input->post('pid'));
				$toid=strip_tags($this->input->post('toid'));
				$post_type=strip_tags($this->input->post('post_type'));
				$this->saveNotificationShortList($postid,$toid,$post_type);
			}else{
				$response['insert']=2;
			}
		}else{
				$response['session']=3;
		}
		echo json_encode($response); 	
	}
	private function saveNotificationShortList($postid,$to,$post_type){
		$session_id = $this->session->userdata('user');
			$NotificationToUser = array(
					'post_id' => $postid,
					'to_id' => $to,
					'from_id' => $session_id,
					'post_type' => $post_type,
					'text' => 'Shortlisted Your Profile',
					'status' => 1,
					'notification_type' => 24,
					'created_on' => date("Y-m-d H:i:s"),
                );
			$NotificationToYou = array(
					'post_id' => $postid,
					'to_id' => $session_id,
					'from_id' => $session_id,
					'post_type' => $post_type,
					'text' => 'Shortlisted Profile',
					'status' => 1,
					'notification_type' => 25,
					'created_on' => date("Y-m-d H:i:s"),
                );
		$this->Notification_model->insertNotification($NotificationToUser);			
		$this->Notification_model->insertNotification($NotificationToYou);			
	}
	private function saveNotificationsFeedback($postid,$to){
		$session_id = $this->session->userdata('user');
			$NotificationToUser = array(
					'post_id' => $postid,
					'to_id' => $to,
					'from_id' => $session_id,
					'text' => 'You Got Feedback',
					'status' => 1,
					'notification_type' => 26,
					'created_on' => date("Y-m-d H:i:s"),
                );
			$NotificationToYou = array(
					'post_id' => $postid,
					'to_id' => $session_id,
					'from_id' => $session_id,
					'text' => 'Feedback Posted',
					'status' => 1,
					'notification_type' => 27,
					'created_on' => date("Y-m-d H:i:s"),
                );
		$this->Notification_model->insertNotification($NotificationToUser);			
		$this->Notification_model->insertNotification($NotificationToYou);			
	}
	public function Shortlists(){
		$session_id = $this->session->userdata('user');
		if(empty($session_id)){
			redirect('');
		}
		$params=array();
		if(!empty($_GET)){
		$params=($_GET);	
			if($_GET['Entrepreneur']){	
				$params['post_type'][]=1;
			}
			if($_GET['Investor']){	
				$params['post_type'][]=2;
			}
			
		}
		$params['session_id']=$session_id;
		$this->data['profile'] = $this->Shortlists_model->ShortlistProfiles($params);

		$this->template->load('no-menu', 'contents' , 'profiles/shortlists-profiles', $this->data);		
	}
	public function ShortlistRemove(){
		$session_id = $this->session->userdata('user');
		if($session_id){
			$pid = strip_tags($this->input->post('pid'));
			$userData['status']=3;	
			$remove = $this->Shortlists_model->ShortlistUpdate($userData,$pid);
				if($remove){
					$dataa['remove']=1;
				}else{
					$dataa['remove']=2;
				}
		}else{
				$dataa['remove']=3;
		}
		echo json_encode($dataa); 
		
	}	
	public function BuyContact(){
		$data=array();
		$session_id = $this->session->userdata('user'); 
		if($session_id){
			$debit=10;	
			$payContact['buyerId']=$session_id;
			$payContact['post_id']=strip_tags($this->input->post('post_id'));
			$payContact['post_type']=strip_tags($this->input->post('post_type'));
			$payContact['price']=$debit;
			$payContact['create_date']=date("Y-m-d H:i:s");
		
			$buyContact = $this->Contacts_model->BuyContact($payContact);
			
			if($buyContact){
				$pid = strip_tags($this->input->post('post_id'));
				$post_type = strip_tags($this->input->post('post_type'));
				$cData=array('pid'=>$pid,'debit'=>$debit,'source'=>'Contact Buy'); 
				$nData=array('pid'=>$pid,'nType'=>28,'text'=>'Contact Buy'); 
			$this->CoinsDebit($cData);
			$insertNotification = $this->NotificationAdd($nData);
				if($insertNotification){
					$data['status']=1;
				}else{
					$data['status']=0;	
				}
			}else{
					$data['status']=0;	
			}
		}else{
					$data['session']=1;	
		}
		
		echo json_encode($data);		
	}
	private function CoinsDebit($cData){
		$session_id = $this->session->userdata('user'); 
			$coins['debit']   = $cData['debit'];
			$coins['userid']  = $session_id;
			$coins['txn_id']  = $cData['pid'];
			$coins['source']  = $cData['source'];
	return $coinsInsert = $this->Coins_model->insertCoins($coins);
	}
	private function NotificationAdd($nData){
		$session_id = $this->session->userdata('user'); 
		$Notification['post_id'] = $nData['pid'];
		$Notification['to_id']   = $session_id;
		$Notification['from_id'] = $session_id;
		$Notification['notification_type'] = $nData['nType']; 
		$Notification['text']=$nData['text'];
		$Notification['created_on']=date("Y-m-d H:i:s");
		return $this->Notification_model->insertNotification($Notification);
	}
	function checkSession(){
		$session_user = $this->session->userdata('user'); 
		if(!empty($session_user)){
			    $data['session_exist'] = 1;
		}else{
			    $data['session_exist'] = 0;
		}
		 echo json_encode($data);
	} 
}
