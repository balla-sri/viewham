<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Franchise_model extends CI_Model{
    function __construct() {
         $this->load->database();
    }
    public function Insert_franchise($data = array()) {
	    $insert = $this->db->insert('vh_franchise', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function UpdatePost($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_franchise', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	function MyProjects($id){
		$this->db->order_by("f.id", "desc");	
		$this->db->select('i.id as industry_id, i.industry, f.id as id, f.description, f.days, f.publish_start_date,f.status');
		$this->db->from('vh_franchise f');
		$this->db->join('industries i', 'f.industry = i.id','left');
		$this->db->where('f.posted_by', $id);
		$query = $this->db->get();
			return $query->result_array();
	
	}
	
	function FranchiseOffersModel(){
		$this->db->order_by("franchize", "asc");	
		$this->db->select('DISTINCT(franchize) as franchize ' );
		$this->db->from('vh_franchise');		
		$query = $this->db->get();
		return $query->result_array();
	
	}
	
	function FranchiseOffers($params=array()){
		$this->db->order_by("f.id", "desc");	
		$this->db->select('f.*,i.industry as industry_name,u.name,u.email,u.mobile');
		$this->db->from('vh_franchise f');
		$this->db->join('industries i', 'f.industry = i.id','left');
		$this->db->join('users u', 'f.posted_by = u.id','left');
           $params['industry'] = (isset($params['industry']) && is_array($params['industry']))? $params['industry']:array();
        if(is_array($params['industry']) && count($params['industry']) > 0){
            $this->db->where_in('f.industry', $params['industry']);
        }
		if(!empty($params['location'])){
			$this->db->like('f.location', $params['location']);
		}
		if(!empty($params['model'])){
			$this->db->like('f.franchize', $params['model']);
		}
		if(!empty($params['currency_type'])){
			$this->db->where('f.currency_type ', $params['currency_type']);
		}
		if(!empty($params['min_invest'])){			
			$this->db->where('f.min_invest >=', $params['min_invest']);
		}		
		if(!empty($params['max_invest'])){
			$this->db->where('f.max_invest <=', $params['max_invest']);
		}
		if(!empty($params['income_min'])){
			$this->db->where('f.income_min >=', $params['income_min']);
		}
		if(!empty($params['income_max'])){
			$this->db->where('f.income_max <=', $params['income_max']);
		}
		if(!empty($params['income_type'])){
			$this->db->where('f.income_type ', $params['income_type']);
		}
		if(!empty($params['break_even_type'])){
			$this->db->where('f.break_even_type ', $params['break_even_type']);
		}
		if(!empty($params['min_break_even'])){
			$this->db->where('f.min_break_even >=', $params['min_break_even']);
		}
		if(!empty($params['max_break_even'])){
			$this->db->where('f.max_break_even <=', $params['max_break_even']);
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
	/*/ single outsource project details /*/
	Public function SingleFranchise($id){
		$this->db->select('f.*,i.industry as industry_name,u.name,u.email,u.mobile');
		$this->db->from('vh_franchise f');
		$this->db->join('industries i', 'f.industry = i.id','left');
		$this->db->join('users u', 'f.posted_by = u.id','left');
		$this->db->where('f.id', $id);
		$query = $this->db->get();
		return $query->row_array();

	}
	/*/ single outsource project details /*/
	Public function FranchiseByIndustry($industry,$params){
		$this->db->order_by("o.id", "desc");	
		$this->db->select('o.*,i.industry as industry_name,u.name,u.email,u.mobile');
		$this->db->from('vh_franchise o');
		$this->db->join('industries i', 'o.industry = i.id','left');
		$this->db->join('users u', 'o.posted_by = u.id','left');
		$this->db->where('o.industry', $industry);
  		
  		if(!empty($params['location'])){
			$this->db->like('o.location ', $params['location']);
		}
		if(!empty($params['investment_currency'])){
			$this->db->where('o.currency_type ', $params['investment_currency']);
		}
		if(!empty($params['min_invest'])){			
			$this->db->where('o.min_invest >=', $params['min_invest']);
		}		
		if(!empty($params['max_invest'])){
			$this->db->where('o.max_invest <=', $params['max_invest']);
		}
		if(!empty($params['income_min'])){
			$this->db->where('o.income_min >=', $params['income_min']);
		}
		if(!empty($params['income_max'])){
			$this->db->where('o.income_max <=', $params['income_max']);
		}
		if(!empty($params['income_type'])){
			$this->db->where('o.income_type ', $params['income_type']);
		}
		if(!empty($params['min_break_even'])){
			$this->db->where('o.min_break_even >=', $params['min_break_even']);
		}
		if(!empty($params['max_break_even'])){
			$this->db->where('o.max_break_even <=', $params['max_break_even']);
		}
		if(!empty($params['break_even_type'])){
			$this->db->where('o.break_even_type ', $params['break_even_type']);
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
	Public function responsesFranchise($id){
		$query = $this->db->get_where('vh_notification', array('post_id' => $id,'notification_type' => 'Franchise a Offer'));
		return $query->result_array();
	}




}