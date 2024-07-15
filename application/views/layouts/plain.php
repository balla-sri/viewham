<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('common/main_head.php');?>
<body>
        <?php echo $contents ?>
    </body>
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
            getFbUserData();
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
    $.post("<?php echo base_url('facebook_login/saveUserData'); ?>", {oauth_provider:'facebook', userData: JSON.stringify(userData)}, function(data){ 
	if(data){
            window.location.href='<?php echo base_url(''); ?>';
	}
	return true;
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
//alert("Plain HTML")
      function onSignIn(googleUser) {
        //alert("Ok 1234")
		var profile = googleUser.getBasicProfile();
		
        saveUserDataGoogle(profile);
      }
function saveUserDataGoogle(userData){
 
    $.post("<?php echo base_url('Google_login/saveUserData'); ?>", {oauth_provider:'Google',oauth_page:'signin', userData: JSON.stringify(userData)}, function(data){ 
	if(data){
        window.location.href='<?php echo base_url(''); ?>';
	}
	return true;
	});	
	
	
}
</script>


</html>
