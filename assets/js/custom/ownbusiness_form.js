$('.e2_2aaa').selectize({
	maxItems: 5
});
$('.combobox2').selectize({});
$(document).ready(function() { 
$(".e2_2ss").select2({
placeholder: "Search by Industry"
});});
$(document).ready(function() {
	

 	$(".input").bind("keyup change select", function(e){   
	var key = $(this).attr('id');
	if(key=='min_share' || key=='max_share'){
		$(".share").html('');  
	}else if(key=='max_invest' || key=='min_invest'){
				$(".invest").html('');  
	}
	$("."+key).html('');  
	 
  });
  
$(".input").bind("keyup change", function(e){   
var keyfield = $(this).attr('id');
for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
}
var baseurl = $('#establish-business').attr('action');
var url = baseurl+'/establishbusinessvalidate';
var formm = $('#establish-business')[0];

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
	success: function(data) {
		console.log(data);
	$.each(data.error, function(key, item) {
		if(key==keyfield || key=='share' || key=='invest'){
			$("."+key).html(item); 
		}	  

    });
	

	}
});
});
  
$("#submit_form").click(function() {
for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
}
var baseurl = $('#establish-business').attr('action');
var url = baseurl+'/establishbusinesssubmit';
var formm = $('#establish-business')[0];
$(".error").html('');
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
	success: function(data) {
		console.log(data);
		if(data.emptySession==1 && data.error==''){
		 $('#signinModal').modal('toggle');	
		}else{
			$.each(data.error, function(key, item) {
				$("."+key).html(item);  
			});
		}
	if(data.insert_status==1){
	$("#submit_form").attr('disabled','disabled');
	$("#payment_info").show();
	$("#payment_info").removeClass('hide');
	$("#postid").val(data.insertId);
	
	}

	}
});
});

$("#coins_form").click(function() {

var baseurl = $('#coins-form').attr('action');
var url = baseurl;
var formm = $('#coins-form')[0];
$(".error").html('');
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
	success: function(data) {
		  console.log(data);
		if(data.status==1){
		$('#establish-business')[0].reset();
		$('#coins-form')[0].reset();
		$("#submit_form").removeAttr('disabled');
		$("#payment_info").slideToggle();
		$("#payment-update").slideToggle();
		$("#payment-update").removeClass('hide');
		window.location.href = '/ownbusiness/details/'+data.postid;
		
	 }else if(data.status == 2){
                    alert(data.error_message);
                    window.location.href = "/coins/add";
         }
	 }
});
});

$('.coins-spend').keyup(function() {
    var hrs = $(this).val()*2;
	$('.d-hrs').html(hrs);
  if(!hrs){
 	$("#coins_form").attr('disabled','disabled');
  }else{
	 $("#coins_form").removeAttr('disabled'); 
  }
  

});

});

$('#consultant').on('change', function(e){
   if(e.target.checked){
     $('#consultantModal').modal();
   }
});

$('#mentor').on('change', function(e){
   if(e.target.checked){
     $('#mentorModal').modal();
   }
});


function textAreaAdjust(o) {
o.style.height = "1px";
o.style.height = (25 + o.scrollHeight) + "px";
}

CKEDITOR.on('instanceCreated', function (e) {
 e.editor.on('change', function (event) {
 var value = CKEDITOR.instances['description'].getData();//Value of Editor
	$(".description").html('');  
});
});


CKEDITOR.replace('description', {
toolbar: [{
		name: 'basicstyles',
		items: ['Bold', 'Italic', 'Underline']
	}, {
		name: 'paragraph',
		items: ['NumberedList', 'BulletedList']
	},

]
});