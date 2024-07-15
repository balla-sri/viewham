	<section class="dashboard-box"> 
		<div class="container">
			<div class="row">
				<div class="col-md-4 pd-5">
					<div class="grey-box single">
						<div class="title">IdeaZone</div>
						<div class="mobile-title up-title-1">IdeaZone<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-1"><img src="<?php echo base_url('assets/'); ?>images/idea-d.svg"/>IdeaZone<i class="fa fa-angle-down"></i></div>
						<div class="panel panel1" onclick="window.location.href='<?php echo base_url(); ?>/businessideas/'"> 
							<div class="panel-heading no-border"> 
								Business Ideas
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold"><?php echo $dashboard['ideas']; ?></div> 
									<small class="text-muted">New Ideas</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold"><?php echo $dashboard['saved-ideas']; ?></div> 
									<small class="text-muted">Saved Ideas</small> 
								</div> 
							</div> 
						</div>
					</div>	
				</div>	
				<div class="col-md-8 pd-5">
					<div class="grey-box double">
						<div class="title">Gain</div>
						<div class="mobile-title up-title-2"><img src="<?php echo base_url('assets/'); ?>images/gain-d.svg"/>Gain<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-2">Gain<i class="fa fa-angle-down"></i></div>
						<?php if(!empty($dashboard['entrepreneur']['p_id'])){ ?>
						
						<div class="panel panel2" onclick="window.location.href='<?php echo base_url(); ?>entrepreneur/'"> 
							<div class="panel-heading no-border"> 
								Entrepreneur
								<label data-postid="<?php echo $dashboard['entrepreneur']['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
									<input type="checkbox" id="switch-1" class="mdl-switch__input" <?php if($dashboard['entrepreneur']['status']==1){ echo "checked";} ?>>
									<span class="mdl-switch__label"></span>
								</label>
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold"><?php echo $dashboard['initiateAll']; ?></div> 
									<small class="text-muted">Initiations</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold"><?php echo $dashboard['saved-ideas']; ?></div> 
									<small class="text-muted">Proposals</small> 
								</div> 
							</div> 
						</div>
					
								<?php } else{?>
								
								<div class="panel panel2" onclick="window.location.href='<?php echo base_url(); ?>entrepreneur/'"> 
							<div class="panel-heading no-border"> 
											Add Entrepreneur 
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
	<?php if(!empty($dashboard['investor']['p_id'])){ ?>
					<div class="panel panel2" onclick="window.location.href='<?php echo base_url(); ?>investor/'"> 
							<div class="panel-heading no-border" > 
								Investor
								<label data-postid="<?php echo $dashboard['investor']['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
									<input type="checkbox" id="switch-2" class="mdl-switch__input" <?php if($dashboard['investor']['status']==1){ echo "checked";} ?>>
									<span class="mdl-switch__label"></span>
								</label>
							</div> 
							<div class="padder-v text-center clearfix"> 
								<div class="col-xs-6 b-r"> 
									<div class="h2 font-bold"><?php echo $dashboard['investAll']; ?></div> 
									<small class="text-muted">Investables</small> 
								</div>									
								<div class="col-xs-6"> 
									<div class="h2 font-bold"><?php echo $dashboard['saved-ideas']; ?></div> 
									<small class="text-muted">Proposals</small> 
								</div> 
							</div> 
						</div>
					
					<?php } else{?>
								
								<div class="panel panel2" onclick="window.location.href='<?php echo base_url(); ?>investor/'"> 
							<div class="panel-heading no-border"> 
											Add Investor 
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
				<div class="col-md-12 pd-5">
					<div class="grey-box multi">
						<div class="title">Earn</div>
						<div class="mobile-title up-title-3"><img src="<?php echo base_url('assets/images/earn-d.svg'); ?>"/>Earn<i class="fa fa-angle-up"></i></div>
						<div class="mobile-title down-title-3">Earn<i class="fa fa-angle-down"></i></div>
						<div class="carousel slide media-carousel" id="media">
							<div class="carousel-inner">
								<div class="item  active" >
								<?php
								if(!empty($dashboard['professional']['p_id'])){ ?>
								<div class="panel panel3"> 
										<div class="panel-heading no-border" onclick="window.location.href='<?php echo base_url('earn/myprofiles/').$dashboard['professional']['p_id']; ?>'"> 
											<?php echo $dashboard['professional']['skill_name']; ?>
											<label data-postid="<?php echo $dashboard['professional']['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-3">
												<input type="checkbox" id="switch-3" class="mdl-switch__input" <?php if($dashboard['professional']['status']==1){ echo "checked";} ?>>
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php echo $dashboard['professional']['proposals']; ?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<span class="stars" data-rating="<?php echo $dashboard['professional']['feedback']; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
								<?php }else{ ?>
								<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/mediator/'); ?>'"> 
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
					
								<?php }?>
								<?php
								if(!empty($dashboard['hobby']['p_id'])){ ?>
									<div class="panel panel3"> 
										<div class="panel-heading no-border" onclick="window.location.href='<?php echo base_url('earn/myprofiles/').$dashboard['hobby']['p_id']; ?>'"> 
											<?php echo $dashboard['hobby']['skill_name']; ?>
											<label data-postid="<?php echo $dashboard['hobby']['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-4">
												<input type="checkbox" id="switch-4" class="mdl-switch__input" <?php if($dashboard['hobby']['status']==1){ echo "checked";} ?>>
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php echo $dashboard['hobby']['proposals']; ?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<span class="stars" data-rating="<?php echo $dashboard['hobby']['feedback']; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
								<?php }else{ ?>
								<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/myhobby/'); ?>'"> 
										<div class="panel-heading no-border" > 
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
									</div>
								<?php } ?>
								<?php if(!empty($dashboard['mediator']['p_id'])){ ?>
								<div class="panel panel3"> 
										<div class="panel-heading no-border" onclick="window.location.href='<?php echo base_url('earn/myprofiles/').$dashboard['mediator']['0']['p_id']; ?>'"> 
											<?php echo $dashboard['mediator']['0']['skill_name']; ?>
											<label data-postid="<?php echo $dashboard['mediator']['0']['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-5">
												<input type="checkbox" id="switch-5" class="mdl-switch__input" <?php if($dashboard['mediator']['0']['status']==1){ echo "checked";} ?>>
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php echo $dashboard['mediator']['0']['proposals']; ?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<span class="stars" data-rating="<?php echo $dashboard['mediator']['0']['feedback']; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
								<?php }else{ ?>
								<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/mediator/'); ?>'"> 
										<div class="panel-heading no-border"> 
											Add Mediator Skill 
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
									<?php
									$meditor1='';
									$meditor2='';
									$meditor3='';
									
									if(!empty($dashboard['mediator']['1'])){
										$meditor1  = $dashboard['mediator']['1'];
									}
									if(!empty($dashboard['mediator']['2'])){
										$meditor2  = $dashboard['mediator']['2'];
									}
									if(!empty($dashboard['mediator']['3'])){
										$meditor3  = $dashboard['mediator']['3'];
									}

									$mArray13 =array_filter(array($meditor1,$meditor2,$meditor3));
									if(!empty($mArray13)){
									foreach($mArray13 as $key=>$val){	
									?>
										<div class="panel panel3"> 
										<div class="panel-heading no-border" onclick="window.location.href='<?php echo base_url('earn/myprofiles/').$val['p_id']; ?>'"> 
											<?php echo $val['skill_name']; ?>
											<label data-postid="<?php echo $val['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" >
												<input type="checkbox"  class="mdl-switch__input" <?php if($val['status']==1){ echo "checked";} ?>>
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php echo $val['proposals']; ?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<span class="stars" data-rating="<?php echo $val['feedback']; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
									<?php } }
									
									if(count($mArray13)<3){ ?>
									<div class="panel panel3"> 
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
						
								<?php if(count($dashboard['mediator'])>3){ ?>

									<div class="item">
									<?php
									$meditor4='';
									$meditor5='';
									$meditor6='';
									
									if(!empty($dashboard['mediator']['4'])){
										$meditor4  = $dashboard['mediator']['4'];
									}
									if(!empty($dashboard['mediator']['5'])){
										$meditor5  = $dashboard['mediator']['5'];
									}
									if(!empty($dashboard['mediator']['6'])){
										$meditor6  = $dashboard['mediator']['6'];
									}

									$mArray46 =array_filter(array($meditor4,$meditor5,$meditor6));
									if(!empty($mArray46)){
									foreach($mArray46 as $key=>$val){	
									?>
										<div class="panel panel3"> 
										<div class="panel-heading no-border"> 
											<?php echo $val['skill_name']; ?>
											<label data-postid="<?php echo $val['p_id']; ?>" class="mdl-switch mdl-js-switch mdl-js-ripple-effect" >
												<input type="checkbox"  class="mdl-switch__input" <?php if($val['status']==1){ echo "checked";} ?>>
												<span class="mdl-switch__label"></span>
											</label>
										</div> 
										<div class="padder-v text-center clearfix"> 
											<div class="col-xs-6 b-r"> 
												<div class="h2 font-bold"><?php echo $val['proposals']; ?></div> 
												<small class="text-muted">Proposals</small> 
											</div> 
											<div class="col-xs-6"> 
												<div class="h2 star-block">
													<span class="stars" data-rating="<?php echo $val['feedback']; ?>" data-num-stars="5"></span>
												</div> 
												<small class="text-muted">Trust Factor</small> 
											</div>									
										</div> 
									</div>
									<?php } }
									
									if(count($mArray13)<4){ ?>
									<div class="panel panel3" onclick="window.location.href='<?php echo base_url('earn/mediator/'); ?>'"> 
										<div class="panel-heading no-border"> 
											Add New Profile
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
						
						<?php } ?>
					</div>	
							<a data-slide="prev" href="#media" class="left carousel-control"><img src="<?php echo base_url('assets/'); ?>images/leftarrow.svg"></a>
							<a data-slide="next" href="#media" class="right carousel-control"><img src="<?php echo base_url('assets/'); ?>images/rightarrow.svg"></a>
						</div>		
					</div>						
				</div>
				<div class="col-md-12 pd-5">
					<div class="grey-box multi">
						<div class="title">Learn</div>
						<div class="mobile-title up-title-4"><img src="<?php echo base_url('assets/'); ?>images/learn-d.svg"/>Learn<i class="fa fa-angle-up"></i></div>
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
	var postid = $(this).data("postid");

		if (myClass.indexOf('is-checked') > -1){
		  var is_status = '0';
		} else {
		  var is_status = '1';
		}

		var url = "<?php  echo base_url('dashboard/updateskillstatus'); ?>";
    $.ajax({
      type: "POST",
      url: url,
      enctype: 'multipart/form-data',
      data: {
        post_id: postid, status: is_status}
      ,
    //  dataType: 'json',
      success: function(data)
      {
        console.log(data);
		}
      });	
    	
		console.log(is_status);
		console.log(postid);
	});	
	
	</script>