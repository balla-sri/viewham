$(".input").bind("keyup change", function(e){   
	var key = $(this).data('attr');
	if(key=='min_as_employee' || key=='max_as_employee'){
		$(".employee").html('');  
	}
	if(key=='min_as_partner' || key=='max_as_partner'){
		$(".share").html('');  
	}
	$("."+key).html('');  
	
  });	
$(".input").bind("keyup change", function(e){   
var baseurl = $('#earn-profile').attr('action');
var keyfield = $(this).data('attr');
var url = baseurl+'mediatorformvalidation';
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
			}  
				$.each(data.error, function(key, item) {
				if(key==keyfield || key=="employee"|| key=="share"){
				$("."+key).html(item); 
					}	  
				});
           }
         });
});



$(".submit_form").click(function(){
var baseurl = $('#earn-profile').attr('action');
var url = baseurl+'mediatorFormSubmit';
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
			  console.log(data);
			 if(data.exist==1){
				$('#earn-profile')[0].reset();
				$(".send-info").html(data.message);
			}   
			if(data.insert_status==1){
				$('#earn-profile')[0].reset();
				$(".send-info").html(data.message);
				    setTimeout(function() {
						window.location.href = baseurl+'mediator/';
                    }, 1000);
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
 function handleChange(input) {
    if (input.value < 0) input.value = 0;
    if (input.value > 100) input.value = 100;
  }
  $("#option-1").click(function(){
    
	$(".asempss").hide();
});	
$("#option-2").click(function(){
    
	$(".asempss").show();
});
function AlphabetsOnly(txt, e) {
            var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
            var code;
            if (window.event)
                code = e.keyCode;
            else
                code = e.which;
            var char = keychar = String.fromCharCode(code);
            if (arr.indexOf(char) == -1)
                return false;
            
}
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
	   $(".submit_form").click();
      return false;
    }
  });
});	