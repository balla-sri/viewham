<?php
class Contact extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Outsource_model');
    $this->load->model('Skills');
    $this->load->model('Industry');
    $this->load->model('Contacts_model');
    $this->load->model('Notification_model');	
    $this->load->model('Investor_model');	
    $this->load->model('Shortlists_model');	
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
		$this->template->set('title', 'CONTACT US');
		$this->template->set('sub_title', '');
		$this->data['metatitle'] = 'Contact Us - Small Business Side Income Ideas | Viewham';
		$this->data['metadescription'] = 'Have a question on how to learn more about submitting product ideas and services, and more then please contact us!';
		$this->template->load('main', 'contents' , 'statics/contact-us',$this->data);
		
	}
 	public function invest(){
		$userid = $this->session->userdata('user'); 
		if(!empty($userid)){
		$post_id =strip_tags($this->input->post('post_id'));	
		$to_id =strip_tags($this->input->post('posted_by'));	
		$n_type =strip_tags($this->input->post('n_type'));	
	//// insert invest ///		
		$invest['post_id'] =  strip_tags($this->input->post('post_id'));
		$invest['post_type'] =  strip_tags($this->input->post('post_type'));
		$invest['industry'] =  strip_tags($this->input->post('industry'));
		$invest['status'] =  1;
		$invest['posted_by'] =  $userid;
		$invest['create_date'] =  date("Y-m-d H:i:s");
		$postInitiate = $this->Investor_model->InvestAll($invest);
		if($postInitiate){
	//*-- Coins Debit --*//
		$nToData = array('post_id' =>$post_id,'to_id' =>$to_id,'post_type' =>$invest['post_type'],'text'=>'invest','notification_type'=>$n_type);
		$nYouData = array('post_id' =>$post_id,'to_id' =>$userid,'post_type' =>$invest['post_type'],'text'=>'invest','notification_type'=>$n_type);
		$insertNotification = $this->SaveNotification($nToData);		
		$insertNotification = $this->SaveNotification($nYouData);		
			if($insertNotification){
				$data['status']=1;
			}else{
				$data['status']=0;	
			}
		}else{
				$data['status']=0;	
		}
		}else{
			$data['emptySession']=1;
		}
		echo json_encode($data);		
	}
 	public function initiate(){
		$userid = $this->session->userdata('user'); 
		if(!empty($userid)){
		$post_id =strip_tags($this->input->post('post_id'));	
		$to_id =strip_tags($this->input->post('posted_by'));	
		$n_type =strip_tags($this->input->post('n_type'));	
	//// insert initiate ///		
		$initiate['post_id'] =  strip_tags($this->input->post('post_id'));
		$initiate['post_type'] =  strip_tags($this->input->post('post_type'));
		$initiate['industry'] =  strip_tags($this->input->post('industry'));
		$initiate['status'] =  1;
		$initiate['posted_by'] =  $userid;
		$initiate['create_date'] =  date("Y-m-d H:i:s");
		$postInitiate = $this->Outsource_model->InitiatesAll($initiate);
		if($postInitiate){
	//*-- Coins Debit --*//
		$nToData = array('post_id' =>$post_id,'to_id' =>$to_id,'post_type' =>$initiate['post_type'],'text'=>'Initiate','notification_type'=>$n_type);
		$nYouData = array('post_id' =>$post_id,'to_id' =>$userid,'post_type' =>$initiate['post_type'],'text'=>'Initiate','notification_type'=>$n_type);
		$insertNotification = $this->SaveNotification($nToData);		
		$insertNotification = $this->SaveNotification($nYouData);		
			if($insertNotification){
				$data['status']=1;
			}else{
				$data['status']=0;	
			}
		}else{
				$data['status']=0;	
		}
		}else{
			$data['emptySession']=1;
		}
		echo json_encode($data);		
	}
	public function BuyContact(){
		$userid = $this->session->userdata('user'); 
		if(!empty($userid)){
		$debit = 50;
		$postid =strip_tags($this->input->post('post_id'));	
		$to_id =strip_tags($this->input->post('posted_by'));	
		$n_type =strip_tags($this->input->post('n_type'));	
	//// insert Payment Contact ///
		$payContact['buyerId']=$userid;
		$payContact['post_id']=strip_tags($this->input->post('post_id'));
		$payContact['post_type']=strip_tags($this->input->post('post_type'));
		$payContact['price']=$debit;
		$payContact['create_date']=date("Y-m-d H:i:s");
		
		$buyContact = $this->Contacts_model->BuyContact($payContact);

		if($buyContact){
	//*-- Coins Debit --*//
		$dData = array('amount' =>$debit,'payfrom'=>'View Contact','txn_id'=>$n_type);
		$debitcoins = $this->debitCoins($dData);	

		$nToData = array('post_id' =>$postid,'to_id' =>$to_id,'post_type' =>$payContact['post_type'],'text'=>'Contact View','notification_type'=>$n_type);
		$nYouData = array('post_id' =>$postid,'to_id' =>$userid,'post_type' =>$payContact['post_type'],'text'=>'Contact View','notification_type'=>$n_type);
		$insertNotification = $this->SaveNotification($nToData);		
		$insertNotification = $this->SaveNotification($nYouData);		

		$params['post_id']=$postid;	
		$params['post_type']=strip_tags($this->input->post('post_type'));	
		$params['session_user'] = $this->session->userdata('user');		
		$view=$this->Notification_model->PaidContactOrNot($params);
		
			if($insertNotification){
				$u=$view['user'];
				$html='<div id="contactDetails" class="">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> '.$u["name"].'<br>
						   <b>Mobile:</b> '.$u["mobile"].' <br>
						   <b>E-mail:</b> <a href="mailto:'.$u["email"].'" class="link">'.$u["email"].'</a></p>
					</div>';
				$data['html']=$html;
				$data['status']=1;
			}else{
				$data['status']=0;	
			}
		}else{
				$data['status']=0;	
		}
		}else{
			$data['emptySession']=1;
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
				'to_id' => $nData['to_id'],
				'post_id' => $nData['post_id'],
				'text' => $nData['text'],
				'created_on' => date("Y-m-d H:i:s")
        );
		if($nData['post_type']){
			$Notification['post_type']=$nData['post_type'];
		}
		return $this->Notification_model->insertNotification($Notification);
	}
	public function creditCoins(){
		$session_user = $this->session->userdata('user'); 
		return 	$this->Coins_model->creditCoins($session_user);
	}
    public function interest(){
		$session_id = $this->session->userdata('user');
		if($session_id){
			$DataList = array(
					'post_id' => strip_tags($this->input->post('post_id')),
					'post_type' => strip_tags($this->input->post('post_type')),
					'status' => 1,
					'posted_by' => $session_id,
					'create_date' => date("Y-m-d H:i:s"),
				);
		if(!empty(strip_tags($this->input->post('p_id')))){	
			$DataList['p_id']=strip_tags($this->input->post('p_id'));
		}
		if(!empty(strip_tags($this->input->post('profile_type')))){	
			$DataList['profile_type']=strip_tags($this->input->post('profile_type'));
		}
			$Insert = $this->Shortlists_model->SaveInrest($DataList);
			if($Insert){
				$response['insert']=1;
				$postid=strip_tags($this->input->post('pid'));
				$toid=strip_tags($this->input->post('posted_by'));
				$post_type=strip_tags($this->input->post('post_type'));
				$this->saveNotificationInterest($postid,$toid,$post_type);
			}else{
				$response['insert']=2;
			}
		}else{
				$response['session']=2;
		}
		echo json_encode($response); 	
	}
	private function saveNotificationInterest($postid,$to,$post_type){
		$session_id = $this->session->userdata('user');
			$NotificationToUser = array(
					'post_id' => $postid,
					'to_id' => $to,
					'from_id' => $session_id,
					'text' => 'Apply Job',
					'post_type' => $post_type,
					'status' => 1,
					'notification_type' => 29,
					'created_on' => date("Y-m-d H:i:s"),
                );
			$NotificationToYou = array(
					'post_id' => $postid,
					'to_id' => $session_id,
					'from_id' => $session_id,
					'post_type' => $post_type,
					'text' => 'Apply Job',
					'status' => 1,
					'notification_type' => 29,
					'created_on' => date("Y-m-d H:i:s"),
                );
		$this->Notification_model->insertNotification($NotificationToUser);			
		$this->Notification_model->insertNotification($NotificationToYou);			
	}
	
}
 