<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*To remove html tags and spaces
*/
function sanitize_input($data){
	return htmlentities(addslashes(strip_tags(trim($data))));
}



function sendEmailotp($email,$otpn){
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8'); 
		$this->email->set_header('Content-type', 'text/html'); 

		$this->email->from('ajayviewham@gmail.com', 'Viewham');
		$this->email->to($email);
		$this->email->reply_to($email);
		$this->email->subject('Viewham');
		$lnki = 'https://viewham.com/User/Verifyemail/'.$otpn;
                $this->email->message('Welcome To Viewham. <br><br>  veification link <a href="https://viewham.com/User/Verifyemail/'.$otpn.'">Verify Here</a> ');
               if($this->email->send()) {
				   return 'sent';
			   }else{
				  return 'not sent'; 
			   }	
	}
function sendsmsotp($phone,$otpn){

		$textmessage = urlencode($otpn);
		$service_url ='https://sms.office24by7.com/API/sms.php?username=9492973688&password=NiN0cPZl&from=VIEWHA&to='.$phone.'&msg='.$textmessage.'&type=1';
		$ch = curl_init($service_url);
		$timeout  =  30;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
		$content  = curl_exec($ch);
		curl_close($ch);
		return $service_url;	
	}
// Start function
function shorter($text, $chars_limit)
{
    // Check if length is larger than the character limit
    if (strlen($text) > $chars_limit)
    {
        // If so, cut the string at the character limit
        $new_text = substr($text, 0, $chars_limit);
        // Trim off white space
        $new_text = trim($new_text);
        // Add at end of text ...
        return $new_text . "...";
    }
    // If not just return the text as is
    else
    {
    return $text;
    }
}
function is_email($login)
{

//If the username input string is an e-mail, return true
if(filter_var($login, FILTER_VALIDATE_EMAIL)) {
return true;
} else {
return false;
}
// echo $login; exit;
}
function checksessionexist()
{
$CI =& get_instance();
$ses = $CI->session->userdata();
print_r($ses);
}

function uploadImage($tempFile, $filepath, $modifyFileName) {
        if(''==$tempFile || ''==$filepath || ''==$modifyFileName){
            return 0;  
        }          
        $filepath .= $modifyFileName;           
        if (move_uploaded_file($tempFile, $filepath)) {
            return 1;
        }else{
            return 0;
        }
      }
	  
function SpendCoins($debit,$userid,$text){

	$CI =& get_instance();
//$userid = $CI->session->userdata('user');
	$coins['debit'] = $debit;
	$coins['userid'] = $userid;
	$coins['source'] = $text;
	$coins['create_date'] = date("Y-m-d H:i:s");
	$notification['notification_type'] = 'coins';
	$notification['to_id'] = $userid;
	$notification['text'] = 'debit';
	$notification['created_on'] = date("Y-m-d H:i:s");
	$coinadd  = insertrecord('vh_coins',$coins);
	if($coinadd){
	// Create Notification
	$notification = insertrecord('vh_notification',$notification);
	}
return $notification;	
}	  

