<div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 sign-box">
                    <h3>Sign In Here</h3>
                    <form action="<?php echo base_url(); ?>" id="configformlog">       <input type="hidden" name="trigger_idea" id="trigger_idea" value="0">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                            <img src="<?php echo base_url(); ?>assets/images/login_profile.svg" />
                            <input class="mdl-textfield__input" type="email" id="username" name="username">
                            <label class="mdl-textfield__label" for="sample3">Enter Email</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                            <input class="mdl-textfield__input" type="password" id="loginpasswordModel" name="password">
                            <img src="<?php echo base_url(); ?>assets/images/login_password.svg" />
                            <label class="mdl-textfield__label" for="sample4">Password</label>
                            <span class="mdl-textfield__error">Password is not a number!</span>
                            <span><a  id="showpassword">Show</a></span>
                            <span><a  id="hidepassword">Hide</a></span>
                            <input type="hidden" id="rurl">
                        </div>
                        <div id="peopleerror"></div>
                    </form>
                    <button id="signin" class="btn btn-primary">Sign In</button>
                    <!--<a class="forgot-link pull-right">Forgot Password</a>-->
					<a class="forgotModal forgot-link pull-right" data-toggle="modal" data-target="#forgotModal">Forgot Password</a>
                </div>
                </div>
                <div class="row">
                <div class="line-text col-md-12 col-sm-12 col-xs-12">
                    <p class="bg-line"><span>Not Registered? <a id="sasignupModal" class="forgot-link" data-toggle="modal" data-target="#signupModal"  data-dismiss="modal"> Sign Up Here</a></span></p>
                </div>
                </div>
                <!-- Facebook login or logout button -->
                <div class="row text-center">
                    
                    <div class="col-lg-6 col-md-6 loginbuttons ">
                        <!--<a href="javascript:void(0);" onclick="fbLogin();" id="fbLink" class="btn btn-primary">
                            <img src="https://img.icons8.com/color/48/000000/facebook.png">
                            Login with Facebook
                        </a>-->
						<a href="javascript:void(0);" onclick="fbLogin();" id="fbLink" class="btn-l">
                        <img src="<?php echo base_url('assets/images/fb-signin.png') ?>" width="34px">
                       <span> Sign in</span>
                    </a>
                    </div>
                    <div class="col-lg-6 col-md-6 loginbuttons ">
                        <!--<a href="javascript:void(0);" onclick="renderButton();" id="gSignIn" class="btn btn-primary">
                            <img class=".img-responsive" style="background-color:white" src="https://img.icons8.com/color/48/000000/google-logo.png">
                            Login with Google
                        </a>-->
						<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"> <img class=".img-responsive" style="background-color:white" src="https://img.icons8.com/color/48/000000/google-logo.png">
                            Login with Google</div>
                    </div> 
                    
                 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Facebook Login Start-->
<script>

window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '2796541780571274', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.10' // use graph api version 2.10
    });
    
    // Check whether the user already logged in
    /*FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //display user data
            //getFbUserData();
        }
    });*/
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email', auth_type: 'reauthenticate'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture,cover'},
    function (response) {
        saveUserData(response);
    });
}

