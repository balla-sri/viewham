		<?php
		$Entrepreneurs = "";
		$Investors = "";
		if($this->uri->segment(2)=='Entrepreneur'){ 
		$Entrepreneurs = "active"; }
		else if($this->uri->segment(1)=='Investor'){
			$Investors = "active";
		}
		
$profileType=array('3'=>'Professional Profile','4'=>'Hobby Profile','5'=>'Mediator Profile'); 				
				?>
<div class="white-block mb-30 hidden-sm hidden-xs">
	<h3><a href="<?php echo base_url('businessideas'); ?>">Idea Zone</a></h3>					
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  	<!--Gain Menu Starts--->
	  	<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
			  	<h4 class="panel-title">
					<a class="<?php if($this->uri->segment(1)=='Entrepreneur' || $this->uri->segment(1)=='Investor'){ echo "";}else{ echo "collapsed";} ?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Gain</a>
			  	</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse <?php if($this->uri->segment(1)=='entrepreneur' || $this->uri->segment(1)=='investor'){ echo "in";} ?>" role="tabpanel" aria-labelledby="headingOne">
			  	<div class="panel-body">
					<ul class="acc-list">
						<li><a class="<?php echo $Entrepreneurs; ?>" href="<?php echo base_url('entrepreneur'); ?>">Entrepreneur</a></li>
						<li><a class="<?php echo $Investors; ?>" href="<?php echo base_url('investor'); ?>">Investor</a></li>
					</ul>
				</div>
			</div>
	  	</div>
	  	<!----Gain Menu Ends---->
	  	<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
			  	<h4 class="panel-title">
					<a class="<?php if($this->uri->segment(1)=='Earn'){ echo "";}else{ echo "collapsed";} ?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Earn</a>
			  	</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse <?php if($this->uri->segment(1)=='earn'){ echo "in";} ?>" role="tabpanel" aria-labelledby="headingTwo">
			  	<div class="panel-body">
					<ul class="acc-list">
						<?php $SkillProfiles = SkillProfiles(); 
						foreach($SkillProfiles as $s){ 
							$ptype= $s['post_type'] ?>
							<li><a data-toggle="tooltip" data-placement="right" data-html="true" data-title="<?php echo $profileType[$ptype]; ?>" class="<?php if($this->uri->segment(3)==$s['p_id']){echo "active ";} ?>" href="<?php echo base_url('earn/myprofiles/') . $s['p_id']; ?>"><?php echo $s['skill']; ?></a></li>
						<?php } ?>
					</ul>
			  	</div>
			</div>
	  	</div>
	  	<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingThree">
			  	<h4 class="panel-title">
					<a class="<?php if($this->uri->segment(1)=='earn'){ echo "";}else{ echo "collapsed";} ?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Learn</a>
			  	</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse <?php if($this->uri->segment(1)=='learn'){ echo "in";} ?>" role="tabpanel" aria-labelledby="headingThree">
			  	<div class="panel-body">
					<ul class="acc-list">
						<?php $SkillProfiles = SkillProfiles(); 
						foreach($SkillProfiles as $s){ 
							$ptype= $s['post_type'] ?>
							<li><a data-toggle="tooltip" data-placement="right" data-html="true" data-title="<?php echo $profileType[$ptype]; ?>" class="<?php if($this->uri->segment(3)==$s['p_id']){echo "active ";} ?>" href="<?php echo base_url('learn/feed/') . $s['p_id']; ?>"><?php echo $s['skill']; ?></a></li>
						<?php } ?>
					</ul>
			  	</div>
			</div>
	  	</div>
		<!--end of Earn-->				 
	</div>	
		
</div>
<?php if($session_exist==1){?>
	<div class="mNav visible-xs visible-sm">
		<ul>
		  	<li>
				<button onclick="window.location.href='<?php echo base_url('businessideas') ?>'" class="btn" type="button">Idea Zone</button>
		  	</li>
		  	<li>
				<button class="btn" type="button" id="mNav3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Gain<span class="caret"></span></button>
			    <ul class="dropdown-menu" aria-labelledby="mNav3">
					<li><a href="<?php echo base_url('entrepreneur'); ?>">Entrepreneur</a></li>
					<li><a href="<?php echo base_url('investor'); ?>">Investor</a></li>
				</ul>
		  	</li>
			<li>
				<button class="btn" type="button" id="mNav2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Earn<span class="caret"></span></button>
			    <ul class="dropdown-menu" aria-labelledby="mNav2">
					<?php  foreach($SkillProfiles as $s){ ?>
						<li><a href="<?php echo base_url('earn/myprofiles/').$s['p_id']; ?>"><?php echo $s['skill']; ?></a></li>
						<?php } ?>
				</ul>
			</li>
			<li>
				<button class="btn" type="button">Learn</button>
			</li>
		</li>
	</ul>
</div>
<?php } ?>