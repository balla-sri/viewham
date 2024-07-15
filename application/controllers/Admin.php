<?php

class Admin extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Idea');
        $this->load->library('session');
        $this->load->model('Coins_model');
    }
    
    public function index(){
        $session_user = $this->session->userdata('admin');
        if($session_user){
            redirect('admin/dashboard');
        }
        $this->load->view('admin/admin-signin');
    }
    
    public function SignIn(){
    	if(!empty($_POST)){
                $usn = $this->input->post('email');
                $pwd = $this->input->post('password');
                $query = $this->Admin_model->Admin_login($usn,$pwd);
     
                if($query){
                    $user_id = $query['id'];
            	$user_name = $query['username'];
    	
                    $this->session->set_userdata('admin', $user_id);
                    $this->session->set_userdata('username', $user_name);
                    $session_user = $this->session->userdata('admin');
                    redirect('admin/dashboard');
                }else{
    		$this->session->set_flashdata('error','Please Enter Valid Credentials'); 
    		redirect('admin/');
                }
    	}
            $this->load->view('admin/admin-signin');
        }
    
    public function Dashboard(){
        
        $data['page'] = 'dashboard';
        $this->load->view('admin/admin-dashboard',$data);
    }
    
    public function skills(){
        $session_user = $this->session->userdata('admin');
        if(!$session_user){
            redirect('admin/');
        }
        $data = $this->Admin_model->getSkillsList();
        $data['page'] = 'skills';
        $this->load->view('admin/admin-skills',$data);
    }
    
    public function approveskills($skillid,$status){
        $session_user = $this->session->userdata('admin');
        if(!$session_user){
            redirect('admin/');
        }
        $data = $this->Admin_model->getSkill($skillid);
        $updateskill = $this->Admin_model->UpdateSkill($skillid,array('status'=>$status));
        redirect('admin/skills');
    }
    
    public function ideas(){
        $session_user = $this->session->userdata('admin');
        if(!$session_user){
            redirect('admin/');
        }
        $data['all_ideas'] = $this->Idea->getIdea();
        $data['pending_ideas'] = $this->Idea->getIdea(array('status'=>1));
        $data['approved_ideas'] = $this->Idea->getIdea(array('status'=>2));
        $data['rejected_ideas'] = $this->Idea->getIdea(array('status'=>3));
        $data['page'] = 'ideas';
        $this->load->view('admin/admin-ideas-list',$data);
    }
    
    public function approveidea($idea,$status){
        $session_user = $this->session->userdata('admin');
        if(!$session_user){
            redirect('admin/');
        }
        $data = $this->Idea->getIdea(array('id'=>$idea));
        $updateskill = $this->Admin_model->UpdateIdea($idea,array('status'=>$status));
        if($updateskill){
            if($status == 2){
                $coins['credit'] = 50;
                $coins['userid'] = $data[0]['posted_by'];
                $coins['source'] = 'Posted Idea Approval';
                $coins['create_date'] = date("Y-m-d H:i:s");
                $this->Coins_model->insertCoins($coins);  
            }

            $mail['email'] = $data[0]['email'];
            $mail['name'] = $data[0]['name'];
            $mail['idea_title'] = $data[0]['idea_title'];
            $this->Admin_model->sendEmailApproval($status,$mail);
        }
        redirect('admin/ideas');   
    }
    
    public function viewIdea($idea){
        $session_user = $this->session->userdata('admin');
        if(!$session_user){
            redirect('admin/');
        }
        $data['idea'] = $this->Idea->getIdea(array('id'=>$idea));
        
        $data['page'] = 'ideas';
        $this->load->view('admin/admin-view-idea',$data);
    }
    public function logout(){
        $user_data = $this->session->all_userdata();
        $this->session->sess_destroy();
        redirect('admin/');
    }
}
