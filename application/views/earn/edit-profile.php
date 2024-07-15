 <link href="<?php echo base_url('/assets/vendor/font-awesome/css/earn_editprofile.css'); ?>" rel="stylesheet" type="text/css">
 <section class="ideazone"> 
		<div class="container">
			<div class="row mb-10 hidden-sm hidden-xs">
				<div class="col-md-6">
					<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
					  <li class="breadcrumb-item active"><a href="<?php echo base_url('earn/'); ?>">Earn</a></li>
					  
					</ol>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('earn/reuestforwork/'); ?>"><button class="btn btn-info mb-0 mblock-btn">Request For Work</button></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
				<?php $this->load->view('common/common-left-menu'); ?>
		        <!-- Left Menu End-->
                    <button class="btn btn-info mb-10 mblock-btn visible-xs visible-sm">Request For Work</button>
					<!-- Left white Panel End -->
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-7">
							<!-- Middle Panel1 Start -->
							<?php if(!empty($proposals)){ ?>
							
							<div class="panel panel-default earnPanel">
							  <div class="panel-heading">Proposals</div>
							  <div class="panel-body">
								<ul>
								<?php foreach($proposals as $pr){ ?>
				<li>
				<div class="row">
					<div class="col-md-6">
						<p><span class="title">
						<?php echo $pr['name']; ?>
						
						</span> <span class="date"><?php echo $pr['created_on']; ?></span></p>
						<p>Have requirement for <?php echo $pr['skill']; ?></p>
					</div>
				<div class="col-md-6 mt-10 text-right mText-left">
					<button class="btn btn-primary" data-toggle="modal" data-target="#viewContact_<?php echo $pr['id']; ?>">View Contact</button>
<?php 
	$count = '';
	if($count){ ?>
		<button  id="shortlisted_<?php echo $pr['post_id']; ?>" class="btn btn-gray disabled" data-toggle="tooltip" data-placement="top" data-html="true" data-title="Your interest has been sent">Interested</button>
	<?php }else{
?>					
<a id="shortlist_<?php echo $pr['post_id']; ?>" class="btn btn-primary mb-0 btn-md shortBtn" data-url="<?php echo base_url('contact/interest/'); ?>"  data-postid="<?php echo $pr['post_id']; ?>" data-postedby="<?php echo $pr['from_id']; ?>" data-post_type="10" data-skillid="<?php echo $pr['skill_id']; ?>">Interest</a>
<button style="display:none" id="shortlisted_<?php echo $pr['post_id']; ?>" class="btn btn-gray disabled" data-toggle="tooltip" data-placement="top" data-html="true" data-title="Your interest has been sent">Interested</button>
	<?php } ?>					
					
				
				</div>
										</div>
									</li>
									
<div id="viewContact_<?php echo $pr['id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($pr['paid'])){ ?>
					<div id="contactDetails_<?php echo $pr['id']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $pr['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $pr['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $f['email']; ?>" class="link"><?php echo $pr['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $pr['id']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-nid="<?php echo $pr['id']; ?>" data-post_by="<?php echo $pr['buyerid']; ?>" data-postid="<?php echo $pr['post_id']; ?>" data-post_type="10" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $pr['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $pr['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $pr['email']; ?>" class="link"><?php echo $pr['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
			</div>		
		</div>
	</div>
									
									
										<?php } ?>
									
				<p class="text-center"><a href="#" class="link visible-xs visible-sm mb-20"><i class="fa fa-arrow-down"></i></a></p>
								</ul>
							  </div>
							</div>
							<!--<p class="text-right"><a href="#" class="link visible-xs visible-sm mb-20">See More...</a></p>-->
							<!-- Middle Panel1 End -->
							<!-- Middle Panel2 End -->
							
							<?php }else{ ?>
							<div class="panel panel-default earnPanel">
							  <div class="panel-heading">Lorem Ipsum</div>
							  <div class="panel-body">
								<ul class="noBG">
									<li>
										<h4>Idea Title</h4>
										<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe molestias sed tempore.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe molestias sed tempore.</p>
									</li>
									<li>
										<h4>Description</h4>
										<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe molestias sed tempore.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe molestias sed tempore.</p>
									</li>
								</ul>
								
							  </div>
							</div>
							
							<!-- Middle Panel2 End -->
							<?php } ?>
						</div>
						<div class="col-md-5">
							<!-- Right Panel1 Start -->
							<div class="panel panel-default sidePanel">
							  <div class="panel-heading">Trust Factor <span class="pull-right">
							  <span class="stars" data-rating="3" data-num-stars="5" ></span>
							  <!--<input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="3" />--></span></div>
							  <div class="panel-body">
								<div class="panel-group mb-0" id="accordion2" role="tablist" aria-multiselectable="true">
								  <div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
									  <h4 class="panel-title">
									  <?php $g_rate=($m_rate+$e_ratef)/2; ?>
										<a class="" role="button" style="color:white" data-toggle="collapse" data-parent="#accordion2" href="#p1" aria-expanded="true" aria-controls="collapseOne">
										  General Trust Factor &nbsp;<span class="stars" data-rating="<?php echo round($g_rate, 2); ?>" data-num-stars="5" ></span>
										</a>
									  </h4>
									</div>
									<div id="p1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									  <div class="panel-body">
										<ul class="list-group">
										  <li class="list-group-item">
											<div class="row font-sm">
												<div class="col-xs-4">Mobile</div>
												<div class="col-xs-4 text-center">
											<?php if($user['mobile_authenticated']==1){ ?>
											<span class="verified">Verified</span>
											<?php }else{?>
											<span class="not-verified">Not Verified</span>
											<?php } ?>
											</div>
												<div class="col-xs-4 text-right">
												<a  class="edit-mobile link font-sm">Edit</a>
												<a  class="view-mobile link font-sm" style="display:none">View</a>
												</div>
											</div>
											<div class="row">
										<div class="mobile-view">		
										<div class="col-xs-6">+91 
										<span><?php echo $user['mobile']; ?></span>
										</div>
										<div class="col-xs-6 text-right"><span class="stars" data-rating="<?php echo $m_rate; ?>" data-num-stars="5" ></span></div>
										</div>
										<div class="mobile-edit" style="display:none">		
										<div class="col-xs-6">
										
										<input type="text" value="<?php echo $user['mobile']; ?>" id="mobile-no" class="form-control" placeholder="Mobile no">
										<a class="get-otp link">Get OTP</a>
										<a class="OTP-Sent link"></a>
										</div>
										<div class="col-xs-6">
										<input type="text" class="otp-verify form-control" placeholder="OTP">
										<a class="otp-submit link">Submit OTP</a>
										</div>
										</div>
											</div>
										  </li>
										  <li class="list-group-item">
											<div class="row font-sm">
												<div class="col-xs-4">E-mail</div>
												<div class="col-xs-4 text-center">
									<?php if($user['email_authenticated']==1){  ?>
											<span class="verified">Verified</span>
											<?php }else{ ?>
											<span class="not-verified">Not Verified</span>
											<?php } ?>
												</div>
												<div class="col-xs-4 text-right">
												<a  class="edit-email link font-sm">Edit</a>
												<a  class="view-email link font-sm" style="display:none">View</a>
												</div>
											</div>
											<div class="row">
										<div class="email-view">		
												<div class="col-xs-6"><?php echo $user['email']; ?></div>
												<div class="col-xs-6 text-right"><span class="stars" data-rating="<?php echo $e_ratef; ?>" data-num-stars="5" ></span></div>
												</div>
										<div class="email-edit" style="display:none">		
										<div class="col-xs-12">
										
										<input type="text" value="<?php echo $user['email']; ?>" id="email-no" class="form-control" placeholder="Email" readonly />
										<a data-verifyType="1" class="emailVerify email-sent-verification link">Get Email Verification</a>
										</div>
										
										
										</div>
											
											
											</div>
										  </li>
										</ul>
									  </div>
									</div>
								  </div>
								  
								  <?php if($skillDetails['post_type']==5){ ?>
								   <div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
									  <h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#p2" aria-expanded="false" aria-controls="collapseTwo">
										  Candidate Trust Factor &nbsp;<span class="stars" data-rating="0" data-num-stars="5" ></span>
										</a>
									  </h4>
									</div>
									<div id="p2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									  <div class="panel-body">
										<ul class="list-group">
											<li class="list-group-item">
												<div class="row font-sm">
													<div class="col-xs-12">Name</div>
												</div>
												<div class="row">
													<div class="col-xs-12"><?php echo $skillDetails['candidate']; ?></div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="row font-sm">
													<div class="col-xs-4">Mobile</div>
													<div class="col-xs-4 text-center">
													<?php if($skillDetails['r_mobile_auth']==1){ 
												$r_mRate=5;	?>
											<span class="verified">Verified</span>
											<?php }else{ 
											$r_mRate=0; ?>
											<span class="r_not-verified not-verified">Not Verified</span>
											<?php } ?>
											</div>
													<div class="col-xs-4 text-right">
													<a  class="r_edit-mobile link font-sm">Edit</a>
													<a class="r_view-mobile link font-sm" style="display: none;">View</a>
													</div>
												</div>
												<div class="row">
												<div class="r_mobile-view">
												<div class="col-xs-6">+91 <?php echo $skillDetails['mediator_mobile']; ?></div>
												<div class="col-xs-6 text-right"><span class="stars" data-rating="<?php echo $r_mRate; ?>" data-num-stars="5" ></span></div>
													</div>
																																<div class="r_mobile-edit" style="display:none">		
										<div class="col-xs-6">
										
										<input type="text" value="<?php echo $skillDetails['mediator_mobile']; ?>" id="r_mobile-no" class="form-control" placeholder="Mobile no">
										<a class="r_get-otp link">Get OTP</a>
										<a class="r_OTP-Sent link"></a>
										</div>
										<div class="col-xs-6">
										<input type="text" class="r_otp-verify form-control" placeholder="OTP">
										<a data-postid="<?php echo $skillDetails['p_id']; ?>" class="r_otp-submit link">Submit OTP</a>
										</div>
										</div>
												
												
												
												</div>
																						
											</li>
											<li class="list-group-item">
												<div class="row font-sm">
													<div class="col-xs-4">Email</div>
													<div class="col-xs-4 text-center">
													<?php if($skillDetails['r_email_auth']==1){ 
												$r_mRate=5;	?>
											<span class="verified">Verified</span>
											<?php }else{ 
											$r_mRate=0; ?>
											<span class="not-verified">Not Verified</span>
											<?php } ?>
											</div>
											<div class="col-xs-4 text-right">
											<a  class="r_edit-email link font-sm">Edit</a>
											<a  class="r_view-email link font-sm " style="display:none">View</a>
											</div>
												</div>
												<div class="row">		
										<div class="r_email-view">		
												<div class="col-xs-6"><?php echo $skillDetails['r_email']; ?></div>
												<div class="col-xs-6 text-right"><span class="stars" data-rating="0" data-num-stars="5" ></span></div>
												</div>		
										<div class="col-xs-12 r_email-edit" style="display:none">
										
										<input type="text" value="<?php echo $skillDetails['r_email']; ?>" id="r_email" class="form-control" placeholder="Email" />
										<a data-verifyType="2" class="r_emailVerify email-sent-verification link">Get Email Verification</a>
										</div>
										
										
										</div>
																						
											</li>
										</ul>
									  </div>
									</div>
								  </div>

								  <?php }else{ ?> 
								  <div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
									<?php 
										$overall = $skiltrust['over_all']/4;
										$learn = $skiltrust['learn']/4;
										$skill_trust = ($overall+$learn)/2; 
										?>
									  <h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#p2" aria-expanded="false" aria-controls="collapseTwo">
										  Skill Trust Factor &nbsp;<span class="stars" data-rating="<?php echo $skill_trust; ?>" data-num-stars="5" ></span>
										</a>
									  </h4>
									</div>
									<div id="p2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									  <div class="panel-body">
										<ul class="list-group">
										
										
										  <li class="list-group-item">Learn Participation <span class="glyphicon glyphicon-info-sign info" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="some content"></span> <span class="pull-right"><span class="stars" data-rating="<?php echo $learn;  ?>" data-num-stars="5" ></span></span></li>
										  <li class="list-group-item">Over All Activeness <span class="glyphicon glyphicon-info-sign info" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="some content"></span> <span class="pull-right"><span class="stars" data-rating="<?php echo $overall;  ?>" data-num-stars="5" ></span></span></li>
										</ul>
									  </div>
									</div>
								  </div>
								  
								  <?php } ?>
								  <?php 

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
								  <div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
									  <h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#p3" aria-expanded="true" aria-controls="collapseOne">
										  Feedback &nbsp;<span class="stars" data-rating="<?php echo $f_rate; ?>" data-num-stars="5" ></span>
										</a>
									  </h4>
									</div>
									<div id="p3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
									  <div class="panel-body">
										<ul class="list-group scroll-v">
										 <?php if(empty($feedback)){
											 echo '<li class="list-group-item"> No Feedback</li>';
										 }
										 foreach($feedback as $f){	?>
										 <li class="list-group-item">
									<div class="row earnPanel">
									<div class="col-xs-8">
										<p class="title mb-0"><?php echo $f['name'];?></p>
										<p class="date mb-0"><?php echo $f['feedback']; ?></p>
									</div>
								<div class="col-xs-4 text-right">
								<span class="stars" data-rating="<?php echo $f['rate']; ?>" data-num-stars="5" ></span>
								</div>
									</div>
										  </li>
								<?php } ?> 
										  
										</ul>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							<!-- Right Panel1 End -->
							<!-- Right Panel2 Start -->
							<div class="panel panel-default earnPanel">
							  <div class="panel-heading">Skill Details
							  <a class="skill-details-edit pull-right">Edit</a>
							  <a class="skill-details-view pull-right" style="display:none">View</a>
							  </div>
							  <div class="view-skill-details skill-details panel-body">
								<ul class="noBG">
									<li>
										<h4>Skill Name</h4>
										<p><?php 

										echo $skillDetails['skill_name'];?></p>
									</li>
									<li>
										<h4>Related Skills</h4>
										<ul class="inline-list">
										<?php  
										$cats = json_decode($skillDetails['association']);
										$result = '';
										foreach($cats as $cat) {
										$cat = trim($cat);
										$CI =& get_instance();
										$cus = $CI->skill($cat) ; ?>
										
										<li><?php echo $cus['skill']; ?></li>
										<?php } ?>
										  
										  
										</ul>
									</li>
									<li>
										<h4>Experience</h4>
										<p><?php echo $skillDetails['experience'];
											
										?> Years</p>
									</li>
									<li>
										<h4>Locations</h4>
										<ul class="inline-list">
	<?php $locations_decode = json_decode($skillDetails['location']); 
	foreach($locations_decode as $key=>$val){ 	echo '<li>'.$val.'</li>'; } ?>
										  
										</ul>
									</li>
								<?php if($skillDetails['post_type']!='5') {?>
								<li>
										<h4>Work Timings</h4>
										<?php 
										foreach($userTimings as $ut){ ?>
										<div class="row">
											<div class="col-xs-5"><p><?php echo $ut['day']; ?></p></div>
											<div class="col-xs-7"><p><?php echo $ut['from_time']; ?> - <?php echo $ut['to_time']; ?></p></div>
										</div>
										<?php }?>
									</li>
									<?php } ?>
									<li>
										<h4>My Price</h4>
										<div class="row">
											<div class="col-xs-5">
												<p>Short Term Work</p>
												<p><?php echo $skillDetails['price']; ?> <?php echo $skillDetails['currency']; ?> / <?php echo $skillDetails['price_per']; ?></p>
											</div>
											<div class="col-xs-7">
												<p>Long Term Work</p>
												<p><?php if($skillDetails['l_term_work_option']==1){?>
													<b>Negotiable</b>
												<?php }else{?><b>Non-Negotiable</b></p>
												<p><span class="font-w500">As Employee</span> : <?php echo $skillDetails['min_as_employee']; ?> - <?php echo $skillDetails['max_as_employee']; ?> <?php echo $skillDetails['investment_currency']; ?></p>
												<p><span class="font-w500">As Partner :</span> <?php echo $skillDetails['min_as_partner']; ?> - <?php echo $skillDetails['max_as_partner']; ?> %</p><?php }?>
											</div>
										</div>
									</li>
									<li>
										<h4>Competitive Advantage</h4>
										<p><?php echo $skillDetails['competitive']; ?></p>
									</li>
									<li>
										<h4>My Portfolio</h4>
										<ul class="inline-list">
						<?php 
							$categories = '';
							$cats = json_decode($skillDetails['portfolio']);
							foreach($cats as $cat) {?>
						 <li><a style="color:blue" target="_blank" href="<?php echo base_url('uploads/profile-documents/').$cat; ?>"><?php echo $cat; ?></a></li>
							<?php } ?>
										  
										</ul>
									</li>
									<?php if($skillDetails['post_type']=='5') {?>
									<li>
										<h4><?php echo $skillDetails['mediate_type']; ?></h4>
										<div class="row">
											<div class="col-xs-6">
												<p class="font-w500">Name of candidate</p>
												<p><?php echo $skillDetails['candidate']; ?></p>
											</div>
											<div class="col-xs-6">
												<p class="font-w500">Mobile Number</p>
												<p><?php echo $skillDetails['mobile']; ?></p>
											</div>
										</div>
									</li>
									<?php }?>
								</ul>
							  </div>
							  
							  <div class="edit-skill-details skill-details panel-body" style="display:none">
		<form id="earn-profile" action="<?php echo base_url('earn/editprofileformsubmit/'.$skillDetails['p_id']); ?>" method="post" enctype="multipart/form-data">
								<ul class="noBG">
									<li>
			<h4>Skill Name </h4>
			<select id="select-industry" name="skill" class="" placeholder="Select Skill">
			<option value="">Select a skill...</option>
			<?php foreach($skills as $p){ ?>
			<option value="<?php echo $p['id']; ?>" <?php if($skillDetails['skill']==$p['id']){ echo "Selected"; } ?>>
			<?php echo $p['skill']; ?>
			</option>
			<?php } ?>
			</select>
			<script>$('#select-industry').selectize();</script>
							</li>
									<li>
										<h4>Related Skills</h4>
										
	<?php $cats = json_decode($skillDetails['association']);	?>
		<select id="select-state" name="roles[]" multiple class="mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Association Role">

		<option value="">Select a Role...</option>
		<?php foreach($skills as $p){ ?>
		<option value="<?php echo $p['id']; ?>" <?php if (in_array($p['id'], $cats)){echo 'selected="selected"'; }?>>
		<?php echo $p['skill']; ?>
		</option>
		<?php } ?>

		</select>
		<script>$('#select-state').selectize({maxItems: 5});</script>
		</li>
<li>
<h4>Experience</h4>
<select id="select-experience" name="experience" class="mb-10"  placeholder="Select Experience">

<option value="0" <?php  if($skillDetails['experience']=='0'){ echo "Selected";} ?>>Fresher</option>
<option value="1" <?php  if($skillDetails['experience']=='1'){ echo "Selected";} ?>>0-1 Years</option>
<option value="2" <?php  if($skillDetails['experience']=='2'){ echo "Selected";} ?>>1-2 Years</option>
<option value="3" <?php  if($skillDetails['experience']=='3'){ echo "Selected";} ?>>2-3 Years</option>
<option value="4" <?php  if($skillDetails['experience']=='4'){ echo "Selected";} ?>>3-4 Years</option>
<option value="5" <?php  if($skillDetails['experience']=='5'){ echo "Selected";} ?>>4-5 Years</option>
<option value="6" <?php  if($skillDetails['experience']=='6'){ echo "Selected";} ?>>5-6 Years</option>
<option value="7" <?php  if($skillDetails['experience']=='7'){ echo "Selected";} ?>>6-7 Years</option>
<option value="8" <?php  if($skillDetails['experience']=='8'){ echo "Selected";} ?>>7-8 Years</option>
<option value="9" <?php  if($skillDetails['experience']=='9'){ echo "Selected";} ?>>8-9 Years</option>
<option value="10" <?php  if($skillDetails['experience']=='10'){ echo "Selected";} ?>>More then 10 Years</option>
</select>
<script>
$('#select-experience').selectize();
</script>
</li>
									<li>
	<h4>Location </h4>
	<div class="geo_locations row">	
	<div class="col-md-9"><input name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
	<div style="display:none" class="map_canvas"></div>
	</div>
	<div class="col-md-1">
	<span id="showsquareee"><i class="fa fa-plus-circle">Add</i></span>
	</div>
	</div>
<div id="geo_locations" class="location-all">
	<?php $locations_decode = json_decode($skillDetails['location']); 
	foreach($locations_decode as $key=>$val){ ?>
	<div class="geo_locations">		
	<div><input class="geocomplete form-control" value="<?php echo $val; ?>" name="location[]" type="hidden" placeholder="Type in an address" size="90" />
	<div style="display:none" class="map_canvas"></div>
	</div>
		<span><?php echo $val; ?></span>
	<span class="closesquare"><i class="fa fa-times-circle"></i></span>
	</div>	
	<?php } ?>	
</div>		
	
		
		</li>									</li>
									
									<li>
										<h4>My Price</h4>
										<div class="row">
											<div class="col-xs-12">
												<p><b>Short Term Work</b></p>
												
											</div>
											
										</div>
										<div class="row">
										<div class="col-md-6">
										<input type="text" class="form-control" name="price" value="<?php echo $skillDetails['price']; ?>">
										</div>
				<div class="col-md-6"><select class="medium currencyintitate " name="price_per" id="price_per" required>
					<option value="Day" <?php  if($skillDetails['price_per']=='Day'){ echo "Selected";} ?>>Day</option>
					<option value="Hour" <?php  if($skillDetails['price_per']=='Hour'){ echo "Selected";} ?>>Hour</option>
					
		</select>
		<script>
			$('#price_per').selectize();
		</script></div>
									<div class="col-md-12">
									<select class="currency medium currencyintitate " name="currency" id="" required>
					<option value="INR" <?php  if($skillDetails['currency']=='INR'){ echo "Selected";} ?>>India</option>
					<option value="USD" <?php  if($skillDetails['currency']=='USD'){ echo "Selected";} ?>>U.S. Dollar</option>
					<option value="EUR" <?php  if($skillDetails['currency']=='EUR'){ echo "Selected";} ?>>European Euro</option>
					<option value="JPY" <?php  if($skillDetails['currency']=='JPY'){ echo "Selected";} ?>>Japanese </option>
					<option value="GBP" <?php  if($skillDetails['currency']=='GBP'){ echo "Selected";} ?>>British Pound </option>
					<option value="CHF" <?php  if($skillDetails['currency']=='CHF'){ echo "Selected";} ?>>Swiss Franc </option>
					<option value="CAD" <?php  if($skillDetails['currency']=='CAD'){ echo "Selected";} ?>>Canadian Dollar </option>
					<option value="AUD" <?php  if($skillDetails['currency']=='AUD'){ echo "Selected";} ?>>Australian </option>
					<option value="ZAR" <?php  if($skillDetails['currency']=='ZAR'){ echo "Selected";} ?>>South African Rand </option>
					
		</select>
		<script>
			$('.currency').selectize();
		</script>
									</div>
								
						<div class="col-xs-12">
						<p><b>Long Term Work</b></p>
						
						
						
						<div class="radio-grp">
		 <label>
      <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" <?php if($skillDetails['l_term_work_option']==1){ echo "checked"; }?>>
      <span class="mdl-radio__label">Negotiable</span>
   </label>
    <label >
      <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2" <?php if($skillDetails['l_term_work_option']==2){ echo "checked"; }?>>
      <span class="mdl-radio__label">Non-Negotiable</span>
   </label>
		<div class="non-negotiable">
		<p>As Employee</p>
		<div class="col-md-6">
		<input type="tel" class="form-control" name="min_as_employee" value="<?php echo $skillDetails['min_as_employee']; ?>"></div>
		<div class="col-md-6">
		<input type="tel" class="form-control" name="max_as_employee" value="<?php echo $skillDetails['max_as_employee']; ?>"></div>
		<p>As Partner ( % )</p>
		<div class="col-md-6">
		<input type="tel" class="form-control" name="min_as_partner" value="<?php echo $skillDetails['min_as_partner']; ?>"></div>
		<div class="col-md-6">
		<input type="tel" class="form-control" name="max_as_partner" value="<?php echo $skillDetails['max_as_partner']; ?>"></div>
										</div>
										</div>
						
						
						</div>								
								
									</li>
									<li>
										<h4>Competitive Advantage</h4>
										<p>
										<textarea name="competitive" rows="8" class="form-control"><?php echo $skillDetails['competitive']; ?></textarea></p>
									</li>
									<li>
										<h4>My Portfolio</h4>
										<ul class="inline-list">
										<?php 
							  $categories = '';
							$cats = json_decode($skillDetails['portfolio']);
							
							foreach($cats as $cat) {?>
								 <li><a style="color:blue" target="_blank" href="<?php echo base_url('uploads/profile-documents/').$cat; ?>"><?php echo $cat; ?></a></li>
							<?php } ?>
										  
										</ul>
									<ul class="inline-list"><li>	
										
										<div class="fileup-btn"><div class="attach">Attach your Portfolio <img src="<?php echo base_url(); ?>assets/images/attach.svg"></div>

							<input type="file" id="files" name="avatar[]" multiple>
							</div>
							<div class="attach-list mb-20">
							<div id="selectedFiles"></div>
							</div>
							</li></ul>
									</li>
									<?php if($skillDetails['post_type']=='5') {?>
									<li>
										<h4><?php echo $skillDetails['mediate_type']; ?></h4>
										<div class="row">
											<div class="col-xs-6">
												<p class="font-w500">Name of candidate</p>
												<p><input type="text" class="form-control" name="candidate" value="<?php echo $skillDetails['candidate']; ?>"></p>
											</div>
											<div class="col-xs-6">
												<p class="font-w500">Mobile Number</p>
												<p><input type="tel" class="form-control" name="mobile" value="<?php echo $skillDetails['mobile']; ?>"></p>
											</div>
										</div>
									</li>
									<?php }?>
									<li>
<input type="hidden" class="form-control" name="p_id" value="<?php echo $skillDetails['p_id']; ?>">	
<input type="hidden" class="form-control" name="portfolio" value="<?php echo $skillDetails['portfolio']; ?>">				
		<button type="button" id="submit_form" class="btn btn-primary center"> Save</button>
		</li>
								</ul>
							  </div>
							</form></div>
							<!-- Right Panel2 End -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		
	
	<!-- View Contact Modal --> 
	<div id="viewContact" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contat Details</h5>
				</div>
				<div class="modal-body">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button class="btn btn-initiate">Proceed</button>
					</p>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> Mr.Vykuntam Manuka <br />
						   <b>Mobile:</b> 09325168478 <br />
						   <b>E-mail:</b> <a href="mailto:hello@123.com" class="link">hello@123.com</a></p>
					</div>
					<div id="addCoins">
						<h6>Add Coins:</h6>
						<p>You need: <span class="coins">50 coins</span> <br />
						   Available Coins: <span class="coins">20 Coins</span><br />							
						   Continue to: <span class="coins">30 Coins</span></p>
						<hr class="divider" />
						<p class="text-right">
							<button class="btn btn-initiate">Add Coins</button>
						</p>
					</div>
				</div>
			</div>		
		</div>
	</div>
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
	<!-- View Contact Modal -->
<script>
	$.fn.stars = function() {
        return $(this).each(function() {
            var rating = $(this).data("rating");
            var numStars = $(this).data("numStars");
            var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
            var halfStar = ((rating%1) !== 0) ? '<i class="fa fa-star-half-empty"></i>': '';
            var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
            $(this).html(fullStar + halfStar + noStar);
        });
    }
    $('.stars').stars();
	</script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom/earn_editprofile.js"></script>
	<script>


$(document).ready(function(){
$(".e2_2aaa").selectize({	placeholder: "Search by Skills"	});
var neg = "<?php echo $skillDetails['l_term_work_option']; ?>";
if(neg==1){	
 $('.non-negotiable').hide();
}

$("#option-2").click(function(){
$('.non-negotiable').show();	
});
$("#option-1").click(function(){
$('.non-negotiable').hide();	
});
  
});

</script>
<?php $this->load->view('common/common-geo-location') ?> 