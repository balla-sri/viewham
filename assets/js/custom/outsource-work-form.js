$(document).ready(function() {
$('#payment-update').hide();	
$(".input").bind("keyup change", function(e){   
	var key = $(this).data('attr');
	if(key=='duration_max' || key=='duration_min'){
		$(".duration").html('');  
	}else if(key=='max_invest' || key=='min_invest'){
				$(".quote").html('');  
	}
	$("."+key).html('');  
	
  });
  
$(".input").bind("keyup change", function(e){   
var keyfield = $(this).data('attr');
for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
}
var baseurl = $('#post-form').attr('action');
var url = baseurl+'/adddatacheckerrors';
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
	  if(key==keyfield || key=='duration' || key=='quote'){
			$("."+key).html(item); 
		}	  
        console.log(keyfield);
    });
	}
});
});

$("#submit_form").click(function() {
for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
}
var baseurl = $('#post-form').attr('action');
var url = baseurl+'/adddata';
var formm = $('#post-form')[0];
$("#description").val($("#description").val().replace(/\b(\w)+\@(\w)+\.(\w)+\b/g, ""));
phoneNumberC();
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
				console.log(key+'-'+item);
			});
		}
		if(data.insert_status==1){
			$("#submit_form").attr('disabled','disabled');
			$("#payment-info").show();
			$("#postid").val(data.insertId);
			
			}

	}
});
});


function phoneNumberC() {
    var phoneNumberRegex = /\d{10}/g;
    var questionText = document.getElementById("description").value;
    var phoneNumberDetected = questionText.match(phoneNumberRegex);
    if (phoneNumberDetected != null) {
      phoneNumberDetected = String(phoneNumberDetected);
      var formattedPhone = "";
      var formattedSubject = questionText.replace(phoneNumberDetected, formattedPhone);
      $("#description").val(formattedSubject);
    }
}



$("#coins_form").click(function() {

for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
}
var baseurl = $('#post-form').attr('action');
var url = baseurl+'/spendcoinds';
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
		$("#payment-info").slideToggle();
		$("#payment-update").slideToggle();
		window.location.href = baseurl+'/project/'+data.postid;
	 }else if(data.status == 2){
                    alert(data.error_message);
                    window.location.href = "/coins/add";
         }
	}
});
});

});

function textAreaAdjust(o) {
o.style.height = "1px";
o.style.height = (25 + o.scrollHeight) + "px";
}

$(".e2_2ss").select2({
placeholder: "Search by Industry"
});
CKEDITOR.replace('description', {
toolbar: [{
		name: 'basicstyles',
		items: ['Bold', 'Italic']
	}, {
		name: 'paragraph',
		items: ['NumberedList', 'BulletedList'
		]
	}

]
});
$('.coins-spend').keyup(function() {
	var id =$(this).data('id');	
    var hrs = $(this).val()*2;
	$('.d-hrs').html(hrs);
  if(!hrs){
 	$("#coins_form").attr('disabled','disabled');
  }else{
	 $("#coins_form").removeAttr('disabled'); 
  }
  

});
