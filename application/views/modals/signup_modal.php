<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="col-md-12 col-sm-12 col-xs-12 sign-box signup">
                    <h3>Sign Up Here</h3>
                    <div id="ajsinup"></div>
                    <form action="" method="post" name="register_user" id="register_user">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                            <img src="<?php echo base_url(); ?>assets/images/login_profile.svg" />
                            <input class="mdl-textfield__input" type="text" id="name" name="name" required>
                            <label class="mdl-textfield__label" for="sample3">Name</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                            <img src="<?php echo base_url(); ?>assets/images/login_email.svg" />
                            <input class="mdl-textfield__input" type="text" id="email" name="email" required>
                            <label class="mdl-textfield__label" for="sample3">Email</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                            <img src="<?php echo base_url(); ?>assets/images/login_password.svg" />
                            <input class="mdl-textfield__input" type="password" id="password" name="password" required>
                            <label class="mdl-textfield__label" for="password">Password</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                            <img src="<?php echo base_url(); ?>assets/images/login_mobile-number.svg" />
                            <input class="mdl-textfield__input" type="text" id="phone" name="phone">
                            <label class="mdl-textfield__label" for="sample3">Mobile Number</label>
                            <input type="hidden" id="redirect_url">	
                        </div>
                    </form>
                    <p class="terms-text">By Signing Up with VIEWHAM, you are agreeing to our <a href="<?php echo base_url('terms'); ?>" target="_blank"  class="forgot-link">Terms and  Conditions</a></p>

                    <button id="submit_singnup" class="btn btn-primary" type="button" >Register</button>
                    <div class="line-text col-md-12 col-sm-12 col-xs-12">
                        <p class="">
                            <span>Already Registered? </span>
                                <a id="rsignupc" class="forgot-link" data-toggle="modal" data-target="#signinModal"  data-dismiss="modal"> Signin Here</a>
                            
                        </p>
                    </div>
                </div>
                <!-- Facebook login or logout button -->
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" >
    $('#submit_singnup').on('click', function (event) {
        if(validateForm() == true){
            var data = $("#register_user").serialize();
            var url = '/user/register';
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function(data)
                {
                    if(data.issuccess == 1){
					//ga('send', 'event', { eventCategory: 'Sign Up', eventAction: 'Signup page', eventLabel: 'Lead', eventValue: 1});
                    sendSMSOTP(data.user.id);
                    }else{
                       $('#error_message').modal('toggle');
                       $('#message_box').text(data.error_message);
                    }
                }
            }); 
        }

    });
    $(document).on("click", ".phone-otp-submit", function(event){
        if(validateMobileForm() == true){
            var otp = $("#otp-msg").val();
            var userid = $("#userid").val();
            var url = '/user/verifyotp';
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
                       $('#message_box').text('');
                       $('#message_box').text(data.success_message);
                       setTimeout(function() {
                            $('#error_message').modal('toggle');
                            $('#session_exist').val(1);
                            $('#before_signin_block').removeClass('show');
                            $('#before_signin_block').addClass('hide');
                            $('#after_signin_block').addClass('show');
                            $('#regular_login').remove();
                            $('#ajax_login').removeClass('hide');
                            $('#ajax_login').addClass('show');
                            $('#profile_name_ajax').html(data.user.name);
                            $('#profile_picture_ajax').attr("src",data.user.profile_picture);
                       }, 2000);
                   }else{
                       $('messege_block').text(data.failure_message);
                   }
                }
            }); 
        }
    });

function sendSMSOTP(userid){
    
    var url = '/user/sendsmsotp';
    $.ajax({
        type: "POST",
        url: url,
        data: {"userid":userid},
        dataType: "json",
        success: function(data)
        {
           if(data.issuccess==1){
               $('#signupModal').modal('toggle');
               $('#SendotpMsgModal').modal('toggle');
               $('#userid').val(userid);
           }
        }
    }); 
}

    
function validateMobileForm(){
    return true;
}

function validateForm(){
    var name=$('#name').val();	
    var email=$('#email').val();	
    var password=$('#password').val();	
    var phone=$('#phone').val();
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;	
    
    if((!name) || (!password) || (!email) || (!phone))
    {
        if(!name){
            alert('Name field cannot be empty');
            $("#name").css("border-color","rgb(185, 74, 72)");
            return false;
        }
        if(!email){
            alert('Email field cannot be empty');
            $("#email").css("border-color","rgb(185, 74, 72)");
            return false;
        }
        if(!phone){
            alert('Phone field cannot be empty');
            $("#phone").css("border-color","rgb(185, 74, 72)");
            return false;
        }
        if(!password){
            alert('Password field cannot be empty');
            $("#password").css("border-color","rgb(185, 74, 72)");
            return false;
        }
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

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}


</script>

