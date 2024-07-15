<?php
class Coins extends CI_Controller{
    function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Notification_model');
    $this->load->model('Industry');
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

    public function index(){
		$params=array();
		$session_user = $this->session->userdata('user'); 	
		$conditions['where'] = array('credit >'=>0,'userid'=>$session_user);
		$conditions['order_by'] = "id DESC";
        $conditions['limit'] = 10;
		$debit['where'] = array('debit >'=>0,'userid'=>$session_user);
		$debit['order_by'] = "id DESC";
        $debit['limit'] = 10;
		$this->data['credit'] = $this->Coins_model->getRowsCoins($conditions);
		$this->data['debit'] = $this->Coins_model->getRowsCoins($debit);
	//	$this->data['credit'] = $this->creditCoins();
//		$this->data['debit'] = $this->debitCoins();
		$this->data['total'] = TotalCoins();
		$this->template->load('no-menu', 'contents' , 'coins/all-coins', $this->data);
    }
    public function LoadMoreCrediCoins(){
        $conditions = array();
		$session_user = $this->session->userdata('user'); 	
		$lastID = $this->input->post('id');
		$conditions['where'] = array('credit >'=>0,'id <'=>$lastID,'userid'=>$session_user);
        $conditions['returnType'] = 'count';
        $data['postNum'] = $this->Coins_model->getRowsCoins($conditions);
        
        $conditions['returnType'] = '';
        $conditions['order_by'] = "id DESC";
        $conditions['limit'] = 10;
        $data['posts'] = $this->Coins_model->getRowsCoins($conditions);
        $data['postLimit'] = 10;
        $this->load->view('coins/loadmoreCredit', $data, false);
    }
    public function LoadMoreDebitiCoins(){
        $conditions = array();
		$session_user = $this->session->userdata('user'); 	
		$lastID = $this->input->post('id');
		$conditions['where'] = array('debit >'=>0,'id <'=>$lastID,'userid'=>$session_user);
        $conditions['returnType'] = 'count';
        $data['postNum'] = $this->Coins_model->getRowsCoins($conditions);
        $conditions['returnType'] = '';
        $conditions['order_by'] = "id DESC";
        $conditions['limit'] = 10;
        $data['posts'] = $this->Coins_model->getRowsCoins($conditions);
        $data['postLimit'] = 10;
        $this->load->view('coins/loadmoreDebit', $data, false);
    }
    public function cc(){
		 $this->load->view('coins/form');
	}	
    public function ccavRequestHandler(){
    	if(ENVIRONMENT=='development'){
       		$this->load->view('coins/ccavRequestHandler');
    	}
       	else{
   			$this->payDone();
       	}

    }
    public function add(){
		$this->data['credit'] = $this->creditCoins();
		$this->data['debit'] = $this->debitCoins();
		$this->data['merchant_id'] = $this->config->item('merchant_id');
		$this->data['pay_currency_type'] = $this->config->item('pay_currency_type');
		$this->data['pay_pincode'] = $this->config->item('pay_pincode');
		$this->data['pay_country'] = $this->config->item('pay_country');
		$this->data['pay_state'] = $this->config->item('pay_state');
		$this->data['pay_city'] = $this->config->item('pay_city');
		$this->data['pay_address'] = $this->config->item('pay_address');
		$this->data['total'] = TotalCoins();
		$this->template->load('no-menu', 'contents' , 'coins/add-coins', $this->data);
    }
	public	function creditCoins(){
		$session_user = $this->session->userdata('user'); 	
		return 	$this->Coins_model->creditCoins($session_user);
	}
	public function debitCoins(){
		$session_user = $this->session->userdata('user'); 
		return $this->Coins_model->debitCoins($session_user);
	}
	public function processPaymentData($encresp){
		error_reporting(0);
		$workingKey=$this->config->item('working_key');
		$encResponse=$encresp;
		$rcvdString=decrypt($encResponse,$workingKey);	
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information=explode('=',$decryptValues[$i]);
			if($i==3)	$order_status=$information[1];
		}
		$response['decryptValues'] =$decryptValues;
		$response['dataSize'] =$dataSize;		 
		$response['order_status'] =$order_status;		 
		return $response;
	}
	public function payDone()
    {
    	$response['order_status'] = 'Success';
    	if(ENVIRONMENT=='development'){
			$response = $this->processPaymentData($_POST["encResp"]);
		}
		if($response['order_status']==="Success"){
			

			$msg = "Your transaction is successful";
			if(ENVIRONMENT=='development'){
				$data='';
				for($i = 0; $i < $response['dataSize']; $i++){
					$information=explode('=',$response['decryptValues'][$i]);			
					$data[$information[0]]=$information[1];
				}
			}else{
				$data['amount'] = 100;
				$data['tracking_id'] = 'DUMMYTRANSACTION';
				$data['payment_mode'] = 'Viewham Local';
				$data['card_name'] = 'Test';

			}
				 

			$coins_insert = $this->saveCoins($data);
			if($coins_insert){
				$notification_insert = $this->saveNotification($coins_insert);
			}

		}
		else if($order_status==="Aborted"){
			$msg = "Aborted";
		}
		else if($order_status==="Failure")	{
			$msg = "The transaction has been declined.";
		}
		else{
			$msg = "Security Error. Illegal access detected";
		}		
		$this->session->set_flashdata('transaction_msg', $msg);
		redirect("Coins/add");
	}
	private function saveCoins($data){
		$session_user = $this->session->userdata('user');
		$paydata = json_encode($data);
		$payfrom = $data['payment_mode'].'&nbsp-&nbsp'.$data['card_name'];

		$coins['credit'] = $data['amount'];
		$coins['userid'] = $session_user;
		$coins['source'] = $payfrom;
		$coins['txn_id'] = $data['tracking_id'];
		$coins['remark'] = $paydata;
		$coins['create_date'] = date("Y-m-d H:i:s");
		return $this->Coins_model->insertCoins($coins);
	}


	private function saveNotification($coins_insert){
		$session_user = $this->session->userdata('user');
		$notification['notification_type'] = '2';
		$notification['to_id'] = $session_user;
		$notification['from_id'] = $session_user;
		$notification['text'] = 'credit';
		$notification['post_id'] = $coins_insert;
		$notification['created_on'] = date("Y-m-d H:i:s");
		$this->Notification_model->insertNotification($notification);
	}
}
