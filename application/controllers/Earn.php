<?php
class Earn extends CI_Controller{
    function __construct(){
	parent::__construct();
    $this->load->model('Users');
    $this->load->model('Coins_model');
	$this->load->library('session');
    $this->load->model('Skills');
    $this->load->model('Industry');	
    $this->load->model('Earn_model');	
    $this->load->model('Gain_model');	
    $this->load->model('Notification_model');	
    $this->load->model('Shortlists_model');	
    $this->load->model('Feedback_model');	
    $this->load->model('SkillsTrustFactor_model');	
    $this->load->model('Contacts_model');	
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
  		$this->template->load('no-menu', 'contents' , 'statics/knowmore-earn', $this->data);
    }
    public function MediatorFormValidation(){
		$data['error'] = MeditorProfileFormValidate();
		echo json_encode($data);
	}
    public function HobbyProfileFormValidate(){
		$data['error'] = HobbyProfileFormValidate();
		echo json_encode($data);
	}

	public function mediator(){
			$this->template->load('no-menu', 'contents' , 'earn/earn-mediator', $this->data);
	}
	public function Myprofiles($id){
		$session_user = $this->session->userdata('user'); 
		$profileData = $this->Earn_model->GetMyProfile($id);
		$this->data['proposals'] = $this->Notification_model->EarnProfileNotificatons(array('id' =>$profileData['skill'],'session_id'=>$session_user,'n_type'=>18 ));
		$this->data['userTimings'] = $this->Earn_model->usertimings($session_user,$profileData['post_type']);$this->data['skillDetails']=$profileData;
		if($session_user!=$profileData['posted_by']){	redirect('');}
			$userdetails = $this->Users->getUserDetails(array('id'=>$session_user));
		if($userdetails['mobile_authenticated']==1){
			$this->data['m_rate']=5;
		}else{
			$this->data['m_rate']=0;
		}
		if($userdetails['email_authenticated']==1){
			$this->data['e_ratef']=5;
		}else{
			$this->data['e_ratef']=0;
		}

		$this->data['feedback'] = $this->Feedback_model->FeedbackByPostId($id); 
		$this->data['skiltrust'] = $this->SkillsTrustFactor_model->skillByIdTrustFactor($id); 		
		$this->template->load('no-menu', 'contents' , 'earn/edit-profile', $this->data);
	}


