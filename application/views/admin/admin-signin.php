<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>. . : : Sign In : : . .</title>
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!-- Custom Fonts -->
		<link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Plugin CSS -->
		<link href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
		<!-- Theme CSS -->
		<link href="<?php echo base_url(); ?>assets/css/creative.min.css" rel="stylesheet">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		 <!-- Material Design Lite -->
		<script src="<?php echo base_url(); ?>assets/material/material.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/material/material.indigo-pink.min.css">
		<!-- Material Design Lite -->
		<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<script>
	$(document).ready(function() {
		$('#hidepassword').hide();
		  $('#showpassword').click(function() {
			$('#password').attr('type', 'text');
			$('#showpassword').hide();
			$('#hidepassword').show();
		  });
		  $('#hidepassword').click(function() {
			$('#password').attr('type', 'password');
			$('#showpassword').show();
			$('#hidepassword').hide();
		  });
	});
	</script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row intro">
				<div class="col-md-6 col-sm-12 intro-left hidden-xs">
					<h2>Use Viewham Power <br>to Empower your Income</h2>
					<hr>
					<a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/images/logo.svg" class="logo"/></a>
					<div class="mouse"><div class="scroll"></div></div>
				</div>
				<div class="col-md-6 col-sm-12 intro-right">
					<div class="col-md-8 col-sm-12 col-xs-12 sign-box">
						<h3>Sign In Here</h3>
						<?php $msgg = $this->session->flashdata('error'); 
						if($msgg){	?>
						<p class="sbg-line"><?php echo $msgg; ?></p><?php } ?>
						<?php $reg = $this->session->flashdata('msg'); 
						if($reg){	?>
						<p style="color: #6460e1;"><?php echo $reg; ?></p><?php } ?>
					 <form action="<?php echo base_url(); ?>admin/signin" method="post">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
	  <img src="<?php echo base_url(); ?>assets/images/login_profile.svg" />
        <input class="mdl-textfield__input" type="text" name="email" id="name"  data-validation="email">
        <label class="mdl-textfield__label" for="name">Enter User Email</label>
      </div>
       <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
        <input class="mdl-textfield__input" name="password" type="password" id="password" data-validation="length" data-validation-length="min2">
		<img src="<?php echo base_url(); ?>assets/images/login_password.svg" />
        <label class="mdl-textfield__label" for="sample4">Password</label>
		<span><a  id="showpassword">Show</a></span>
		<span><a  id="hidepassword">Hide</a></span>
        <!--<span class="mdl-textfield__error">Password is not a number!</span>-->
      </div>
						 
						<button type="submit" class="btn btn-primary">Sign In</button>
						<a class="forgotModal forgot-link pull-right" data-toggle="modal" data-target="#forgotModal">Forgot Password</a>
					</form></div>
					<div class="line-text col-md-8 col-sm-12 col-xs-12">
						<p class="bg-line"><span>Not Registered? <a href="<?php echo base_url(); ?>user/signup" class="forgot-link"> Sign Up Here</a></span></p>
					</div>
					
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<div id="send-otp-box">
						<div class="col-md-12 col-sm-12 col-xs-12 sign-box otp-box">
						<h3>Forgot Password</h3>
							<div class="input-box">
								<label>Mobile:</label><input id="f-phone" type="number" class="form-control" placeholder="Phone No" ><a class="link-getotp link">Get OTP</a>
							</div>
							<div class="input-box">
								<label>OTP:</label><input id="f-otp" type="text" class="form-control" placeholder="">

							</div>
							<div class="input-box text-center">
								<a class="link-getotp forgot-link">Resend OTP</a>
								<button class="otp-submit btn btn-primary">Done</button>
							</div>
						</div>
					<div class="line-text col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
						<p class="OTP-Sent" style="display:none;"><span>or</span></p>
					</div>
					<div class="line-text col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
						<p class="bg-line"><span>or</span></p>
					</div>
						<div class="col-md-12 col-sm-12 col-xs-12 sign-box otp-box">
							<div class="input-box">
								<label>Email:</label><input type="text" class="email-otp form-control" placeholder="xxxxxx@gxxx.com" ><a class="link-getotp link">Get OTP</a>
							</div>
							<div class="input-box">
								<label>OTP:</label><input type="text" class="f-otp  form-control " placeholder="">
							</div>
							<div class="input-box text-center">
								<!-- <a class="forgot-link">Resend OTP</a> -->
								<button class="otp-submit btn btn-primary">Done</button>
							</div>
						</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 sign-box-change-password sign-box otp-box" style="display:none">
						<h3>Change Password</h3>
							<div class="input-box">
								<label class="big">New Password:</label>
								<input id="chane-phone" type="hidden" class="form-control"  >
								<input id="chpassword" type="password" class="form-control"  >
							</div>
							<div class="input-box">
								<label class="big">Confirm Password:</label>
								<input id="chcpassword" type="password" class="form-control" >
							</div>
							<div class="input-box text-center">
								<!-- <a class="forgot-link">Resend OTP</a> -->
								<button class="update-submit btn btn-primary">Done</button>
							</div>
						</div>
						<div id="response-msg" style="display:none">
						<h2 class="alert-success">Successfully Password Updated</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>	
	
