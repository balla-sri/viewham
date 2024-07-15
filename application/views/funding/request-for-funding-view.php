	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Request for Funding Details</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('funding/myrequests'); ?>" class="btn btn-info mb-0 mblock-btn">Request Funding</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box p-0">						
						<div class="content p-lr-5">
							<div class="row">
								<div class="col-md-6">
								
									<h6 class="mt-0">Industry</h6>
									<?php  echo $funding['industry_name'];?>
									<h6>Project Description</h6>
									<p><?php echo $funding['description']; ?></p>
									<h6>Current Stage</h6>
									<p><?php 
									$cs= $funding['current_status'];
									$current_status = array("Idea Stage", "Go to Market Stage", "Revenue Stage");
									echo $current_status[$cs];
									?></p>									
									<h6>Location</h6>
									<p><?php $locations = json_decode($funding['location']); 
									foreach($locations as $key=>$val){ 	echo $val.'<br>'; } ?></p>
                                    <h6>Approx Investment Expected</h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix"><?php echo $funding['currency']; ?>.<?php echo $funding['min_amount']; ?> - <?php echo $funding['currency']; ?>.<?php echo $funding['max_amount']; ?></li>
                                    </ul>
                                    <h6>Approx Share Offered</h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix"><?php echo $funding['share_min']; ?>% - <?php echo $funding['share_max']; ?>%</li>
                                    </ul>    
                                    <h6>Role Expected from Investor</h6>
									<p><?php $exrole =  $funding['expected_role']; 
									$role = array("a Sleeping Partner", "As a Strategic Partner", "As a Co-Founder", "As a Financier", "As a Mentor", "Other");
									echo $role[$exrole];
									?></p>									
								</div>
								<div class="col-md-5 col-md-offset-1">
									<div class="panel panel-default earnPanel">
									  <div class="panel-heading">Responses</div>
									  <div class="panel-body">
										<ul><?php 

										foreach($responses as $r){
										?>
											<li>
												<p class="title">
									<?php $r['name'] ?> has shown interest <button class="btn btn-primary pull-right">View Contact</button></p>
											</li>
										<?php } ?>	
										</ul>
									  </div>
									
									<?php if(count($responses)>9){ ?><p class="text-right"><a  class="link mb-20">See More...</a></p>
									<?php } ?>
									<?php if(count($responses)==0){ ?>
									<h5 class="text-center"> No Responses</h5>
									<?php } ?>
									</div>
								</div>
							</div>
							
							
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
