<?php

class Comments extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
    
    public function InsertComment($data = array()) {
	 $insert = $this->db->insert('comments', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    public function getCommentbyid($uid){
        $this->db->order_by("comment_id","desc");
        $query = $this->db->get_where('comments', array('comment_id'=>$uid));
        return $query->row_array();
    }
    
    public function checkLikeComment($uid,$ideaid){
        $query = $this->db->get_where('comments_likes', array('posted_by' => $uid,'comment_id' => $ideaid));
        return $query->row_array();
    }
    
    public function getSubComments($uid){
        $this->db->order_by("comment_id","desc");
        $query = $this->db->get_where('comments', array('parent_id'=>$uid));
        return $query->result_array();
    }
    
    public function UpdateCommentLike($userData,$session_user,$ideaid){
        if(!empty($userData) && !empty($session_user)){
            $update = $this->db->update('comments_likes', $userData, array('posted_by'=>$session_user,'comment_id'=>$ideaid));
            return $update?true:false;
        }else{
            return false;
        }
    }
    
    public function InsertCommentLike($data = array()) {
	$insert = $this->db->insert('comments_likes', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
}