<div class="container-fluid">
    <div class="row intro">
        <div class="col-md-6 col-sm-12 intro-left hidden-xs hidden-sm">
            <h2>Use Viewham Power <br>to Empower your Income</h2>
            <hr>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.svg" class="logo"/></a>
            <div class="mouse"><div class="scroll"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 intro-right">
            <!--div class="line-text row">
                <div class="col-md-5">
                    <a href="javascript:void(0);" onclick="fbLogin();" id="fbLink" class="btn btn-info">
                        <img src="https://img.icons8.com/color/48/000000/facebook.png">
                        Login with Facebook
                    </a>
                </div> 
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <a href="<?php echo base_url('user/linkedinlogin?oauth_init=1'); ?>" class="btn btn-info">
                    <img src="https://img.icons8.com/color/48/000000/linkedin.png">
                    Login with LinkedIn
                    </a>
                </div> 
            </div>
            <div class="row">&nbsp;</div-->
            <div class="col-md-8 col-sm-12 col-xs-12 sign-box signup">
                
                <h3>Sign Up Here</h3>
                <form action="<?php echo base_url(); ?>" method="post" name="register_user" id="register_user">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                        <img src="<?php echo base_url();?>assets/images/login_profile.svg" />
                        <input class="mdl-textfield__input" type="text" id="name" name="name">
                        <label class="mdl-textfield__label" for="name">Name</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                        <img src="<?php echo base_url();?>assets/images/login_email.svg" />
                        <input class="mdl-textfield__input" type="text" id="email" name="email">
                        <label class="mdl-textfield__label" for="email">Email</label>
						<span class="help-block form-error hide">Enter valid email</span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                        <img src="<?php echo base_url();?>assets/images/login_password.svg" />
                        <input class="mdl-textfield__input" type="password" id="password" name="password">
                        <label class="mdl-textfield__label" for="password">Password</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                        <img src="<?php echo base_url();?>assets/images/login_mobile-number.svg" />
                        <input class="mdl-textfield__input" type="text" id="phone" name="phone" maxlength="11">
                        <label class="mdl-textfield__label" for="phone">Mobile Number</label>
                    </div>
                    <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                        <div id="imgdiv" style="display: inline;">
                            <img id="img" src="<?php echo base_url() ?>User/getcapachaimage" />
                        </div>
                        <img id="reload" src="<?php echo base_url() ?>assets/images/login_mobile-number.svg" />
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                        <img src="<?php echo base_url();?>assets/images/fullstar.svg" />
                        <input class="mdl-textfield__input" type="text" id="capacha_error" name="capacha_error">
                        <label class="mdl-textfield__label" for="phone">Enter Image Text</label>
                    </div-->
                </form>
                <p class="terms-text">By Signing Up with VIEWHAM, you are agreeing to our <a target="_blank" href="<?php echo base_url('terms'); ?>"class="forgot-link">Terms and  Conditions</a></span></p>
                <button id="submit_form" class="btn btn-primary" type="button" >Register</button>
            </div>
            
            
            <div class="line-text col-md-8 col-sm-12 col-xs-12">
                <p class="bg-line"><span>Already Registered? <a class="forgot-link" href="<?php echo base_url();?>User/signin"> Sign In Here</a></span></p>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('modals/mobile_otp');?>
<?php $this->load->view('modals/messages');?>
<script src="<?php echo base_url(); ?>assets/js/custom/signup.js"></script>
