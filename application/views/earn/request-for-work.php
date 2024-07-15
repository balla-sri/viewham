	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Request for Work</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('earn/myrequestworks/'); ?>" class="link mt-10">View History</a>&nbsp;&nbsp;
					<button onclick="location.href='<?php echo base_url('earn/profile'); ?>';" class="btn btn-info mb-0 mblock-btn">Create Profile</button>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box">						
						<div class="content">
						
			
			<form action="<?php echo base_url('earn/reuestforworkFromsubmit') ?>" id="post-form" method="POST">
			<label>Skill Type <sup class="red">*</sup></label>
			<select style="width:100%" id="skill" class="input form-control mb-20" name="skill" placeholder="Select location">
				<option value="">Select Skill</option>
				<?php foreach($profiles as $p){ ?>
				<option myTag="<?php echo $p['post_type']; ?>" value="<?php echo $p['skill']; ?>"><?php echo $p['skill_name']; ?></option>
				<?php } ?>

			</select>
			<span class="error skill"></span>
			<label>Profile Type <sup class="red">*</sup></label>
			<select id="skill_byid" name="profile_type" class="input form-control mb-20" readonly  style="-webkit-appearance: none;">
			<option value="">Select Skill</option>
					
							</select><span class="error profile_type"></span>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
								<textarea name="description" class="input mdl-textfield__input form-control" rows="4" type="text" id="txarea1"></textarea>
								<label class="mdl-textfield__label" for="txarea1">Competitive Advantage <sup class="red">*</sup></label>
							
							</div>						
							<span class="error description"></span>
							<button type="button" id="submit_form" class="btn btn-primary sub pull-right ">Submit</button>
							

							</form>
							
							<div class="blue-box2 clearfix" id="payment-info">
								<h3>Payment Information</h3>
							<form id="coins-form" action="<?php echo base_url('earn/spendcoinds'); ?>" method="POST">	
								<div class="row">
									<div class="col-md-offset-3 col-md-8">
										<p>
										<input name="coins" type="text" class="coins-spend form-control text-center"  value="50" />
										<input id="postid" name="postid" type="hidden" class="form-control text-center" value="" />
										<span class="text-style1">Coins for "<b><span class="d-hrs">100</span></b>" Hours</span></p>
										<p class="clear text-style1">To display post: "<b>1</b>" Coins per 2 hours</span></p>										
									</div>
									<hr class="divider clearfix" />
									<p class="text-right">
										<button id="coins_form" type="button" class="btn btn-primary sub mb-0 mr-10">Pay</button>
									</p>
								</div></form>
							</div>
							<div class="blue-box2 clearfix" id="payment-update">
							<div class="row">
									<div class="col-md-offset-3 col-md-8">
									<h3> Post published </h3>
									</div>
							</div>
							
						</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
				

	
<!-- Theme JavaScript -->



<script>
$(document).ready(function() {
$('#payment-update').hide();	
    $("#skill").change(function(){ 
	var element = $(this).find('option:selected'); 
	var sel = element.attr("myTag");
	var	skill_type='Slect Skill';
	if(sel==3){
		var skill_type = 'Primary Profile';
	}else if(sel==4){
		var skill_type = 'Hobby Profile';
	}else if(sel==5){
		var skill_type = 'Meditor Profile';
	}
	$("#skill_byid").html("<option value='"+sel+"'>"+skill_type+"</option>");
           
    }); 

$(".input").bind("keyup change", function(e){   
	var key = $(this).attr('name');
	if(key=="skill"){
		$(".profile_type").html('');  	
	}
	$("."+key).html('');  
  });
$("#submit_form").click(function() {
var url = $('#post-form').attr('action');
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
		console.log(data);
		if(data.emptySession==1 && data.error==''){
		 $('#signinModal').modal('toggle');	
		}else{
			$.each(data.error, function(key, item) {
				$("."+key).html(item);  
				console.log(key);
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
		$('#post-form')[0].reset();
		$('#coins-form')[0].reset();
		$("#submit_form").removeAttr('disabled');
		$("#payment-info").slideToggle();
		$("#payment-update").slideToggle();
		window.location.href = '<?php echo base_url('earn/') ?>/requestworkdetails/'+data.postid;
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
</script>