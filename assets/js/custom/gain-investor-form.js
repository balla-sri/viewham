$(".input").bind("keyup change", function(e){   
	var key = $(this).data('attr');
	if(key=='min_invest' || key=='max_invest'){
		$(".invest").html('');  
	}else if(key=='min_share' || key=='max_share'){
		$(".share").html('');  
	}
	$("."+key).html('');  
	
  });	
$(".input").bind("keyup change", function(e){   
var keyfield = $(this).data('attr');
var baseurl = $('#earn-profile').attr('action');
var url = baseurl+'investorvalidation';
var formm = $('#earn-profile')[0];
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
			if(data.exist==1){
				$('#earn-profile')[0].reset();
				$(".send-info").html(data.message);
				setTimeout(function() {
                        window.location.href = "/investor"
                }, 700);
			}
			$.each(data.error, function(key, item) {
				if(key==keyfield || key=="share" || key=="invest"){
				$("."+key).html(item); 
					}	  
				});
           }
         });
});


$(".submit_form").click(function(){
var baseurl = $('#earn-profile').attr('action');
var url = baseurl+'investorformsubmit';
var formm = $('#earn-profile')[0];
$(".error").html('');
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
			if(data.exist==1){
				$('#earn-profile')[0].reset();
				$("#submit_form").attr('disabled','disabled');
				$(".send-info").html(data.message);
			}
			if(data.insert_status==1){
				$('#earn-profile')[0].reset();
				$("#submit_form").attr('disabled','disabled');
				$(".send-info").html(data.message);
				setTimeout(function() {
                        window.location.href = "/investor"
                    }, 1500);
  			}
			if(data.error=='' && data.session==1){
			 $('#signinModal').modal('toggle');
			}else{
				$.each(data.error, function(key, item) {
				$("."+key).html(item);  
				});
			}
			
           }
         });
});