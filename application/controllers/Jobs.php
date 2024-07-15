<?php
class Jobs extends CI_Controller{
    Public function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Jobs_model');
    $this->load->model('Earn_model');
    $this->load->model('Industry');
    $this->load->model('Skills');
    $this->load->model('Shortlists_model');
    $this->load->model('Notification_model');
    $this->load->model('Contacts_model');
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
		$this->data['total'] = TotalCoins();
        $this->data['industries'] = $this->Industry->getAll();
        $this->data['skills'] = $this->Skills->getAll();
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
    }

    public function index(){
	$params=array();
	$session_user = $this->session->userdata('user');
	if($session_user){	
	$this->data['profiles'] = $this->Jobs_model->ProfileByUser($session_user);	
	$params['session_user'] = $session_user;
	}else{
	$this->data['profiles'] ='';	
	}	
	if(!empty($_GET)){ $params =($_GET);}
	$params['work_type']=$job_type[$slug]; 
		
	$this->data['session_userid'] = $session_user;	
	$this->data['alljobs'] = $this->Jobs_model->jobOffers($params);	
	$this->template->load('no-menu', 'contents' , 'offer-a-work/jobs-list', $this->data);
    }
    public function type($slug=''){
	$params=array();
			$job_type=array(
					'part-time'=>1,
					'full-time'=>2,
					'work-from-home'=>3,
					'internship'=>4,
					'fresher'=>5,
					'contract'=>6,
					'commission'=>7,
					'volunteer'=>8
				);	
				$job_page=array(
					1=>'Part Time',
					2=>'Full Time',
					3=>'Work from home',
					4=>'Internship',					
					5=>'Fresher',					
					6=>'Contract',					
					7=>'Commission',					
					8=>'volunteer'					
				);	
	$pagename=$job_type[$slug]; 
	$this->data['page_name']=$job_page[$pagename]; 
	$session_user = $this->session->userdata('user');
	if($session_user){	
	$this->data['profiles'] = $this->Jobs_model->ProfileByUser($session_user);	
	}else{
	$this->data['profiles'] ='';	
	}	
	
	if(!empty($_GET)){ $params =($_GET);}
	$params['work_type']=$job_type[$slug]; 
	$params['session_user'] = $session_user;	
	$this->data['session_userid'] = $session_user;	
	$this->data['alljobs'] = $this->Jobs_model->jobOffers($params);	
	$this->template->load('no-menu', 'contents' , 'offer-a-work/jobs-list', $this->data);
    }
    public function Offerwork(){
		$this->template->load('no-menu', 'contents' , 'offer-a-work/offer-a-work-form', $this->data);
    }  
	Public function OfferFormCheckErrors(){
		if(!empty($_POST)){
			$error = OfferformValidate();
			if(!$error){		
				$data['error_status']=1;
			}else{
				$data['error_status']=0;
			}
			$data['error']=$error;
		}
		echo json_encode($data);
	}	

    public function OfferFormSubmit(){
   	$session_user = $this->session->userdata('user'); 	
	$error = OfferformValidate();
				if(!$session_user){
					$session=1;	
					$data['emptySession']=$session;
				}else{
					$session='';
				}
		if(empty($error) && empty($session)){	
		$locations = array_filter($this->input->post('location'));		 
		$skill_id= strip_tags($this->input->post('skill'));
		$userData = array(
                'skill' => strip_tags($this->input->post('skill')),
                'location' => json_encode($locations),
                'description' => $this->input->post('description'),
                'experience' => strip_tags($this->input->post('experience')),
                'currency' => strip_tags($this->input->post('currency')),
                'min_salary' => strip_tags($this->input->post('min_salary')),
                'max_salary' => strip_tags($this->input->post('max_salary')),
                'income_type' => strip_tags($this->input->post('income_type')),
                'work_type' => strip_tags($this->input->post('work_type')),
                'posted_by' => $session_user,
                'create_date' => date("Y-m-d H:i:s")
            );
		
		
		$Insertid = $this->Jobs_model->Insert_offerWork($userData);
			if($Insertid){
				$data['insertId']=$Insertid;
				$data['skill_id']=$skill_id;
				$data['insert_status']="1";
				$data['error']=$error;	
			}else{
				$data['error']=$error;	
				$data['insert_status']="0";
				$data['message']='Enter all fields';	
			}
	
		}else{
			$data['error']=$error;	
			$data['message']='Enter all fields';	
			$data['insert_status']='0';	
		}
	echo json_encode($data); 
    }
  public function SpendCoinds(){
		$debit = $this->input->post('coins')*2;
		$postid = $this->input->post('postid');
		$skill_id = $this->input->post('skill_id');
		$text ='offer a Work Published';
		$session_user = $this->session->userdata('user'); 
		$userData = array(
					'coins' => strip_tags($this->input->post('coins')),
					'days' => $debit,
					'publish_start_date' => date("Y-m-d H:i:s"),
					'update_on' => date("Y-m-d H:i:s"),
					'status' => 1,
				);
        $query_result = $this->db->query('SELECT sum(credit)-sum(debit) as balance '
                                . 'FROM `vh_coins` where userid = '.$this->db->escape($session_user));
        
        $coins_row = $query_result->row();
        
        if($coins_row){
            $coin_balance = $coins_row->balance;
        }else{
            $coin_balance = 0;
        }        
        if($coin_balance < $debit){
            $data['status'] = 2;
            $data['error_message'] = "No sufficient coins. Please add coins";
            echo json_encode($data);
            exit;
        }
	$update = $this->Jobs_model->UpdatePostOfferWork($userData,$postid);
			
	if($update){
		$dData = array('debit' =>$debit,'source'=>$text,'pid'=>$postid);
		$data['debit'] = $this->CoinsDebit($dData);
		$OfferWork = $this->Jobs_model->SingleOfferWork($postid);
		if($data['debit']){
			$Notification = array(
					'notification_type' => '18',
					'from_id' => $session_user,
					'post_id' => $postid,
					'skill_id' => $skill_id,
					'text' => 'Offer a work published',
					'created_on' => date("Y-m-d H:i:s")
			);
			$NotificationToMe = array(
					'notification_type' => '18',
					'from_id' => $session_user,
					'to_id' => $session_user,
					'post_id' => $postid,
					'skill_id' => $skill_id,
					'text' => 'Offer a work published',
					'created_on' => date("Y-m-d H:i:s")
			);
		$sendNotificationToMe = $this->Jobs_model->NotificationAdd($NotificationToMe);	
		$sendNotificationToAll = $this->Jobs_model->NotificationAddToAllProfiles($Notification,$OfferWork['skill']);	
		}
		$Date = $OfferWork['publish_start_date'];
		$days = $OfferWork['days'];
		$html = date('d-F-Y H:i:s', strtotime($Date)).'&nbsp To &nbsp'.date('d-F-Y H:i:s', strtotime($Date. ' + '.$days.' Hours')); 
		$data['postid']=$postid;
		$data['status']='1';
		$data['html']=$html;
		}
		echo json_encode($data); 
	}	
	
	public function MyOfferWorks(){
		$session_user = $this->session->userdata('user'); 
		$this->data['offers'] = $this->Jobs_model->OfferWorksByUser($session_user);
		$this->template->load('no-menu', 'contents' , 'offer-a-work/my-offer-works', $this->data);
	}
	public function details($id){
		$this->data['job'] = $this->Jobs_model->SingleOfferWork($id);
		$this->data['jobNotifications'] = $this->Jobs_model->PostNotifications(array('post_id'=>$id,'post_type'=>10));
		$this->data['income_type'] = array('1'=>'Daily','2'=>'Monthly','3'=>'Yearly');
		$this->template->load('no-menu', 'contents' , 'offer-a-work/offer-a-work-view', $this->data);
	} 	 
    public function interest(){
		$session_id = $this->session->userdata('user');
		if($session_id){
			$DataList = array(
					'post_id' => strip_tags($this->input->post('pid')),
					'post_type' => strip_tags($this->input->post('post_type')),
					'status' => 1,
					'posted_by' => $session_id,
					'create_date' => date("Y-m-d H:i:s"),
				);
			
			$Insert = $this->Shortlists_model->SaveInrest($DataList);
			if($Insert){
				$response['insert']=1;
				$postid=strip_tags($this->input->post('pid'));
				$toid=strip_tags($this->input->post('posted_by'));
				$this->saveNotificationInterest($postid,$toid);
			}else{
				$response['insert']=2;
			}
		}else{
				$response['session']=2;
		}
		echo json_encode($response); 	
	}
	private function saveNotificationInterest($postid,$to){
		$session_id = $this->session->userdata('user');
			$NotificationToUser = array(
					'post_id' => $postid,
					'to_id' => $to,
					'from_id' => $session_id,
					'text' => 'Apply Job',
					'status' => 1,
					'notification_type' => 29,
					'created_on' => date("Y-m-d H:i:s"),
                );
			$NotificationToYou = array(
					'post_id' => $postid,
					'to_id' => $session_id,
					'from_id' => $session_id,
					'text' => 'Apply Job',
					'status' => 1,
					'notification_type' => 29,
					'created_on' => date("Y-m-d H:i:s"),
                );
		$this->Notification_model->insertNotification($NotificationToUser);			
		$this->Notification_model->insertNotification($NotificationToYou);			
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
				$nData=array('pid'=>$pid,'nType'=>30,'text'=>'Contact Buy'); 
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
}
