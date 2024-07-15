<?php

class Posts extends CI_Model {

    public function __construct() {
        parent::__construct();
        //load database library
        $this->load->database();
    }
	
    public function get_posts($slug = NULL,$profile=array())
    {
        /*select count(plk.userid) as cnt, case WHEN group_concat(plk.userid) is null then 0 else group_concat(plk.userid) end as likedusers,b.* from (SELECT  p.id as postid,p.question,p.tags,GROUP_CONCAT(s.skill) skillnames
        FROM posts p 
        left JOIN skills s ON FIND_IN_SET(s.id, p.tags) > 0 
        where p.tags like '%3%' GROUP BY p.id) b left join post_like plk on b.postid = plk.postid group by b.postid*/
        $where = false;
        $select1 = "SELECT  p.id as post_id, p.question,p.tags,u.name as username , p.created_date, feed_type as type, GROUP_CONCAT(s.skill) skillnames
        FROM posts p 
        left JOIN skills s ON FIND_IN_SET(s.id, p.tags) > 0 
        LEFT JOIN users u ON p.user_id = u.id ";
            if(is_array($profile) && count($profile)>0){
                $select1.=" where ";
                $where = true;
                foreach ($profile as $key => $value) {
                    if($key!=0){
                       $select1.= ' or ';         
                    }
                    $select1.=" p.tags like '%,".$value.",%' or p.tags like '".$value.",%' or p.tags like '%,".$value."' ";            
                }
            }
            if(isset($slug) && $slug!=NULL){
                if($where == false)
                    $select1.=" where ";
                else
                    $select1.=" and ";

                $select1 .=  " p.user_id = ".$slug;
            }

        $select1 .= " GROUP BY p.id";

        $select_main = " select count(plk.userid) as cnt, case WHEN group_concat(plk.userid) is null then 0 else group_concat(plk.userid) end as likedusers,b.* from  ";
        $select_main .= "( ".$select1." )";
        $select_main .= " b left join post_like plk on b.post_id = plk.postid group by b.post_id ORDER BY created_date DESC";

        $qry = $this->db->query($select_main);
        //echo  $this->db->last_query();exit;
        return $qry->result_array();
    }

