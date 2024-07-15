<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function EntrepreneurFormValidate(){
	$error =array();
	if(!empty($_POST)){
		
 	if(empty($_POST['industry'])){
		$error['industry']="Please Select Industry";
	}
 	// if(empty($_POST['experience'])){
		// $error['experience']="Please Enter experience";
	// }
 	if(empty($_POST['nature'])){
		$error['nature']="Please Enter nature";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}	
 	if(empty($_POST['roles']['0'])){
		$error['roles']="Please select role";
	}	
 	if(empty($_POST['currency'])){
		$error['currency']="Please enter currency";
	}
 	if(empty($_POST['min_budget'])){
		$error['min_budget']="Please enter min budget";
	}
 	if(empty($_POST['max_budget'])){
		$error['max_budget']="Please enter max budget";
	}
	if(!empty($_POST['max_budget']) && !empty($_POST['min_budget'])){
		if($_POST['min_budget'] >= $_POST['max_budget'] ){
		$error['budget']="Max budget should be greater than Min budget";	
		}
	}	
	}
	return $error;
	}
	function InvestorFormValidate(){
	$error =array();
	if(!empty($_POST)){

 	if(empty($_POST['industry'])){
		$error['industry']="Please Select Industry";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}	
 	if(empty($_POST['roles']['0'])){
		$error['roles']="Please select role";
	}
 	if(empty($_POST['investment_currency'])){
		$error['investment_currency']="Please Select investment currency";
	}
 	if(empty($_POST['min_invest'])){
		$error['min_invest']="Please enter min Invest";
	}
 	if(empty($_POST['max_invest'])){
		$error['max_invest']="Please enter max Invest";
	}
	if(!empty($_POST['max_invest']) && !empty($_POST['min_invest'])){
		if($_POST['min_invest'] >= $_POST['max_invest'] ){
		$error['invest']="Max invest should be greater than Min invest";	
		}
	}
 	if(empty($_POST['share_currency'])){
		$error['share_currency']="Please Select Share currency";
	}
 	if(empty($_POST['min_share'])){
		$error['min_share']="Please enter min Share";
	}
 	if(empty($_POST['max_share'])){
		$error['max_share']="Please enter max Share";
	}
	if(!empty($_POST['max_share']) && !empty($_POST['min_share'])){
		if($_POST['min_share'] >= $_POST['max_share'] ){
		$error['share']="Max share should be greater than Min share";	
		}
	}	
	}
	return $error;
	}
	
	function ProfileFormValidate(){
	$error =array();

	if(!empty($_POST)){
 	if(empty($_POST['skill'])){
		$error['skill']="Please Select Primary Skill";
	}
 	if(empty($_POST['currency'])){
		$error['currency']="Select Currency Type";
	}
 	if(empty($_POST['price'])){
		$error['price']="Please Enter Price";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}	
 	if(empty($_POST['roles']['0'])){
		$error['roles']="Please select related skills";
	}
 	if($_POST['l_term_work_option']==2){
		
		if(empty($_POST['min_as_employee'])){
			$error['min_as_employee']="Enter Min Value";
		}
		if(empty($_POST['max_as_employee'])){
			$error['max_as_employee']="Enter Max Value";
		}
		if(empty($_POST['min_as_partner'])){
			$error['min_as_partner']="Enter Min Value";
		}
		if(empty($_POST['max_as_partner'])){
			$error['max_as_partner']="Enter Max Value";
		}
		if(!empty($_POST['min_as_employee'] && !empty($_POST['max_as_employee']))){
			if($_POST['min_as_employee'] >= $_POST['max_as_employee'] ){
				$error['employee']="Max Emp should greater than Min Emp";	
			}
		}
		if(!empty($_POST['min_as_partner'] && !empty($_POST['max_as_partner']))){
			if($_POST['min_as_partner'] >= $_POST['max_as_partner'] ){
				$error['share']="Max value should greater than Min value";	
			}
		}
	}
	
		
	}
	return $error;
	}
	function HobbyProfileFormValidate(){
	$error =array();
	if(!empty($_POST)){
		
 	if(empty($_POST['skill'])){
		$error['skill']="Please Select Hobby Skill";
	}
 	if(empty($_POST['currency'])){
		$error['currency']="Select Currency";
	}
 	if(empty($_POST['price'])){
		$error['price']="Enter Price";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location";
	}	
 	if(empty($_POST['roles']['0'])){
		$error['roles']="Please select related skills";
	}
 	if($_POST['l_term_work_option']==2){
		if(empty($_POST['min_as_employee'])){
			$error['min_as_employee']="Please Enter Min Value";
		}
		if(empty($_POST['max_as_employee'])){
			$error['max_as_employee']="Please Enter Max Value";
		}
		if(empty($_POST['min_as_partner'])){
			$error['min_as_partner']="Please Enter Min Value";
		}
		if(empty($_POST['max_as_partner'])){
			$error['max_as_partner']="Please Enter Max Value";
		}
		if(!empty($_POST['min_as_employee'] && !empty($_POST['max_as_employee']))){
			if($_POST['min_as_employee'] >= $_POST['max_as_employee'] ){
				$error['employee']="Max value should be greater than min value";	
			}
		}
		if(!empty($_POST['min_as_partner'] && !empty($_POST['max_as_partner']))){
			if($_POST['min_as_partner'] >= $_POST['max_as_partner'] ){
				$error['share']="Max value should be greater than min value";	
			}
		}
	}	
	}
	return $error;
	}
	function MeditorProfileFormValidate(){
	$error =array();
	if(!empty($_POST)){

 	if(empty($_POST['skill'])){
		$error['skill']="Please Select Primary Skill.";
	}
 	if(empty($_POST['currency'])){
		$error['currency']="Please Select Currency Type.";
	}
 	if(empty($_POST['price'])){
		$error['price']="Please Enter Price.";
	}
 	if(empty($_POST['mobile'])){
		$error['mobile']="Please Enter Candidate Mobile No.";
	}
 	if(empty($_POST['candidate'])){
		$error['candidate']="Please Enter candidate Name.";
	}
	$location=array_filter($_POST['location']);
	if(empty($location)){
		$error['location']="Please enter location.";
	}	
 	if(empty($_POST['roles']['0'])){
		$error['roles']="Please select role";
	}
	if($_POST['l_term_work_option']==2){
		if(empty($_POST['min_as_employee'])){
			$error['min_as_employee']="Please Enter Min Value";
		}
		if(empty($_POST['max_as_employee'])){
			$error['max_as_employee']="Please Enter Max Value";
		}
		if(empty($_POST['min_as_partner'])){
			$error['min_as_partner']="Please Enter Min Value";
		}
		if(empty($_POST['max_as_partner'])){
			$error['max_as_partner']="Please Enter Max Value";
		}
		if(!empty($_POST['max_as_employee']) && !empty($_POST['min_as_employee'])){
			if($_POST['min_as_employee'] >= $_POST['max_as_employee'] ){
			$error['employee']="Max value should be greater than min value";	
			}
		}
		if(!empty($_POST['max_as_partner']) && !empty($_POST['min_as_partner'])){
			if($_POST['min_as_partner'] > $_POST['max_as_partner'] ){
			$error['share']="Max value should be greater than min value";	
			}
		}	
	}
	}
	
	return $error;
	}
	?>