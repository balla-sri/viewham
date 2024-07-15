$(document).ready(function () {
    var baseurl = $('#register_user').attr('action');
    $('#register_user input[type="text"]').each(function(){
        $(this).keypress(function (e) {
            var key = e.which;
            if(key == 13){ // the enter key code
                $('#submit_form').click();
                return false;  
            }
        });   
    });
    $("#submit_form").click(function(){
        if(validateForm() == true){
            var data = $("#register_user").serialize();
            var url = baseurl+'/user/register';
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function(data)
                {
                    if(data.issuccess == 1){
                       sendSMSOTP(data.user.id);
                    }else{
                       $('#error_message').modal('toggle');
                       $('#message_box').text(data.error_message);
                    }
                }
            }); 
        }
    });
    $(".phone-get-otp").click(function(){
        sendSMSOTP($("#userid").val(),true);
    });
    
    $(".phone-otp-submit").click(function(){
        if(validateMobileForm() == true){
            var otp = $("#otp-msg").val();
            var userid = $("#userid").val();
            var url = baseurl+'/user/verifyOtp';
            $.ajax({
                type: "POST",
                url: url,
                data: {"otp":otp,"id":userid},
                dataType: "json",
                success: function(data)
                {
                   if(data.issuccess == 1){
                       $('#SendotpMsgModal').modal('toggle');
                       $('#error_message').modal('toggle');
                       $('#message_box').html('');
                       $('#message_box').html(data.success_message);
                       $('.close').click(function(e){
                           window.location.href = "/businessideas"
                       });
                       setTimeout(function() {
                            //window.location.href = "/businessideas"
                        }, 4000);
                   }else{
                       $('#messege_block').html(data.failure_message);
                   }
                }
            }); 
        }
    });
});

function sendSMSOTP(userid,resend){
    var baseurl = $('#register_user').attr('action');
    var url = baseurl+'/user/sendsmsotp';
    if(resend === undefined){
        resend = false;
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {"userid":userid},
        dataType: "json",
        success: function(data)
        {
           if(data.issuccess==1){
               if(resend){
                    alert("OTP Resent");
               }else{
                    $('#SendotpMsgModal').modal('toggle');
                    $('#phone-otp').attr("placeholder",data.user.mobile);
                    $('#userid').val(userid);
                }
           }
        }
    }); 
}

function validateForm(){
    var name=$('#name').val();  
    var email=$('#email').val();    
    var password=$('#password').val(); 
	var passwordlenght=$('#password').val().length;		
	//alert(passwordlenght)
    var phone=$('#phone').val();
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;    
    
    var alert_string = "";
    
    if((!name) || (!password) || (!email) || (!phone))
    {
        
        if(!name){
            alert_string += 'Name field cannot be empty!\n';
            $("#name").css("border-color","rgb(185, 74, 72)");
        }
		
        if(!email){
            alert_string  += 'Email field cannot be empty!\n';
            $("#email").css("border-color","rgb(185, 74, 72)");
        }
        if(!phone){
            alert_string += 'Phone field cannot be empty!\n';
            $("#phone").css("border-color","rgb(185, 74, 72)");
        }
        if(!password){
            alert_string += 'Password field cannot be empty!\n';
            $("#password").css("border-color","rgb(185, 74, 72)");
        }
        
        if(alert_string.length > 0){
            alert_string = "Please fill the following fields\n\n"+alert_string;
            alert(alert_string);
            return false;
        }
    }
	
	/*if(/^[a-zA-Z0-9- ]*$/.test(name) == true) {
 alert_string += 'Name can have only alphabets\n';
$("#name").css("border-color","rgb(185, 74, 72)");
   return false;
}
*/


var alphanumers = /^[a-zA-Z0-9 ]+$/;
if(!alphanumers.test(name)){
    alert("Name can have only alphabets ");
	 return false;
}




		if(passwordlenght < 8)
	{
		 alert('Password should be greater that 8 characters');
        $("#password").css("border-color","rgb(185, 74, 72)");
        return false;
	}
    
    if(!isEmail(email)){
        alert('Enter valid email');
        $("#email").css("border-color","rgb(185, 74, 72)");
        return false;
    }
    if (!filter.test(phone)) {
        alert('Enter valid phone number');
        $("#phone").css("border-color","rgb(185, 74, 72)");
        return false;
    }
    return true;
}

function validateMobileForm(){
    return true;
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
