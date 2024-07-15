<div class="container-fluid">
    <div class="row intro">
        <div class="col-md-6 col-sm-12 intro-left hidden-xs hidden-sm">
            <h2>Use Viewham Power <br>to Empower your Income</h2>
            <hr>
            <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/images/logo.svg" class="logo"/></a>
            <div class="mouse"><div class="scroll"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 intro-right">
            <?php if(isset($error_msg) && $error_msg!=''){ ?>
            <div class="red"><?php echo $error_msg;?></div>
            <?php }?>
            <div class="line-text row">
		
                <div class="col-xs-6 col-lg-6 col-md-6">
                    <a href="javascript:void(0);" onclick="fbLogin();" id="fbLink" class="btn-l">
                        <img src="<?php echo base_url('assets/images/fb-signin.png') ?>" width="34px">
                       <span style="color:#fff"> Sign in</span>
                    </a>
                </div> 
                <div class="col-xs-6 col-lg-6 col-md-6">
                     <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                </div> 
            </div>
            <div class="row">&nbsp;</div>
            <div class="col-md-8 col-sm-12 col-xs-12 sign-box">
                <h3>Sign In Here</h3>
				<?php if($this->session->flashdata('msg')){
					echo $this->session->flashdata('msg');
				} ?>
                <form action="<?php echo base_url(); ?>" method="post" id="signin_form">
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
                    
                    <button type="button" id="signin" class="btn btn-primary">Sign In</button>
                    <a class="forgotModal forgot-link pull-right" data-toggle="modal" data-target="#forgotModal">Forgot Password</a>
                </form>
            </div>
            <div class="line-text col-md-8 col-sm-12 col-xs-12">
                <p class="bg-line"><span>Not Registered? <a href="<?php echo base_url(); ?>user/signup" class="forgot-link"> Sign Up Here</a></span></p>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('modals/messages');?>
<?php $this->load->view('modals/forgot_password');?>
<script src="<?php echo base_url(); ?>assets/js/custom/signin.js"></script>
