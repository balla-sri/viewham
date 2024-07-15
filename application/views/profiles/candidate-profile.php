	<section class="ideazone"> 
		<div class="container">
			<div class="row mb-10 hidden-sm hidden-xs">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Candidate Profile</h4>
				</div>
				<div class="col-md-6 text-right">
					
				</div>
			</div>
			<div class="row">
			
				<div class="col-md-3">
					<!-- Left Panel1 Start -->
					<div class="panel panel-default earnPanel">
					  <div class="panel-heading">Candidate Profile</div>

					  <div class="panel-body">
						<div class="profile-img-blk">
						
           <?php 
		   
		   if($profile['login_type']==1){
                $profile_pic = (isset($profile['profile_picture']) && $profile['profile_picture']!='')?$profile['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $profile['profile_picture'];
            }
            ?>						
						
						
						
							<img src="<?php echo $prof_pic; ?>" class="avatar img-circle" alt="avatar" width="150px">
						</div>
						<ul class="noBG">
							<li>
								<h4>Name</h4>
								<p><?php echo $profile['name']; ?></p>
							</li>
							<li>
								<h4>Gender</h4>
								<p><?php
								if($profile['gender']){
									if($profile['gender']==1){
									echo "Male";
								}else{ echo "Female"; } 
								}else{
									echo '--';
								}?></p>
							</li>
							<li>
								<h4>Mobile</h4>
								<p><?php
								if($profile['mobile']){
									echo $profile['mobile'];
								}else{
									echo '--';
								}	

									?></p>
							</li>
							<li>
								<h4>Age</h4>
								<p><?php  
								if($profile['age']){
									echo $profile['age'];
								}else{
									echo '--';
								}?></p>
							</li>
							<li>
								<h4>Email</h4>
								<p><a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $profile['email']; ?>&su=Viewham&body=" class="link"><?php echo $profile['email']; ?></a></p>
							</li>
							<li>
								<h4>Linkedin</h4>
								<?php  
								if($profile['linkedin_id']){ ?>
								<p><a target="blank" href="<?php  echo $profile['linkedin_id']; ?>" class="link"><?php  echo $profile['linkedin_id'];
								?></a></p>
								<?php }else{ echo '--';			} ?>
							</li>
						</ul>
					  </div>
					</div>
					<!-- Left Panel1 End -->
				</div>
				<div class="col-md-5">
					<?php if(($profile['post_type']=='1') || ($profile['post_type']=='2')){ ?>
					<div class="panel panel-default earnPanel">
					  <div class="panel-heading"><?php
						$pType=array('1'=>'Entrepreneur','2'=>'Investor');
						
					  $profileType = $profile['post_type']; echo $pType[$profileType];?> Details</div>
					  <div class="panel-body">
						<ul class="noBG">
							<li>
								<h4>Select Occupation</h4>
								<?php echo $profile['skill_name']; ?>
								<?php echo $profile['industry_name']; ?>
							</li>
							<li>
								<h4>Related Skills</h4>
								<ul class="inline-list">
								<?php 
								$role = json_decode($profile['association']);
									foreach($role as $key=>$val){
										echo "<li>".$skills[$val]['skill']."</li>";
									}
								?>
								</ul>
							</li>
							<li>
								<h4>Locations</h4>
								<ul class="inline-list">
								   <?php $loc = array_filter(json_decode($profile['location']));
								   foreach($loc as $key=>$val){
									echo "<li>".$val."</li>";   
								   }
								   ?>
								</ul>
							</li>
							<?php if($profile['post_type']=='1'){ ?>
							<li>
								<h4>Experience</h4>
								<p><?php echo $profile['experience']; ?> Years</p>
							</li>
							
							
							<li>
								<h4>Budget</h4>
							<p><?php
							
							echo $profile['currency'].'&nbsp'.$profile['min_budget'] .'-'.$profile['max_budget'] ; ?></p>
							</li>
							<li>
								<h4>Nature of Business</h4>
								<p><?php echo $profile['nature']; ?></p>
							</li>
					<?php } 
					if($profile['post_type']=='2'){ ?>
						<li>
								<h4>Investment </h4>
							<p><?php

							echo $profile['investment_currency'].'&nbsp'.$profile['min_invest'] .'-'.$profile['max_invest'] ; ?></p>
							</li>
							<li>
								<h4>Share </h4>
							<p><?php
							echo $profile['share_currency'].'&nbsp'.$profile['min_share'] .'-'.$profile['max_share'] ; ?></p>
							</li>
					<?php } ?>	</ul>
					  </div>
					</div>
	
					<?php }else{ ?>
			<div class="panel panel-default earnPanel">
					  <div class="panel-heading">Skill Details</div>
					  <div class="panel-body">
						<ul class="noBG">
							<li>
								<h4>Select Occupation</h4>
								<p>				
								<?php echo $profile['skill_name']; ?>
								<?php echo $profile['industry_name']; ?></p>
							</li>
							<li>
								<h4>Related Skills</h4>
								<ul class="inline-list">
								<?php 
									$role = json_decode($profile['association']);
									foreach($role as $key=>$val){
										echo "<li>".$skills[$val]['skill']."</li>";
									}
								?>
								</ul>
							</li>
							<li>
								<h4>Experience</h4>
								<p><?php echo $profile['experience']; ?> Years</p>
							</li>
							<li>
								<h4>Locations</h4>
								<ul class="inline-list">
								    <?php $loc = array_filter(json_decode($profile['location']));
								   foreach($loc as $key=>$val){
									echo "<li>".$val."</li>";   
								   }
								   ?>
								</ul>
							</li>
							<?php if($profile['language']){ ?>
							<li>
								<h4>Languages</h4>
								<ul class="inline-list">
								  <li><?php echo $profile['language']; ?></li>
								</ul>
							</li>
							<?php } ?>
							<li>
								<h4>Work Timings</h4>
								<div class="row">
									<div class="col-xs-12">
										<?php foreach($timings as $key=>$val){ ?>
										<p class="col-xs-5"> <?php echo $val['day']; ?></p>
										<p class="col-xs-7"><?php echo $val['from_time']; ?> - <?php echo $val['to_time']; ?></p>
										<?php } ?>
									</div>
								</div>
							</li>
							<li>
								<h4>My Price</h4>
								<div class="row">
									<div class="col-xs-5">
										<p>Short Term Work</p>
										<p><?php echo $profile['price']; ?> <?php echo $profile['currency']; ?> / <?php echo $profile['price_per']; ?></p>
									</div>
									<div class="col-xs-7">
										<p>Long Term Work</p>
										<?php if($profile['l_term_work_option']=='2'){?>
										<p><b>Non-Negotiable</b></p>
										<p><span class="font-w500">As Employee</span> : <?php echo $profile['min_as_employee']; ?> - <?php echo $profile['max_as_employee']; ?> USD</p>
										<p><span class="font-w500">As Partner :</span> <?php echo $profile['min_as_partner']; ?> - <?php echo $profile['max_as_partner']; ?> %</p>
										<?php }else{ ?>
										<p><b>Negotiable</b></p>
										<?php }?>
									</div>
								</div>
							</li>
							<li>
								<h4>Competitive Advantage</h4>
								<p><?php echo $profile['competitive']; ?></p>
							</li>
							<li>
								<h4>My Portfolio</h4>
								<ul class="inline-list">
	<?php $locations_decode = json_decode($profile['portfolio']); 
	foreach($locations_decode as $key=>$val){ 	echo "<li> <a href='".base_url('/uploads/profile-documents/').$val."'>".$val.'</a></li>'; } ?>

								</ul>
							</li>
							<!--
                            <li class="text-right">
								<button class="btn btn-primary mb-0 btn-md">Interested</button>
								<button class="btn btn-info mb-0 btn-md">View Contact</button>
							</li> -->
						</ul>
					  </div>
					</div>
	 <?php  } ?>
					<!-- Right Panel2 Start -->
									<!--<p class="text-right"><a href="#" class="link visible-xs visible-sm mb-20">See More...</a></p>-->
					<!-- Middle Panel1 End -->
				</div>
				<div class="col-md-4">
					<!-- Right Panel1 Start -->
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Feedback <span class="pull-right">
					  <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2.5" />
					  </span></div>
					  <div class="panel-body">
						<textarea id="feedback_text" cols="" rows="10" class="form-control" placeholder="write feedback..."></textarea>
						<div id="error_messages" class="text-center alert-danger"></div>

						<button data-toid="<?php echo $profile['uid']; ?>" data-keyid="<?php echo $this->uri->segment(3); ?>" data-profile_type="<?php echo $profile['post_type']; ?>" id="feedback" class="btn btn-primary mb-0 mt-10 pull-right">Submit</button>
					  </div>
					</div>
					<!-- Right Panel1 End -->	
					<div id="message" class="alert-success text-center" style="padding: 15px;display: none;">Thanks..! Your Feedback has Posted</div>		
				</div>
			</div>
		</div>
	</section>
	
<script>
$("#feedback_text").bind("keyup change", function(e){   
		$('#error_messages').html('');
});
$("#feedback").click(function(){
	var color = $('.label-default').text();
	var impress = color.slice(0, 3);
	var toid = $(this).data('toid');
	var keyid = $(this).data('keyid');
	var profile_type = $(this).data('profile_type');
	var feedback = $('#feedback_text').val();
	if(!feedback){
		$('#error_messages').html('Please Enter Feedback');
		return false;
	}
	var url = "<?php echo base_url('skill/feedbackaddtoskill'); ?>";
	$.ajax({
           type: "POST",
           url: url,
		   data: {feedback: feedback, impress: impress, profile_type: profile_type, toid: toid, keyid: keyid},
		   dataType: 'json',
           success: function(data)
           {
            console.log(data);
			if(data.status==1){
				$('#feedback_text').val('');
				$('#message').show();
				$('#feedback').prop('disabled', true);
			}
           }
         });
});
</script>