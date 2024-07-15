<?php

class Learn extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Users');
        $this->load->model('Posts');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Notification_model');
        $this->load->helper('viewham_helper');
        $this->load->model('Skills');
        $this->load->model('Entrepreneur_model');

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
        $this->data['metatitle'] = 'Business Ideas | Best Startup Ideas | Submit Your Ideas Online';
        $this->data['metadescription'] = 'Looking for New Business Ideas or Opportunities? Welcome to Viewham, an online platform for the modern-day entrepreneur & beginners to start sharing ideas!';

    }

    public function index() {
        if($this->data['session_exist']==1){
            redirect(base_url() . 'learn/feed');
        }
        $this->template->load('no-menu', 'contents' , 'statics/knowmore-learn', $this->data);
    }

    public function Feed($profileid = '') {
        $this->data['skills'] = $this->Skills->getAll();
        $this->data['posts'] = array();
        $this->data['profile_id'] = 0;

        $this->template->load('learn', 'contents' , 'learn/learn-user', $this->data);
    }


    public function do_upload() {

        if (!empty($_FILES['userfile']['name'])) {
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $imgName = $_FILES['userfile']['name'];
                $splittedArray = @explode(".", $imgName);
                $imagename = time() . '_' . $i . '.' . end($splittedArray);

                $_FILES['userfile']['file_name'] = $imagename;
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options('uploads/', $imagename));
                $this->upload->do_upload();
                $dataInfo[] = $this->upload->data();
            }
            return $dataInfo;
        }
    }

    private function set_upload_options($path, $imagename) {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        $config['file_name'] = $imagename;
        $config['upload_path'] = $path;
        return $config;
    }

    function new_post() {
//Creating new post page
        $session_user = $this->session->userdata('user');

        if ($this->input->post()) {

			if(!empty($this->input->post('multi'))){
				$tags = implode(',',$this->input->post('multi'));
			}else{$tags = '';}
            $data = array('question' => $this->input->post('question'),'feed_type' => $this->input->post('feed_type'), 'tags'=>$tags,'user_id' => $session_user);
            
            $last_inserted_id = $this->Posts->insert_post($data);
            if (!empty($_FILES['userfile']['name'])) {
                $uploaded_datas = $this->do_upload();
                $att_data = array();
                foreach ($uploaded_datas as $uploaded_data) {
                    $bin = array(
                        'name' => $uploaded_data['file_name'],
                        'type' => $uploaded_data['file_type'],
                        'size' => $uploaded_data['file_size'],
                        'post_id' => $last_inserted_id,
                        'addedby' => $data['user_id']
                    );
                    $att_data = array_merge($att_data, $bin);
                    $this->db->insert('attachments', $att_data);
                }
            }
            redirect(base_url() . 'learn/feed');
        }
    }

    public function itemLike() {
		$session_user = $this->session->userdata('user');
        $postId = $this->input->post('postid');

        $type = $this->input->post('type');

        $data = array(
            "userid" => $session_user,
            "postid" => $postId,
            "type" => $type
        );
        $this->db->select('postid');
        $this->db->where('postid', $postId);
        $query = $this->db->get('post_like');
        $num = $query->num_rows();
        if ($query->num_rows >= 1) {

            $this->db->where('postid', $postId);
            $this->db->update('post_like', $data);
            if ($type == "0") {
                echo 'unliked';
            }
        } else {
			if ($type == "1") {
                $this->db->insert('post_like', $data);
                echo 'liked';
            }
        }
    }

    

    function new_answers() {
//Creating new comment
        $session_user = $this->session->userdata('user');
        if ($this->input->post()) {
//'tags' => $this->input->post('tags'),
            $data = array('answer' => $this->input->post('answer'), 'post_id' => $this->input->post('post_id'), 'user_id' => 1,);

            $last_inserted_id = $this->Posts->insert_ans($data);
            redirect(base_url() . 'learn/feed');
        }
    }
    
	function feednew_answer() {
         $html = "";
        $session_user = $this->session->userdata('user');
        if($this->input->post()) {
			$data = array('answer' => $this->input->post('comment_text'),'reply_id' =>$this->input->post('reply_id'), 'post_id' => $this->input->post('post_id'), 'user_id' => $session_user);

            $last_inserted_id = $this->Posts->insert_ans($data);
            if ($last_inserted_id != NULL) {
                foreach ($last_inserted_id as $row) {
                    $date = $row->created_date;
                    echo "<li id='feedli_comment_{$row->comment_id}'>" ;
                    echo "<div><img src='".base_url('uploads/images/svg.svg')."' alt='' class='profile-pic'><span class='commenter'>{$row->user_id}</span>&nbsp;<span class='comment_date'>{$date}</span></div>" ;
                    echo "<div style='margin-top:4px;'>{$row->answer}</div>";
                    echo "<a href='javascript:void(0);' class='feedreply_button stat-item' data-postid='{$row->post_id}' id='{$row->comment_id}'><i class='fa fa-reply'></i> Reply</a>";
                    "</li>";

                }
               
            } else {
                echo 'Error in adding comment';
            }

        }
        
    }
	
    function new_answer() {
         $html = "";
        $session_user = $this->session->userdata('user');
        if($this->input->post()) {
            $data = array('answer' => $this->input->post('comment_text'),'reply_id' =>$this->input->post('reply_id'), 'post_id' => $this->input->post('post_id'), 'user_id' => $session_user);

            $last_inserted_id = $this->Posts->insert_ans($data);
            if ($last_inserted_id != NULL) {
                foreach ($last_inserted_id as $row) {
                    $date = $row->created_date;
                    echo "<li id='li_comment_{$row->comment_id}'>" ;
                    echo "<div><img src='".base_url('uploads/images/svg.svg')."' alt='' class='profile-pic'><span class='commenter'>{$row->user_id}</span>&nbsp;<span class='comment_date'>{$date}</span></div>" ;
                    echo "<div style='margin-top:4px;'>{$row->answer}</div>";
                    echo "<a href='javascript:void(0);' class='reply_button stat-item' data-postid='{$row->post_id}' id='{$row->comment_id}'><i class='fa fa-reply'></i> Reply</a>";
                    "</li>";

                }
               
            } else {
                echo 'Error in adding comment';
            }

        }
        
    }

    function Feed_posts() {
        $data['posts'] = $this->Posts->get_posts($this->data['user']['id']);
        $posts_count = count($data['posts']);

        for ($i = 0; $i < $posts_count; $i++) {
            $post_ids = $data['posts'][$i]['post_id'];
            $data['attachments'][] = $this->Posts->get_attachments($post_ids);
            $data['answers'][$post_ids] = $this->Posts->feedget_answers($post_ids);
        }
		
        $this->load->view('learn/learn-user-feed', $data);
    }

    function Explore() {
        $session_user = NULL;
        $skillsarray = array();
        
        if($this->data['session_exist']){
            $profileid = $this->input->post('profileid');
            if($profileid == 0){
                $k = SkillProfiles();
                if(is_array($k) && count($k) > 0)
                    $profileid = $k[0]['p_id'];
                else
                    $profileid = 0;
            }
            
            $skill = $this->Entrepreneur_model->EntrepreneurDetails($profileid);
            array_push($skillsarray,$skill['skill']);
            $ass_array = json_decode($skill['association']);
            if(is_array($ass_array) && count($ass_array)>0)
                foreach ($ass_array as $key => $value) {
                    array_push($skillsarray,$value);
                }
            
        }
        
        $data['posts'] = $this->Posts->get_posts(null,$skillsarray);
		$posts_count = count($data['posts']);

        for ($i = 0; $i < $posts_count; $i++) {
            $post_ids = $data['posts'][$i]['post_id'];
            $data['attachments'][] = $this->Posts->get_attachments($post_ids);
            $data['answers'][$post_ids] = $this->Posts->get_answers($post_ids);
        }
        //echo "<pre>";print_r($data['posts']);exit;
        $array['view'] = $this->load->view('learn/learn-user-explore',$data,true);
        echo json_encode($array);
        
    }
	
	function Fetch_notifications() {
		if(isset($_POST['view'])){
            $userid = ($this->data['session_exist'])?$this->data['user']['id']:NULL;
            $data['posts'] = $this->Posts->get_posts($userid);
            $posts_count = count($data['posts']);

            for ($i = 0; $i < $posts_count; $i++) {
                $post_ids = $data['posts'][$i]['post_id'];
                $data['answers'][$post_ids] = $this->Posts->get_answers($post_ids);
            }
		  
            $output = '';

		  if(!empty($data['posts'])){
    		foreach($data['posts'] as $datas){
    			if($datas["type"] == 1){
    				$dliked =' liked this Post';
    			}else if($datas["type"] == 1){
    				$dliked = ' Disliked this Post';
    			}else{
    				$dliked ='';
    			}
    			
                $output .= '
   <li>
   <a href="#">
    <p class="info">'.$datas["question"].'
   <span class="date">'.$datas["created_date"].'</span>
</p>
   </a>
   <strong>'.$datas["username"].'</strong> Tagged 
   <small><em>';
   $tags = explode(",", $datas['tags']);

   if(is_array($tags) && count($tags)>0)
    foreach ($tags as $key=>$tag) {
      $output .= getTagInfo($tag);
      if($key!=(count($tags)-1)){
        $output .= " ,";
      }
    }
    
    
   $output .= '</em></small>
   
    <p class="info">'.$datas["likedusers"].'
   <span class="date">'.$dliked.'</span>
</p>
   </li>
   ';
		}
		
		}else{
     $output .= '
    <!-- <li><a href="#" class="text-bold text-italic">No Notifications Found</a></li>--><li>No Notifications Found</li>';
	}

		$data = array(
    'notification' => $output
    //'unseen_notification'  => $count
);

echo json_encode($data);exit;

    }
	}
}
