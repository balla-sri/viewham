<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Funding_model extends CI_Model{
    function __construct() {
         $this->load->database();
    }
    public function Insert_Funding($data = array()) {
	    $insert = $this->db->insert('vh_funding', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function UpdatePost($userData,$id){
		 if(!empty($userData) && !empty($id)){
            $update = $this->db->update('vh_funding', $userData, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
	}
	Public function MyProjects($id){
		$this->db->order_by("f.id", "desc");	
		$this->db->select('i.id as industry_id, i.industry, f.id as id, f.description, f.days, f.publish_start_date,f.status');
		$this->db->from('vh_funding f');
		$this->db->join('industries i', 'f.industry = i.id','left');
	    $this->db->where('f.posted_by', $id);
        $query = $this->db->get();
        return $query->result_array();
	
	}
	/*/ single Funding project details /*/
	Public function SingleFunding($id){
		$this->db->select('f.*,i.industry as industry_name');
		$this->db->from('vh_funding f');
		$this->db->join('industries i', 'f.industry = i.id','left');
	    $this->db->where('f.id', $id);
        $query = $this->db->get();
        return $query->row_array();
	}
	/*/  single Funding project details /*/
	Public function FundingByIndustry($id){
		$query = $this->db->get_where('vh_funding', array('industry' => $id));
		return $query->result_array();
	}
	function responsesFunding($id){
		$query = $this->db->get_where('vh_notification', array('post_id' => $id,'notification_type' => 'Request Funding'));
    return $query->result_array();
    }




}