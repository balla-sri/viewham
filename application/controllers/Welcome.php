<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
        public function __construct() {
            parent::__construct();
            $this->load->library('session');
            $this->load->model('Users');
			$this->load->helper('viewham_helper');
            $this->load->model('Industry');          
            $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
            $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';
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
        }
    
        public function index()
	{
		if($this->data['session_exist']==1){
			redirect('dashboard');
		}
		$this->data['landing'] = 'index';
		$this->template->set('title', 'IDEA ZONE');
        $this->template->set('sub_title', 'Ideas live Forever');
		$this->template->load('no-menu', 'contents' , 'home', $this->data);
	}
        
        public function page(){
            
            $page = $this->uri->segment('1');
            switch ($page)
		{
                    case "who-we-are":
                        $this->template->set('title', 'WHO WE ARE?');
                        $this->template->set('sub_title', '');
                        $this->template->load('main', 'contents' , 'statics/who-we-are',$this->data);
                        break;		
                    case "contact-us":
                        $this->template->set('title', 'CONTACT US');
                        $this->template->set('sub_title', '');
                        $this->data['metatitle'] = 'Contact Us - Small Business Side Income Ideas | Viewham';
                        $this->data['metadescription'] = 'Have a question on how to learn more about submitting product ideas and services, and more then please contact us!';
                        $this->template->load('main', 'contents' , 'statics/contact-us',$this->data);
                    break;		
                    case "terms":
			$this->template->set('title', 'TERMS AND CONDITIONS');
                        $this->template->set('sub_title', '');
                        $this->template->load('main', 'contents' , 'statics/terms-and-conditions',$this->data);
					break;
                    case "how-it-works":
                        $this->template->set('title', 'How IT WORKS');
                        $this->template->set('sub_title', '');
                        $this->template->load('main', 'contents' , 'statics/how-it-works',$this->data);
                    break;		
                    case "what-we-do":
                        $this->template->set('title', 'What WE DO?');
                        $this->template->set('sub_title', '');
                        $this->template->load('main', 'contents' , 'statics/what-we-do',$this->data);
					break;		
                    case "earn":
                        $this->load->view('knowmore-earn');
                        break;	
                    case "gain":
                        $this->load->view('knowmore-gain');
                    break;	
                    case "sitemap":
                        $this->data['metatitle'] = 'Sitemap | Viewham.com Hyderabad, India';
                        $this->data['metadescription'] = " Here's a guide to everything you need to know about Viewham.com.";
                        $industries = $this->Industry->getAll();
                        
                        $this->data['industries'] = $industries;
                        $this->template->set('title', 'SITEMAP');
                        $this->template->set('sub_title', '');
                        $this->template->load('main', 'contents' , 'sitemap',$this->data);
                        break;
                    break;  
                    case "quick-links":
                        $this->template->load('no-menu', 'contents' , 'statics/quick-links',$this->data);
					break;
           			/*$session_user = $this->session->userdata('user'); 
           			$data['user'] = $this->User_model->user_details($session_user);
           			$this->load->view('admin/user-quick-links',$data);
                    break;*/

                    default:
                        $this->template->set('title', '404 Page Not Found');
                        $this->template->set('sub_title', 'The requested page could not be found');
                        $this->template->load('main', 'contents' , 'error_404', $this->data);
                    break;
		}
            
        }
        
        public function ContactUs(){
            $name= $this->input->post('name');
            $email= $this->input->post('email');
            $phone= $this->input->post('phone');
            $message= $this->input->post('message');
            
            $this->load->library('email');
            
            $this->email->set_newline("\r\n");
            $this->email->set_header('MIME-Version', '1.0; charset=utf-8'); 
            $this->email->set_header('Content-type', 'text/html'); 

            $this->email->from('ajay@viewham.com', 'Viewham');
            $this->email->to('ramakrishna.viewham@gmail.com');
            $this->email->reply_to($email);
            $this->email->subject('Viewham');

            $this->email->message('Welcome To Viewham. <br><br>  Name: '.$name.'
                            <br> email: '.$email.'
                            <br> phone: '.$phone.'
                            <br> Message: '.$message.'
                            ');
            if($this->email->send()) {
                $array['issuccess'] = 1;
                $array['message'] = 'Sent Succussful will get back to you Soon';
            }else{
                $array['issuccess'] = 0;
                $array['message'] = 'Sorry... not sent. Oops failed!'; 
            }
            echo json_encode($array);
        }
	
}