function insertrecord($table,$data){
	$CI =& get_instance();
	$CI->db->insert($table,$data);
	return $CI->db->insert_id();
}
function SkillProfiles(){
	$CI =& get_instance();
	$id = $CI->session->userdata('user');
	$where='(p.post_type="3" or p.post_type = "4" or p.post_type = "5")';
	$CI->db->from('vh_posts as p');
	$query = $CI->db->where('p.posted_by',$id);
	$query = $CI->db->where($where);			
	$query = $CI->db->join('skills as m', 'm.id = p.skill', 'LEFT');
	$query = $CI->db->get()->result_array();
	return $query;
}
function NotificationsCount(){
	$result = array();
	$CI =& get_instance();
	$id = $CI->session->userdata('user');
	$CI->db->from('vh_notification as n');
	$query = $CI->db->where('n.from_id',$id);
	$query = $CI->db->where('n.to_id',$id);
	$query = $CI->db->where('n.status',1);
	$query = $CI->db->join('users as u', 'u.id = n.from_id', 'LEFT');
	$query = $CI->db->get()->result_array();

	$CI->db->from('vh_notification as n');
	$queryTo = $CI->db->where('n.from_id !=',$id);
	$queryTo = $CI->db->where('n.to_id',$id);
	$queryTo = $CI->db->where('n.status',1);
	$queryTo = $CI->db->join('users as u', 'u.id = n.from_id', 'LEFT');
	$queryTo = $CI->db->get()->result_array();
	
	$result['fromYou']	=count($query);
	$result['toYou']	=count($queryTo);
	$result['viewham']	=array();
	$result['totalCount']	=count($query)+count($queryTo);
	return $result;
}
function LoginUserDetails(){
$CI =& get_instance();
$session_user = $CI->session->userdata('user');
$query = $CI->db->get_where('vh_usr', array('ID' => $session_user))->row_array();
return $query;
}
function TotalCoins(){
$CI =& get_instance();
$session_user = $CI->session->userdata('user');
 	$CI =& get_instance();
	$query = $CI->db->get_where('vh_coins', array('userid' => $session_user))->result_array();
    $credit=0;
	$debit=0;
	foreach($query as $c){
		$credit+=$c['credit'];
		$debit+=$c['debit'];
	}
	$data['totalCoins']=$credit-$debit;
	$data['totalCredit']=$credit;
	$data['totalDebit']=$debit;
	return $data;
}
function deleterecord($table,$wherecondition){
       $CI =& get_instance();
       $CI->db->where($wherecondition);
       $CI->db->delete($table);
}
function NotificationSendEnterprenurs($data = array(),$industry) {
	 $CI =& get_instance();
	$query = $CI->db->get_where('vh_posts', array('industry' => $industry,'post_type' => '1'))->result_array();
	foreach($query as $key=>$val){	
	$data['to_id']=$val['posted_by'];
	$insert = $CI->db->insert('vh_notification', $data);
	$data[$key]=$insert;
	}
	return $data;
}
function NotificationSendToInvestors($data = array(),$industry) {
	 $CI =& get_instance();
	$query = $CI->db->get_where('vh_posts', array('industry' => $industry,'post_type' => '2'))->result_array();
	foreach($query as $key=>$val){	
	$data['to_id']=$val['posted_by'];
	$insert = $CI->db->insert('vh_notification', $data);
	$data[$key]=$insert;
	}
	return $data;
}	
function FranchiseformValidate(){
	$error =array();
 	if(empty($_POST['industry'])){
		$error['industry']="Please Select Industry";
	}
 	if(empty($_POST['description'])){
		$error['description']="Please Enter description";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}
 	if(empty($_POST['franchize'])){
		$error['franchize']="Select franchise";
	}
	if(empty($_POST['currency_type'])){
		$error['currency_type']="Please enter currency";
	}
 	if(empty($_POST['min_invest'])){
		$error['min_invest']="Please enter invest min";
	}
 	if(empty($_POST['max_invest'])){
		$error['max_invest']="Please enter invest max";
	}
 	if(empty($_POST['income_type'])){
		$error['income_type']="Please Select income type";
	}
 	if(empty($_POST['income_min'])){
		$error['income_min']="Please enter min income";
	}
 	if(empty($_POST['income_max'])){
		$error['income_max']="Please enter max income";
	}
 	if(empty($_POST['break_even_type'])){
		$error['break_even_type']="Please Select income type";
	}
 	if(empty($_POST['min_break_even'])){
		$error['min_break_even']="Please enter min value";
	}
 	if(empty($_POST['max_break_even'])){
		$error['max_break_even']="Please enter max value";
	}
	if(!empty($_POST['max_invest']) && !empty($_POST['min_invest'])){
		if($_POST['min_invest'] >= $_POST['max_invest'] ){
		$error['invest']="Max invest should be greater than MIn invest";	
		}
	}
	if(!empty($_POST['income_max']) && !empty($_POST['income_min'])){
		if($_POST['income_min'] >= $_POST['income_max'] ){
		$error['income']="Max income should be greater than Min income";	
		}
	}
	if(!empty($_POST['max_break_even']) && !empty($_POST['min_break_even'])){
		if($_POST['min_break_even'] >= $_POST['max_break_even'] ){
		$error['break_even']="Max breakeven time should be greater than Min breakeven time";	
		}
	}
	return $error;
	}
