$(".edit-mobile").click(function(){
	  $('.mobile-edit').show();
	  $('.mobile-view').hide();
	  $('.view-mobile').show();
	  $('.edit-mobile').hide();
});
$(".view-mobile").click(function(){
	  $('.mobile-edit').hide();
	  $('.mobile-view').show();
	  $('.view-mobile').hide();
	  $('.edit-mobile').show();
});
$(".edit-email").click(function(){
	  $('.email-edit').show();
	  $('.email-view').hide();
	  $('.view-email').show();
	  $('.edit-email').hide();
});
$(".view-email").click(function(){
	  $('.email-edit').hide();
	  $('.email-view').show();
	  $('.view-email').hide();
	  $('.edit-email').show();
});
$(".r_edit-mobile").click(function(){
	  $('.r_mobile-edit').show();
	  $('.r_mobile-view').hide();
	  $('.r_view-mobile').show();
	  $('.r_edit-mobile').hide();
});
$(".r_view-mobile").click(function(){
	  $('.r_mobile-edit').hide();
	  $('.r_mobile-view').show();
	  $('.r_view-mobile').hide();
	  $('.r_edit-mobile').show();
});
$(".r_edit-email").click(function(){
	  $('.r_email-edit').show();
	  $('.r_email-view').hide();
	  $('.r_view-email').show();
	  $('.r_edit-email').hide();
});
$(".r_view-email").click(function(){
	  $('.r_email-edit').hide();
	  $('.r_email-view').show();
	  $('.r_view-email').hide();
	  $('.r_edit-email').show();
});
$(".skill-details-edit").click(function(){
  $('.skill-details-view').show();
  $('.skill-details-edit').hide();
  $('.view-skill-details').hide();
  $('.edit-skill-details').show();
});
$(".skill-details-view").click(function(){
  $('.skill-details-view').hide();
  $('.skill-details-edit').show();
  $('.view-skill-details').show();
  $('.edit-skill-details').hide();
});
$(".get-otp").click(function(){
var phone = $('#mobile-no').val();
if((!phone)){
	alert('Enter Phone or Email');
	return false;
}
var url = "/user/sendphonesmsotp";
$.ajax({
    type: "POST",
    url: url,
    data: {
      "phone": phone
    },
	dataType: "json",
    success: function(JSONObject) {
	if(JSONObject.issuccess==1){
     $('#mobile-no').prop('readonly', true);
     $('.get-otp').hide();
     $('.OTP-Sent').show('slow');
     $('.OTP-Sent').html('Otp Sent Successfully');
	 setTimeout(function() {
		$('.OTP-Sent').hide('slow');
		$('.OTP-Sent').html('');
		 $('.get-otp').show();
		
    }, 5000);
		}else if(JSONObject.issuccess==0){
			$('.OTP-Sent').show('slow');
     $('.OTP-Sent').html('Oops Worng.. will get back to you.');
	 setTimeout(function() {
        
		$('.OTP-Sent').hide();
		$('.OTP-Sent').html('');
		
    }, 5000);
		}else{
		console.log(JSONObject);	
		}
    }
  });
});
$(".r_get-otp").click(function(){
var phone = $('#r_mobile-no').val();
if((!phone)){
	alert('Enter Phone or Email');
	return false;
}
var url = "/user/sendphonesmsotp";
$.ajax({
    type: "POST",
    url: url,
    data: {
      "phone": phone
    },
	dataType: "json",
    success: function(JSONObject) {
	if(JSONObject.issuccess==1){
     $('#r_mobile-no').prop('readonly', true);
     $('.r_get-otp').hide();
     $('.r_OTP-Sent').show('slow');
     $('.r_OTP-Sent').html('Otp Sent Successfully');
	 setTimeout(function() {
		$('.r_OTP-Sent').hide('slow');
		$('.r_OTP-Sent').html('');
		$('.r_get-otp').show();    }, 3000);
		}else if(JSONObject.issuccess==0){
	 $('.r_OTP-Sent').show('slow');
     $('.r_OTP-Sent').html('Oops Worng.. will get back to you.');
	 setTimeout(function() {        
		$('.r_OTP-Sent').hide();
		$('.r_OTP-Sent').html('');
		
    }, 5000);
		}else{
		console.log(JSONObject);	
		}
    }
  });
});
$(".emailVerify").click(function(){
var email = $('#email-no').val();
var verifyType = $(this).data('verifyType');
var url = "/user/emailverificationlinksend";
$.ajax({
    type: "POST",
    url: url,
	dataType: "json",
    data: {"email": email,"verifyType":verifyType},
    success: function(JSONObject) {
	console.log(JSONObject);
	if(JSONObject.issuccess==1){
			$('.emailVerify').html(JSONObject.message);
			setTimeout(function() { $('.emailVerify').html('');  }, 2000);
	}else{
		alert(JSONObject.message);	
	}
    }
  });
});
$(".r_emailVerify").click(function(){
var email = $('#r_email').val();
var verifyType = $(this).data('verifyType');
var url = "/user/emailverificationlinksend";
$.ajax({
    type: "POST",
    url: url,
	dataType: "json",
    data: {"email": email,"verifyType":verifyType},
    success: function(JSONObject) {
	console.log(JSONObject);
	if(JSONObject.issuccess==1){
		$("#r_email").attr('disabled','disabled');
		$('.r_emailVerify').html(JSONObject.message);
		setTimeout(function() { $('.r_emailVerify').html('');  }, 2000);

	}else{
		alert(JSONObject.message);	
	}
    }
  });
});
$(".otp-submit").click(function(){
var phone = $('#mobile-no').val();
var otp = $('.otp-verify').val();
var email = $('.email-otp').val();
if(!phone){
	var wher = email;
}else{
	var wher = phone;
}
if((!otp)){
	alert('Enter Otp');
	return false;
}
if((!wher)){
	alert('Enter Phone');
	return false;
}
var url = '/user/verifyotp';
	
$.ajax({
    type: "POST",
    url: url,
    data: {
      "phone": phone,
      "otp": otp,
      "email": email
    },
	dataType: "json",
    success: function(msg) {
		console.log(msg);
		if(msg.issuccess==1){
			$('.otp-submit').html('<span class="alert-success">Verified</span>');
				 setTimeout(function() {
        
		$('.mobile-edit').hide();
		$('.mobile-view').show();
		$('.not-verified').html('Verified');
		location.reload();
		
    }, 1000);
		}else if(msg.issuccess==0){
			alert('Wrong OTP');	
			//$('.otp-stuts').html('<span class="alert-danger">Wrong entry</span>');
		}
		
    }
  });
});
$(".r_otp-submit").click(function(){
var phone = $('#r_mobile-no').val();
var otp = $('.r_otp-verify').val();
var postid = $(this).data('postid');
if((!otp)){
	alert('Enter Otp');
	return false;
}
var url = '/user/verifyotprefermobile';
$.ajax({
    type: "POST",
    url: url,
    data: {
      "phone": phone,
      "otp": otp,
      "postid": postid	  
    },
	dataType: "json",
    success: function(msg) {
		console.log(msg);
		if(msg.issuccess==1){
			$('.r_otp-submit').html('<span class="alert-success">Verified</span>');
				 setTimeout(function() {
		$('.r_mobile-edit').hide();
		$('.r_mobile-view').show();
		$('.r_not-verified').html('Verified');
    }, 1000);
		}else if(msg.issuccess==0){
			alert('Wrong OTP');	
			//$('.otp-stuts').html('<span class="alert-danger">Wrong entry</span>');
		}
		
    }
  });
});
$(".email-otp-submit").click(function(){
var email = $('#email-no').val();
var otp = $('.email-otp-verify').val();
if((!otp)){
	alert('Enter Otp');
	return false;
}

var url = "/user/verifyotp";
	
$.ajax({
    type: "POST",
    url: url,
    data: {
      "email": email,
      "otp": otp
    },
    success: function(msg) {
		console.log(msg);
		if(msg==1){
			$('.otp-submit-status').html('<span class="alert-success">Verified</span>');
				 setTimeout(function() {
        
		$('.email-edit').hide();
		$('.email-view').show();
		$('.not-verified').html('Verified');
		location.reload();
		
    }, 1000);
		}else if(msg==3){
				$('.otp-submit-status').html('<span class="alert-danger">Wrong entry</span>');
		}
		
    }
  });
});

