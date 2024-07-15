<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/croppic.css" />
    <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
<section class="ideazone">
    <div class="container">
        <div class="row mb-20">
            <div class="col-md-6">
                <h4 class="mt-0 mb-0">Your Profile</h4>
            </div>
            <div class="col-md-6">
            <?php if(!empty($this->session->flashdata('success'))){?>
                <div class="alert alert-success"><b>Congratulations!!</b> Your  profile has been Updated</div>
            <?php } ?>
            </div>
        </div>
        <?php 
            $pimg = $user['profile_picture']; //ok
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="ideazone-content form-box">                     
                    <div class="row mt-20">
                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                            <!-- left column -->
                            <div class="col-md-3">
                                <div class="text-center">
                                    <?php if($user['login_type'] == 1 || 1==1){?>
                                        <span id="remove-pic" >X</span>
                                    <?php } ?>
                                    <div class="upload-pic">
                                        
                                        <?php if($user['login_type'] == 1  || 1==1){?>
                                        <div id="uploaded_image">
                                            <img id="blah" src="<?php echo $pimg; ?>" class="avatar" alt="avatar" />
                                        </div>
                                        <div class=" mt">
                <div id="cropContainerModal"></div>
                <input type="hidden" name="imageprofile" id="cropOutput" >
                <input type="hidden" name="profile_image_url" id="profile_image_url" />
            </div> 
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- edit form column -->
                            <div class="col-md-8 col-md-offset-1 personal-info">
                                <h2>Personal info</h2>                              
                                <div class="">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                        <input class="mdl-textfield__input" name="name" value="<?php echo $user['name']; ?>" type="text" id="n1">
                                        <label class="mdl-textfield__label"  for="n1">Name</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                        <input class="mdl-textfield__input" name="age" value="<?php echo ($user['age']!=0)?$user['age']:''; ?>" type="text" id="a1">
                                        <label class="mdl-textfield__label" for="a1">Age</label>
                                    </div>
                                     <div class="row">   <div class="col-md-11">
                                    
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                        <input class="mdl-textfield__input" name="mobile" value="<?php echo $user['mobile']; ?>" type="text"  readonly="true">
                                        <label class="mdl-textfield__label" for="m1">Mobile</label>
                                        </div>
    
                                    </div>
                                    <div class="col-md-1">
                                    <br>
                                    <a class="edit_mobile_click link">Edit</a>
                                    <a class="edit_mobile_cancel link hide">Cancel</a>
                                    </div>
                                    <div><span class="otp-submit"></span></div>
                                    <div class="edit_mobile hide">
                                    <div class="col-md-1">&nbsp </div>
                                    <div class="col-md-4"><input type="text" class="mdl-textfield__input" name="v_mobile" value="<?php echo $user['mobile']; ?>" placeholder="Enter Mobile"maxlength="11"><a class="link get_otp">Get OTP</a>
                                    <span class="otp-sent"></span></div>
                                    
                                    <div class="col-md-4 get_otp_div hide">
                                    <input type="text" name="m_otp" class="mdl-textfield__input" placeholder="Enter OTP">
                                    <a class="link submit_otp">Submit OTP</a>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row"> 
                                    <div class="col-md-11">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                        <input class="mdl-textfield__input" name="email" value="<?php echo $user['email']; ?>" type="text" id="e1" readonly="true">
                                        <label class="mdl-textfield__label" for="e1">Email</label>
                                        <span class="sent-email"></span>
                                    </div>
                                    </div>
                                    <div class="col-md-1"><br>
                                        <a class="link editEmail">Edit </a>
                                        <a class="link editEmailCancel hide">Cancel</a>
                                    
                                    </div>
                                    <div class="EditEmailDiv hide">
                                    <div class="col-md-6">
                                    <input class="mdl-textfield__input" name="EditEmail" value="<?php echo $user['email']; ?>" type="text" >
                                    </div>
                                    <div class="col-md-6">
                                    <a class="updateEmail link">Update</a>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                            <input class="mdl-textfield__input" name="Linkedin" value="<?php echo $user['linkedin_id']; ?>" type="text" id="li1">
                                            <label class="mdl-textfield__label" for="li1">Linkedin</label>
                                    </div>
                                    <label class="mt-20">Gender</label>
                                    <div class="radio-grp">
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="male">
                                            <input type="radio" id="male" class="mdl-radio__button" name="GENDER" value="1" <?php if($user['gender'] == 1){ echo "checked";  } ?>>
                                            <span class="mdl-radio__label">Male</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="female">
                                            <input type="radio" id="female" class="mdl-radio__button" name="GENDER"  value="2" <?php if($user['gender']== 2){ echo "checked";  } ?>>
                                            <span class="mdl-radio__label">Female</span>
                                        </label>
                                    </div>
									<input type="hidden" value="<?php echo base_url()?>" name="base_url"  id="base_url">
                                    <button class="btn btn-primary sub mt-20">Save</button>
                                    <br /><br />
                                </div>
                <br />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
 

   
<script src="<?php echo base_url(); ?>assets/js/custom/edit_profile.js"></script>
<script src="<?php echo base_url(); ?>assets/js/croppic.min.js"></script>
 