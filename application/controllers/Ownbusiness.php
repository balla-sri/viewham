<?php
class Ownbusiness extends CI_Controller{
    Public function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Ownbusiness_model');
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
	public function myownbusinessideas(){
		 $session_user = $this->session->userdata('user');	 
		 $this->data['ownideas'] = $this->Ownbusiness_model->UserOwnBusinessIdeas($session_user);
		$this->template->load('no-menu', 'contents' , 'ownbusiness/establish-own-business-history', $this->data);
	}
	public function details($id){
		$this->data['ownidea'] = $this->Ownbusiness_model->detailsOwnBusinessIdeas($id);
		$this->template->load('no-menu', 'contents' , 'ownbusiness/establish-own-business-view', $this->data);
	}
    public function add(){
		$this->template->load('no-menu', 'contents' , 'ownbusiness/establish-own-business-form', $this->data);
    }
    public function deleteOwnbusinessIdea($id,$postid){
		$userData = array(
                'status' =>3,
			    );
		$statusChange = $this->Ownbusiness_model->UpdateBusinessIdea($userData,$postid);
		$statusChange = $this->Ownbusiness_model->UpdateBusinessIdeaInitiate($userData,$id);
    if($statusChange){
		
	}    
	
	
	}
    public function edit($id){
		$this->data['ownidea'] = $this->Ownbusiness_model->detailsOwnBusinessIdeas($id);
		$this->template->load('no-menu', 'contents' , 'ownbusiness/establish-own-business-form-edit', $this->data);
    } 
   function EstablishBusinessValidate(){
	   if(!empty($_POST)){
			$error = OwnBusinessValidate();
			if(!$error){		
				$data['error_status']=1;
			}else{
				$data['error_status']=0;
			}
			$data['error']=$error;
		}
		echo json_encode($data);
   }
   function EstablishBusinessSubmit($id=''){
		$error = '';
		$session_user = $this->session->userdata('user');
		$locations = array_filter($this->input->post('location'));	
		$error = OwnBusinessValidate();
			if(!$session_user){
					$session=1;	
					$data['emptySession']=$session;
				}else{
					$session='';
				}
		if(empty($error) && empty($session)){	
				$resource = json_encode($_POST['resource']);
				$userData = array(
                'industry' => strip_tags($this->input->post('industry')),
                'description' => $this->input->post('description'),
                'idea_status' => strip_tags($this->input->post('idea_status')),
                'currency' => strip_tags($this->input->post('currency')),
                'min_invest' => strip_tags($this->input->post('min_invest')),
                'max_invest' => strip_tags($this->input->post('max_invest')),
                'min_share' => strip_tags($this->input->post('min_share')),
                'max_share' => strip_tags($this->input->post('max_share')),
                'investor_role' => strip_tags($this->input->post('investor_role')),
                'investor' => strip_tags($this->input->post('investor')),
                'consultant' => strip_tags($this->input->post('consultant')),
                'mentor' => strip_tags($this->input->post('mentor')),
                'location' => json_encode($locations),
				'resource' => $resource,
				'posted_by' => $session_user,
                'create_date' => date("Y-m-d H:i:s")
            );

		$Insertid = $this->Ownbusiness_model->InsertOwnBusines($userData);
		if($Insertid){
		$initiate = array(
					'posted_by' => $session_user,
					'industry' => strip_tags($this->input->post('industry')),
					'post_id' => $Insertid,
					'post_type' => '11',
					'status' => '1',
					'create_date' => date("Y-m-d H:i:s")
			);		
		$initiate = $this->Ownbusiness_model->InsertOwnBusinesInitiate($initiate);
				$data['insertId']=$Insertid;
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
		$debit = $this->input->post('coins');
		$postid = $this->input->post('postid');
		$text ='Own business Published';
		$session_user = $this->session->userdata('user');
		$hrs = $debit*2;		
		$userData = array(
					'coins' => strip_tags($this->input->post('coins')),
					'days' =>$hrs,
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
	$update = $this->Ownbusiness_model->UpdateBusinessIdea($userData,$postid);
			
	if($update){
		$data['debit'] = SpendCoins($debit,$session_user,$text);
		$singleidea = $this->Ownbusiness_model->singleideaPost($postid);
		if($data['debit']){
			$Notification = array(
					'from_id' => $session_user,
					'post_id' => $postid,
					'text' => 'Own business published',
					'created_on' => date("Y-m-d H:i:s")
			);
			$NotificationToMe = array(
					'notification_type' => '20',
					'from_id' => $session_user,
					'to_id' => $session_user,
					'post_id' => $postid,
					'text' => 'Own business published',
					'created_on' => date("Y-m-d H:i:s")
			);
		$sendNotificationToMe = $this->Ownbusiness_model->NotificationAdd($NotificationToMe);	
		$sendNotificationToAll = $this->Ownbusiness_model->NotificationAddToAll($Notification,$singleidea);	
		}
		$Date = $singleidea['publish_start_date'];
		$days = $singleidea['days'];
		$html = date('d-F-Y H:i:s', strtotime($Date)).'&nbsp To &nbsp'.date('d-F-Y H:i:s', strtotime($Date. ' + '.$days.' Hours')); 
		$data['postid']=$postid;
		$data['status']='1';
		$data['html']=$html;
		}
		echo json_encode($data); 
	}

}
