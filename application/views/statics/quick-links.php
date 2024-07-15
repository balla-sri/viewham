	<section class="ideazone"> 
		<div class="container">
			<div class="row mb-10 hidden-sm hidden-xs">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Quick Links</h4>
				</div>
				<div class="col-md-6 text-right">
				</div>
			</div>
			<div class="row quicklinks">
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Offer a Work </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('jobs/offerwork'); ?>" class="link">Post Work Requirement to right people</a></li>
						</ul>
					  </div>
					</div>					
				</div>
                            <?php 
                                $session_id = $this->session->userdata('user');
                                if($session_id){
                                    $request_for_work_link= base_url('earn/reuestforwork');
                                }else{
                                    $request_for_work_link= base_url('user/signin');
                                }
                            ?>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Request for Work </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo $request_for_work_link ?>" class="link">Post your availability to hirer</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Post Own Business </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('ownbusiness/add'); ?>" class="link">Post your business to gather support</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Request for Funding </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('funding/add'); ?>" class="link">Post your business details to reach Potential Investments</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Outsource a Project </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('outsource/add'); ?>" class="link">Post project details to right Entrepreneurs</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Offer a Franchise </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('franchise/add'); ?>" class="link">Post franchise model to right Entrepreneurs</a></li>
						</ul>
					  </div>
					</div>
				</div>
			</div>
		</div>
<br>
<br>
<br>
<br>
<br>
<br>
	</section>
	