</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>

  $.validate({
    modules : 'location, date, security, file',
    onModulesLoaded : function() {
     // $('#country').suggestCountry();
    }
  });
</script>

<script>

$(document).ready(function () {
$(".forgotModal").click(function(){
	 $('#f-phone').prop('readonly', false);
	 $('.email-otp').prop('readonly', false);
	 $("#f-phone").val('');
		$("#f-otp").val('');
		$(".email-otp").val('');
		$(".f-otp").val('');
		$("#chpassword").val('');
		$("#chcpassword").val('');
		$("#send-otp-box").show();
		$('#response-msg').hide();
		$("#send-otp-box").show();
		$('.sign-box-change-password').hide();
});
$(".link-getotp").click(function(){
	
var phone = $('#f-phone').val();
var email = $('.email-otp').val();
if((!phone) && (!email)){
	alert('Enter Phone or Email');
	return false;
}
var url = "<?php echo base_url('user/sendotp'); ?>";
	
$.ajax({
    type: "POST",
    url: url,
    data: {
      "phone": phone,
      "email": email
    },
    success: function(JSONObject) {
		
		
		if(JSONObject==1){
     $('#f-phone').prop('readonly', true);
     $('.email-otp').prop('readonly', true);
     $('.OTP-Sent').show('slow');
     $('.OTP-Sent').html('Otp Sent');
	 setTimeout(function() {
        
		$('.OTP-Sent').hide('slow');
		$('.OTP-Sent').html('');
		
    }, 5000);
		}else if(JSONObject==2){
			$('.OTP-Sent').show('slow');
     $('.OTP-Sent').html('Oops Worng.. will get back to you.');
	 setTimeout(function() {
        
		$('.OTP-Sent').hide();
		$('.OTP-Sent').html('');
		
    }, 5000);
		}else{
		alert(JSONObject);	
		}
    }
  });
});
$(".otp-submit").click(function(){
var phone = $('#f-phone').val();
var otp = $('#f-otp').val();
if(!otp){
	var otp =$('.f-otp').val();
}
var email = $('.email-otp').val();
if(!phone){
	var wher = email;
}else{
	var wher = phone;
}
if((!otp)){
	alert('Enter Otp');
	return false;
}
var url = "<?php echo base_url('user/verifyotpforgot'); ?>";
	
$.ajax({
    type: "POST",
    url: url,
    data: {
      "phone": phone,
      "otp": otp,
      "email": email
    },
    success: function(msg) {
		console.log(msg);
		if(msg==1){
		$("#chane-phone").val(wher);
		$("#send-otp-box").hide('slow');
		$('.sign-box-change-password').show('slow');
		}else if(msg==3){
			 $('.OTP-Sent').show('slow');
     $('.OTP-Sent').html('Wrong OTP');
	 setTimeout(function() {
        
		$('.OTP-Sent').hide('slow');
		$('.OTP-Sent').html('');
		
    }, 5000);
		}
    }
  });
});
$(".update-submit").click(function(){
var phone = $('#chane-phone').val();
var password = $('#chpassword').val();
var cpassword = $('#chcpassword').val();
if(password != cpassword){
	alert('Password not matched');
	return false;
}
var url = "<?php echo base_url('user/updatepassword'); ?>";
$.ajax({
    type: "POST",
    url: url,
    data: {
      "password": password,
      "phone": phone
	      },
    success: function(msg) {
		console.log(msg);
		if(msg==1){
		$('.sign-box-change-password').hide('slow');
		$('#response-msg').show('slow');
		setTimeout(function() {
         $('.close').click();
		$("#f-phone").val('');
		$("#f-otp").val('');
		$("#chpassword").val('');
		$("#chcpassword").val('');
		$("#send-otp-box").show();
		$('#response-msg').hide();
		
    }, 5000);
		
		}
    }
  });
});
});
</script>
