
	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Entrepreneur Profiles</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('ownbusiness/add'); ?>" class="btn btn-info mb-0 mblock-btn">Outsource a Project</a>
					<a href="<?php echo base_url('franchise/add'); ?>" class="btn btn-info mb-0 mblock-btn">Offer a Franchise</a>
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
							if(!empty($_GET['industry']))
							?>
							<select name="industry[]" id="e2_2" multiple="multiple" class="e2_2aaa mb-5" style="width:100%" tabindex="-1">
							<?php

							foreach($industries as $ind){ ?>
							<option  value="<?php echo $ind['id']; ?>" <?php if(!empty($_GET['industry'])){$marks = $_GET['industry'];
							if (in_array($ind['id'], $marks)){  echo "selected";  } }?>><?php echo $ind['industry']; ?></option>
							<?php } ?>
							</select>
							<script>
							$(document).ready(function() { 
							$(".e2_2aaa").select2({
							placeholder: "Search by Industry"
							});});
							</script>	
							
							
														<label>Location</label>
						<div class="row">
									<div class="col-xs-12">
									<input type="text" name="location" class="geocomplete form-control" value="<?php if(!empty($_GET['location'])){ echo $_GET['location']; }  ?>"  placeholder="Location" />
								<div style="display:none" class="map_canvas">
								</div>
								</div>
						</div>
	
					<label>Budget
					<select name="currency" class="form-control sub-dw pull-right">
					<option value="">Select Currency</option>			
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='INR'){ echo "selected";}} ?>  value="INR">India</option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='USD'){ echo "selected";}} ?> value="USD">U.S. Dollar</option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='EUR'){ echo "selected";}} ?> value="EUR">European Euro</option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='JPY'){ echo "selected";}} ?> value="JPY">Japanese </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='GBP'){ echo "selected";}} ?> value="GBP">British Pound </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='CHF'){ echo "selected";}} ?> value="CHF">Swiss Franc </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='CAD'){ echo "selected";}} ?> value="CAD">Canadian Dollar </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='AUD'){ echo "selected";}} ?> value="AUD">Australian </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='ZAR'){ echo "selected";}} ?> value="ZAR">South African Rand </option>
								</select>
								
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input type="text" name="min_budget" class="form-control" value="<?php if(!empty($_GET['min_budget'])){ echo $_GET['min_budget']; }  ?>"  placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input type="text" name="max_budget" class="form-control" value="<?php if(!empty($_GET['max_budget'])){ echo $_GET['max_budget']; }  ?>"  placeholder="max" />
								</div>
							</div>
							
							
							
							<p class="mt-20">
							<a href="<?php echo base_url('skill/index'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
					</div>
				</div>
				<div class="col-md-9">
					<div class="ideazone-content">
						<div class="row">
						<?php 
									//echo "<pre>"; print_r($profile); 
							$profiles=$profile['profiles'];
							if(empty($profiles)){
							echo '<div class="text-center p10"> Not available. </div>';
							}
							foreach($profiles as $p){ ?>
							<div class="col-sm-6 col-md-4">
								<div class="profile-box">
									<div class="p10 ">
									<div class="mb-10 pointer" onclick="window.location.href='<?php echo base_url('skill/candidateprofile/').$p['p_id']; ?>'">
										<span >
								<?php  echo $p['name'];?>
										</span>
								<?php 
								$pid =$p['p_id'];
								$feedback = $profile['feedback'][$pid];
								if($feedback){
								$rate='';
								foreach($feedback as $fr){
									$rate = $rate + $fr['rate'];
								}
									$f_rate =  $rate / count($feedback);
								}else{
									$f_rate=0;	
								}

								?>				
										<span class="pull-right"><span class="stars" data-rating="<?php echo $f_rate; ?>" data-num-stars="5"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span></span>
									</div>
									<div class="pointer" onclick="window.location.href='<?php echo base_url('skill/details/').$p['p_id']; ?>'">
									<?php $sType =array('1'=>'Entrepreneur','2'=>'Investor','3'=>'Primary Profile','4'=>'Hobby Profile','5'=>'Mediator Profile');   ?>
									<div class="side-ribbon blue-ribbon">
										<span><?php $pType=$p['post_type'];
											echo $sType[$pType];?></span>
									</div>
									<div class="mb-10">
										<div class="gray-text">Industry</div>
										<div class="dark-text">
										<?php echo $p['industry_name']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Location</div>
										<div class="dark-text">
			<?php $locations_decode = array_filter(json_decode($p['location'])); 
	foreach($locations_decode as $key=>$val){ 	echo $val.'<br>'; } ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Experience</div>
										<div class="dark-text"><?php echo $p['experience']; ?> Years</div>
									</div>									
									<div class="mb-10">
										<div class="gray-text">Budget</div>
										<div class="dark-text"><?php echo $p['currency']; ?> <?php echo $p['min_budget']; ?>-<?php echo $p['max_budget']; ?></div>
									</div>
									</div>
									</div>
									<div>
				<button data-toggle="modal" data-target="#viewContact_<?php echo $p['p_id']; ?>" class="btn">View Contact</button>
				<?php $pid= $p['p_id'];
								$shortlists=$profile['shortlists'][$pid];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" data-pid="<?php echo $p['p_id']; ?>" data-post_type="<?php echo $p['post_type']; ?>"><span class="shortlist_<?php echo $p['p_id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $p['p_id']; ?>" class="btn shortBtn" data-pid="<?php echo $p['p_id']; ?>" data-toid="<?php echo $p['posted_by']; ?>" data-post_type="<?php echo $p['post_type']; ?>"><span class="shortlist_<?php echo $p['p_id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $p['p_id']; ?>" class="btn " data-pid="<?php echo $p['p_id']; ?>" data-post_type="<?php echo $p['post_type']; ?>" style="display:none"><span class="shortlist_<?php echo $p['p_id']; ?>">Shortlisted</span></button>



										<?php } ?>	
									</div>
								</div>
							</div>
							
	<div id="viewContact_<?php echo $p['p_id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($p['paid'])){ ?>
					<div id="contactDetails_<?php echo $p['p_id']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $p['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $p['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $p['email']; ?>" class="link"><?php echo $p['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $p['p_id']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-post_by="<?php echo $p['posted_by']; ?>" data-postid="<?php echo $p['p_id']; ?>" data-post_type="<?php echo $p['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $p['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $p['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $p['email']; ?>" class="link"><?php echo $p['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
				<!--
				<div class="modal-footer fl-right">
					<button class="btn btn-initiate">Initiate</button>
				</div> -->
			</div>		
		</div>
	</div>
																	
							
							<?php } ?>
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	


<script>
$(".shortBtn").click(function(){
	var pid = $(this).data('pid');
	var post_type = $(this).data('post_type');
	var toid = $(this).data('toid');
	var url = "<?php echo base_url('skill/shortlistadd'); ?>";
	        
    $.ajax({
           type: "POST",
           url: url,
		   enctype: 'multipart/form-data',
		   data: {pid: pid, post_type: post_type, toid: toid},
		   dataType: 'json',
           success: function(data)
           {
            console.log(data);
			if(data.session==1){
				$('#signinModal').modal('toggle');
			}
			if(data.insert==1){
				$('#shortlist_'+pid).hide();
				$('#shortlisted_'+pid).show();
			}
           }
         });
});
</script>
<script>
$(document).ready(function() {
$('.contact-details').hide();	
$('.pay-contact-view').hide();	
$(".view-contact").click(function() {
var btn_id = $(this).data('postid'); 
$('.vc_'+btn_id).hide();		
$('.pcv_'+btn_id).show('slow');		
});
$(".buy_contact").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var n_type = 31;
    var url = "<?php echo base_url('contact/buycontact'); ?>";
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
			if(data.emptySession==1){
				$('#viewContact_'+post_id).modal('toggle'); 
				$('#signinModal').modal('toggle');	
			}else{	
			if(data.status==1){
				$('.pay_'+post_id).addClass('hide');
				$('#contactDetails_'+post_id).removeClass('hide');
			 }else{
				$('#viewContact_'+post_id).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
			} 
		}
         });
});

});
</script>
<?php $this->view('common/common-geo-location') ?>
