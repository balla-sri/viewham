<?php
class Outsource extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Outsource_model');
    $this->load->model('Skills');
    $this->load->model('Industry');
    $this->load->model('Notification_model');	
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
		$params['session_user']=$session_user;
		if(!empty($_GET)){ $params =($_GET);}
		$this->data['outsource'] = $this->Outsource_model->OutsourceProjects($params);
		$this->template->load('no-menu', 'contents' , 'outsource/outsource-projects-all', $this->data);
    }
    	
 
    public function SpendCoinds(){
		
		$debit = $this->input->post('coins');
		$postid = $this->input->post('postid');
		$text ='Outsource Project';
		$userid = $this->session->userdata('user'); 
		$userData = array(
					'coins' => strip_tags($this->input->post('coins')),
					'days' => $debit,
					'publish_start_date' => date("Y-m-d H:i:s"),
					'update_on' => date("Y-m-d H:i:s"),
					'status' => 1,
				);
        $query_result = $this->db->query('SELECT sum(credit)-sum(debit) as balance '
                                . 'FROM `vh_coins` where userid = '.$this->db->escape($userid));
        
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
				
	$update = $this->Outsource_model->UpdatePost($userData,$postid);
	if($update){
		$dData = array('amount' =>$debit,'payfrom'=>$text,'txn_id'=>'15');
		$data['debit'] = $this->debitCoins($dData);
		$outsource = $this->Outsource_model->SingleProject($postid);
		if($data['debit']){
			$Notification = array(
                'notification_type' => 15,
				'to_id' => $userid,
				'from_id' => $userid,
				'post_id' => $postid,
				'text' => 'Outsource work posted',
				'created_on' => date("Y-m-d H:i:s")
        );
		$sendNotification = $this->Notification_model->NotificationSendEnterprenurs($Notification,$outsource['industry']);	
			
		$nData = array('post_id' =>$postid,'text'=>'Insert Profile posted','notification_type'=>15);
		$this->SaveNotification($nData);
		$Date = $outsource['publish_start_date'];
		$days = $outsource['days'];
		$html = date('d-F-Y H:i:s', strtotime($Date)).'&nbsp To &nbsp'.date('d-F-Y H:i:s', strtotime($Date. ' + '.$days.' Hours')); 
		$data['status']='1';
		$data['postid']=$postid;
		$data['html']=$html;
		}
		}
		echo json_encode($data); exit;
	}

    public function addDataCheckErrors(){
		if(!empty($_POST)){
		$error = OutSourceFormValidate();
			if(!$error){		
			$data['error_status']=1;
			}else{
			$data['error_status']=0;
			}
			$data['error']=$error;
		}
		echo json_encode($data);
	}
	public function add(){
		$this->template->load('no-menu', 'contents' , 'outsource/outsource-work', $this->data);
	}
	public function addData(){
			$session_user = $this->session->userdata('user'); 
			if(!empty($_POST)){
			$error  ='';
			$error = OutSourceFormValidate();
				if(!$session_user){
					$session=1;	
					$data['emptySession']=$session;
				}else{
					$session='';
				}
		if(!$error && !$session){	
		$locations = array_filter($this->input->post('location'));	
		$userData = array(
                'industry' => strip_tags($this->input->post('industry')),
                'location' => json_encode($locations),
                'min_invest' => strip_tags($this->input->post('min_invest')),
                'currency_type' => strip_tags($this->input->post('currency_type')),
                'max_invest' => strip_tags($this->input->post('max_invest')),
                'duration_type' => strip_tags($this->input->post('duration_type')),
                'duration_min' => strip_tags($this->input->post('duration_min')),
                'duration_max' => strip_tags($this->input->post('duration_max')),
                'description' => $this->input->post('description'),
                'posted_by' => $session_user,
            );

		$userData['create_date'] = date("Y-m-d H:i:s");
		$Insertid = $this->Outsource_model->Insert_outsource($userData);
			if($Insertid){
			$data['insertId']=$Insertid;
			$data['insert_status']="1";
			}else{
			$data['insert_status']="2";
			}
		
		}else{
			$data['error']=$error;	
		 
			}
		}
		echo json_encode($data); 			
	}
 	public function Projects(){
		$session_user = $this->session->userdata('user'); 
		$this->data['projects'] = $this->Outsource_model->MyProjects($session_user);
		$this->template->load('no-menu', 'contents' , 'outsource/outsource-projects', $this->data);
	}
	public function Project($id){
			$this->data['outsource'] = $this->Outsource_model->SingleProject($id);
			$this->template->load('no-menu', 'contents' , 'outsource/outsource-work-detail', $this->data);
	} 
	
	public function BuyContact(){
		$userid = $this->session->userdata('user'); 
		$debit = 50;
			
	//// insert Payment Contact ///
		$payContact['buyerId']=$userid;
		$payContact['post_id']=strip_tags($this->input->post('post_id'));
		$payContact['post_type']=strip_tags($this->input->post('post_type'));
		$payContact['price']=$debit;
		$payContact['create_date']=date("Y-m-d H:i:s");
		
	//// insert initiate ///		
		
		$initiate['post_id'] =  strip_tags($this->input->post('post_id'));
		$initiate['post_type'] =  strip_tags($this->input->post('post_type'));
		$initiate['industry'] =  strip_tags($this->input->post('industry'));
		$initiate['status'] =  1;
		$initiate['posted_by'] =  $userid;
		$initiate['create_date'] =  date("Y-m-d H:i:s");
			
	//// insert Notification ///		
		$Notification['post_id'] =  strip_tags($this->input->post('post_id'));
		$Notification['to_id']   =  strip_tags($this->input->post('posted_by'));
		$Notification['from_id'] = $userid;
		$Notification['notification_type'] =  strip_tags($this->input->post('post_type'));
		$Notification['text']='viewed-contact';
		$Notification['created_on']=date("Y-m-d H:i:s");
	
		$postInitiate = $this->Outsource_model->InitiatesAll($initiate);
		$buyContact = $this->Outsource_model->BuyContact($payContact);
		if($buyContact){
	//// Coins Debit ///					
		$debitcoins = SpendCoins($debit,$userid,'Out Source Project Contact buy');	
		$insertNotification = $this->Outsource_model->NotificationAdd($Notification);
			if($insertNotification){
				$data['status']=1;
			}else{
				$data['status']=0;	
			}
		}
		echo json_encode($data);		
	}
	private function debitCoins($data){
		$session_user = $this->session->userdata('user');
		$coins['debit'] = $data['amount'];
		$coins['userid'] = $session_user;
		$coins['source'] = $data['payfrom'];
		$coins['txn_id'] = $data['txn_id'];
		$coins['create_date'] = date("Y-m-d H:i:s");
		return $this->Coins_model->insertCoins($coins);
	}	
	private function SaveNotification($nData){
		$session_user = $this->session->userdata('user');
		$Notification = array(
                'notification_type' => $nData['notification_type'],
				'from_id' => $session_user,
				'to_id' => $session_user,
				'post_id' => $nData['post_id'],
				'text' => $nData['text'],
				'created_on' => date("Y-m-d H:i:s")
        );
		$this->Notification_model->insertNotification($Notification);
	}
	public function creditCoins(){
		$session_user = $this->session->userdata('user'); 
		return 	$this->Coins_model->creditCoins($session_user);
	}
	public function Industry($id){
		return $industry = $this->Industry->getIndustry($id);
	}
	public function SingleProject($id){
		return $SingleProject = $this->Outsource_model->SingleProject($id);
	}
	public function responsesOutSourceWork($id){
		return $data = $this->Outsource_model->responsesOutSourceWork($id);	
	}
	public function Userdeatail($id){
		return $user = $this->Users->getUserDetails(array('id'=>$session_user));
	}	
	public function ContactPaid($id){
		return $ContactPaid = $this->Outsource_model->ContactPaid($id);
	}	
	
}
 