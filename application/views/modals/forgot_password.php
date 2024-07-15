<SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
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
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 sign-box otp-box">
                        
                        <div class="input-box">
                            <label>Mobile:</label>
							<!--<input id="f-phone" type="number" class="form-control" placeholder="Phone No" >-->
							<input id="f-phone" type="text" maxlength=10 onkeypress="return isNumberKey(event)" class="form-control" placeholder="Phone No" >
							<a class="link-getotp-mobile link">Get OTP</a>
                        </div>
                        <div class="input-box">
                            <label>OTP:</label><input id="f-otp" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="input-box text-center">
                            <a class="link-getotp-mobile forgot-link">Resend OTP</a>
                            <button class="otp-submit-mobile btn btn-primary">Done</button>
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
                            <label>Email:</label><input type="text" class="email-otp form-control" placeholder="xxxxxx@gxxx.com" ><a class="link-getotp-email link">Get OTP</a>
                        </div>
                        <div class="input-box">
                            <label>OTP:</label><input type="text" class="email-otp-val  form-control " placeholder="">
                        </div>
                        <div class="input-box text-center">
                            <a class="link-getotp-email forgot-link">Resend OTP</a>
                            <button class="otp-submit-email btn btn-primary">Done</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 sign-box-change-password sign-box otp-box hide">
                    <h3>Change Password</h3>
                    <div class="input-box">
                        <input type="hidden" name="source" id="source" value="">
                        <input type="hidden" name="type" id="type" value="">
                        <label class="big">New Password:</label>
                        <input id="chpassword" type="password" class="form-control"  >
                    </div>
                    <div class="input-box">
                        <label class="big">Confirm Password:</label>
                        <input id="chcpassword" type="password" class="form-control" >
                    </div>
                    <div class="input-box text-center">
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