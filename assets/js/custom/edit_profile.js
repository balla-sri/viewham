$(document).ready(function(){
	base_url = $("#base_url").val();
	$('#cropContainerModal').hide();
    $(".editEmailCancel").click(function(){
		$('.EditEmailDiv').addClass('hide');
		$('.editEmailCancel').addClass('hide');
		$('.editEmail').removeClass('hide');
	});
    $(".edit_mobile_cancel").click(function(){
		$('.edit_mobile_click').removeClass('hide');
		$('.edit_mobile').addClass('hide');
		$('.get_otp_div').addClass('hide');
		$('.edit_mobile_cancel').addClass('hide');
		$('input[name="m_otp"]').val(null);

	});
    $(".editEmail").click(function(){
		$('.EditEmailDiv').removeClass('hide');
		$('.editEmailCancel').removeClass('hide');
		$('.editEmail').addClass('hide');
	});
    $(".edit_mobile_click").click(function(){
		$('.edit_mobile').removeClass('hide');
		$('.edit_mobile_cancel').removeClass('hide');
		$('.edit_mobile_click').addClass('hide');
		$('.get_otp_div').addClass('hide');
		$('input[name="m_otp"]').val(null);

	});
    $(".get_otp").click(function(){
		var phone = $('input[name="v_mobile"]').val();
		if((!phone)){
			alert('Enter Mobile No');
			return false;
		}
	var url = base_url+'user/sendphonesmsotp';
		$.ajax({
			type: "POST",
			url: url,
			data: {"phone": phone},
			dataType: "json",
			success: function(data) {
				$('.get_otp_div').removeClass('hide');
				$('.get_otp').html('Resend OTP');

				console.log(data);
			}
		});
	});
   
$(".submit_otp").click(function(){
var phone = $('input[name="v_mobile"]').val();
var otp = $('input[name="m_otp"]').val();
if((!otp)){
	alert('Enter Otp');
	return false;
}
var url = base_url+'user/verifyotpmobile';
$.ajax({
    type: "POST",
    url: url,
    data: {"phone": phone,"otp": otp},
	dataType: "json",
    success: function(msg) {
		if(msg.issuccess==1){
			$('input[name="mobile"]').val(phone);
			$('.edit_mobile_click').removeClass('hide');
			$('.edit_mobile').addClass('hide');
			$('.get_otp_div').addClass('hide');
			$('.edit_mobile_cancel').addClass('hide');
			$('input[name="m_otp"]').val(null);
			$('.otp-submit').html('<span class="alert-success">Verified</span>');
			setTimeout(function() {
				$('.otp-submit').html('');
				}, 1000);

		}else if(msg.issuccess==0){
			alert('Wrong OTP');	
		}
		
    }
  });
});
$(".updateEmail").click(function(){
var email = $('input[name="EditEmail"]').val();
if((!email)){
	alert('Enter Email');
	return false;
}
var url = base_url+'user/updateemailverificationlinksend';
$.ajax({
    type: "POST",
    url: url,
    data: {"email": email},
	dataType: "json",
    success: function(msg) {
		if(msg.issuccess==1){
			$('.EditEmailDiv').addClass('hide');
			$('input[name="EditEmail"]').val(email);
			$('.editEmailCancel').addClass('hide');
			$('.editEmail').removeClass('hide');
			$('.sent-email').html('<span class="alert-success">E-mail Sent please verify</span>');
			setTimeout(function() {
				$('.sent-email').html('');
				}, 5000);

		}else if(msg.issuccess==0){
			alert('Wrong OTP');	
		}
		
    }
  });
});


   $("#remove-pic").click(function(){
        var dataimg = 'svg.svg'; 	
//        $('#uploaded_image').html('<img src="/assets/images/uploads/'+dataimg+'" />');
	$('#remove-pic').hide();	
	$('#uploaded_image').hide();
	$('#cropContainerModal').show();
        var url = base_url+"user/removeprofilepic";
        $.ajax({
            type: "POST",
            url: url,
            timeout: 600000,
           success: function(data)
           {
               $('#remove-pic').hide();
                $('#imageprofile').val('');
           }
         });
    });	

	var croppicContainerModalOptions = {
				uploadUrl:base_url+'assets/cropic/img_save_to_file.php',
				cropUrl:base_url+'assets/cropic/img_crop_to_file.php',
				outputUrlId:'cropOutput',
				modal:true,
				imgEyecandyOpacity:0.4,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){
                                    console.log('onAfterImgCrop');
                                    var temp_img = $('.croppedImg').attr('src').replace(base_url+'assets/images/uploads/','');
                                    $('#profile_image_url').val(temp_img);
                                },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
		
		
	
});  