function FundingFormValidate(){
	if(!empty($_POST)){
		
	$error  =array();
 	if(empty($_POST['description'])){
		$error['description']="Please Enter description";
	}
 	if(empty($_POST['current_status'])){
		$error['current_status']="Please Select current status";
	}
 	if(empty($_POST['industry'])){
		$error['industry']="Please Select Industry";
	}
 	if(empty($_POST['currency'])){
		$error['currency']="Please Select Currency Type";
	}
 	if(empty($_POST['expected_role'])){
		$error['expected_role']="Please Select Expected Role";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}
 	if(empty($_POST['min_amount'])){
		$error['min_amount']="Please enter min amount";
	}
 	if(empty($_POST['max_amount'])){
		$error['max_amount']="Please enter max amount";
	}
	if(!empty($_POST['max_amount']) && !empty($_POST['min_amount'])){
		if($_POST['min_amount'] >= $_POST['max_amount'] ){
		$error['amount']="Max invest should be greater than Min invest";	
		}
	}
 	if(empty($_POST['share_min'])){
		$error['share_min']="Please enter min share";
	}
 	if(empty($_POST['share_max'])){
		$error['share_max']="Please enter max share";
	}
	if(!empty($_POST['share_max']) && !empty($_POST['share_min'])){
		if($_POST['share_min'] > $_POST['share_max'] ){
		$error['share']="Max share should be greater than Min share";	
		}
	}	
	}
	return $error;
	}
	function OutSourceFormValidate(){

	if(!empty($_POST)){
	$error  =array();
 	if(empty($_POST['industry'])){
		$error['industry']="Please Select Industry";
	}
 	if(empty($_POST['description'])){
		$error['description']="Please Enter description";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}
 	if(empty($_POST['currency_type'])){
		$error['currency_type']="Please enter currency";
	}
 	if(empty($_POST['min_invest'])){
		$error['min_invest']="Please enter invest min";
	}
 	if(empty($_POST['max_invest'])){
		$error['max_invest']="Please enter invest max";
	}
 	if(empty($_POST['duration_type'])){
		$error['duration_type']="Please Select duration type";
	}
 	if(empty($_POST['duration_min'])){
		$error['duration_min']="Please enter min duration";
	}
 	if(empty($_POST['duration_max'])){
		$error['duration_max']="Please enter max duration";
	}
	if(!empty($_POST['max_invest']) && !empty($_POST['min_invest'])){
		if($_POST['min_invest'] >= $_POST['max_invest'] ){
		$error['quote']="Max quote should be greater than Min quote";	
		}
	}
	if(!empty($_POST['duration_max']) && !empty($_POST['duration_min'])){
		if($_POST['duration_min'] >= $_POST['duration_max'] ){
		$error['duration']="Max duration should be greater than Min duration";	
		}
	}
	}
	return $error;
	}
 function OfferformValidate(){
	if(!empty($_POST)){
	$error  =array();
 	if(empty($_POST['skill'])){
		$error['skill']="Please Select Skill";
	}
 	if(empty($_POST['description'])){
		$error['description']="Please Enter description";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}	
 	if(empty($_POST['work_type'])){
		$error['work_type']="Please Select Work Type";
	}
 	if(empty($_POST['currency'])){
		$error['currency']="Please enter currency";
	}
 	if(empty($_POST['min_salary'])){
		$error['min_salary']="Please enter min salary";
	}
 	if(empty($_POST['max_salary'])){
		$error['max_salary']="Please enter max salary";
	}
 	if(empty($_POST['income_type'])){
		$error['income_type']="Please Select income type";
	}

	if(!empty($_POST['max_salary']) && !empty($_POST['min_salary'])){
		if($_POST['min_salary'] >= $_POST['max_salary'] ){
		$error['salary']="Max salary should be greater than Min salary";	
		}
	}

	}
	return $error;
	}
 function OwnBusinessValidate(){
	if(!empty($_POST)){
	$error  =array();
 	if(empty($_POST['industry'])){
		$error['industry']="Please Select industry";
	}
 	if(empty($_POST['description'])){
		$error['description']="Please Enter description";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}	
 	if(empty($_POST['currency'])){
		$error['currency']="Please enter currency";
	}
	if(!empty($_POST['skill'])){
			$resource=array_filter($_POST['resource']);
		if(empty($resource)){
			$error['resource']="Please select resource.";
		}
	}
	if(empty($_POST['skill']) && empty($_POST['investor']) && empty($_POST['consultant']) && empty($_POST['mentor'])    ){
		$error['resourceall']="Please select resource.";
	}
	if(!empty($_POST['investor'])){
		if(empty($_POST['min_invest'])){
			$error['min_invest']="Enter min invest.";
		}	
		if(empty($_POST['max_invest'])){
			$error['max_invest']="Enter max invest.";
		}	
		if(empty($_POST['min_share'])){
			$error['min_share']="Enter min share.";
		}	
		if(empty($_POST['max_share'])){
			$error['max_share']="Enter max share.";
		}
		if(empty($_POST['investor_role'])){
			$error['investor_role']="Please select investor role.";
		}	
		if(!empty($_POST['max_invest']) && !empty($_POST['min_invest'])){
			if($_POST['min_invest'] >= $_POST['max_invest'] ){
			$error['invest']="Max investment should be greater than Min investment";	
			}
		}
		if(!empty($_POST['max_share']) && !empty($_POST['min_share'])){
			if($_POST['min_share'] >= $_POST['max_share'] ){
			$error['share']="Max share should be greater than Min share.";	
			}
		}	
	
	
	}



	}
	return $error;
	}

	function getTagInfo($industry) {
	 	$CI =& get_instance();
		$query = $CI->db->get_where('skills', array('id' => $industry))->result_array();

		if(is_array($query) && count($query) > 0){
			return $query[0]['skill'];
		}else{
			return false;
		}
	}	

?>
