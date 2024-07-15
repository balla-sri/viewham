<?php
class Gain extends CI_Controller{
    Public function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
	$this->load->library('session');
    $this->load->model('Skills');
    $this->load->model('Industry');	
    $this->load->model('Gain_model');	
    $this->load->model('Investor_model');	
    $this->load->model('Notification_model');	
	$this->load->helper('viewham_helper');
	$this->load->helper('gain_helper');
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
		if($this->data['session_exist']==1){
			redirect('dashboard');
		}
		$this->template->load('no-menu', 'contents' , 'statics/knowmore-gain', $this->data);
    }
    public function EntrepreneurValidation(){
		$data['error'] = EntrepreneurFormValidate();
		echo json_encode($data);
	}
    public function EntrepreneurFormSubmit(){
		$session_user = $this->session->userdata('user');
		if(!empty($_POST)){
			$errors = EntrepreneurFormValidate();
			$postType = '1';
			if(!$session_user){
				$response['session']='1';
				$check='';
			}else{
				$check = $this->Gain_model->checkEntrepreneur_byuser($session_user);
				if($check){
					$response['exist']="1";
					$response['message']="<span class='error'>You have already created Entrepreneur Profile</span>";
				}
			}

		if(!$errors && !$check && $session_user){
		$association = json_encode($_POST['roles']);
		$locations = array_filter($this->input->post('location'));
 		$userData = array(
                'industry' => strip_tags($this->input->post('industry')),
                'association' => strip_tags($association),
                'location' => json_encode($locations),
                'currency' => strip_tags($this->input->post('currency')),
                'min_budget' => strip_tags($this->input->post('min_budget')),
                'max_budget' => strip_tags($this->input->post('max_budget')),
                'experience' => strip_tags($this->input->post('experience')),
                'nature' => strip_tags($this->input->post('nature')),
                'posted_by' => $session_user,
                'post_type' => $postType,
                'create_date' => date("Y-m-d H:i:s"),
                'modified_date' => date("Y-m-d H:i:s")
            );


			$Insert = $this->Gain_model->InsertEnerprenur($userData);
			if($Insert){
			
				$cData = array('amount' =>100,'payfrom'=>'Entrepreneur Profile','txn_id'=>'9');
				$coins = $this->saveCoins($cData);	
				$nData = array('post_id' =>$Insert,'text'=>'Entrepreneur Profile posted','notification_type'=>9,'post_type'=>1);
				$this->SaveNotification($nData);
				$response['insert_status']="1";			
				$response['message']="Successfully created. Your Entrepreneur Profile";			
			}else{
				$response['insert_status']="0";
			}
		}else{
			$response['error']=$errors;
		}	
			echo json_encode($response); 
		}
	
	}
	private function saveCoins($data){
		$session_user = $this->session->userdata('user');
		$coins['credit'] = $data['amount'];
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
				'post_type' => $nData['post_type'],
				'text' => $nData['text'],
				'created_on' => date("Y-m-d H:i:s")
        );

		$this->Notification_model->insertNotification($Notification);
	}
    public function Entrepreneur(){
		$session_user = $this->session->userdata('user'); 		
		$entrepreneur = $this->Gain_model->checkEntrepreneur_byuser(		$session_user);
			if($entrepreneur){
				redirect('entrepreneur/');
			}
		$this->template->load('no-menu', 'contents' , 'gain/gain-entrepreneur', $this->data);
	}
    public function InvestorValidation(){
		$data['error'] = InvestorFormValidate();
		echo json_encode($data);
	}	
    public function Investor(){
		$session_user = $this->session->userdata('user'); 		
		$investor = $this->Investor_model->checkInvestor_byuser($session_user);
		if($investor){
			redirect('investor/');
		}

		$this->template->load('no-menu', 'contents' , 'gain/gain-investor', $this->data);	

	}
	public function InvestorFormSubmit(){
		$session_user = $this->session->userdata('user');
		if(!empty($_POST)){
			$errors = InvestorFormValidate();
			$postType = '2';
			if(!$session_user){
				$response['session']='1';
				$check='';
			}else{
				$check = $this->Gain_model->checkInvestor_byuser($session_user);
		if($check){
			$response['exist']="1";
			$response['message']="<span class='error'>You have already created Investor Profile</span>";
			}
		}
		if(!$errors && !$check && $session_user){
			$industries = json_encode($_POST['industry']);
			$association = json_encode($_POST['roles']);
			$locations = array_filter($_POST['location']);
	 		$userData = array(
                'industry' => strip_tags($industries),
                'association' => strip_tags($association),
                'location' => json_encode($locations),
                'investment_currency' => strip_tags($this->input->post('investment_currency')),
                'min_invest' => strip_tags($this->input->post('min_invest')),
                'max_invest' => strip_tags($this->input->post('max_invest')),
                'share_currency' => strip_tags($this->input->post('share_currency')),
                'min_share' => strip_tags($this->input->post('min_share')),
                'max_share' => strip_tags($this->input->post('max_share')),
                'posted_by' => $session_user,
                'post_type' => $postType,
				'create_date' => date("Y-m-d H:i:s"),
                'modified_date' => date("Y-m-d H:i:s")
            );
            
		$Insert = $this->Gain_model->InsertEnerprenur($userData);
			if($Insert){
				$cData = array('amount' =>100,'payfrom'=>'Investor Profile','txn_id'=>'10');
				$coins = $this->saveCoins($cData);	
				$nData = array('post_id' =>$Insert,'text'=>'Investor Profile posted','notification_type'=>10,'post_type'=>2);
				$this->SaveNotification($nData);
				$response['insert_status']="1";			
				$response['message']="Successfully created. Your Investor Profile";			
			}else{
				$response['insert_status']="0";
				$response['message']="Oops wrong.. please try again later";
			}
		}else{
			$response['error']=$errors;
		}	
		echo json_encode($response); 
		}
	
	}
	


}
