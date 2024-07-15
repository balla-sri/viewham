<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coins_model extends CI_Model{
    public function __construct() {
        $this->load->database();
    }
  function getRowsCoins($params = array()){
        $this->db->select('*');
        $this->db->from('vh_coins');
        if(array_key_exists("where",$params)){
            foreach ($params['where'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        if(array_key_exists("order_by",$params)){
            $this->db->order_by($params['order_by']);
        }
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
	return $result;
    }
    public function creditCoinsList($params){   
		$this->db->from('vh_coins');
		$this->db->order_by("id", "desc");
		$this->db->where("credit >", 0);
		if($params['start']!=''){
			$this->db->limit($params['limit'], $start);
		}else{
			$this->db->limit(10);
		}
		$query  = $this->db->get();
        return $query->result_array();
	 }
	public function creditCoins($userid){   
		$this->db->order_by("id", "desc");
        $query = $this->db->get_where('vh_coins', array('userid' => $userid,'credit >' => 0));
        return $query->result_array();
	 }
    public function debitCoins($userid){   
		$this->db->order_by("id", "desc");
        $query = $this->db->get_where('vh_coins', array('userid' => $userid,'debit >' => 0));
        return $query->result_array();
	 }
    public function insertCoins($data = array()) {
     $insert = $this->db->insert('vh_coins', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	public function insertTransaction($data){
		$insert = $this->db->insert('payments',$data);
		return $insert?true:false;
	}

    public function getCoinsEarned($userid,$ideaid,$source=''){
        $query = $this->db->get_where('vh_coins', array('userid' => $userid,'post_id'=>$ideaid, 'source' => $source));
        return $query->result_array();  
    }	
}