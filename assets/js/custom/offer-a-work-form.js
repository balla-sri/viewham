$(document).ready(function() { 

$(".e2_2ss").select2({
placeholder: "Search by Industry"
});});
$(document).ready(function() {
	
$('#payment-update').hide();	
 	$(".input").bind("keyup change", function(e){   
	var key = $(this).attr('id');
	if(key=='min_salary' || key=='max_salary'){
		$(".salary").html('');  
	}
	$("."+key).html('');  
	 
  });
  
$(".input").bind("keyup change", function(e){   
var keyfield = $(this).attr('id');
for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
}
var baseurl = $('#post-form').attr('action');
var url = baseurl+'/offerformcheckerrors';
var formm = $('#post-form')[0];

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
	$.each(data.error, function(key, item) {
		if(key==keyfield || key=='salary'){
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
var baseurl = $('#post-form').attr('action');
var url = baseurl+'/offerformsubmit';
var formm = $('#post-form')[0];
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
		if(data.emptySession==1 && data.error==''){
		 $('#signinModal').modal('toggle');	
		}else{
			$.each(data.error, function(key, item) {
				$("."+key).html(item);  
			});
		}
	if(data.insert_status==1){
	$("#submit_form").attr('disabled','disabled');
	$("#payment-info").show();
	$("#postid").val(data.insertId);
	$("#skill_id").val(data.skill_id);
	
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
		if(data.status==1){
                    $('#post-form')[0].reset();
                    $('#coins-form')[0].reset();
                    $("#submit_form").removeAttr('disabled');
                    $("#payment-info").slideToggle();
                    $("#payment-update").slideToggle();
                    window.location.href = '/jobs/details/'+data.postid;
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
		items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
	}, {
		name: 'paragraph',
		items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
			'-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'
		]
	}, {
		name: 'tools',
		items: ['Maximize', '-']
	}, {
		name: 'insert',
		items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
	}, {
		name: 'clipboard',
		items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
	},

]
});
