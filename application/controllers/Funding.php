<?php
class Funding extends CI_Controller{
    function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Franchise_model');
    $this->load->model('Funding_model');
    $this->load->model('Notification_model');
    $this->load->model('Industry');
    $this->load->model('Skills');
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

    function index(){
		redirect('Funding/add');
    }
    public function SpendCoinds(){
		
		$debit = $this->input->post('coins');
		$postid = $this->input->post('postid');
		$text ='Request for funding posted';
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
		$update = $this->Funding_model->UpdatePost($userData,$postid);
		if($update){
		$dData = array('amount' =>$debit,'payfrom'=>$text,'txn_id'=>'15');
		$data['debit'] = $this->debitCoins($dData);
		$funding = $this->Funding_model->SingleFunding($postid);
		if($data['debit']){
			$Notification = array(
                'notification_type' => 17,
				'to_id' => $userid,
				'from_id' => $userid,
				'post_id' => $postid,
				'text' => 'funding posted',
				'created_on' => date("Y-m-d H:i:s")
        );
		$sendNotification = $this->Notification_model->NotificationSendinvestors($Notification,$funding['industry']);	
		$nData = array('post_id' =>$postid,'text'=>'Insert Profile posted','notification_type'=>17);
		$this->SaveNotification($nData);
		$Date = $funding['publish_start_date'];
		$days = $funding['days'];
		$html = date('d-F-Y H:i:s', strtotime($Date)).'&nbsp To &nbsp'.date('d-F-Y H:i:s', strtotime($Date. ' + '.$days.' Hours')); 
		$data['status']='1';
		$data['postid']=$postid;
		$data['html']=$html;
		}
		}
		echo json_encode($data); 
	}

	public function addDataCheckErrors(){
		if(!empty($_POST)){
		$error = FranchiseformValidate();
		
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
		$this->template->load('no-menu', 'contents' , 'funding/request-for-funding', $this->data);
	}
    public function FundingFormCheckErrors(){
		$error = FundingFormValidate();
		if(!$error){		
		$data['error_status']=1;
		}else{
		$data['error_status']=0;
		}
		$data['error']=$error;
		echo json_encode($data);
	}
    public function FundingFormSubmit(){
		$session_user = $this->session->userdata('user'); 	
		$error = FundingFormValidate();
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
                'currency' => strip_tags($this->input->post('currency')),
                'min_amount' => strip_tags($this->input->post('min_amount')),
                'max_amount' => strip_tags($this->input->post('max_amount')),
                'share_min' => strip_tags($this->input->post('share_min')),
                'share_max' => strip_tags($this->input->post('share_max')),
                'current_status' => strip_tags($this->input->post('current_status')),
                'expected_role' => strip_tags($this->input->post('expected_role')),
                'description' => $this->input->post('description'),
                'posted_by' => $session_user,
                'create_date' => date("Y-m-d H:i:s")
            );
		
		$Insertid = $this->Funding_model->Insert_Funding($userData);
		if($Insertid){
				$data['insertId']=$Insertid;
				$data['insert_status']="1";
			}else{
				$data['insert_status']="2";
			}
		}else{
			$data['error']=$error;	
		 
		}
		echo json_encode($data); 
	}
	public function MyRequests(){
		$session_user = $this->session->userdata('user'); 
		$this->data['projects'] = $this->Funding_model->MyProjects($session_user);
		$this->template->load('no-menu', 'contents' , 'funding/my-projects', $this->data);
	}
	public function detail($id){
		$this->data['responses'] = $this->Funding_model->responsesFunding($id);
		$this->data['funding'] = $this->Funding_model->SingleFunding($id);
		$this->template->load('no-menu', 'contents' , 'funding/request-for-funding-view', $this->data);
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
	public function SingleFunding($id){
		return $SingleFranchise = $this->Funding_model->SingleFunding($id);
	}	
	public function responsesFunding($id){
		return $data = $this->Funding_model->responsesFunding($id);	
	}
	public function Userdeatail($id){
		return $user = $this->Users->getUserDetails(array('id'=>$session_user));
	}	
	public function ContactPaid($id){
		return $ContactPaid = $this->Outsource_model->ContactPaid($id);
	}	

	
}
