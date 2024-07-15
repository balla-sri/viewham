$(document).ready(function () {
	var baseurl = $('#signin_form').attr('action');
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
                  
    $("#signin").click(function(){
        var username = $('#name').val();
        var password = $('#password').val();
        if(validatesigninform()==true){
            var url = baseurl+'/user/login';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {'username':username,'password':password},
                 dataType: "json",
                 success: function(data)
                 {
                     if(data.issuccess == 1){
                        window.location.href = baseurl+'dashboard';

                     }else{
                        $('#error_message').modal('toggle');
                        $('#message_box').text(data.error_message);
                     }
                 }
             }); 
        }
       
    });
    //Send OTP for Mobile
    $(document).on("click", ".link-getotp-mobile", function(event){
        var phone = $('#f-phone').val();
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if(!phone || !filter.test(phone)){
            alert('Enter a valid Mobile no');
            return false;
        }
        var url = "/user/forgotpassword";
        $.ajax({
            type: "POST",
            url: url,
            data: {"phone":phone,"type":"phone"},
            dataType: "json",
            success: function(data)
            {
               if(JSON.parse(data.issuccess)==1){
                   $('#f-phone').prop('readonly', true);
                   $('.OTP-Sent').show();
                   $('.OTP-Sent').html('<span class="alert-success">OTP sent</span>');
               }else{
                   alert(data.message);
               }
            }
        });
    });
    //Send OTP for Email
    $(document).on("click", ".link-getotp-email", function(event){
        var email = $('.email-otp').val();
        if(!email || !isEmail(email)){
            alert('Enter a valid Email');
            return false;
        }
        var url = "/user/forgotpassword";
        $.ajax({
            type: "POST",
            url: url,
            data: {"email":email,"type":"email"},
            dataType: "json",
            success: function(data)
            {
               if(JSON.parse(data.issuccess)==1){
                   $('.email-otp').prop('readonly', true);
               }else{
                   alert(data.message);
               }
            }
        });
    });
    //verify  phone OTP
    $(document).on("click", ".otp-submit-mobile", function(event){
        var otp = $('#f-otp').val();
        if(!otp){
            alert('Enter the OTP');
            return false;
        }
        var url = "/user/verifyforgotpasswordotp";
        var phone = $('#f-phone').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {"source":phone,"otp":otp,"type":"phone"},
            dataType: "json",
            success: function(data)
            {
                if(JSON.parse(data.issuccess)==1){ 
                    $('.sign-box-change-password').removeClass('hide');
                    $('.sign-box-change-password').addClass('show');
                    $('.close').addClass('show');
                    $('#type').val('phone');
                    $('#source').val(phone);
                    $('#send-otp-box').addClass('hide');
                }else{
                    alert(data.message);
                }
            }
        });
        
    });
    //verify  Email OTP
    $(document).on("click", ".otp-submit-email", function(event){
        var otp = $('.email-otp-val').val();
        if(!otp){
            alert('Enter the OTP');
            return false;
        }
        var url = "/user/verifyforgotpasswordotp";
        var email = $('.email-otp').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {"source":email,"otp":otp,"type":"email"},
            dataType: "json",
            success: function(data)
            {

				if(JSON.parse(data.issuccess)==1){
                    $('.sign-box-change-password').removeClass('hide');
                    $('.sign-box-change-password').addClass('show');
                    $('#type').val('email');
                    $('#source').val(email);
                    $('#send-otp-box').addClass('hide');
                }else{
                    alert(data.message);
                }
            }
        });
        
    });
    //Update password after successful OTP verification
    $(document).on("click", ".update-submit", function(event){
        var password = $('#chpassword').val();
        var cpassword = $('#chcpassword').val();
        if(password != cpassword){
            alert('Password not matched');
            return false;
        }
        
        var url = "/user/updatepassword";
        var type = $('#type').val();
        var source = $('#source').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {"source":source,"type":type,"password":password},
            dataType: "json",
            success: function(data)
            {
                 if(JSON.parse(data.issuccess)==1){
                    $('.sign-box-change-password').removeClass('show');
                    $('.sign-box-change-password').addClass('hide');
                    $('#send-otp-box').addClass('show');
                    $('#forgotModal').modal('toggle');
                    $('#error_message').modal('toggle');
                    $('#message_box').text('Password updated. Wait a moment! You will be logged in');
                    setTimeout(function() {
                        window.location.href = "/businessideas"
                    }, 2000);
                }
            }
        });
    });
    
    
});

function validatesigninform(){
	//alert("Here 123")
	var email=  $('input[name="email"]').val();	
    var password=  $('input[name="password"]').val();
    
    var error_text = "";
    
    if(!email){
        error_text += "Please enter your email id ";
    }
    
    if(!password){
        if(error_text.length > 0 ){
            error_text += " and password";
        }else{
            error_text += " Please enter your password";
        }
    }
    
    if(error_text.length > 0  ){
        $('#error_message').modal('toggle'); 	
        $('#message_box').text(error_text);
	 return false;
    }
	
    return true;
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
$('#name,#password').keypress(function (e) {
  if (e.which == 13) {
		$("#signin").click();
  }
});

