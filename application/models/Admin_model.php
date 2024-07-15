<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
    /*
     * Fetch Admin_login data
     */
    public function Admin_login($usn,$pwd){
        $query = $this->db->get_where('admin_users', array('username' => $usn,'status' => 1, 'password' => md5($pwd)));
        return $query->row_array();
    }
    
    public function getSkill($skill){
        $query = $this->db->get_where('skills', array('id'=>$skill));
        return $query->row_array();
    }
    public function getSkillsList(){
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('skills');
        $skills_array = $query->result_array();
        $array['all_skills'] = $skills_array;
        
        $this->db->order_by('created_at', 'DESC');
        $query1 = $this->db->get_where('skills', array('status' => '1'));
        $other_skills_array1 = $query1->result_array();
        $array['pending_skills'] = $other_skills_array1;
        
        $this->db->order_by('created_at', 'DESC');
        $query2 = $this->db->get_where('skills', array('status' => '3'));
        $other_skills_array2 = $query2->result_array();
        $array['inactive_skills'] = $other_skills_array2;
        
        $this->db->order_by('created_at', 'DESC');
        $query3 = $this->db->get_where('skills', array('status' => '2'));
        $other_skills_array3 = $query3->result_array();
        $array['active_skills'] = $other_skills_array3;
        return $array;
    }
    public function UpdateSkill($id,$data){
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('vh_skills_list', $data, array('id'=>$id));
            return (($update)?true:false);
        }else{
            return false;
        }
    }
    
    public function getIdeasList(){
        $this->db->select('a.*,b.ID as industry_id, b.SDESC, c.ID as userid,c.NAME');
        $this->db->join('vh_master_data b', 'b.id = a.INDUSTRY');
        $this->db->join('vh_usr c', 'c.id = a.POSTED_BY');
        $this->db->order_by('a.POSTED_DATE', 'DESC');
        $query = $this->db->get('vh_idea_hub a');
        $array['all_ideas'] = $query->result_array();
        
        $this->db->select('a.*,b.ID as industry_id, b.SDESC, c.ID as userid,c.NAME');
        $this->db->join('vh_master_data b', 'b.id = a.INDUSTRY');
        $this->db->join('vh_usr c', 'c.id = a.POSTED_BY');
        $this->db->order_by('a.POSTED_DATE', 'DESC');
        $query1 = $this->db->get_where('vh_idea_hub a',array('status'=>1));
        $array['pending_ideas'] = $query1->result_array();
        
        $this->db->select('a.*,b.ID as industry_id, b.SDESC, c.ID as userid,c.NAME');
        $this->db->join('vh_master_data b', 'b.id = a.INDUSTRY');
        $this->db->join('vh_usr c', 'c.id = a.POSTED_BY');
        $this->db->order_by('a.POSTED_DATE', 'DESC');
        $query2 = $this->db->get_where('vh_idea_hub a',array('status'=>2));
        $array['approved_ideas'] = $query2->result_array();
        
        $this->db->select('a.*,b.ID as industry_id, b.SDESC, c.ID as userid,c.NAME');
        $this->db->join('vh_master_data b', 'b.id = a.INDUSTRY');
        $this->db->join('vh_usr c', 'c.id = a.POSTED_BY');
        $this->db->order_by('a.POSTED_DATE', 'DESC');
        $query3 = $this->db->get_where('vh_idea_hub a',array('status'=>3));
        $array['rejected_ideas'] = $query3->result_array();
        
        return $array;
    }
    
    public function getIdea($id){
        $this->db->select('a.*,b.ID as industry_id, b.SDESC, c.ID as userid,c.NAME');
        $this->db->join('vh_master_data b', 'b.id = a.INDUSTRY');
        $this->db->join('vh_usr c', 'c.id = a.POSTED_BY');
        $query = $this->db->get_where('vh_idea_hub a', array('a.ID'=>$id));
        return $query->row_array();
    }
    
    public function UpdateIdea($id,$data){
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('ideas', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    public function sendEmailApproval($status,$mail){
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8'); 
        $this->email->set_header('Content-type', 'text/html'); 

        $this->email->from('admin@viewham.com', 'Viewham');
        $this->email->to($email);
        $this->email->reply_to($email);
        $this->email->subject('Viewham');

        $message = "Dear ".$mail['name']."</br>";
        if($status==2){
            $message .= " Congratulations! Your Idea ".$mail['idea_title']." is approved.";
        } else if($status==3) {
            $message .= " Your Idea ".$mail['idea_title']." is rejected by admin. Please re-post with appropriate data";
        }

        $message .= " Thanks, \n ADMIN";
        $this->email->message($message);
        if($this->email->send()) {
            return 1;
        }else{
            return 2; 
        }   
    
    }
}
?>