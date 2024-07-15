	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Offer a Franchise</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('franchise/add'); ?>" class="btn btn-info mb-0 mblock-btn">Offer a Franchise</a>
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
									<?php echo $franchise['industry_name']; ?></p>
									<h6>Project Description</h6>
									<p><?php echo $franchise['description']; ?></p>
									<h6>Location</h6>
									<p><?php $location = json_decode($franchise['location']);
									foreach($location as $key=>$val){
										echo $val."<br>";
									} 
										?></p>
                                    <h6>Franchise Model</h6>
									<p><?php echo $franchise['franchize']; ?></p>
									<h6>Approx Investment</h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix">
									  <?php echo $franchise['currency_type']; ?>.<?php echo $franchise['min_invest']; ?> - <?php echo $franchise['currency_type']; ?>.<?php echo $franchise['max_invest']; ?></li>
                                    </ul>
                                    <h6>Approx Income</h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix">
									  INR: <?php echo $franchise['income_min']; ?> -  <?php echo $franchise['income_max']; ?> /<?php echo $franchise['income_type']; ?></li>
                                    </ul>
                                    <h6>Break Even </h6>
                                    <ul class="inline-list p-0">
                                      <li class="clearfix">
									  INR: <?php echo $franchise['min_break_even']; ?> -  <?php echo $franchise['max_break_even']; ?> /<?php echo $franchise['break_even_type']; ?></li>
                                    </ul>
									
								</div>
								<div class="col-md-5 col-md-offset-1">
									<div class="panel panel-default earnPanel">
									  <div class="panel-heading">Responses</div>
									  <div class="panel-body">
										<ul><?php 
										$pid = $this->uri->segment(3);
										$CI =& get_instance();
										$resposes = $CI->responsesFranchise($pid);
										foreach($resposes as $r){
										?>
											<li>
												<p class="title">
									<?php 
									$CI =& get_instance();
									$us = $CI->Userdeatail($r['from_id']);
									echo $us['NAME'];
											?> has shown interest <button class="btn btn-primary pull-right">View Contact</button></p>
											</li>
										<?php } ?>	
										</ul>
									  </div>
									
									<?php if(count($resposes)>9){ ?><p class="text-right"><a  class="link mb-20">See More...</a></p>
									<?php } ?>
									<?php if(count($resposes)==0){ ?>
									<h5 class="text-center"> No Responses</h5>
									<?php } ?>
									</div></div>
								</div>
							</div>
							
							
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
