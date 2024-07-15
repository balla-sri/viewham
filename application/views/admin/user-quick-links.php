	<?php $this->view('admin/user-header') ?>

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
							<li><a href="<?php echo base_url('gain/offer_work'); ?>" class="link">Post Work Requirement to right people</a></li>
						</ul>
					  </div>
					</div>					
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Request for Work </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('earn/reuest_works'); ?>" class="link">Post your availability to hirer</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Post Own Business </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('gain/ownbusinessadd'); ?>" class="link">Post your business to gather support</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Request for Funding </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('gain/reuest_funding'); ?>" class="link">Post your business details to reach Potential Investments</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Outsourse a Project </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('gain/outsource_work'); ?>" class="link">Post project details to right Enterpreneurs</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default sidePanel">
					  <div class="panel-heading">Offer a Franchise </div>
					  <div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('gain/offer_a_franchize'); ?>" class="link">Post franchise model to right Enterpreneurs</a></li>
						</ul>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- View Contact Modal -->
	
<?php $this->view('home-footer') ?>
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>