    public function get_answers($post_id)
    {
        if ($post_id != '')
        {
            $query = $this->db->where('post_id',$post_id)->get('answers');
            if ($query->num_rows() > 0) {
            $items = array();
            foreach ($query->result() as $row) {
                $items[] = $row;
            }
                            //echo '<pre>';print_r($items);exit;
            //return $items;
            $comments = $this->format_comments($items);
            return $comments;
        }
            return '<ul class="comment"></ul>';
            //return $query->row_array();
        }
 
 
        $this->db->select('pl.type,p.question ,p.tags,p.user_id,p.id,a.att_id,a.name,a.post_id,u.ID as userid,u.NAME as username');
        $this->db->from('posts p'); 
        $this->db->join('attachments a', 'a.post_id = p.id', 'left');
        $this->db->join('users u', 'u.id = p.user_id', 'left');
        $this->db->join('post_like pl', 'pl.postid = p.id AND pl.userid = p.user_id','left');
        $this->db->where('p.user_id',$post_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function format_comments($comments) {
        $html = array();
        $root_id = 0;
        foreach ($comments as $comment)
            $children[$comment->reply_id][] = $comment;

        // loop will be false if the root has no children (i.e., an empty comment!)
        $loop = !empty($children[$root_id]);

        // initializing $parent as the root
        $parent = $root_id;
        $parent_stack = array();

        // HTML wrapper for the menu (open)
        $html[] = '<ul class="comment">';
        
        foreach ($children[$parent] as $option => $value) {
            if ($option === false) {
                $parent = array_pop($parent_stack);

                // HTML for comment item containing childrens (close)
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2) . '</ul>';
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1) . '</li>';
            } elseif (!empty($value->id)) {
                $tab = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1);

                $name = $value->created_date;
                $postid = $value->post_id;
                // HTML for comment item containing childrens (open)
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>', $tab, // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
                        $value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
                        $postid// %6$s  = post_id 
                        
                );
                //$check_status = "";
                $html[] = $tab . '<ul class="comment">';

                array_push($parent_stack, $value->reply_id);
                $parent = $value->id;
            } else {
                $name = $option['value']->created_date;
                $postid = $option['value']->post_id;
                // HTML for comment item with no children (aka "leaf") 
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>' .
                        '%1$s</li>', str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1), // %1$s = tabulation
                        $option['value']->id, //%2$s id
                        $name, // %3$s = commenter 
                        $option['value']->answer, // %4$s = comment
                        $option['value']->created_date, // %5$s = comment created_date
                        $postid// %6$s  = post_id
                );
            }
        }

        /*while ($loop && ( ( $option = each($children[$parent]) ) || ( $parent > $root_id ) )) {
            if ($option === false) {
                $parent = array_pop($parent_stack);

                // HTML for comment item containing childrens (close)
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2) . '</ul>';
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1) . '</li>';
            } elseif (!empty($children[$option['value']->id])) {
                $tab = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1);

                $name = $option['value']->created_date;
                $postid = $option['value']->post_id;
                // HTML for comment item containing childrens (open)
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>', $tab, // %1$s = tabulation
                        $option['value']->id, //%2$s id
                        $name, // %3$s = commenter 
                        $option['value']->answer, // %4$s = comment
                        $option['value']->created_date, // %5$s = comment created_date
                        $postid// %6$s  = post_id 
                        
                );
                //$check_status = "";
                $html[] = $tab . '<ul class="comment">';

                array_push($parent_stack, $option['value']->reply_id);
                $parent = $option['value']->id;
            } else {
                $name = $option['value']->created_date;
                $postid = $option['value']->post_id;
                // HTML for comment item with no children (aka "leaf") 
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>' .
                        '%1$s</li>', str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1), // %1$s = tabulation
                        $option['value']->id, //%2$s id
                        $name, // %3$s = commenter 
                        $option['value']->answer, // %4$s = comment
                        $option['value']->created_date, // %5$s = comment created_date
                        $postid// %6$s  = post_id
                );
            }
        }*/

        // HTML wrapper for the comment (close)
        $html[] = '</ul>';
        return implode(" ", $html);
    }

    public function get_attachments($post_id)
    {
       $this->db->select('a.att_id,a.post_id,a.name,a.type,a.size,a.addedby,a.dateofadded');
       $this->db->from('attachments a'); 
       $this->db->where('a.post_id',$post_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_post($data)
    {
        //print_r($data);exit;
        $this->db->insert('posts',$data);
        return $this->db->insert_id();
    }

    public function feedget_answers($post_id)
    {
        if ($post_id != '')
        {
            $query = $this->db->where('post_id',$post_id)->get('answers');
            if ($query->num_rows() > 0) {
            $items = array();
            foreach ($query->result() as $row) {
                $items[] = $row;
            }
                            //echo '<pre>';print_r($items);exit;
            //return $items;
            $comments = $this->feedformat_comments($items);
            return $comments;
        }
            return '<ul class="comment"></ul>';
            //return $query->row_array();
        }
 
 
        $this->db->select('pl.type,p.question ,p.tags,p.user_id,p.id,a.att_id,a.name,a.post_id,u.ID as userid,u.NAME as username');
        $this->db->from('posts p'); 
        $this->db->join('attachments a', 'a.post_id = p.id', 'left');
        $this->db->join('vh_usr u', 'u.ID = p.user_id', 'left');
        $this->db->join('post_like pl', 'pl.postid = p.id AND pl.userid = p.user_id','left');
        $this->db->where('p.user_id',$post_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_ans($data){
        $this->db->insert('answers',$data);
        $inserted_id = $this->db->insert_id();
        if ($inserted_id > 0) {
            $query = $this->db->query('SELECT bc.id as comment_id, bc.post_id, 
                    bc.reply_id, bc.answer, bc.created_date, bc.user_id
                    FROM answers bc WHERE bc.id=' . $inserted_id);
            return $query->result();
        }
        return NULL;
        
    }

     private function feedformat_comments($comments) {
        $html = array();
        $root_id = 0;
        foreach ($comments as $comment)
            $children[$comment->reply_id][] = $comment;

        // loop will be false if the root has no children (i.e., an empty comment!)
        $loop = !empty($children[$root_id]);

        // initializing $parent as the root
        $parent = $root_id;
        $parent_stack = array();

        // HTML wrapper for the menu (open)
        $html[] = '<ul class="comment">';
        foreach ($children[$parent] as $option => $value) {
            if ($option === false) {
                $parent = array_pop($parent_stack);

                // HTML for comment item containing childrens (close)
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2) . '</ul>';
                $html[] = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1) . '</li>';
            } elseif (!empty($children[$value->id])) {
                $tab = str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1);

                $name = $value->created_date;
                $postid = $value->post_id;
                // HTML for comment item containing childrens (open)
                $html[] = sprintf(
                        '%1$s<li id="feedli_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="feedreply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>', $tab, // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
                        $value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
                        $postid// %6$s  = post_id 
                        
                );
                //$check_status = "";
                $html[] = $tab . '<ul class="comment">';

                array_push($parent_stack, $value->reply_id);
                $parent = $value->id;
            } else {
                $name = $value->created_date;
                $postid = $value->post_id;
                // HTML for comment item with no children (aka "leaf") 
                $html[] = sprintf(
                        '%1$s<li id="feedli_comment_%2$s">' .
                        '%1$s%1$s<div><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="profile-pic"><span class="commenter" style="display:none">%3$s</span>&nbsp;<span class="comment_date">%5$s</span><span>%6$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="feedreply_button stat-item" data-postid="%6$s" id="%2$s"><i class="fa fa-reply"></i> Reply</a>' .
                        '%1$s</li>', str_repeat("", ( count($parent_stack) + 1 ) * 2 - 1), // %1$s = tabulation
                        $value->id, //%2$s id
                        $name, // %3$s = commenter 
                        $value->answer, // %4$s = comment
                        $value->created_date, // %5$s = comment created_date
                        $postid// %6$s  = post_id
                );
            }
        }

        // HTML wrapper for the comment (close)
        $html[] = '</ul>';
        return implode(" ", $html);
    }
    
}
?>