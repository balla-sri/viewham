<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ideazone extends CI_Controller{
    Public function __construct(){
    	parent::__construct();
        $this->load->model('Idea');
        $this->load->model('Users');
        $this->load->model('Coins_model');
        $this->load->model('Skills');
        $this->load->model('Industry'); 
        $this->load->model('gain_model');   
        $this->load->model('Investor_model');   
        $this->load->model('Notification_model');

        $this->load->model('Tag');
        $this->load->model('Comments');

    	$this->load->library('session');
        $this->load->library("pagination");
        $this->load->library("truncatehtml");
        	
    	$this->load->helper('viewham_helper');
    	$this->load->helper('gain_helper');
    	$this->load->helper('crypto_helper');

        $this->data['module'] = 'ideazone';

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
		$this->template->load('no-menu', 'contents' , 'statics/knowmore-ideazone', $this->data);

        $this->data['industries'] = $this->Industry->getAll();
        
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
        
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
}