	public function EditProfileFormSubmit($id){
		$session_user = $this->session->userdata('user'); 
		$profileData = $this->Earn_model->GetMyProfile($id);
		$errors='';
		if($session_user!=$profileData['posted_by']){
			$errors['auth']="This profile not yours";
		}
				if($profileData['post_type']==3){
					$errors = ProfileFormValidate();				
				}elseif($profileData['post_type']==4){
					$errors = HobbyProfileFormValidate();
				}elseif($profileData['post_type']==5){
					$errors = MeditorProfileFormValidate();
				}

		if(empty($errors)){
		$association = json_encode($_POST['roles']);
		$locations = array_filter($this->input->post('location'));
		if(!empty($_FILES)){
			foreach($_FILES as $key=>$value){
			   $doc= $this->UploadFile($key);
			}
		}else{$doc='';}
		$userData = array(
				'association' => strip_tags($association),
                'skill' => strip_tags($this->input->post('skill')),
                'investment_currency' => strip_tags($this->input->post('investment_currency')),
                'location' => json_encode($locations),
                'price' => strip_tags($this->input->post('price')),
                'price_per' => strip_tags($this->input->post('price_per')),
                'experience' => strip_tags($this->input->post('experience')),
                'competitive' => strip_tags($this->input->post('competitive')),
                'currency' => strip_tags($this->input->post('currency')),
                'l_term_work_option' => strip_tags($this->input->post('options')),
                'min_as_employee' => strip_tags($this->input->post('min_as_employee')),
                'max_as_employee' => strip_tags($this->input->post('max_as_employee')),
                'min_as_partner' => strip_tags($this->input->post('min_as_partner')),
                'max_as_partner' => strip_tags($this->input->post('max_as_partner')),
                'candidate' => strip_tags($this->input->post('candidate')),
                'mobile' => strip_tags($this->input->post('candidate_mobile')),
                'mediate_type' => strip_tags($this->input->post('Mediate_type')),
           		'posted_by' => $session_user,
				'modified_date' => date("Y-m-d H:i:s")				
				);						
				if($doc){ $userData['portfolio']=$doc;}	
			
	$UpdateProfile = $this->Earn_model->UpdateProfile($profileData['p_id'],$userData);
	if($profileData['post_type']==3){
		$ntype=45;
	}elseif($profileData['post_type']==4){
		$ntype=46;		
	}elseif($profileData['post_type']==5){
		$ntype=47;		
	}		
	if($UpdateProfile){	
			$shortsists = $this->Shortlists_model->ByPostTypeById($profileData['p_id'],$profileData['post_type']); 
			$postdata['post_id']=$profileData['p_id'];
			$postdata['post_type']=$profileData['post_type'];
			$this->Last7daysPaidContacts($postdata);
			$nData=array();
			foreach($shortsists as $key=>$val){
					$nData=array('notification_type'=>$ntype,'to_id'=>$val['posted_by'],'post_id'=>$val['pid'],'post_type'=>$val['post_type'],'text'=>'Update  Profile');
					$this->SaveNotification($nData);
					$userDatashort['status']=0;	
					$remove = $this->Shortlists_model->ShortlistUpdate($userDatashort,$val['id']);
			}
					$data['update_status']=1;	
					$data['message']='Your Profile Successfully updated';	
					$data['error']=$errors;	
				}else{
						$data['update_status']=0;	
						$data['message']='Oops wrong update failed';	
						$data['error']=$errors;	
				}	
					
					}else{
						$data['update_status']=0;	
						$data['message']='Please Enter All required fields';	
						$data['error']=$errors;	
					}
				

		echo json_encode($data); exit;
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
	public function mediatorFormSubmit(){
		$session_user = $this->session->userdata('user');
		if(!empty($_POST)){
				$response['exist']="";
				$errors=='';	
				$errors = MeditorProfileFormValidate();
				$postType = '5';
			if(!$session_user){
				$response['session']='1';
				$check='';
			}else{
				$check = $this->Earn_model->checkMediator_Profile($session_user);
				if($check>5){
					$count=$check;	
					$response['exist']="1";
					$response['message']="<span class='error'>You have already created Mediators Profile</span>";
				}else{
					$count='';	
				}
			}

		if(!$errors && !$count && $session_user){
			$association = json_encode($_POST['roles']);
			$locations = array_filter($this->input->post('location'));
			$language = array_filter($this->input->post('language'));
		if(!empty($_FILES)){
			foreach($_FILES as $key=>$value){
			   $doc= $this->UploadFile($key);
			}
		}else{$doc='';}			
			$userData = array(
					'skill' => strip_tags($this->input->post('skill')),
					'association' => strip_tags($association),
					'location' => json_encode($locations),
					'language' => json_encode($language),
					'price_per' => strip_tags($this->input->post('price_per')),
					'price' => strip_tags($this->input->post('price')),
					'experience' => strip_tags($this->input->post('experience')),
					'competitive' => strip_tags($this->input->post('competitive')),
					'currency' => strip_tags($this->input->post('currency')),
					'l_term_work_option' => strip_tags($this->input->post('l_term_work_option')),
					'min_as_employee' => strip_tags($this->input->post('min_as_employee')),
					'max_as_employee' => strip_tags($this->input->post('max_as_employee')),
					'min_as_partner' => strip_tags($this->input->post('min_as_partner')),
					'max_as_partner' => strip_tags($this->input->post('max_as_partner')),
					'candidate' => strip_tags($this->input->post('candidate')),
					'mobile' => strip_tags($this->input->post('mobile')),
					'mediate_type' => strip_tags($this->input->post('Mediate_type')),
					'posted_by' => $session_user,
					'post_type' => $postType,
					'create_date' => date("Y-m-d H:i:s"),
					'modified_date' => date("Y-m-d H:i:s")
				);
			if($doc){ $userData['portfolio']=$doc;}	
			$Insert = $this->Gain_model->InsertEnerprenur($userData);
			if($Insert){
			$cData = array('amount' =>100,'payfrom'=>'Mediator Profile posted','txn_id'=>'14');
			$coins = $this->saveCoins($cData);	
			$nData = array('post_id' =>$Insert,'post_type'=>$postType,'text'=>'Mediator Profile posted','notification_type'=>14);
			$this->SaveNotification($nData);
			$response['insert_status']=1;			
			$response['message']="Successfully Added";			
				}else{
					$response['insert_status']=0;
					}
			}else{
		$response['error']=$errors;
	}	
	echo json_encode($response); 
	}
		
	}
	public function Myhobby(){
		$session_user = $this->session->userdata('user'); 	
		$check = $this->Earn_model->checkHobby_Profile($session_user);
		if($check){
			redirect('Earn/myprofiles/'.$check['p_id']);
		}
		$this->template->load('no-menu', 'contents' , 'earn/hobby-profile-form', $this->data);
	}
	public function MyhobbyFormSubmit(){
		$session_user = $this->session->userdata('user'); 	
		if(!empty($_POST)){
			$response['exist']="";
			$errors=='';	
			$errors = ProfileFormValidate();
			$postType = '4';
			if(!$session_user){
				$response['session']='1';
				$check='';
			}else{
				$check = $this->Earn_model->checkHobby_Profile($session_user);
				if($check){
				$response['exist']="1";
				$response['message']="<span class='error'>You have already created Hobby Profile</span>";
				}
			}
	if(!$errors && !$check && $session_user){
		$association = json_encode($_POST['roles']);

		$locations = array_filter($this->input->post('location'));
		if(!empty($_FILES)){

			foreach($_FILES as $key=>$value){
			   $files= $this->UploadFile($key);
		}
	}else{$files='';}
			$userData = array(
					'skill' => strip_tags($this->input->post('skill')),
					'association' => strip_tags($association),
					'location' => json_encode($locations),
					'price_per' => strip_tags($this->input->post('price_per')),
					'price' => strip_tags($this->input->post('price')),
					'experience' => strip_tags($this->input->post('experience')),
					'competitive' => strip_tags($this->input->post('competitive')),
					'currency' => strip_tags($this->input->post('currency')),
					'l_term_work_option' => strip_tags($this->input->post('l_term_work_option')),
					'min_as_employee' => strip_tags($this->input->post('min_as_employee')),
					'max_as_employee' => strip_tags($this->input->post('max_as_employee')),
					'min_as_partner' => strip_tags($this->input->post('min_as_partner')),
					'max_as_partner' => strip_tags($this->input->post('max_as_partner')),
					'posted_by' => $session_user,
					'portfolio' => $files,
					'post_type' => $postType,
					'create_date' => date("Y-m-d H:i:s"),
					'modified_date' => date("Y-m-d H:i:s")
				);
				$Insert = $this->Gain_model->InsertEnerprenur($userData);
		if($Insert){
			$day_data =array();
			$dayyss=array_filter($_POST['dayswize']);
			$to_times=array_filter($_POST['totime']);
			$fromtimes=array_filter($_POST['fromtime']);
			foreach ($dayyss as $key => $value) {
				$day_data['day']=$value;
				$day_data['totime']=$to_times[$key];
				$day_data['fromtime']=$fromtimes[$key];
				$day_data['postid']=$Insert;
				$this->CreateTimingDay($day_data);
			}
			$cData = array('amount' =>100,'payfrom'=>'Hobby Profile posted','txn_id'=>'13');
			$coins = $this->saveCoins($cData);	
			$nData = array('post_id' =>$Insert,'text'=>'Hobby Profile posted','notification_type'=>13);
			$this->SaveNotification($nData);
				$response['postid']=$Insert;			
				$response['insert_status']="1";			
				$response['message']="Successfully Added";			
		}else{
				$response['insert_status']="0";
				}
	}else{
				$response['error']=$errors;
			}	
	echo json_encode($response); 
	}
	
		
	}
	public function UploadFile($file=''){
	$filesCount = count($_FILES[$file]['name']);
		  for($i = 0; $i < $filesCount; $i++){
			
			$_FILES['file']['name']     = time().$_FILES[$file]['name'][$i];
			$_FILES['file']['type']     = $_FILES[$file]['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES[$file]['tmp_name'][$i];
			$_FILES['file']['error']     = $_FILES[$file]['error'][$i];
			$_FILES['file']['size']     = $_FILES[$file]['size'][$i];
			
			// File upload configuration
			$uploadPath = 'uploads/profile-documents';
			$config['upload_path'] = $uploadPath;
		   $config['allowed_types'] = '*';
			
			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file')){
				$fileData = $this->upload->data();
				$uploadData[$i] = $fileData['file_name'];
				//$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
				$picture = json_encode($uploadData);
				
			}else{
				$picture ='';
			}
		  }
			return $picture;

	}
	public function PrimaryFormValidation(){
		$data['error'] = ProfileFormValidate();
		echo json_encode($data);
	}
	public function Profile(){
		$session_user = $this->session->userdata('user'); 	
		$check = $this->Earn_model->checkProfessional_Profile($session_user);
		if($check){
			redirect('Earn/myprofiles/'.$check['p_id']);
		}
		$this->template->load('no-menu', 'contents' , 'earn/primary-profile', $this->data);
	}
	private function CreateTimingDay($day_data){
		$userData = array(
			'day' => $day_data['day'],
			'to_time' => $day_data['totime'],
			'from_time' => $day_data['fromtime'],
			'postid' => $day_data['postid'],
			);
		return $Insert = $this->Earn_model->Insertearnprofile($userData);
	}

	public function ProfileFormSubmit(){
	
	$session_user = $this->session->userdata('user'); 
	if(!empty($_POST)){
		$response['exist']="";
		$errors=='';	
		$errors = ProfileFormValidate();
		$postType = '3';
	if(!$session_user){
		$response['session']='1';
		$check='';
	}else{
		$check = $this->Earn_model->checkProfessional_Profile($session_user);
	if($check){
		$response['exist']="1";
		$response['message']="<span class='error'>You have already created Primary Profile</span>";
	}
	}

	if(!$errors && !$check && $session_user){
		$association = json_encode($_POST['roles']);
		$locations = array_filter($this->input->post('location'));
	if(!empty($_FILES)){
			foreach($_FILES as $key=>$value){
			   $doc= $this->UploadFile($key);
		}
	}else{$doc='';}
	$userData = array(
			'skill' => strip_tags($this->input->post('skill')),
			'association' => $association,
			'location' => json_encode($locations),
			'currency' => strip_tags($this->input->post('currency')),
			'language' => strip_tags($this->input->post('language')),
			'price_per' => strip_tags($this->input->post('price_per')),
			'price' => strip_tags($this->input->post('price')),
			'experience' => strip_tags($this->input->post('experience')),
			'competitive' => strip_tags($this->input->post('competitive')),
			'l_term_work_option' => strip_tags($this->input->post('l_term_work_option')),
			'min_as_employee' => strip_tags($this->input->post('min_as_employee')),
			'max_as_employee' => strip_tags($this->input->post('max_as_employee')),
			'min_as_partner' => strip_tags($this->input->post('min_as_partner')),
			'max_as_partner' => strip_tags($this->input->post('max_as_partner')),
			'posted_by' => $session_user,
			'portfolio' => $doc,
			'post_type' => $postType,
			'create_date' => date("Y-m-d H:i:s"),
			'modified_date' => date("Y-m-d H:i:s")
		);
	$Insert = $this->Gain_model->InsertEnerprenur($userData);

		if($Insert){
			$day_data =array();
			$dayyss=array_filter($_POST['dayswize']);
			$to_times=array_filter($_POST['totime']);
			$fromtimes=array_filter($_POST['fromtime']);
			foreach ($dayyss as $key => $value) {
				$day_data['day']=$value;
				$day_data['totime']=$to_times[$key];
				$day_data['fromtime']=$fromtimes[$key];
				$day_data['postid']=$Insert;
				$this->CreateTimingDay($day_data);
			}

			$cData = array('amount' =>100,'payfrom'=>'Profession Profile posted','txn_id'=>'12');
			$coins = $this->saveCoins($cData);	
			$nData = array('post_id' =>$Insert,'text'=>'Profession Profile posted','notification_type'=>12);
			$this->SaveNotification($nData);
			$response['postid']=$Insert;			
			$response['insert_status']="1";			
			$response['message']="Successfully Added";			
		}else{
			$response['insert_status']="0";
		}
	}else{
		$response['error']=$errors;
	}	
	echo json_encode($response);
	}
	
	}
	public function Getusertimings(){
	$id =$this->session->userdata('user');
	$from =strip_tags($this->input->post('from'));		
	$jsonData = $this->Earn_model->usertimings($id,$from);		
	echo json_encode($jsonData);
	}
	public function Usertimedelete($day){
	$id =$this->session->userdata('user');
	$efected = $this->Earn_model->DeleteUserday($id,$day);
	$from =strip_tags($this->input->post('from'));		
	$jsonData = $this->Earn_model->usertimings($id,$from);	
	echo json_encode($jsonData);
	}
	public function Updateusertimings(){
		$sid =$this->session->userdata('user');
		$id = strip_tags($this->input->post('idd'));
		$from = strip_tags($this->input->post('from'));
		$userData = array(
			'day' => strip_tags($this->input->post('day')),
			'to_time' => strip_tags($this->input->post('totime')),
			'from_time' => strip_tags($this->input->post('fromtime'))
		);
		$efected = $this->Earn_model->Updateusertiming($id,$userData);
		$jsonData['data'] = $this->Earn_model->usertimings($sid,$from);	
		echo json_encode($jsonData);
	}
	public function Createusertimings(){

	if(empty($this->session->userdata('user'))){
		$jsonData['session'] = "Nosession";
		echo json_encode($jsonData); exit;
	}
	$id =$this->session->userdata('user');
	$from=strip_tags($this->input->post('from'));
	$day=strip_tags($this->input->post('day'));
	$chekday = $this->Earn_model->usertimingsByday($id,$from,$day);
	if(!empty($chekday)){
		$jsonData['exist'] = "exist";
		$jsonData['data'] = $this->Earn_model->usertimings($id,$from);	
		echo json_encode($jsonData); exit;
	}
			$userData = array(
			'day' => strip_tags($this->input->post('day')),
			'to_time' => strip_tags($this->input->post('totime')),
			'from_time' => strip_tags($this->input->post('fromtime')),
			'u_id' => $this->session->userdata('user'),
			'from_from' => strip_tags($this->input->post('from'))
		);
		$Insert = $this->Earn_model->Insertearnprofile($userData);
		if($Insert){
		
			$jsonData['data'] = $this->Earn_model->usertimings($id,$from);		
			echo json_encode($jsonData);
		}else{
			echo "failed Create"; exit;
		}
	}

	public function Skill($id){
	 return $skill = $this->Skills->skillById($id);
	}

	public function reuestforwork(){
		$session_user = $this->session->userdata('user'); 
		if(!$session_user){	redirect('');}
		if(!empty($_POST)){
			print_r($_POST); exit;
		}
		$this->data['profiles']= $this->Earn_model->GetAllUserProfiles($session_user);
		$this->template->load('no-menu', 'contents' , 'earn/request-for-work', $this->data);
	}
	public function SkillDetailsById($id){
	$profile = $this->Earn_model->GetMyProfile($id);
	$array=array('3'=>"Primary Profile",'4'=>"Hobby Profile",'5'=>"Mediator Profile");
	$post_t = $profile['post_type'];
	$data['value'] = $array[$post_t];
	$data['key'] = $post_t;
	echo  json_encode($data);
	}
	public function reuestforworkFromSubmit(){
		$errors='';
		if(empty($this->input->post('skill'))){
			$errors['skill']="Please Select Skill";	
		}
		if(empty($this->input->post('profile_type'))){
			$errors['profile_type']="Please Select Profile Type";		
		}
		if(empty($this->input->post('description'))){
			$errors['description']="Please Enter description";		
		}
		
		if(empty($errors)){
			
		$session_user = $this->session->userdata('user'); 
		$userData = array(
					'skill' => strip_tags($this->input->post('skill')),
					'skill_type' => strip_tags($this->input->post('skill')),
					'description' => strip_tags($this->input->post('description')),
					'create_date' => date("Y-m-d H:i:s"),
					'posted_by' => $session_user,
				);
		$Insertid = $this->Earn_model->InsertRequestWork($userData);
			if($Insertid){
				$data['error']=	$errors;
				$data['insert_status']=	1;
				$data['insertId']=$Insertid;
				$data['message']='Successfully Posted';	
			}else{
				$data['error']=	$errors;
				$data['insert_status']=	0;
				$data['message']='Oops Wrong post failed';				
			}
		}else{
			$data['error']=	$errors;
			$data['insert_status']=	0;
			$data['message']='Please Enter All Fields';
		}
		echo json_encode($data);
		
	}
    public function myrequestworks(){
	$session_user = $this->session->userdata('user'); 
	$this->data['MyRequestWorks'] = $this->Earn_model->RequestWorksByUser($session_user);
	$this->template->load('no-menu', 'contents' , 'earn/my-request-works', $this->data);			
	}
    public function requestworkdetails($id){
	$session_user = $this->session->userdata('user'); 
	$this->data['MyRequestWork'] = $this->Earn_model->SingleRequestWork($id);
	$this->template->load('no-menu', 'contents' , 'earn/request-works-detail-view', $this->data);			
	}
    public function SpendCoinds(){
		$debit = $this->input->post('coins');
		$postid = $this->input->post('postid');
		$text ='Request For Work Published';
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
	$update = $this->Earn_model->UpdatePostRequestWork($userData,$postid);
			
	if($update){
		$data['debit'] = SpendCoins($debit,$session_user,$text);
		$RequestWork = $this->Earn_model->SingleRequestWork($postid);
		
		if($data['debit']){
			$Notification = array(
					'notification_type' => '19',
					'from_id' => $session_user,
					'to_id' => $session_user,
					'post_id' => $postid,
					'text' => 'Request work published',
					'created_on' => date("Y-m-d H:i:s")
			);
		$sendNotification = $this->Earn_model->NotificationAdd($Notification);	
		}
		$Date = $RequestWork['publish_start_date'];
		$days = $RequestWork['days'];
		$html = date('d-F-Y H:i:s', strtotime($Date)).'&nbsp To &nbsp'.date('d-F-Y H:i:s', strtotime($Date. ' + '.$days.' Hours')); 
		$data['status']='1';
		$data['postid']=$postid;
		$data['html']=$html;
		}
		echo json_encode($data); 
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
				'text' => $nData['text'],
				'created_on' => date("Y-m-d H:i:s")
        );
		if($nData['post_type']){
			$Notification['post_type']=$nData['post_type'];			
		}
		if($nData['to_id']){
			$Notification['to_id']=$nData['to_id'];			
		}
		$this->Notification_model->insertNotification($Notification);
	}
	function SkillTrustFactor($id){


	}
	function UpdateSkillTrustFactor(){
	$getAllProfiles = $this->SkillsTrustFactor_model->getAllProfiles();
	foreach ($getAllProfiles as $key => $value) {
		$id=$value['p_id'];
		$feedback = $this->Feedback_model->FeedbackByPostId($id);
		$profileData = $this->Earn_model->GetMyProfile($id);
		$userdetails = $this->Users->getUserDetails(array('id'=>$profileData['posted_by']));
		if($userdetails['email_authenticated']==1){
			$email_authenticated = 5;
		}else{
			$email_authenticated = 0;
		}
		if($userdetails['mobile_authenticated']==1){
			$mobile_authenticated = 5;
		}else{
			$mobile_authenticated = 0;
		}
		if($profileData['r_email_auth']==1){
			$r_email_auth = 7.5;
		}else{
			$r_email_auth = 0;
		}
		if($profileData['r_mobile_auth']==1){
			$r_mobile_auth = 7.5;
		}else{
			$r_mobile_auth = 0;
		}		
		$rate=0;
		if($feedback){	
		foreach ($feedback as $key => $value) {
			$rate = $rate + $value['rate'];
		}	
		$f_rate =  $rate / count($feedback)*10;
		if($profileData['post_type']==5){
			$f_rate = ($f_rate*2/100)*75;
		}
		  
		}	
		$SkillTrustUpdate = array(
			'postid'=>$id,
			'email'=>$email_authenticated,
			'mobile'=>$mobile_authenticated,
			'over_all'=>0,
			'learn'=>0,
			'feedback'=>$f_rate,
			'r_mobile'=>$r_mobile_auth,
			'r_email'=>$r_email_auth
		);
		$checkTrust = $this->SkillsTrustFactor_model->skillByIdTrustFactor($id);	
		if(empty($checkTrust)){
			$SkillTrustUpdate['create_date']=date("Y-m-d H:i:s");
			$SkillTrustUpdate['update_date']=date("Y-m-d H:i:s");
			$checkTrust = $this->SkillsTrustFactor_model->insertTrustFactor($SkillTrustUpdate);	
		}else{
			$SkillTrustUpdate['update_date']=date("Y-m-d H:i:s");
			$checkTrust = $this->SkillsTrustFactor_model->UpdateSkillTrustFactor($SkillTrustUpdate,$checkTrust['id']);	
		}	


	}


	}	

}