// Save user data to the database
function saveUserData(userData){
    var url = '/facebook_login/saveuserdata';
    $.ajax({
        type: "POST",
        url: url,
        data: {oauth_provider:'facebook', userData: JSON.stringify(userData)},
        dataType: "json",
        success: function(data)
        {
            $('#signinModal').modal('toggle');
            $('#session_exist').val(1);
            $('#before_signin_block').removeClass('show');
            $('#before_signin_block').addClass('hide');
            $('#after_signin_block').addClass('show');
            $('#regular_login').remove();
            $('#ajax_login').removeClass('hide');
            $('#ajax_login').addClass('show');
            $('#profile_name_ajax').html(data.user.name);
            $('#profile_picture_ajax').attr("src",data.user.profile_picture);
            if($('#page_name').val() == 'businessideas'){
                var trigger_id = $('#trigger_idea').val();
                var ee = trigger_id.split('_');
                $("#long_desc_"+ee[0]+ee[1]).css("display","none");
                $("#full_desc_"+ee[0]+ee[1]).css("display","block");
                showContent(ee[1],ee[0]);
            }else if($('#page_name').val() == 'businessideas/postidea'){
                showContent();
            }
        }
    });
}

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="<?php echo base_url('assets/images/fblogin.png'); ?>"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
    });
}
</script>
<script>
function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}
function onSuccess(googleUser) {
    gapi.client.load('oauth2', 'v2', function () {
        var request = gapi.client.oauth2.userinfo.get({
            'userId': 'me'
        });
        request.execute(function (resp) { //console.log(resp);
        saveUserDataGoogle(resp);
        });
    });
}
// Sign-in failure callback
function onFailure(error) {
    console.log(error);
}
function saveUserDataGoogle(userData){
 
    $.post("<?php echo base_url('Google_login/saveUserData'); ?>", {oauth_provider:'facebook', userData: JSON.stringify(userData)}, function(data){ 
    if(data){
            $('#signinModal').modal('toggle');
            $('#session_exist').val(1);
            $('#before_signin_block').removeClass('show');
            $('#before_signin_block').addClass('hide');
            $('#after_signin_block').addClass('show');
            $('#regular_login').remove();
            $('#ajax_login').removeClass('hide');
            $('#ajax_login').addClass('show');
            $('#profile_name_ajax').html(data.user.name);
            $('#profile_picture_ajax').attr("src",data.user.profile_picture);
            if($('#page_name').val() == 'businessideas'){
                var trigger_id = $('#trigger_idea').val();
                var ee = trigger_id.split('_');
                $("#long_desc_"+ee[0]+ee[1]).css("display","none");
                $("#full_desc_"+ee[0]+ee[1]).css("display","block");
                showContent(ee[1],ee[0]);
            }else if($('#page_name').val() == 'businessideas/postidea'){
                showContent();
            }
        }
    return true;
    }); 
    
    
}
</script>

<script type="text/javascript">
    $('#hidepassword').hide();
    $('#showpassword').click(function() {
          $('#loginpasswordModel').attr('type', 'text');
          $('#showpassword').hide();
          $('#hidepassword').show();
    });
    $('#hidepassword').click(function() {
          $('#loginpasswordModel').attr('type', 'password');
          $('#showpassword').show();
          $('#hidepassword').hide();
    });

$('#signin').on('click', function (event) {
    var username = $('#username').val();
    var password = $('#loginpasswordModel').val();
    var baseurl = $('#configformlog').attr('action');

    if(validatesigninform()==true){
        var url = baseurl+'/user/login';
        $.ajax({
             type: "POST",
             url: url,
             data: {'username':username,'password':password},
             dataType: "json",
             success: function(data)
             {
                 console.log(data);
                 if(data.issuccess == 1){
                    //window.location.href = '/businessideas';
                    $('#signinModal').modal('toggle');
                    $('#session_exist').val(1);
                    $('#before_signin_block').removeClass('show');
                    $('#before_signin_block').addClass('hide');
                    $('#after_signin_block').addClass('show');
                    $('#regular_login').remove();
                    $('#ajax_login').removeClass('hide');
                    $('#ajax_login').addClass('show');
                    $('#profile_name_ajax').html(data.user.name);
                    $('#profile_picture_ajax').attr("src",data.user.profile_picture);
                    if($('#page_name').val() == 'businessideas'){
                        var trigger_id = $('#trigger_idea').val();
                        var ee = trigger_id.split('_');
                        $("#long_desc_"+ee[0]+ee[1]).css("display","none");
                        $("#full_desc_"+ee[0]+ee[1]).css("display","block");
                        showContent(ee[1],ee[0]);
                    }else if($('#page_name').val() == 'businessideas/postidea'){
                        showContent();
                    }
                 }else{
                    $('#error_message').modal('toggle');
                    $('#message_box').text(data.error_message);
                 }
             }
         }); 
    }
       
});

function validatesigninform(){
    return true;
}
$('#username,#loginpasswordModel').keypress(function (e) {
  if (e.which == 13) {
		$("#signin").click();
  }
});

</script>