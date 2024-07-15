<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Outsource_model extends CI_Model{
    function __construct() {
         $this->load->database();
    }
    public function Insert_outsource($data = array()) {
	    $insert = $this->db->insert('vh_outsource_work', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function UpdatePost($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_outsource_work', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}


	public function OutsourceProjects($params=array()){
		$this->db->order_by("o.id", "desc");	
		$this->db->select('o.*,i.industry as industry_name,u.name,u.email,u.mobile');
		$this->db->from('vh_outsource_work o');
		$this->db->join('industries i', 'o.industry = i.id','left');
		$this->db->join('users u', 'o.posted_by = u.id','left');
           $params['industry'] = (isset($params['industry']) && is_array($params['industry']))? $params['industry']:array();
        if(is_array($params['industry']) && count($params['industry']) > 0){
            $this->db->where_in('o.industry', $params['industry']);
        }
		if(!empty($params['currency_type'])){
			$this->db->where('o.currency_type ', $params['currency_type']);
		}
		if(!empty($params['min_invest'])){			
			$this->db->where('o.min_invest >=', $params['min_invest']);
		}		
		if(!empty($params['max_invest'])){
			$this->db->where('o.max_invest <=', $params['max_invest']);
		}
		if(!empty($params['duration_min'])){
			$this->db->where('o.duration_min >=', $params['duration_min']);
		}
		if(!empty($params['duration_max'])){
			$this->db->where('o.duration_max <=', $params['duration_max']);
		}
		if(!empty($params['duration_type'])){
			$this->db->where('o.duration_type ', $params['duration_type']);
		}
		$query = $this->db->get();
		$qry = $query->result_array();
		foreach($qry as $key=>$val){
			if(!empty($params['session_user'])){
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
				$qry[$key]['paid']=$paid;
				$initiate = $this->db->get_where('vh_initiatesall', array('posted_by'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
				$qry[$key]['paid']=$paid;		
				$qry[$key]['initiate']=$initiate;		
			}else{
				$qry[$key]['paid']='';	
				$qry[$key]['initiate']='';	
			}
		
			
		}
		return $qry;

	}

	public function MyProjects($id){
			$this->db->order_by("o.id", "desc");	
			$this->db->select('o.*,in.industry as industry_name');
			$this->db->from('vh_outsource_work o');		
			$this->db->join('industries in', 'o.industry = in.id','left');
			$this->db->where('o.posted_by', $id);
			return $qry = $this->db->get()->result_array();			
	}
	//// single outsource project details ////
	public function SingleProject($id){
			$this->db->order_by("o.id", "desc");	
			$this->db->select('o.*,in.industry as industry_name');
			$this->db->from('vh_outsource_work o');		
			$this->db->join('industries in', 'o.industry = in.id','left');
			$this->db->where('o.id', $id);
			return $qry = $this->db->get()->row_array();
	}
	//// outsource projects by Industry ////
	function OutSourceByIndustry($industry,$params){

			$this->db->order_by("o.id", "desc");	
		$this->db->select('o.*,i.industry as industry_name,u.name,u.email,u.mobile');
		$this->db->from('vh_outsource_work o');
		$this->db->join('industries i', 'o.industry = i.id','left');
		$this->db->join('users u', 'o.posted_by = u.id','left');
		$this->db->where('o.industry', $industry);
  
		if(!empty($params['currency_type'])){
			$this->db->where('o.currency_type ', $params['currency_type']);
		}
		if(!empty($params['min_invest'])){			
			$this->db->where('o.min_invest >=', $params['min_invest']);
		}		
		if(!empty($params['max_invest'])){
			$this->db->where('o.max_invest <=', $params['max_invest']);
		}
		if(!empty($params['duration_min'])){
			$this->db->where('o.duration_min >=', $params['duration_min']);
		}
		if(!empty($params['duration_max'])){
			$this->db->where('o.duration_max <=', $params['duration_max']);
		}
		if(!empty($params['duration_type'])){
			$this->db->where('o.duration_type ', $params['duration_type']);
		}
		$query = $this->db->get();
		$qry = $query->result_array();
		foreach($qry as $key=>$val){
			if(!empty($params['session_user'])){
				$paid = $this->db->get_where('vh_paidcontacts', array('buyerId'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
				$qry[$key]['paid']=$paid;
				$initiate = $this->db->get_where('vh_initiatesall', array('posted_by'=>$params['session_user'],'post_id'=>$val['id'],'post_type'=>$val['post_type']))->row_array();	
				$qry[$key]['paid']=$paid;		
				$qry[$key]['initiate']=$initiate;		
			}else{
				$qry[$key]['paid']='';	
				$qry[$key]['initiate']='';	
			}
		}
		return $qry;

	}
	public function responsesOutSourceWork($id){

        $query = $this->db->get_where('vh_notification', array('post_id' => $id,'notification_type' => 'Out Source Project'));
        return $query->result_array();
    }
    public function NotificationAdd($data = array()) {
	    $insert = $this->db->insert('vh_notification', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function BuyContact($data = array()) {
	    $insert = $this->db->insert('vh_paidcontacts', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function InitiatesAll($data = array()) {
	   $insert = $this->db->insert('vh_initiatesall', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }	
	//// Contact Paid or Not ////
	function ContactPaid($id,$post_type){
	$userid = $this->session->userdata('user'); 	
	$query = $this->db->get_where('vh_paidcontacts', array('buyerId' => $userid,'post_id' => $id,'post_type' => $post_type));
	return $query->row_array();
	}


}