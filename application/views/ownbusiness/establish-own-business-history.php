	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">My Offer Works</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('ownbusiness/add'); ?>" class="btn btn-info mb-0 mblock-btn">Add Own Business</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box p-0">						
						<div class="content p-lr-5">
						<?php 
						foreach($ownideas as $work){?>
						
						<div class="row h-line">
								<div class="col-md-6">
									<h6 class="mt-0">Skill</h6>
									<p>
						<?php  echo $work['industry_name']; ?>
								</p>
									<h6>Project Description</h6>
									<div><?php							
										echo $string = substr($work['description'],0,200);
									
									?></div>
									
									
									
								<a href="<?php echo base_url('ownbusiness/details/').$work['id']; ?>">see more</a>
									
								</div>
								<div class="col-md-5 col-md-offset-1" style="margin-bottom:10px">
									
								<div class="blue-box2 clearfix" id="payment-info_<?php echo $work['id'];?>">
								
								<?php
								$now = date("Y-m-d H:i:s");
								$publish_start_date = $work['publish_start_date'];
								$hrs = $work['coins']*2;
								$valid_time = date("Y-m-d H:i:s", strtotime('+'.$hrs.' hours',strtotime($publish_start_date)));								
								if($now <= $valid_time){ ?>
								<div class="row">
									<div class="text-center col-md-12">
									<h3> Published </h3>
									 <?php
									$Date = $work['publish_start_date'];
									$days = $work['days'];
									echo date('d-F-Y H:i:s', strtotime($Date)).'&nbsp To &nbsp'.date('d-F-Y H:i:s', strtotime($Date. ' + '.$days.' hours')); ?>
								</div>	
								</div>	
								<?php }else{ ?>
								<div class="pay_<?php echo $work['id'];?>">
								<h3>Payment Information</h3>
								<form id="coins-form_<?php echo $work['id']; ?>" action="<?php echo base_url('ownbusiness/spendcoinds'); ?>" method="POST">	
								<div class="row">
									<div class="col-md-12 text-center">
										<p><input name="coins" data-id="<?php echo $work['id']; ?>" type="text" class="coins-spend form-control text-center" value="50" /> <span class="text-style1">Coins for "<b><span class="d-hrs-<?php echo $work['id']; ?>">100</span></b>" Hours</span></p>
										<p class="clear text-style1">To display post: "<b>1</b>" Coins per 2 Hours</span></p>
									<input id="postid" name="postid" type="hidden" class="form-control text-center" value="<?php echo $work['id']; ?>" />										
									</div>
									<hr class="divider clearfix" />
									<p class="text-right">
										<button data-id="<?php echo $work['id']; ?>" type="button" class="coins_form btn btn-primary sub mb-0 mr-10">Pay</button>
									</p>
								</div>
								</form>
								</div>
								<div class="row publish publish_<?php echo $work['id'];?>">
									<div class="text-center col-md-12">
									<h3> Published </h3>
									<div class="html_<?php echo $work['id'];?>"> </div>
								</div>	
								</div>
								<?php } ?>
							
							
							</div>
					</div>
							</div>
						<hr>
							<?php } ?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<script>
$(".coins_form").click(function(){
var id =$(this).data('id');
var formm = $('#coins-form_'+id)[0];
var url = $('#coins-form_'+id).attr('action');
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
		$('#coins-form_'+id)[0].reset();
		$(".pay_"+id).slideToggle();
		$(".publish_"+id).slideToggle();
		$(".html_"+id).html(data.html);
	 }
 }
});
});
$(document).ready(function() {
$('.publish').hide();	
});

$('.coins-spend').keyup(function() {
	var id =$(this).data('id');	
    var hrs = $(this).val()*2;
	$('.d-hrs-'+id).html(hrs);
  if(!hrs){
 	$("#coins_form").attr('disabled','disabled');
  }else{
	 $("#coins_form").removeAttr('disabled'); 
  }
  

});
</script>
<style>
.h-line{
	border-bottom: 1px solid #57a9f7;
}</style>