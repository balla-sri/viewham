	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Out Source your Work</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('outsource/projects'); ?>" class="btn btn-info mb-0 mblock-btn">View History</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box p-0">						
						<div class="content p-lr-5">
							<div class="row">
								<div class="col-md-6">
									<h6 class="mt-0">Industry</h6>
									<p>
									<?php echo $outsource['industry_name'];?>
								</p>
									<h6>Project Description</h6>
									<p><?php echo $outsource['description']; ?></p>
																		
									<h6>Location</h6>
									<p><?php $location = json_decode($outsource['location']);
										foreach($location as $key=>$val){
											echo $val."<br>";
										}?></p>
									<h6>Approx Outsource Project Quote</h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix"><?php echo $outsource['currency_type']; ?>.<?php echo $outsource['min_invest']; ?> - <?php echo $outsource['currency_type']; ?>.<?php echo $outsource['max_invest']; ?></li>
                                    </ul>
                                    <h6>Approx Project Deadline/Duration</h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix"><?php echo $outsource['duration_min']; ?> <?php echo $outsource['duration_type']; ?> - <?php echo $outsource['duration_max']; ?> <?php echo $outsource['duration_type']; ?></li>
                                    </ul>
									
								</div>
								<div class="col-md-5 col-md-offset-1">
									
									<div class="panel panel-default earnPanel">
									  <div class="panel-heading">Responses</div>
									  <div class="panel-body">
										<ul><?php 										
										foreach($responses as $r){
										?>
											<li>
											<p class="title"><?php echo $r['name'];
											?> has shown interest <button class="btn btn-primary pull-right">View Contact</button></p>
											</li>
										<?php } ?>	
										</ul>
									  </div>
									
									<?php if(count($responses)>9){ ?><p class="text-right"><a  class="link mb-20">See More...</a></p>
									<?php } ?>
									<?php if(count($responses)==0){ ?>
									<h5 class="text-center"> No Responses</h5>
									<?php } ?>
									</div></div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
			




