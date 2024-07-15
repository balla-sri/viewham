	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Establish Own Business</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('ownbusiness/myownBusinessideas'); ?>" class="btn btn-info mb-0 mblock-btn">Establish Business</a>
				</div>
			</div><?php if($idea){ if($idea['POSTED_BY']!=$user['ID']){
					redirect('businessideas/');
			}} ?>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box">	
			<div class="content">
			<form method="post" id="establish-business" action="<?php echo base_url('ownbusiness'); ?>">					
					<?php // echo "<pre>";print_r($ownidea); ?>	
						<label>Industry <sup class="red">*</sup></label>
						<select style="width:100%" id="industry" name="industry" class="input e2_2ss demo-default" placeholder="Select Industry" >
							<option value="">Select a Industry...</option>
								<?php foreach($industries as $p){ ?>
									<option value="<?php echo $p['id']; ?>" <?php if(isset($ownidea[ 'industry'])){if($ownidea[ 'industry']==$p[ 'id']){echo "selected";}}?>>
										<?php echo $p['industry']; ?>
									</option>
									<?php } ?>
							</select>
						<span class="error industry"></span>		
		            
							<label class="mt-20" for="txarea1">Business Vision/Project Description <sup class="red">*</sup></label>
							<textarea class="input content2 mdl-textfield__input form-control" rows="4" name="description" type="text" id="description"><?php echo $ownidea['description']; ?></textarea>	
						<span class="error description"></span>								
							<label style="margin-top: 12px;">Current Status <sup class="red">*</sup></label>
							<?php $c_status=array("1"=>"Idea Stage", "2"=>"Go to Market Stage", "3"=>"Revenue Stage"); ?>
							
						<select name="idea_status" class="input form-control mb-10">
						<?php foreach($c_status as $key=>$val){ ?>
						<option value="<?php echo $key; ?>" <?php if(isset($idea['current_status'])){if($idea[ 'current_status']==$key){echo "selected";}}?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						<span class="error idea_status"></span>	
								
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
							<label for="loc1">Location <sup class="red">*</sup> </label>
								<div class="geo_locations row">	
								<div class="col-md-11"><input id="location" name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
								<div style="display:none" class="map_canvas"></div>
								</div>
								<div class="col-md-1">
								<span id="showsquareee"><i class="fa fa-plus-circle">Add</i></span>
								</div>
						</div>
						<div id="geo_locations" class="location-all">
						<?php if(!empty($ownidea['location'])){
						$loc = json_decode($ownidea['location']);
						foreach($loc as $key=>$val){?>
						<div class="geo_locations">
						<input type="hidden" name="location[]" value="<?php echo $val; ?>"><span><?php echo $val; ?></span>
						<span class="closesquare">
						<i class="fa fa-times-circle"></i></span>
						</div>
						<?php } } ?>
						</div>
									<span class="error location"></span>
							</div>	

						<label class="mt-20">Required Resources <sup class="red">*</sup></label>
							
			<div class="md-checkbox md-checkbox-inline click-blk1">
			<input id="sc" type="checkbox" name="skill" checked >
			<label for="sc">Skilled Candidates</label>
			</div>
			<div id="field0qq" class="grey-form-box hide-show-blk1">
					
	<select name="resource[]" id="e2_2" multiple="multiple" class="e2_2aaa mb-5" style="width:100%" tabindex="-1">
                                            <?php foreach($skills as $skill){ ?>
                                                    <option value="<?php echo $skill['id']; ?>">
                                                        <?php echo $skill['skill']; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>
							
							</div>
						
								
							
							<div>
						<div class="md-checkbox md-checkbox-inline click-blk2">
						<input name="investor" id="investor" type="checkbox" <?php if($ownidea){ if($ownidea['investor'] == 'on'){ echo "checked"; }} ?>>
						<label for="investor">Investor <?php echo $ownidea['investor']; ?></label>
						</div>
								<div class="grey-form-box hide-show-blk2" <?php  if($ownidea['investor'] != 'on'){ ?>   style="display:none;" <?php  }  ?> >
									<div class="row">
										<div class="col-md-4 text-right">
											<label class="mt-30">Approx Investment Expected:</label>
										</div>
										<div class="col-md-8">
											<select name="currency" class="form-control w-120">
												
									<option value="INR" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='INR' ){echo "selected";}}?>>India(₹)</option>
									<option value="USD" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='USD' ){echo "selected";}}?>>U.S. Dollar($)</option>
									<option value="EUR" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='EUR' ){echo "selected";}}?>>European Euro(€)</option>
									<option value="JPY" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='JPY' ){echo "selected";}}?>>Japanese (¥)</option>
									<option value="GBP" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='GBP' ){echo "selected";}}?>>British Pound (£)</option>
									<option value="CHF" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='CHF' ){echo "selected";}}?>>Swiss Franc (SFr)</option>
									<option value="CAD" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='CAD' ){echo "selected";}}?>>Canadian Dollar (C$)</option>
									<option value="AUD" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='AUD' ){echo "selected";}}?>>Australian (A$)</option>
									<option value="ZAR" <?php if(isset($idea[ 'currency'])){if($idea[ 'currency']=='ZAR' ){echo "selected";}}?>>South African Rand (R)</option>
											</select>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
									<input name="min_invest" class="mdl-textfield__input" type="text" value="<?php if(isset($ownidea['min_invest'])){echo $ownidea['min_invest'];}?>" id="min1">
									<label class="mdl-textfield__label" for="min1">Min</label>
								</div><span>-</span>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
									<input name="max_invest" class="mdl-textfield__input" type="text" value="<?php if(isset($ownidea['max_invest'])){echo $ownidea['max_invest'];}?>" id="">
									<label class="mdl-textfield__label" for="max1">Max</label>
								</div>
							</div>
									</div>
									<div class="row">
										<div class="col-md-4 text-right">
											<label class="mt-30">Approx Share Offered:</label>
										</div>
										<div class="col-md-8">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
										<input name="min_share" class="mdl-textfield__input" type="text" value="<?php if(isset($ownidea['min_share'])){echo $ownidea['min_share'];}?>">
										<label class="mdl-textfield__label" for="min1">Min %</label>
											</div><span>-</span>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
									<input name="max_share" class="mdl-textfield__input" type="text" value="<?php if(isset($ownidea['max_share'])){echo $ownidea['max_share'];}?>">
												<label class="mdl-textfield__label" for="max1">Max %</label>
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-4 text-right">
									<label class="mt-30">Role Expected from Investor:</label>
										</div>
				<div class="col-md-8">
				<select  placeholder="Select Role" class="combobox2 w-120 mt-20 xs-mt-5" name="investor_role" >
				<option value=''>Select Role</option>
				<option value="1">As a Sleeping Partner</option>
				<option value="2">As a Strategic Partner</option>
				<option value="3">As a Co-Founder</option>
				<option value="4">As a Financiar</option>
				<option value="5">As a Mentor</option>
				<option value="6">Other</option>
							</select>	
					
		 						
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="md-checkbox md-checkbox-inline">
									<input id="consultant" name="consultant" type="checkbox" <?php if($ownidea){ if($ownidea['consultant'] == 'on'){ echo "checked";} } ?>>
									<label for="consultant" >Consultant</label>
									<!--<label for="consultant" data-toggle="modal" data-target="#consultantModal">Consultant</label>-->
								</div>
							</div>
							<div>
								<div class="md-checkbox md-checkbox-inline">
									<input id="mentor" name="mentor" type="checkbox" <?php if($ownidea){ if($ownidea['mentor'] == 'on'){ echo "checked";} } ?>>
									<label for="mentor" >Mentor</label>
									<!--<label for="mentor" data-toggle="modal" data-target="#mentorModal">Mentor</label>-->
								</div>
							</div>
							
							<button type="button" id="submit_form" class="btn btn-primary sub pull-right sumbit-btn">Submit</button>
							</form>
						<div class="blue-box2 clearfix" id="payment-info">
						<h3>Payment Information</h3>
						<form id="coins-form" action="<?php echo base_url('ownbusiness/spendcoinds'); ?>" method="POST">	
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
	
<!-- jQuery -->


<div id="consultantModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
	<div class="modal-content">
		<div class="modal-body">
			<p class="sentmsg"></p>
		</div>
	</div>
	</div>
</div>
<div id="mentorModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
	<div class="modal-content">
		<div class="modal-body">
			<p>Your Mentor request has been sent</p>
		</div>
	</div>
	</div>
</div>
<script>
$('.e2_2aaa').selectize({});
$('.combobox2').selectize({});
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
		$('#establish-business')[0].reset();
		$('#coins-form')[0].reset();
		$("#submit_form").removeAttr('disabled');
		$("#payment-info").slideToggle();
		$("#payment-update").slideToggle();
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
		items: ['Bold', 'Italic', 'Underline']
	}, {
		name: 'paragraph',
		items: ['NumberedList', 'BulletedList']
	},

]
});
</script>
<?php $this->load->view('common/common-geo-location'); ?>
<style> 
div#mceu_13-body {
    display: none;
}
</style> 
