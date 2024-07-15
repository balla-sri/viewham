	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Establish Own Business</h4>
				</div>
				<div class="col-md-6 text-right">
				<a href="<?php echo base_url('ownbusiness/myownBusinessideas'); ?>" class="btn btn-info mb-0 mblock-btn">Establish Business</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box p-0">						
						<div class="content p-lr-5">
							<div class="row">
								<div class="col-md-6">
									<h6 class="mt-0">Industry</h6>
									
									<p><?php echo $ownidea['industry_name']; ?></p>
									<h6>Project Description</h6>
									<p><?php echo $ownidea['description']; ?></p>
									<h6>Current Stage</h6>
									<p><?php $i_status = $ownidea['idea_status']; 
									$c_status=array("1"=>"Idea Stage", "2"=>"Go to Market Stage", "3"=>"Revenue Stage"); 
									echo $c_status[$i_status];
									?></p>
									<h6>Location</h6>
									<p><?php $loc = json_decode($ownidea['location']); 
										foreach($loc as $key=>$val){
											echo $val."</br>";
										}?></p>
									<h6>Required Resources</h6>
									<div class="grey-block mb-20">
                                        <p class="mb-0"><b>Skilled Candidates:</b></p>
										<ul class="inline-list p-0">
										<?php $resource = json_decode($ownidea['resource']); 
											foreach($resource as $key=>$val){
												echo "<li>".$skills[$val]['skill']."</li>";
												}
										?>
										</ul>
										<?php if($ownidea['investor']){ ?>
                                        <p class="mb-0 mt-20"><b>Investor:</b></p>
                                        <ul class="inline-list p-0">
										  <li class="clearfix">Investment Expected: <?php echo $ownidea['currency']; ?>.<?php echo $ownidea['min_invest']; ?> - <?php echo $ownidea['currency']; ?>.<?php echo $ownidea['max_invest']; ?></li>
										  <li class="clearfix">Share Offered: <?php echo $ownidea['min_share']; ?>% - <?php echo $ownidea['max_share']; ?>%</li>
										  <?php $role=array('1'=>'As a Sleeping Partner','2'=>'As a Strategic Partner','3'=>'As a Co-Founder','4'=>'As a Financier','5'=>'As a Mentor','6'=>'Other') ?>
										  <li class="clearfix">Expected Role: <?php  $ex_role=  $ownidea['investor_role']; 
										  echo $role[$ex_role];?></li>
										</ul>
                                        <?php } ?>
									</div>
									
								</div>
								<div class="col-md-5 col-md-offset-1">
									<div class="panel panel-default earnPanel">
									  <div class="panel-heading">Responses</div>
									  <div class="panel-body">
										<ul>
											<li>
											Not available
												<!--<p class="title">Ajay has shown interest <button class="btn btn-primary pull-right">View Contact</button></p>-->
											</li>
											
										</ul>
									  </div>
									</div>
									
								</div>
							</div>
							
							
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

