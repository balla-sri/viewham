<?php $this->view('admin/user-header') ?>
	
	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Fundings</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('gain/reuest_funding'); ?>" class="btn btn-info mb-0 mblock-btn">Request Funding</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<a href="javascript:void()" class="filter-btn visible-xs visible-sm"><img src="images/filter.png" alt="filter"/></a>
					<div class="filter-content grey-block mb-20">
						<h4 class="text-center">Search filters</h4>
						<form>
							<label>Industry</label>
						<?php
							if(!empty($_GET['industrkey']))
							?>
							<select name="industrkey[]" id="e2_2" multiple="multiple" class="e2_2aaa mb-5" style="width:100%" tabindex="-1">
							<?php
							$CI =& get_instance();
							$industry = $CI->getindustry();

							foreach($industry as $ind){ ?>
							<option  value="<?php echo $ind['ID']; ?>" <?php if(!empty($_GET['industrkey'])){$marks = $_GET['industrkey'];
							if (in_array($ind['ID'], $marks)){  echo "selected";  } }?>><?php echo $ind['SDESC']; ?></option>
							<?php } ?>
							</select>
							<script>
							$(document).ready(function() { 
							$(".e2_2aaa").select2({
							placeholder: "Search by Industry"
							});});
							</script>		
							
						<label>Location</label>
					<input type="text" class="geocomplete form-control mb-5" placeholder="Search by Location" title="">	
					  <div style="display:none" class="map_canvas"></div>								
						<label>Investment
						<select name="currency_id" class="form-control sub-dw pull-right">
					<option value="">Select Currency</option>			
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='INR'){ echo "selected";}} ?>  value="INR">India</option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='USD'){ echo "selected";}} ?> value="USD">U.S. Dollar</option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='EUR'){ echo "selected";}} ?> value="EUR">European Euro</option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='JPY'){ echo "selected";}} ?> value="JPY">Japanese </option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='GBP'){ echo "selected";}} ?> value="GBP">British Pound </option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='CHF'){ echo "selected";}} ?> value="CHF">Swiss Franc </option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='CAD'){ echo "selected";}} ?> value="CAD">Canadian Dollar </option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='AUD'){ echo "selected";}} ?> value="AUD">Australian </option>
					<option <?php if(!empty($_GET['currency_id'])){ 
					if($_GET['currency_id']=='ZAR'){ echo "selected";}} ?> value="ZAR">South African Rand </option>
								</select>
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="min_amount" type="text" class="form-control" value="<?php if(!empty($_GET['min_amount'])){ echo $_GET['min_amount']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="max_amount" type="text" class="form-control" value="<?php if(!empty($_GET['max_amount'])){ echo $_GET['max_amount']; }  ?>" placeholder="max" />
								</div>
							</div>	
							
							<label>Share
					
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="min_share" type="text" class="form-control" value="<?php if(!empty($_GET['min_share'])){ echo $_GET['min_share']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="max_share" type="text" class="form-control" value="<?php if(!empty($_GET['max_share'])){ echo $_GET['max_share']; }  ?>" placeholder="max" />
								</div>
							</div>						
							
							<p class="mt-20">
							<a href="<?php echo base_url('gain/fundingsList'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
						</div>
				</div>
				<div class="col-md-9">
					<div class="ideazone-content">
					
