	<?php $this->view('admin/user-header') ?>
	<section class="dashboard-box" style="padding-top: 110px;"> 
	
		<div class="container">
			<div class="row">
				<div class="col-md-4 pd-5">
					<div class="grey-box single">
						<div class="title">IdeaZone</div>
						<div class="mobile-title up-title-1">IdeaZone<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-1"><img src="<?php echo base_url(); ?>assets/images/idea-d.svg"/>IdeaZone<i class="fa fa-angle-down"></i></div>
						
						<div class="panel panel1" > <a style="color:#000" href="<?php echo base_url('ideazoneall/'); ?>" >
							<div class="panel-heading no-border"> 
								Business Ideas
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold"><?php echo $data['ideas']; ?></div> 
									<small class="text-muted">New Ideas</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold"><?php echo $data['saved-ideas']; ?></div> 
									<small class="text-muted">Saved Ideas</small> 
								</div> 
							</div> </a>
						</div>
					</div>	
				</div>	
				<div class="col-md-8 pd-5">
					<div class="grey-box double">
						<div class="title">Gain</div>
						<div class="mobile-title up-title-2"><img src="<?php echo base_url(); ?>assets/images/gain-d.svg"/>Gain<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-2">Gain<i class="fa fa-angle-down"></i></div>
						<div class="panel panel2"> 
							<div class="panel-heading no-border"> 
								Entrepreneur
								<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
									<input type="checkbox" id="switch-1" class="mdl-switch__input" checked>
									<span class="mdl-switch__label"></span>
								</label>
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold"><?php echo $data['initiatesall']; ?></div> 
									<small class="text-muted">Initiations</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold">0</div> 
									<small class="text-muted">Proposals</small> 
								</div> 
							</div> 
						</div>
						<div class="panel panel2"> 
							<div class="panel-heading no-border"> 
								Investor
								<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
									<input type="checkbox" id="switch-2" class="mdl-switch__input">
									<span class="mdl-switch__label"></span>
								</label>
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold"><?php echo $data['investall']; ?></div> 
									<small class="text-muted">Investables</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold">0</div> 
									<small class="text-muted">Proposals</small> 
								</div> 
							</div> 
						</div>
					</div>						
				</div>	
				<div class="col-md-12 pd-5">
					<div class="grey-box multi">
						<div class="title">Earn</div>
						<div class="mobile-title up-title-3"><img src="<?php echo base_url(); ?>assets/images/earn-d.svg"/>Earn<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-3">Earn<i class="fa fa-angle-down"></i></div>
						<div class="carousel slide media-carousel" id="media">
							<div class="carousel-inner">
								<div class="item  active">
								<?php if($data['Professional']['skill']){ ?>	
									<div class="panel panel3"> 
										<div class="panel-heading no-border"> 
			<?php	$ind = $data['Professional']['skill']; 
					$CI =& get_instance();
					$find = $CI->Skill($ind);
					echo $find['FDESC'];
					?>
											<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-3">
												<input type="checkbox" id="switch-3" class="mdl-switch__input">
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold">
										<?php $CI =& get_instance();
										$proposals = $CI->Proposals($ind);
										echo count($proposals);
										?>
												</div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
												<?php 
												$CI =& get_instance();					$trust = $CI->Trustfactor($ind);
												?>
													<span class="stars" data-rating="<?php echo $trust; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
								<?php }else{ ?>
								<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/profile'); ?>'"> 
										<div class="panel-heading no-border"> 
											Add Professional Skill 
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-12"> 
											<div class="h2 font-bold">
											<i class="fa fa-plus"></i>
											</div> 
											<small class="text-muted">&nbsp;</small> 
											</div> 
																				
							</div>   
					</div>	
								<?php } ?>
									<?php if($data['Hobby']['skill']){ ?>
									<div class="panel panel3"> 
										<div class="panel-heading no-border"> 
									<?php 
					$ind = $data['Hobby']['skill']; 
					$CI =& get_instance();
					$find = $CI->Skill($ind);
					echo $find['FDESC'];	?>
									<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-4">
												<input type="checkbox" id="switch-4" class="mdl-switch__input">
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php 
												$CI =& get_instance();
										$proposals = $CI->Proposals($ind);
										echo count($proposals);
										?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<?php 
												$CI =& get_instance();					$trust = $CI->Trustfactor($ind);
												?>
													<span class="stars" data-rating="<?php echo $trust; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
									<?php }else{ ?>
						<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/myhobby'); ?>'"> 
										<div class="panel-heading no-border"> 
											Add Hobby Skill
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-12"> 
											<div class="h2 font-bold">
											<i class="fa fa-plus"></i>
											</div> 
											<small class="text-muted">&nbsp;</small> 
											</div> 
																				
							</div>   
					</div>					<?php } ?>
					<?php 
					$output = array_slice($data['Mediator'], 1,3);
					$mediator0 = $data['Mediator']['0'];
					if($mediator0){ ?>
					<div class="panel panel3"> 
						<div class="panel-heading no-border"> 
											<?php  
					$ind = $mediator0['skill']; 
					$CI =& get_instance();
					$find = $CI->Skill($ind);
					echo $find['FDESC']; ?>
											<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-5">
												<input type="checkbox" id="switch-5" class="mdl-switch__input">
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
										<div class="h2 font-bold"><?php
										$CI =& get_instance();
										$proposals = $CI->Proposals($ind);
										echo count($proposals);	?>
										</div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<?php 
												$CI =& get_instance();					$trust = $CI->Trustfactor($ind);
												?>
													<span class="stars" data-rating="<?php echo $trust; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
							<?php }else{ ?>
					<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/mediator/'); ?>'"> 
										<div class="panel-heading no-border"> 
											Add New Skill Name
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-12"> 
											<div class="h2 font-bold">
											<i class="fa fa-plus"></i>
											</div> 
											<small class="text-muted">&nbsp;</small> 
											</div> 
																				
							</div>   
					</div>		
							<?php } ?>
								</div>
									<div class="item">
									<?php //print_r($output);
									foreach($output as $m){ ?>
									<div class="panel panel3"> 
										<div class="panel-heading no-border"> 
											<?php 
					$ind = $m['skill'];
					$CI =& get_instance();
					$find = $CI->Skill($ind);
					echo $find['FDESC'];		?>
											<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-<?php echo $m['p_id'] ?>">
												<input type="checkbox" id="switch-<?php echo $m['p_id'] ?>" class="mdl-switch__input">
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php
										$CI =& get_instance();
										$proposals = $CI->Proposals($ind);
										echo count($proposals);	?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<?php 
												$CI =& get_instance();					$trust = $CI->Trustfactor($ind);
												?>
													<span class="stars" data-rating="<?php echo $trust; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
								
									<?php  } 
									if(count($output)<3){
									?>
									<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/mediator'); ?>'"> 
										<div class="panel-heading no-border"> 
											Add New Skill Name
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-12"> 
											<div class="h2 font-bold">
											<i class="fa fa-plus"></i>
											</div> 
											<small class="text-muted">&nbsp;</small> 
											</div> 
																				
										</div>   
									</div>
									<?php } ?>
								</div>
							</div>	
							<a data-slide="prev" href="#media" class="left carousel-control"><img src="<?php echo base_url(); ?>assets/images/leftarrow.svg"></a>
							<a data-slide="next" href="#media" class="right carousel-control"><img src="<?php echo base_url(); ?>assets/images/rightarrow.svg"></a>
						</div>		
					</div>						
				</div>
				<div class="col-md-12 pd-5">
					<div class="grey-box multi">
						<div class="title">Learn</div>
						<div class="mobile-title up-title-4"><img src="<?php echo base_url(); ?>assets/images/learn-d.svg"/>Learn<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-4">Learn<i class="fa fa-angle-down"></i></div>
						<div class="panel panel4"> 
							<div class="panel-heading no-border"> 
								Professional
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold">19</div> 
									<small class="text-muted">Posts</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold">19</div> 
									<small class="text-muted"> Q & A's</small> 
								</div> 
							</div> 
						</div>
						<div class="panel panel4"> 
							<div class="panel-heading no-border"> 
								Hobby
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold">19</div> 
									<small class="text-muted">Posts</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold">19</div> 
									<small class="text-muted"> Q & A's</small> 
								</div> 
							</div> 
						</div>
						<div class="panel panel4"> 
							<div class="panel-heading no-border"> 
								Your Interests
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold">19</div> 
									<small class="text-muted">Posts</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold">19</div> 
									<small class="text-muted"> Q & A's</small> 
								</div> 
							</div> 
						</div>
					</div>						
				</div>
			</div>
		</div>
	</section>
	<?php $this->view('home-footer') ?>
	<!-- jQuery -->
	<script>
		$(document).ready(function() {
			$('.down-title-1').hide();
			$('.up-title-2').hide();
			$('.up-title-3').hide();
			$('.up-title-4').hide();
			if ($(window).width() > 767) {
				$('.panel2').show();
				$('.panel3').show();
				$('.panel4').show();
			}
			if ($(window).width() <= 767) {
				$('.panel2').hide();
				$('.panel3').hide();
				$('.panel4').hide();
				
				$('.up-title-1').click(function(){ $('.down-title-1').show();$('.up-title-1').hide();$('.panel1').hide('slow');});
				$('.down-title-1').click(function(){ $('.up-title-1').show();$('.down-title-1').hide();$('.panel1').show('slow');});
				
				$('.down-title-2').click(function(){ $('.down-title-2').hide();$('.up-title-2').show();$('.panel2').show('slow');});
				$('.up-title-2').click(function(){ $('.up-title-2').hide();$('.down-title-2').show();$('.panel2').hide('slow');});
				
				$('.down-title-3').click(function(){ $('.down-title-3').hide();$('.up-title-3').show();$('.panel3').show('slow');});
				$('.up-title-3').click(function(){ $('.up-title-3').hide();$('.down-title-3').show();$('.panel3').hide('slow');});
				
				$('.down-title-4').click(function(){ $('.down-title-4').hide();$('.up-title-4').show();$('.panel4').show('slow');});
				$('.up-title-4').click(function(){ $('.up-title-4').hide();$('.down-title-4').show();$('.panel4').hide('slow');});
			}
		});
	</script>
    <script>
	$.fn.stars = function() {
        return $(this).each(function() {
            var rating = $(this).data("rating");
            var numStars = $(this).data("numStars");
            var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
            var halfStar = ((rating%1) !== 0) ? '<i class="fa fa-star-half-empty"></i>': '';
            var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
            $(this).html(fullStar + halfStar + noStar);
        });
    }
    $('.stars').stars();

	$('.mdl-switch').click(function(){
	var myClass = $(this).attr("class");

		if (myClass.indexOf('is-checked') > -1){
		  var is_status = 'off';
		} else {
		  var is_status = 'on';
		}
		console.log(is_status);
	});
	
	</script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

