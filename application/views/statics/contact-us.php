<section class="knowmore-box"> 
			<div class="container static form-box">
			
			<div class="content white-box">
			<form action="" method="post" id="post-Register">
				<div class="col-md-6 ">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
					<input type="text" class="mdl-textfield__input" id="name" name="name" >
					

					<label class="mdl-textfield__label" for="title">Name <sup class="red">*</sup></label>
				</div>		
				</div>
				<div class="col-md-6 ">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
					<input type="number" class="mdl-textfield__input" id="phone" name="phone" >
					<label class="mdl-textfield__label" for="title">Phone Number <sup class="red">*</sup></label>
				</div>		
				</div>
				<div class="col-md-6 ">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
					
					<textarea  onkeyup="textAreaAdjust(this)" rows="3" class="mdl-textfield__input" id="message" name="message" ></textarea>

					<label class="mdl-textfield__label" for="title">Message <sup class="red">*</sup></label>
				</div>		
				</div>
				<div class="col-md-6 ">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
					<input type="email" class="mdl-textfield__input" id="email" name="email" >
					<label class="mdl-textfield__label" for="title">Email <sup class="red">*</sup></label>
				</div>	
<button type="button" id="submit_form" class="btn btn-primary">send</button>	
<div id="message-success"></div>			
				</div>
				
					
				
				</form>
			</div>
			</div>
		</section>	
	
<script>

function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (25+o.scrollHeight)+"px";
}
$("#submit_form").click(function(){
    var name=$('#name').val().trim();	
    var email=$('#email').val().trim();	
    var message=$('#message').val().trim();	
    var phone=$('#phone').val().trim();	
    if((!name) || (!message) || (!email) || (!phone))
    {
        var fields = [];
        if(!name){
            fields.push("name");
        }
        if(!email){
            fields.push("email");
        }
        if(!phone){
            fields.push("phone");
        }
        if(!message){
            fields.push("message");
        }
        $(fields).each(function (index, value) { 
            $('#'+value).addClass('error-contact');
        });
 
        return false;
    } 	
    var url = "<?php echo base_url()?>welcome/ContactUs";
    var data = $("#post-Register").serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function(data)
        {
            $('#post-Register')[0].reset();
            $('#message-success').html('<div class="alert alert-success">'+data.message+'</div>')
        }
    });
});
</script>			
<style>								
.error-contact {
    border: solid 2px red !important;
}
</style>								