	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Offer a Work</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('jobs/myofferworks'); ?>" class="link mt-10 pull-right">View History</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box p-0">						
						<div class="content p-lr-5">
							<div class="row">
								<div class="col-md-6"><?php //print_r($job); ?>
									<h6 class="mt-0">Skill Name</h6>
									<p><?php echo $job['skill_name'];?></p>
									<h6>Experience</h6>
									<p><?php echo $job['experience']; ?> Years</p>
									
									<h6>Job Description</h6>
									<p><?php echo $job['description']; ?></p>
									<h6>Location</h6>
									<p><?php $loc = json_decode($job['location']); 
									foreach($loc as $key=>$val){
										echo $val."<br>";
									}?></p>
									<h6>Salary</h6>
									<p><?php echo $job['currency']; ?>.<?php echo $job['min_salary']; ?> - <?php echo $job['currency']; ?>.<?php echo $job['max_salary']; ?> /<?php 
									$incomeType = $job['income_type'];
									echo $income_type[$incomeType];	?></p>
								</div>
								<div class="col-md-5 col-md-offset-1">
									
									<div class="panel panel-default earnPanel">
									  <div class="panel-heading">Responses</div>
									  <div class="panel-body">
										<ul>
										<?php foreach($jobNotifications as $key=>$j){ ?>
							<li><p class="title"><span title="<?php echo $j['name']; ?>"><?php echo truncate($j['name'],2,10); ?></span> has shown interest <button data-toggle="modal" data-target="#viewContact_<?php echo $j['id']; ?>" class="btn btn-primary pull-right">View Contact</button></p>
											</li>	

	<div id="viewContact_<?php echo $j['id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($j['paid'])){ ?>
					<div id="contactDetails_<?php echo $j['id']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $j['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $j['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $j['email']; ?>" class="link"><?php echo $j['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $j['id']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-post_by="<?php echo $j['posted_by']; ?>" data-pid="<?php echo $j['id']; ?>" data-postid="<?php echo $j['p_id']; ?>" data-post_type="<?php echo $j['profile_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $j['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $j['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $j['email']; ?>" class="link"><?php echo $j['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
				
			</div>		
		</div>
	</div>

	

											
										<?php } ?>			
										
										</ul>
									  </div>
									  <?php if(empty($jobNotifications)){ ?>
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
	
				

</div>
	
<?php 
     function truncate($input, $maxWords, $maxChars){
        $words = preg_split('/\s+/', $input);
        $words = array_slice($words, 0, $maxWords);
        $words = array_reverse($words);
        $chars = 0;
        $truncated = array();
        while(count($words) > 0){
            $fragment = trim(array_pop($words));
            $chars += strlen($fragment);
            if($chars > $maxChars) break;
            
            $truncated[] = $fragment;
        }
        $result = implode($truncated, ' ');

        if ($input == $result) {
            return $input;
        } else {
            return preg_replace('/[^\w]$/', '', $result) . '...';
        }
    }
	?>	
<script src="<?php echo base_url(); ?>assets/js/custom/jobs_detail.js"></script>	