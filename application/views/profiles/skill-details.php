	<section class="ideazone"> 
		<div class="container">
			<div class="row mb-10 hidden-sm hidden-xs">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Skill Details</h4>
				</div>
				<div class="col-md-6 text-right">
					<button class="btn btn-info mb-0 mblock-btn">Request For Work</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<!-- Right Panel2 Start -->
					<div class="panel panel-default earnPanel">
					  <div class="panel-heading">Skill Details</div>
					  <div class="panel-body"><?php //echo "<pre>";print_r($profile); ?>
						<ul class="noBG">
							<li>
								<h4>Select Occupation</h4>
								<p>
								<?php echo $profile['skill_name']; ?>
								<?php echo $profile['industry_name']; ?>
								</p>
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
								  <?php $locations_decode = json_decode($profile['location']); 
	foreach($locations_decode as $key=>$val){ 	echo "<li>".$val.'</li>'; } ?>
								</ul>
							</li>
							<?php if(!empty($profile['language'])){?>
							<li>
								<h4>Languages</h4>
								<ul class="inline-list">
								  <li>Telugu</li>
								  <li>English</li>
								  <li>Hindi</li>
								</ul>
							</li>
							<?php } ?>
							<?php if($profile['post_type']=='3' || $profile['post_type']=='4'){?>
							<li>
								<h4>Work Timings</h4>
								<div class="row">
									<div class="col-xs-5">
										<?php foreach($timings as $key=>$val){ ?>
										<p class="col-xs-5"> <?php echo $val['day']; ?></p>
										<p class="col-xs-5"><?php echo $val['from_time']; ?> - <?php echo $val['to_time']; ?></p>
										<?php } ?>
									</div>
								</div>
							</li>
							<?php } ?>
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
							<?php if(!empty($profile['portfolio'])){ ?>
							<li>
								<h4>My Portfolio</h4>
								<ul class="inline-list">
	<?php $locations_decode = json_decode($profile['portfolio']); 
	foreach($locations_decode as $key=>$val){ 	echo "<li> <a href='".base_url('/uploads/profile-documents/').$val."'>".$val.'</a></li>'; } ?>
								</ul>
							</li>
							<?php } ?>
							
						</ul>
					  </div>
					</div>
					<!--<p class="text-right"><a href="#" class="link visible-xs visible-sm mb-20">See More...</a></p>-->
					<!-- Middle Panel1 End -->
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
							<div class="panel-heading" role="tab" id="headingTwo">
							  <h4 class="panel-title">
								Candidate Tust Factor &nbsp;<span class="stars" data-rating="3" data-num-stars="5" ></span>
                                <!--<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#p2" aria-expanded="false" aria-controls="collapseTwo">
								  Candidate Tust Factor &nbsp;<span class="stars" data-rating="3" data-num-stars="5" ></span>
								</a>-->
							  </h4>
							</div>
							<div id="p2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
							  <div class="panel-body">
								<ul class="list-group">
								  <li class="list-group-item">Learn Participation <span class="glyphicon glyphicon-info-sign info" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="some content"></span> <span class="pull-right"><span class="stars" data-rating="3" data-num-stars="5" ></span></span></li>
								  <li class="list-group-item">Over All Activeness <span class="glyphicon glyphicon-info-sign info" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="some content"></span> <span class="pull-right"><span class="stars" data-rating="3" data-num-stars="5" ></span></span></li>
								</ul>
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title">
								Feedback &nbsp;<span class="stars" data-rating="3" data-num-stars="5" ></span>
                                </h4>
							</div>
							<div id="p3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body">
								<ul class="list-group scroll-v">
								
								  <li class="list-group-item">
									<div class="row earnPanel">
										<div class="col-xs-8">
											<p class="title mb-0">Priyanka</p>
											<p class="date mb-0">Great work done!!</p>
										</div>
										<div class="col-xs-4 text-right">
											<span class="stars" data-rating="3" data-num-stars="5" ></span>
										</div>
									</div>
								  </li>
								</ul>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- Right Panel1 End -->
					
				</div>
			</div>
		</div>
	</section>
