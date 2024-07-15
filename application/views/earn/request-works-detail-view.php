	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Request Work</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('earn/reuestforwork'); ?>" class="btn btn-info mb-0 mblock-btn">Request a Work</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box p-0">						
						<div class="content p-lr-5">
							<div class="row">
								<div class="col-md-6">
									<h6 class="mt-0">Skill</h6>
									<p>
									<?php  echo $MyRequestWork['skill_name']; ?></p>
									<h6>Project Description</h6>
									<p><?php echo $MyRequestWork['description']; ?></p>
									<h6>Status</h6>
									<?php if($MyRequestWork['status']==1){
										echo "Active";
									}else{
										echo "Inactive";
									}
										?>
<br>
<br>
<br>
<br>
<br>									
								</div>
								<div class="col-md-5 col-md-offset-1">
									<div class="panel panel-default earnPanel">
									  <div class="panel-heading">Responses</div>
									  <div class="panel-body">
										
									  </div>
									
									
									<h5 class="text-center"> No Responses</h5>
									
									</div></div>
								</div>
							</div>
							
							
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
