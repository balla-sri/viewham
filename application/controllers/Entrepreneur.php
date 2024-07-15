<?php
class Entrepreneur extends CI_Controller{
    function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
    $this->load->model('Gain_model');
    $this->load->model('Profiles');
    $this->load->model('Outsource_model');
    $this->load->model('Franchise_model');
    $this->load->model('Entrepreneur_model');
    $this->load->model('Industry');
    $this->load->model('Skills');	
    $this->load->model('Shortlists_model');	
    $this->load->model('Notification_model');	
   	$this->load->library('session');
	$this->load->helper('viewham_helper');
	$this->load->helper('gain_helper');
	$this->load->helper('crypto_helper');
	$this->load->model('Feedback_model');
	$this->load->model('Contacts_model');
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
			$session_user = $this->session->userdata('user'); 
			if(!$session_user){
				redirect('gain/entrepreneur');
			}
			$params=array();
			$params['session_user']=$session_user;
			if(!empty($_GET)){ 
				$params =($_GET);
			}
			$entrepreneur = $this->Gain_model->checkEntrepreneur_byuser(		$session_user);
			if(!$entrepreneur){
				redirect('gain/entrepreneur/');
			}
			$this->data['skill_byid'] = $this->Entrepreneur_model->EntrepreneurDetails(		$entrepreneur['p_id']);
			$industry = $this->data['skill_byid']['industry']; 
			$params['industry']=$industry;
			$this->data['outsource'] = $this->Outsource_model->OutSourceByIndustry($industry,$params); 
			$this->data['proposals'] = $this->Entrepreneur_model->proposalsOursourceFrancise($session_user); 
			$this->data['franchise'] = $this->Franchise_model->FranchiseByIndustry($industry,$params); 
			$this->data['allinitiate'] = $this->Entrepreneur_model->Initiates($params);
			$this->data['feedback'] = $this->Feedback_model->FeedbackByPostId($entrepreneur['p_id']); 
			$this->template->load('no-menu', 'contents' , 'entrepreneur/gain-entrepreneur', $this->data);			
    }
  	public function EntrepreneurEditSubmit(){
			$error = EntrepreneurFormValidate();
			
		if(empty($error)){
				$session_user = $this->session->userdata('user');	
				$EntrepreneurProfile = $this->Entrepreneur_model->checkEntrepreneur_byuser($session_user);						
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
					'modified_date' =>  date("Y-m-d H:i:s"),
				);
		$UpdateProfile = $this->Entrepreneur_model->UpdateProfile($EntrepreneurProfile['p_id'],$userData);
		$post_type=1;	

		if($UpdateProfile){
			
			$shortsists = $this->Shortlists_model->ByPostTypeById($EntrepreneurProfile['p_id'],$post_type); 
			$postdata['post_id']=$EntrepreneurProfile['p_id'];
			$postdata['post_type']=$post_type;
			$this->Last7daysPaidContacts($postdata);
			$nData=array();
			foreach($shortsists as $key=>$val){
				$nData=array('notification_type'=>43,'to_id'=>$val['posted_by'],'post_id'=>$val['pid'],'post_type'=>$val['post_type'],'text'=>'Update Entrepreneur Profile');
				$this->SaveNotification($nData);
				$userDatashort['status']=0;	
				$remove = $this->Shortlists_model->ShortlistUpdate($userDatashort,$val['id']);
			}
				$data['update_status']=1;
				$data['message']=$nData;				
			}else{
				$data['update_status']=0;
				$data['message']='Oops Wrong update failed';				
			}
		}else{
			$data['error']=$error;
			$data['update_status']=0;
			$data['message']='Please enter all fields';
		}
		echo json_encode($data);
	}
	private function Last7daysPaidContacts($postdata){
			$params=array();
			$params['post_type']=$postdata['post_type'];
			$params['poste_id']=$postdata['poste_id'];
			$paidContacts = $this->Contacts_model->Last7daysPaidContacts($params);
				foreach($paidContacts as $key=>$val){
					$cdata=array('coins'=>$val['price'],'userid'=>$val['buyerId'],'source'=>'Coins Refunded','txn_id'=>48,'post_id'=>$val['post_id'],'post_type'=>$val['post_type']);
					$refund = $this->CoinsRefund($cdata);
					if($refund){
						$nData=array('notification_type'=>48,'to_id'=>$val['buyerId'],'post_id'=>$val['post_id'],'post_type'=>$val['post_type'],'text'=>'Profile updated coins refunded');
						$this->SaveNotification($nData);
						$remove = $this->Contacts_model->PaidContactRemove($val['id']);	
					}
				}	
	}
	private function CoinsRefund($data){
		$coins['credit']=$data['coins'];
		$coins['userid']=$data['userid'];
		$coins['source']=$data['source'];
		$coins['txn_id']=$data['txn_id'];
		$coins['post_id']=$data['post_id'];
		$coins['post_type']=$data['post_type'];
		return $coinsId = $this->Coins_model->insertCoins($coins);
		
	}
    public function profiles(){
		$params=array();
		if(!empty($_GET)){ $params =($_GET);}
		$params['session_user']=$session_user;
		$params['post_type']=1;
        $this->data['profile'] = $this->Profiles->EntrepreneurProfile($params);
		$this->template->load('no-menu', 'contents' , 'entrepreneur/entrepreneur-profiles', $this->data);
    }	
	private function SaveNotification($nData){
		$session_user = $this->session->userdata('user');
		$Notification = array(
                'notification_type' => $nData['notification_type'],
				'from_id' => $session_user,
				'to_id' => $nData['to_id'],
				'post_id' => $nData['post_id'],
				'post_type' => $nData['post_type'],
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
	public function skillById($id){
		return $skill = $this->Skills->skillById($id);
	}
	public function SingleFranchise($id){
		return $SingleFranchise = $this->Franchise_model->SingleFranchise($id);
	}	
	public function responsesFranchise($id){
		return $data = $this->Franchise_model->responsesFranchise($id);	
	}
	function Userdeatail($id){
		$session_user = $this->session->userdata('user'); 	
	return $user = $this->Users->getUserDetails(array('id'=>$session_user));
	}	
	function ContactPaid($id,$post_type){
		return $ContactPaid = $this->Outsource_model->ContactPaid($id,$post_type);
	}
	function feedback($id){
		return $data = $this->Gain_model->feedback($id);	
	}	
	public function Initiates(){
		$data = $this->Entrepreneur_model->Initiates(36); 
		echo "<pre>";print_r($data);
	}
 
	
}
