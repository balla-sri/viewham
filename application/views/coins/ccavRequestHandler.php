<html>
<head>
<title> Iframe</title>
</head>
<body>
<center>

<?php 

	error_reporting(0);

	$working_key=$this->config->item('working_key');//Shared by CCAVENUES
	$access_code=$this->config->item('access_code');//Shared by CCAVENUES
	$merchant_data='';
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

	$production_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
?>
<iframe src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

<script type="text/javascript" src="<?php echo base_url('assets/js/'); ?>jquery-1.7.2.js"></script>
<script type="text/javascript">
    	$(document).ready(function(){
			
    		 window.addEventListener('message', function(e) {
		    	 $("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
		 	 }, false);
	 	 	
		});
</script>
</center>
</body>
</html>

