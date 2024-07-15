<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Businessideas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Idea');
        $this->load->model('Users');
        $this->load->model('Industry');
        $this->load->model('Skills');
        $this->load->model('Currencies');
        $this->load->model('Tag');
        $this->load->model('Comments');
        $this->load->model('Notification_model');
        $this->load->helper('viewham_helper');
        $this->load->model('Coins_model');
        
        $this->data['module'] = 'ideazone';
        
        $this->load->library('session');
        $this->load->library("pagination");
        $this->load->library("truncatehtml");
        
        $session_user = $this->session->userdata('user'); 
        $this->data['session_exist'] = 0;
    	if($session_user){
            $userdetails = $this->Users->getUserDetails(array('id'=>$session_user));
            if($userdetails['login_type']==1){
                $profile_pic = (isset($userdetails['profile_picture']) && $userdetails['profile_picture']!='')?$userdetails['profile_picture']:'svg.svg';
                    $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $userdetails['profile_picture'];
            }
            $this->data['user'] = $userdetails;
            $this->data['user']['profile_picture'] = $prof_pic;
            $this->data['session_exist'] = 1;
        }

        
        

        $listindustries = $industries = $this->Industry->getAll();
        $all = array('industry'=>'All','slug'=>'');
        array_unshift($listindustries, $all);
        
        $this->data['listindustries'] = $listindustries;
        $this->data['industries'] = $industries;
        $this->data['currencies'] = $this->Currencies->getAllCurrencies();
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
        $this->data['canonical'] = current_url();
    }
    
    public function index()
    {
        $config = array();
        $config["base_url"] = base_url() . "/businessideas/page";
        $params['status'] = 2;
        $allideas = $this->Idea->getIdeas($params);
        $total_row = count($allideas);
        
        $config["total_rows"] = $total_row;
        $config["per_page"] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-info">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)-1)*$config["per_page"];
        }
        else{
            $page = 0;
        }
        
        $params['per_page'] = $config["per_page"];
        $params['page'] = $page;
        $this->getideas($params);
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;',$str_links );
        $this->data['landing'] = 'ideaslist';
        if($this->data['session_exist']==0)
            $this->data['spark'] = 1;
        $this->template->load('master', 'contents' , 'ideas/ideas-list', $this->data);
        
    }
       
    public function page(){
        
        $config = array();
        $config["base_url"] = base_url() . "/businessideas/page";
        $params['status'] = 2;
        $allideas = $this->Idea->getIdeas($params);
        $total_row = count($allideas);
        
        $config["total_rows"] = $total_row;
        $config["per_page"] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-info">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)-1)*$config["per_page"];
        } else {
            redirect('businessideas');
        }
        
        $params['per_page'] = $config["per_page"];
        $params['page'] = $page;
        $this->getideas($params);
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;',$str_links );
	
        $this->data['landing'] = 'ideaslist';
        
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online - Page '.$this->uri->segment(3);
        $this->data['metadescription'] = 'Page '.$this->uri->segment(3).' - Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
        $this->template->load('master', 'contents' , 'ideas/ideas-list', $this->data);
    }
    
    private function getideas($params){
		$session_user = $this->session->userdata('user'); 
		$params['session_user']=$session_user;
        $businessidea = array();
        $pbusinessidea = array();
        $params['status'] = 2;
        $ideas = $this->Idea->getIdea($params);
        foreach($ideas as $key=>$idea){
            $idea['shortdescription'] = $this->truncatehtml->truncateWords($idea['description'],50);
            $idea['longdescription'] = $this->truncatehtml->truncateWords($idea['description'],100);
            $idea['tags'] = explode(',', $idea['tag_name']);
            $idea['slug'] = explode(',', $idea['slug']);
            $businessidea[] = $idea; 
        }
//		echo "<pre>"; print_r($ideas); exit;
        $this->data['bussinessIdeas'] = $businessidea;
        if($this->data['session_exist']){
            $params1['session_user'] = $params1['posted_by'] = $this->data['user']['id'];
            $posted_ideas = $this->Idea->getIdea($params1);
            foreach($posted_ideas as $key1=>$pidea){
                $pidea['shortdescription'] = $this->truncatehtml->truncateWords($pidea['description'],50);
                $pidea['longdescription'] = $this->truncatehtml->truncateWords($pidea['description'],100);
                $pbusinessidea[] = $pidea; 
            }

            $this->data['posted_bussinessIdeas'] = $pbusinessidea;
            
        }
        
    }

    public function initiateIdeas(){
        $initiates = array();
        $session_user = $this->session->userdata('user'); 
        $params['session_user']=$session_user;
        $params['status'] = 2;
        
        $initiateideas = $this->Idea->initiates($params);
        if(count($initiateideas)){
            foreach($initiateideas as $key3=>$initiate){
                $initiate['shortdescription'] = $this->truncatehtml->truncateWords($initiate['description'],50);
                $initiate['longdescription'] = $this->truncatehtml->truncateWords($initiate['description'],100);
                $initiates[] = $initiate; 
            }
        }
        
        $view['initiates'] = $initiates;
        $array['view'] = $this->load->view('ideas/ideas-initiates',$view,true);
        echo json_encode($array);

    }

    public function investIdeas(){
        $investsAll = array();
        $session_user = $this->session->userdata('user'); 
        $params['session_user']=$session_user;
        $params['status'] = 2;

        $investideas = $this->Idea->investAll($params);
        if(count($investideas)){
            foreach($investideas as $key4=>$invest){
                $invest['shortdescription'] = $this->truncatehtml->truncateWords($invest['description'],50);
                $invest['longdescription'] = $this->truncatehtml->truncateWords($invest['description'],100);
                $investsAll[] = $invest; 
            }
        }
        $view['investsAll'] = $investsAll;
        $array['view'] = $this->load->view('ideas/ideas-invested',$view,true);
        echo json_encode($array);
        
    }
    
    public function savedIdeas(){
        
        $session_user = $this->data['user']['id'];
        $ideaslist = $this->Idea->savedIdeasList($session_user);
        $saved_ideas = $ideas = $sideas = array();
        if(count($ideaslist)>0){
            
            foreach ($ideaslist as $k=>$v){
                $ideas[$k] = $v['idea_id'];
            }
            $params['saved_ideas'] = $ideas;
            $params['session_user'] = $session_user;
            $saved_ideas = $this->Idea->getIdea($params);

            $sideas = array();
            if(count($saved_ideas)){
                foreach($saved_ideas as $key2=>$sidea){
                    $sidea['shortdescription'] = $this->truncatehtml->truncateWords($sidea['description'],50);
                    $sidea['longdescription'] = $this->truncatehtml->truncateWords($sidea['description'],100);
                    $sideas[] = $sidea; 
                }
            }
        }
        $view['saved_ideas'] = $sideas;
        $array['view'] = $this->load->view('ideas/ideas-saved',$view,true);
        echo json_encode($array);
    }

    public function idea($ideaid){
        $params['id'] = $ideaid;
        $ideas = $this->Idea->getIdea($params);
        foreach($ideas as $key=>$idea){
            $idea['shortdescription'] = $this->truncate($idea['description'],50,200);
            $idea['longdescription'] = $this->truncate($idea['description'],100,300);
            $businessidea[] = $idea; 
        }
        $this->data['bussinessIdeas'] = $businessidea;
        $this->data['features'] = "";
        $this->template->load('master', 'contents' , 'ideas/ideas-list', $this->data);
    }
    
    public function Ideadetails(){
        
        $idea_id = $this->input->post('ideaid');
        $view['idea'] = $this->Idea->getIdea(array('id'=>$idea_id));
        $view['idea_details'] = $this->Idea->getIdeaDetails($idea_id);
        
        $view['resources'] = $this->Idea->getResourceDetails($idea_id);
        $view['user'] = $this->data['user'];
        $view['issaved'] = $this->Idea->isSavedIdea($idea_id, $this->data['user']['id']);
        $array['view'] = $this->load->view('ideas/idea_details',$view,true);
        
        echo json_encode($array);
    }
    public function search(){
        $industrylist = $_GET;
        $this->data['industrkey'] = $industrylist;
        $params['industry'] = $industrylist;
        $params['status'] = 2;

        $search = $this->Idea->getIdea($params);
        $businessidea = array();
        if(count($search)>0){
            foreach($search as $key=>$idea){
                $idea['shortdescription'] = $this->truncate($idea['description'],50,200);
                $idea['longdescription'] = $this->truncate($idea['description'],100,300);
                //$idea['tags'] = explode(',', $idea['tag_name']);
                //$idea['slug'] = explode(',', $idea['slug']);
                $businessidea[] = $idea; 
            }
        }
        $this->data['bussinessIdeas'] = $businessidea;
        $this->template->load('master', 'contents' , 'ideas/ideas-list', $this->data);
    }
    
    public function postidea(){
        $this->data['skills'] = $this->Skills->getAll();
        $this->data['tags'] = $this->Tag->getAll();
		$this->data['page'] = $this->Tag->getAll();
        $this->template->set('title', 'postidea');
        $this->template->set('sub_title', 'Ideas live Forever');
        $this->template->load('main', 'contents' , 'ideas/post-idea', $this->data);
    }
    
    
    public function submitPost(){
        $post_array = $this->input->post();
        
        $validate = $this->validatePostIdea($post_array);
        if($validate){
            $post_array['posted_by'] = $this->data['user']['id'];
            $insert = $this->Idea->InsertIdea($post_array);
            if($insert){
                $array['issuccess'] = 1;
                $array['success_message'] = "Business idea posted.";
            }else{
                $array['issuccess'] = 2;
                $array['failure_message'] = "issue with idea posting. Please check and re-post";
            }
        }else{
            $array['issuccess'] = 2;
            $array['failure_message'] = "Please enter valid details";
        }
        
        echo json_encode($array);
    }
    
    public function validatePostIdea($array){
        return true;
    }
    
    public function tag()
    {
        $businessidea = array();
        $params['slug'] = $this->uri->segment('2');
        $params['status'] = 2;
        $ideas = $this->Idea->getIdea($params);
        $tag = $this->Tag->getTagInfo($params['slug']);
        if(isset($tag['title']) && $tag['title']!=''){
            $this->data['metatitle'] = $tag['title'];
            $this->data['metadescription'] = $tag['description'];
        }
        $this->data['metatitle'] = ucfirst($tag['tag_name']) .'- Post A Business Idea | Viewham';
        $this->data['metadescription'] = 'Viewham is making its way to be a great platform where people can login to set a pace around their '. ucfirst($tag['tag_name']) .'. Post and explore business ideas.';
            
        foreach($ideas as $key=>$idea){
            $idea['shortdescription'] = $this->truncate($idea['description'],50,200);
            $idea['longdescription'] = $this->truncate($idea['description'],100,300);
            //$idea['tags'] = explode(',', $idea['tag_name']);
            //$idea['slug'] = explode(',', $idea['slug']);
            $businessidea[] = $idea; 
        }
        
        $this->data['bussinessIdeas'] = $businessidea;
        $this->data['landing'] = 'ideaslist';
        $this->template->load('master', 'contents' , 'ideas/ideas-list', $this->data);
        
    }

    public function industry()
    {
        $businessidea = array();
        $this->data['industry_name'] = $this->uri->segment('2');
        $this->data['industrkey'] = array($this->data['industry_name']);
        $industry_details = $this->Industry->getIndustrySlug($this->data['industry_name']);
        
        if(isset($industry_details) && is_array($industry_details)){
            $params['industry'] = array($industry_details['id']);
            $this->data['industry_title'] = $industry_details['industry'];
            $this->data['industry_content'] = $industry_details['content'];
        }
        $this->data['metatitle'] = ucfirst($industry_details['industry']) .' Business Ideas - Plans, Opportunities and Profitable';
        $this->data['metadescription'] = 'Submit and view hundreds of different startup, money making low investment '.ucfirst($industry_details['industry']).' profitable business ideas & plans posted on Viewham Hyderabad, India.';
        
        $params['status'] = 2;
        $ideas = $this->Idea->getIdea($params);
        foreach($ideas as $key=>$idea){
            $idea['shortdescription'] = $this->truncate($idea['description'],50,200);
            $idea['longdescription'] = $this->truncate($idea['description'],100,300);
            //$idea['tags'] = explode(',', $idea['tag_name']);
            //$idea['slug'] = explode(',', $idea['slug']);
            $businessidea[] = $idea; 
        }
        
        $this->data['bussinessIdeas'] = $businessidea;
        $this->data['landing'] = 'industry';
        $this->template->load('master', 'contents' , 'ideas/ideas-list', $this->data);
        
    }
    
    private function truncate($input, $maxWords, $maxChars){
        $words = preg_split('/\s+/', $input);
        $words = array_slice($words, 0, $maxWords);
        $words = array_reverse($words);
        $chars = 0;
        $truncated = array();
        while(count($words) > 0){
            $fragment = trim(array_pop($words));
            $chars += strlen($fragment);
            if($chars > $maxChars) break;
            
            $truncated[] = $fragment;
        }
        $result = implode($truncated, ' ');

        if ($input == $result) {
            return $input;
        } else {
            return preg_replace('/[^\w]$/', '', $result) . '...';
        }
    }
    
    public function Comments($id){
        return $comments = $this->Idea->getComments($id);
    }
    
    public function saveComments(){
        $session_user = $this->data['user']['id'];
        $userData = array(
            'comment_name' => strip_tags($this->input->post('postcomment')),
            'parent_id' => strip_tags($this->input->post('parent_id')),
            'post_id' => strip_tags($this->input->post('ideaid')),
            'comment_byuser' => $session_user,
            'comment_created' => date("Y-m-d H:i:s"),
        );

        $ideaid = $this->input->post('ideaid');	
        $Insert = $this->Comments->InsertComment($userData);
        if($Insert){
            $list = $this->Coins_model->getCoinsEarned($session_user,$ideaid,'Opinion on a idea');
            if(count($list)==0){
                $coins['credit'] = 5;
                $coins['userid'] = $session_user;
                $coins['source'] = 'Opinion on a idea';
                $coins['create_date'] = date("Y-m-d H:i:s");
                $coins['post_id'] = $ideaid; 
                $this->Coins_model->insertCoins($coins);  
            }

            $comments = $this->Comments->getCommentbyid($Insert);
            $userid = $comments['comment_byuser'];
            $view['user'] = $this->Users->getUserDetails(array('id'=>$userid));
            $view['comments']=$comments;
            if($view['user']['login_type']==1){
                $profile_pic = (isset($view['user']['profile_picture']) && $view['user']['profile_picture']!='')?$view['user']['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $view['user']['profile_picture'];
            }
            $view['user']['profile_picture'] = $prof_pic;
            $data['issuccess']=1;
            $data['view'] = $this->load->view('ideas/comments',$view,true);
            
        }else{
            $data['issuccess']=0;
            $data['error_message']='Failed to insert comment';
        }
        echo json_encode($data);
    }
    
    public function userdata($id){
        return $userdata = $this->Users->getUserDetails(array('id'=>$id));
    }
    
    public function comment_ById($id){
        $session_user = $this->session->userdata('user'); 	
        return $chechLike=$this->Comments->checkLikeComment($session_user,$id);	
    }
    
    public function SubComments($id){
        return $comments = $this->Comments->getSubComments($id);
    }
    
    public function Commentsadd(){
        $session_user = $this->session->userdata('user'); 
        $userData = array(
            'comment_name' => strip_tags($this->input->post('postcomment')),
            'parent_id' => strip_tags($this->input->post('parent_id')),
            'post_id' => strip_tags($this->input->post('ideaid')),
            'comment_byuser' => $session_user,
            'comment_created' => date("Y-m-d H:i:s"),
        );
	
        $ideaid = $this->input->post('ideaid');	
	$Insert = $this->Comments->InsertComment($userData);
	if($Insert){
            $list = $this->Coins_model->getCoinsEarned($session_user,$ideaid,'Opinion on a idea');
            if(count($list)==0){
                $coins['credit'] = 5;
                $coins['userid'] = $session_user;
                $coins['source'] = 'Opinion on a idea';
                $coins['create_date'] = date("Y-m-d H:i:s");
                $coins['post_id'] = $ideaid; 
                $this->Coins_model->insertCoins($coins);  
            }
            $dataa = $this->Comments->getCommentbyid($Insert);
            $userid = $dataa['comment_byuser'];
            $view['user'] = $this->Users->getUserDetails(array('id'=>$userid));
            $view['comment']=$dataa;
            if($view['user']['login_type']==1){
                $profile_pic = (isset($view['user']['profile_picture']) && $view['user']['profile_picture']!='')?$view['user']['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $view['user']['profile_picture'];
            }
            $view['user']['profile_picture'] = $prof_pic;
            $data['view'] = $this->load->view('ideas/comments_reply',$view,true);
            $data['issuccess']=1;
            
        }else{
            $data['issuccess']=0;
            $data['error_message']='Failed to insert comment';
        }		
	echo json_encode($data);	
    }
    
    public function commentLike(){
        $session_user = $this->data['user']['id'];
        $comment_id = $this->input->post('comment_id');
        $textstatus = $this->input->post('textstatus');
        if($textstatus=='Like'){
            $status=1;
        }else{
            $status=2;
        }
        $userData = array(
            'status' => $status,
            'comment_id' => strip_tags($this->input->post('comment_id')),
            'posted_by' => $session_user ,
            'created_date' => date("Y-m-d H:i:s")
        );
			
        $chechLike=$this->Comments->checkLikeComment($session_user,$comment_id);	
        if(!empty($chechLike)){
            $Insert = $this->Comments->UpdateCommentLike($userData,$session_user,$comment_id);
        }else{		
            $Insert = $this->Comments->InsertCommentLike($userData);
        }
        if($Insert){
            echo json_encode($status);
        }else{
            echo "failed Oops"; exit;
        }		
    }
    
    public function saveidea(){
        $ideaid = $this->input->post('ideaid');
        $uid = $this->input->post('uid');
        $saved = $this->input->post('saved');
        
        if($saved==1){
            $data['delete'] = $this->Idea->deleteSavedIdea(array('idea_id'=>$ideaid,'user_id'=>$uid));
            $data['val'] = 0;
        }else{
            $data['insert'] = $this->Idea->insertSavedIdea(array('idea_id'=>$ideaid,'user_id'=>$uid));
            $data['val'] = 1;
        }
        echo json_encode($data);
    }
    
    
    public function reportIdea(){
        $session_user = $this->data['user']['id']; 
        $userData = array(
            'report' => strip_tags($this->input->post('optionsreport')),
            'status' => 1,
            'idea_id' => strip_tags($this->input->post('postidreport')),
            'posted_by' => $session_user,
            'create_date' => date("Y-m-d H:i:s")
        );
        
        $Insert = $this->Idea->InsertReportIdea($userData);
        if($Insert){
            $array['issuccess'] = 1;
        }else{
            $array['issuccess'] = 0;
        }		
        
        echo json_encode($array);
		
    }
    
    public function ImpressIdea(){
        $session_user = $this->session->userdata('user'); 
        $ideaid = $this->input->post('ideaid');
        $userData = array(
            'feedback' => strip_tags($this->input->post('impress')),
            'status' => 1,
            'idea_id' => strip_tags($this->input->post('ideaid')),
            'posted_by' => $session_user ,
            'create_date' => date("Y-m-d H:i:s"),
        );
			
        $chechfeedback=$this->Idea->checkFeedbackIdea($session_user,$ideaid);	
        if(!empty($chechfeedback)){
            $Insert = $this->Idea->UpdateFeedbackIdea($userData,$session_user,$ideaid);
        }else{		
            $Insert = $this->Idea->InsertFeedbackIdea($userData);
            $coins['credit'] = 5;
            $coins['userid'] = $session_user;
            $coins['source'] = 'Rating for a Idea';
            $coins['create_date'] = date("Y-m-d H:i:s");
            $coins['idea_id'] = $ideaid;
            $this->Coins_model->insertCoins($coins);  
        }
        if($Insert){
            $feed = $this->Idea->Postfeedback_byId($ideaid);
            
            $data['issuccess'] = 1;
            $data['fdb'] = $feed['rating'];
            
        }else{
            $data['issuccess'] = 0;
            $data['message'] = "Error in updating data";
        }
        echo json_encode($data);
    }
   public function ignore(){
   $session_user = $this->session->userdata('user');         
        $userData = array(
            'idea_id' => strip_tags($this->input->post('ideaid')),
            'user_id' => $session_user ,
            'created_at' => date("Y-m-d H:i:s"),
        );
		$response['insert'] = $this->Idea->ignoreIdea($userData);
	 if(strip_tags($this->input->post('typeaction'))==2){
			$ideaid=strip_tags($this->input->post('idea_id'));
			$response['insert'] = $this->Idea->insertSavedIdea(array('idea_id'=>$ideaid,'user_id'=>$session_user));
			$response['val'] = 1;
	 }
    $response['data']=$userData;
    echo json_encode($response);        
    }
	public function initiates(){
		$this->Idea->initiates();
	}
	public function postInvestIdea(){
		$session_user = $this->session->userdata('user');         
		$idea_id = $this->input->post('idea_id');
		$ideaDetails = $this->Idea->getIdeaDetails($idea_id);			
		$error= $this->postIniateIdeaValidatiotn();
		if(empty($error)){
		  $locations = array_filter($this->input->post('location'));
		  $dataInitiate=array(
				'role'=>$this->input->post('role'),
				'idea_id'=>$this->input->post('idea_id'),
				'posted_by'=>$this->data['user']['id'],
				'location' => json_encode($locations),
				'currency'=>$this->input->post('currency'),
				'invest_min'=>$this->input->post('invest_min'),
				'invest_max'=>$this->input->post('invest_max'),
				'share_min'=>$this->input->post('share_min'),
				'share_max'=>$this->input->post('share_max'),
				'create_date'=>date("Y-m-d H:i:s")
		);
		$investall=array(
				'post_id'=>$this->input->post('idea_id'),
				'posted_by'=>$this->data['user']['id'],
				'industry'=>$this->input->post('industry'),
				'post_type'=>12,
				'create_date'=>date("Y-m-d H:i:s")
		);
		
		$insert= $this->Idea->InsertInvestIdea($dataInitiate);
		if($insert){
		$insert= $this->Idea->InsertInvestAll($investall);
			$data['is_success']=1;
			$data['message']='Successfully initiated';
			$toMeData = array('post_id' =>$insert,'text'=>'you have initiated idea','skill_id'=>$idea_id,'to_id'=>$session_user,'notification_type'=>36);
			$toOwenerData = array('post_id' =>$insert,'text'=>'your idea initiated','skill_id'=>$idea_id,'to_id'=>$ideaDetails['posted_by'],'notification_type'=>37);
			$this->SaveNotification($toMeData);
			$this->SaveNotification($toOwenerData);
		}else{
			$data['is_success']=0;
			$data['message']='Oops Wrong..! Please try again later';
		}
		}else{
			$data['is_success']=2;
			$data['error']=$error;
			$data['message']='Please Enter valid fields';
			
		}	
		echo json_encode($data);exit;
	}	
	public function postIniateIdeaValidatiotn(){
	$error =array();
            if(isset($_POST['funding'])){
 		if(empty($_POST['invest_min'])){
			$error['invest_min']="Please enter min invest.";
		}	
		if(empty($_POST['invest_max'])){
			$error['invest_max']="Please enter max invest.";
		}	
		if(empty($_POST['share_min'])){
			$error['share_min']="Please enter min share.";
		}	
		if(empty($_POST['share_max'])){
			$error['share_max']="Please enter max share.";
		}
		if(empty($_POST['role'])){
			$error['role']="Please select investor role.";
		}
		$location=array_filter($_POST['location']);
		if(empty($location)){
			$error['location']="Please enter location";
		}	
		if(!empty($_POST['invest_max']) && !empty($_POST['invest_min'])){
			if($_POST['invest_min'] >= $_POST['invest_max'] ){
				$error['invest']="Max investment should be greater than Min Investment";	
			}
		}
		if(!empty($_POST['share_max']) && !empty($_POST['share_min'])){
			if($_POST['share_min'] >= $_POST['share_max'] ){
			$error['share']="Max share should be greater than Min share";	
			}
		}
	
            }	
		return $error;	
	}
	public function postIniateIdeaAjaxValidate(){
			$error= $this->postIniateIdeaValidatiotn();
			$data['is_success']=2;
			$data['error']=$error;
		echo json_encode($data);
	}
	public function postIniateIdea(){
		$session_user = $this->session->userdata('user');         
		$idea_id = $this->input->post('idea_id');
		$ideaDetails = $this->Idea->getIdeaDetails($idea_id);			

		$locations = array_filter($this->input->post('location'));
		$error= $this->postIniateIdeaValidatiotn();
		if(empty($error)){
		$dataInitiate=array(
				'idea_id'=>$this->input->post('idea_id'),
				'posted_by'=>$this->data['user']['id'],
				'is_employee'=>$this->input->post('employee'),
				'is_partner'=>$this->input->post('partner'),
				'role'=>$this->input->post('role'),
				'location' => json_encode($locations),
				'currency'=>$this->input->post('currency'),
				'invest_min'=>$this->input->post('invest_min'),
				'invest_max'=>$this->input->post('invest_max'),
				'share_min'=>$this->input->post('share_min'),
				'share_max'=>$this->input->post('share_max'),
				'consultant'=>$this->input->post('consultant'),
				'mentorship'=>$this->input->post('mentorship'),
				'create_date'=>date("Y-m-d H:i:s")
		  );
		  $initiateall=array(
				'post_id'=>$this->input->post('idea_id'),
				'posted_by'=>$this->data['user']['id'],
				'industry'=>$this->input->post('industry'),
				'post_type'=>12,
				'create_date'=>date("Y-m-d H:i:s")
		);
		$insert= $this->Idea->InsertInitiateIdea($dataInitiate);
		if($insert){
			$industry = $this->input->post('industry');
			$insert= $this->Idea->InsertInitiatAll($initiateall);
			$nData = array('post_id' =>$insert,'text'=>'idea Initiated','skill_id'=>$idea_id);
			$toMeData = array('post_id' =>$insert,'text'=>'you have initiated idea','skill_id'=>$idea_id,'to_id'=>$session_user,'notification_type'=>34);
			$toOwenerData = array('post_id' =>$insert,'text'=>'your idea initiated','skill_id'=>$idea_id,'to_id'=>$ideaDetails['posted_by'],'notification_type'=>35);
			$dataInitiate['industry']=$industry;
			$this->NotificationSendToAll($nData,$dataInitiate);
			$this->SaveNotification($toMeData);
			$this->SaveNotification($toOwenerData);
			$data['is_success']=1;
			$data['message']='Successfully initiated idea';
		}else{
			$data['is_success']=0;
			$data['message']='Oops Wrong..! Please try again later';
		}
	}else{
			$data['is_success']=2;
			$data['error']=$error;
			$data['message']=$error;
	}
		echo json_encode($data);
	}	
	private function NotificationSendToAll($data = array(),$singleidea) {
			$consultant = $singleidea['consultant'];
			$mentor = $singleidea['mentorship'];
			$industry = $singleidea['industry'];
			if($consultant==1){
			$query = $this->db->get_where('vh_posts', array('post_type' => 1,'industry' =>$industry))->result_array();
			foreach($query as $key=>$val){
					$data['to_id']=$val['posted_by'];
					$data['notification_type']='22';
					$this->SaveNotification($data);							
				}
		
			}
			// send notification for investor Mentor
			
			if($mentor==1){
				$mentorquery = $this->db->get_where('vh_posts', array('post_type' => 2,'industry' =>$industry))->result_array();
			foreach($mentorquery as $k=>$v){
					$data['to_id']=$v['posted_by'];
					$data['notification_type']='23';
					$this->SaveNotification($data);							
			}
		
			}
			return $mentor;
       
    }
	private function SaveNotification($nData){
		$session_user = $this->session->userdata('user');
		$Notification = array(
                'notification_type' => $nData['notification_type'],
				'from_id' => $session_user,
				'to_id' => $nData['to_id'],
				'post_id' => $nData['post_id'],
				'skill_id' => $nData['skill_id'],
				'text' => $nData['text'],
				'created_on' => date("Y-m-d H:i:s")
        );
		$this->Notification_model->insertNotification($Notification);
	}
}