<div class="row">
							
							<?php //print_r($funduing);
							foreach($funduing as $f) {
								?>
							<div class="col-sm-6 col-md-4">
								<div class="profile-box pointer" >
								<div class="p10" onclick="location.href='<?php echo base_url('gain/fundingdetails/').$f['ID']; ?>';">
											<div class="mb-10">
												<span><?php 
												$ind= $f['CREATED_BY'];
									$CI =& get_instance();
									$us = $CI->Userdeatail($ind);
									echo $us['NAME']; 

												?></span>
												<span class="pull-right"></span>
											</div>
							<div class="mb-10">
								<div class="gray-text">Industry</div>
								<div class="dark-text">
								<?php $ind = $f['INDUSTRY_ID']; $CI =& get_instance();
								$indst = $CI->Industry($ind);
								echo $indst['SDESC']; ?>
								</div>
							</div>
							<div class="mb-10">
								<div class="gray-text">Location</div>
								<div class="dark-text">
								<?php $locations_decode = json_decode($f['location']); 
	foreach($locations_decode as $key=>$val){ 	echo $val.'<br>'; } ?>
								
								</div>
							</div>
							<div class="mb-10">
								<div class="gray-text">Approx Investment</div>
								<div class="dark-text"><?php echo $f['CURRENCY_ID']; ?>  <?php echo $f['MIN_AMOUNT']; ?> - <?php echo $f['MAX_AMOUNT']; ?></div>
							</div>
							<div class="mb-10">
								<div class="gray-text">Approx Share</div>
								<div class="dark-text"> <?php echo $f['SHARE_MIN']; ?>% - <?php echo $f['SHARE_MAX']; ?>%</div>
							</div>
											</div>
								
								<div>
				<button class="btn" >View Contact</button>
	<?php $CI =& get_instance();
	$shortlist = $CI->inivests($f['ID'],'Funding Requests'); 
	if($shortlist){ ?>
	<button class="btn" >Invested</button>	
	<?php }else{ ?>
			<button class="btn" data-toggle="modal" data-target="#fundingInvest_<?php echo $f['ID']; ?>">Invest</button>
	<?php } ?>	
											</div>
										</div>
									</div>



<div id="fundingInvest_<?php echo $f['ID']; ?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">		
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Funding Invest Project</h5>
					</div>
					<div class="modal-body">
					<h6>Description</h6>
						<p><?php echo $f['DESCRIPTION']; ?></p>
						<h6>Industry</h6>
						<p><?php
	$ind = $f['INDUSTRY_ID'];
	$CI =& get_instance();
	$indst = $CI->Industry($ind);
	echo $indst['SDESC'];
	?></p>
						<h6>Current Status</h6>
						<p><?php if($f['STATUS']==1){
							echo "Idea Stage";
						} else if($f['STATUS']==2){
							echo "Go to Market Stage";
						}else if($f['STATUS']==3){
							echo "Revenue Stage";
						} ?></p>
						<h6>Location</h6>
						<p><?php echo $f['location']; ?></p>
						<ul class="investment list-unstyled">
							<li>Approx Investment Expected <br> <span><?php echo $f['CURRENCY_ID']; ?>  <?php echo $f['MIN_AMOUNT']; ?> - <?php echo $f['CURRENCY_ID']; ?> <?php echo $f['MAX_AMOUNT']; ?></span></li>
							<li>Approx Share Offered <br> <span><?php echo $f['SHARE_MIN']; ?>% - <?php echo $f['SHARE_MAX']; ?>%</span></li>
						</ul>
						<h6>Role Expected from Investor</h6>
						<p><?php echo $f['EXPECTED_ROLE']; ?></p>
						<h6>View Details</h6>
					<p><b>Name:</b> <?php $ind= $f['CREATED_BY'];								
									$CI =& get_instance();
									$us = $CI->Userdeatail($ind);
									echo $us['NAME'];?><br />
						   <b>Mobile:</b> <?php echo $us['MOBILENO'];?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $us['EMAIL'];?>" class="link"><?php echo $us['EMAIL'];?></a></p>
					</div>
					<div class="modal-footer fl-right">

						<button data-postid="<?php  echo $f['ID']; ?>" data-industry="<?php  echo $f['INDUSTRY_ID']; ?>" data-post_by="<?php  echo $f['CREATED_BY']; ?>" data-post_type="Funding Requests"  class="btn btn-initiate invest-store">Invest</button>
					</div>
				</div>		
			</div>
		</div>									
									
										
									
							
							<?php } ?>
							
							
									
							
						</div>					</div>
				</div>
			</div>
		</div>
	</section>
	
<!-- jQuery -->

<!-- MsgModal Modal -->
<div id="MsgModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-sm">
			
				<!-- Modal content-->
			<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						
					</div>
					<div class="modal-body">
					
						<div class="msgs"></div>
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			
				</div>
			</div>



<?php $this->view('home-footer') ?>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script>
	$(".invest-store").click(function(){
	var pid = $(this).data('postid');
	var post_type = $(this).data('post_type');
	var industry = $(this).data('industry');
	var toid = $(this).data('post_by');
	var url = "<?php echo base_url('gain/investall'); ?>";
	$.ajax({
	type: "POST",
	url: url,
	enctype: 'multipart/form-data',
	data: {
	pid: pid, post_type: post_type, toid: toid, industry: industry},
	dataType: 'json',
	success: function(data)
	{
	console.log(data);
	if(data.insert==1){
	$('#fundingInvest_'+ pid).modal('toggle');
	$(".modal-backdrop.fade.in").css("display","none");
	$('.msgs').html('<p class="">Successfully Initiateed</p>')
	$('#MsgModal').modal('toggle');
	setTimeout(function () {
                    window.location.reload();
                 }, 1500);
	}
	else if(data.insert==2){
	$('#fundingInvest_'+ pid).modal('toggle');
	$('.msgs').html('<p class="">Oops Wrong Please try again later</p>')
	$('#MsgModal').modal('toggle');
	}
	}
	});
	});
	</script> 
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkEI8rKWdBKImwigXUrdW-O8eRolZayYA&libraries=places" ></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<script>
$(function(){
$(".geocomplete").geocomplete({
map: ".map_canvas"
});
});
</script>