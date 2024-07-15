$(document).ready(function() {
		$('#hidepassword').hide();
		  $('#showpassword').click(function() {
			$('#upassword').attr('type', 'text');
			$('#showpassword').hide();
			$('#hidepassword').show();
		  });
		  $('#hidepassword').click(function() {
			$('#upassword').attr('type', 'password');
			$('#showpassword').show();
			$('#hidepassword').hide();
		  });
	});
	
$("#sasignupModal").click(function(){
    $('#signinModal').modal('hide');	
});
$("#rsignupc").click(function(){
    $('#signupModal').modal('hide');	
});
$("#rregister").click(function(){
	var uname = $('#rname').val();
	var rpwd = $('#rpassword').val();
	var rmobile = $('#rmobile').val();
	var remail = $('#remail').val();
	if (rpwd == '' && rmobile == '' && remail == ''){
    alert('Enter valid details');
	return false;
	}
	var url = "<?php echo base_url('user/ajaxsignup'); ?>";
$.ajax({
    type: "POST",
    url: url,
    data: {
      "uname": uname, "rpwd": rpwd
    },
    success: function(JSONObject) {
		 if (isNaN(JSONObject))	{
			 var ajsinup = "";
			ajsinup += "<div class='error' style='color: #106ada;'>  Congratulations!! Registered Successfully please login and continue" ;
			ajsinup += "</div>";
			$("#ajsinup").html(ajsinup);
					 
			 
			 }else{
			var ajsinup = "";
			ajsinup += "<div class='error' style='color: red'>  Congratulations!! Registered Successfully please login and continue" ;
			ajsinup += "</div>";
			$("#ajsinup").html(ajsinup);
			$("#scform")[0].reset();		 
			 }
   }
  });
});
$("#signinajax").click(function(){
	var uid = $('#username').val();
	var pwd = $('#upassword').val();
	var url = "<?php echo base_url('user/ajaxsignin'); ?>";
	
$.ajax({
    type: "POST",
    url: url,
    data: {
      "uid": uid, "pwd": pwd
    },
    success: function(JSONObject) {
		
		 if (isNaN(JSONObject)) 
		{
		var peopleHTML = "";
			peopleHTML += "<div class='error'>" + JSONObject ;
			peopleHTML += "</div>";
			$("#peopleerror").html(peopleHTML);
		}else{
		var submitbtn = "";
			submitbtn += "<input type='hidden' name='uid' value='"+ JSONObject +"'>" ;
			submitbtn += "";
			$("#peoplsubmit").html(submitbtn);	
		$('#signinModal').modal('hide');
		$('#ssigninModal').hide();
		$('.form-sub').show();

		}
     
    }
  });
});

