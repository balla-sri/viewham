<div id="SendotpMsgModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
                <div class="col-md-12 col-sm-12 col-xs-12 sign-box otp-box">
                    <div class="input-box">
                        <label>Mobile:</label>
                        <input name="phone-otp" id="phone-otp" type="text" class="form-control" placeholder="xxxxxx4822" disabled>
                        <button class="phone-get-otp btn btn-primary"style="margin-top: 20px !important; margin-left: 10px;">Resend OTP</button>
                        <input type="hidden" name="userid" id="userid" value="" />
                    </div>
                    <div class="input-box">
                        <label>OTP:</label>
                        <input id="otp-msg" type="text" class="form-control" placeholder="">
                        
                    </div>

                    <div class="input-box text-center">
                        <button class="phone-otp-submit btn btn-primary">Done</button>
                    </div>
                </div>
                <div class="input-box text-center messege_block">
                    
                </div>    
            </div>
        </div>
    </div>
</div>	