////   Edit form ///// 

$("#submit_form").click(function(){
	var url = $('#earn-profile').attr('action');
	var formm = $('#earn-profile')[0];
		// Create an FormData object 
        var data = new FormData(formm);
    $.ajax({
           type: "POST",
           url: url,
		   enctype: 'multipart/form-data',
		   data: data,
		   dataType: 'json',
           processData: false,
           contentType: false,
           cache: false,
           timeout: 600000,
           success: function(data)
           {
               console.log(data);
			  
			   if(data.update_status=='1'){
			  $('.msgs').html('<p class="">Successfully Updated</p>');
			  $('#MsgModal').modal('toggle');
			  	 setTimeout(function() { location.reload();}, 2000);
			   }else{
			 
			   $('.msgs').html('<p class="">'+data.message+'</p>');
					$('#MsgModal').modal('toggle');
			   }
           }
         });
});


  var selDiv = "";
    var storedFiles = [];
    
    $(document).ready(function() {
        $("#files").on("change", handleFileSelect);
        
        selDiv = $("#selectedFiles"); 
        $("#myForm").on("submit", handleForm);
        
        $("body").on("click", ".selFile", removeFile);
    });
        
    function handleFileSelect(e) {
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function(f) {          

            if(!f.type.match("image.*")) {
                return;
            }
            storedFiles.push(f);
            
            var reader = new FileReader();
            reader.onload = function (e) {
                var html = "<div class='attach-item '>" +f.name+ "<a class='x-delete selFile'>x</a></div>";
                selDiv.append(html);
                
            }
            reader.readAsDataURL(f); 
        });
        
    }
        
    function handleForm(e) {
        e.preventDefault();
        var data = new FormData();
        
        for(var i=0, len=storedFiles.length; i<len; i++) {
            data.append('files', storedFiles[i]); 
        }
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'handler.cfm', true);
        
        xhr.onload = function(e) {
            if(this.status == 200) {
                console.log(e.currentTarget.responseText);  
                alert(e.currentTarget.responseText + ' items uploaded.');
            }
        }
        
        xhr.send(data);
    }
        
    function removeFile(e) {
        var file = $(this).data("file");
        for(var i=0;i<storedFiles.length;i++) {
            if(storedFiles[i].name === file) {
                storedFiles.splice(i,1);
                break;
            }
        }
        $(this).parent().remove();
    }


$(".buy_contact").click(function(){
    var nid = $(this).data('nid');
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var n_type = 33;
    var url = '/contact/buycontact';
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
		   console.log(post_by);
		   if(data.status==1){
				$('.pay_'+nid).addClass('hide');
				$('#contactDetails_'+nid).removeClass('hide');
			 }else{
				$('#viewContact_'+nid).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
		}
         });
});

$(".shortBtn").click(function(){
    var pid = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var posted_by = $(this).data('posted_by');
    var url = $(this).data('url');
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {pid: pid, post_type: post_type, posted_by: posted_by},
           dataType: 'json',
           success: function(data)
           {
            console.log(data);
            if(data.insert==1){
                $('#shortlist_'+pid).hide();
			 	$('#shortlisted_'+pid).show();
             }else if(data.insert==2){
                $('.msgs').html('<p class="">Oops Wrong Please try again later</p>')
                $('#MsgModal').modal('toggle');
             }
           }
         });
});