					<!-- Proposals Section Start -->
					<div class="panel panel-default earnPanel">
					  <div class="panel-heading">Proposals</div>
					  <div class="panel-body">
						<ul class="scroll-v-big">
						<?php foreach($proposals as $key=>$val){
						if($val['notification_type']=='24' && $val['post_id']==$skill_byid['p_id']){	
							?>
						<li>
								<div class="row">
									<div class="col-md-12">
										<p><span class="title"><?php echo $val['name']; ?></span></p>
										<p>has shortlisted your Profile</p>
									</div>
									<!--<div class="col-md-12 mt-10 text-right mText-left">
										<button class="btn btn-primary" data-toggle="modal" data-target="#viewContact_<?php echo $key; ?>">View Contact</button>
										<button class="btn btn-gray disabled" data-toggle="tooltip" data-placement="top" data-html="true" data-title="Your interest has been sent">Interested</button>
									</div>-->
								</div>
							</li>
						<?php }else	if($val['notification_type']=='41' && $val['post_type']=='8'){	
							?>
						<li>
								<div class="row">
									<div class="col-md-12">
										<p><span class="title"><?php echo $val['name']; ?></span></p>
										<p>has invested your Funding request</p>
									</div>
								</div>
							</li>						
						<?php 
						}else if($val['notification_type']=='26' && $val['post_id']==$skill_byid['p_id']){ ?>
						<li>
								<div class="row">
									<div class="col-md-12">
										<p><span class="title"><?php echo $val['name']; ?></span></p>
										<p>has given Feedback to your Investor Profile.</p>
									</div>
									
								</div>
							</li>
							
						<?php }else if($val['notification_type']=='17'){ ?>
						<li>
								<div class="row">
									<div class="col-md-12">
										<p><span class="title"><?php echo $val['name']; ?></span></p>
										<p>has requirement for Investor in Fundings</p>
									</div>
									<!--<div class="col-md-12 mt-10 text-right mText-left">
										<button class="btn btn-primary" data-toggle="modal" data-target="#viewContact_<?php echo $key; ?>">View Contact</button>
										<button class="btn btn-gray disabled" data-toggle="tooltip" data-placement="top" data-html="true" data-title="Your interest has been sent">Interested</button>
									</div>-->
								</div>
							</li>
						
						
						<?php } ?>
<div id="viewContact_<?php echo $key; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button class="btn btn-initiate">Proceed</button>
					</p>
					
					
				</div>

			</div>		
		</div>
	</div>
							
						
						<?php } ?>
							</ul>
					  </div>
					</div>
					<!-- Proposals Section End -->
					<!-- Invester Section Start -->
					<div class="panel panel-default earnPanel">
					  <div class="panel-heading">Investor <a id="editind" class="pull-right link">Edit</a><a style="display:none" id="viewind" class="pull-right link">View</a></div>
					  <div class="panel-body">
						<ul class="noBG noBGview">
							<li>
								<h4>Industry</h4>
								<ul class="inline-list">
								<?php 
									$industrylist = json_decode($skill_byid['industry']);
									foreach($industrylist as $industryid) { ?>
										<li><?php echo $industries[$industryid]['industry']; ?> </li>
										<?php } ?>
								
								</ul>

							</li>
							<li>
								<h4>Association </h4>
								<ul class="inline-list">
								<?php $categories = '';
										$roles = json_decode($skill_byid['association']);
										foreach($roles as $cat) { ?>
										<li><?php echo $skills[$cat]['skill']; ?></li>
										<?php } ?>
								</ul>
								
							</li>
							
							<li>
								<h4>Location</h4>
								<ul class="inline-list">
					<?php $locations_decode = json_decode($skill_byid['location']); 
	foreach($locations_decode as $key=>$val){ 	echo '<li>'.$val.'</li>'; } ?>
								</ul>								
							</li>
							<li>
								<h4>Investment </h4>
								<p> <b>Min: </b><?php echo $skill_byid['min_invest']; ?> - <b>Max: </b><?php echo $skill_byid['max_invest']; ?> <?php echo $skill_byid['investment_currency']; ?></p>
															
							</li>
							<li>
								<h4>Share  </h4>
								<p> <b>Min: </b><?php echo $skill_byid['min_share']; ?> - <b>Max: </b><?php echo $skill_byid['max_share']; ?> <?php echo $skill_byid['share_currency']; ?></p>
															
							</li>
													
						</ul>
						<ul class="noBG noBGedit" style="display:none">
							<form action="<?php echo base_url('investor/editinvestorformsubmit'); ?>" id="edit-gain-investor">
							<li>
							<h4>Industry</h4>
							<?php $industrylist = json_decode($skill_byid['industry']);?>
							<select id="select-industry" name="industry[]" multiple class="" placeholder="Select Industry">
				<option value="">Select a Industry...</option>
				<?php foreach($industries as $p){ ?>
					<option value="<?php echo $p['id']; ?>" <?php if(in_array($p['id'], $industrylist)){ echo "Selected"; } ?>>
						<?php echo $p['industry']; ?>
					</option>
					<?php } ?>

			</select>

			<script>
				$('#select-industry').selectize({maxItems: 5});
			</script>
			</li>
			<li>
		<h4>Association Role</h4>	
		<?php $roles = json_decode($skill_byid['association']);?>
		<select id="select-state" name="roles[]" multiple class="mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Association Role">

		<option value="">Select a Role...</option>
		<?php foreach($skills as $p){ ?>
		<option value="<?php echo $p['id']; ?>" <?php if (in_array($p['id'], $roles)){echo 'selected="selected"'; }?>>
		<?php echo $p['skill']; ?>
		</option>
		<?php } ?>

		</select>
		<script>$('#select-state').selectize({maxItems: 5});</script>
		</li>
		<li>
		
		<h4>Location </h4>
			
<div class="geo_locations row">	
					<div class="col-md-9"><input name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
					<div style="display:none" class="map_canvas"></div>
					</div>
					<div class="col-md-1">
					<span id="showsquareee"><i class="fa fa-plus-circle">Add</i></span>
					</div></div>
<div id="geo_locations" class="location-all">
	<?php $locations_decode = json_decode($skill_byid['location']); 
	foreach($locations_decode as $key=>$val){ ?>
	<div class="geo_locations">		
	<div><input class="geocomplete form-control" value="<?php echo $val; ?>" name="location[]" type="hidden" placeholder="Type in an address" size="90" />
	<div style="display:none" class="map_canvas"></div>
	</div>
		<span><?php echo $val; ?></span>
	<span class="closesquare"><i class="fa fa-times-circle"></i></span>
	</div>	
	<?php } ?>	
</div>		
	
		
		</li>
		<li><h4>Invest</h4>
		
		<select class="medium currencyintitate " name="investment_currency" id="investment_currency" required>
					<option value="INR" <?php  if($skill_byid['investment_currency']=='INR'){ echo "Selected";} ?>>India</option>
					<option value="USD" <?php  if($skill_byid['investment_currency']=='USD'){ echo "Selected";} ?>>U.S. Dollar</option>
					<option value="EUR" <?php  if($skill_byid['investment_currency']=='EUR'){ echo "Selected";} ?>>European Euro</option>
					<option value="JPY" <?php  if($skill_byid['investment_currency']=='JPY'){ echo "Selected";} ?>>Japanese </option>
					<option value="GBP" <?php  if($skill_byid['investment_currency']=='GBP'){ echo "Selected";} ?>>British Pound </option>
					<option value="CHF" <?php  if($skill_byid['investment_currency']=='CHF'){ echo "Selected";} ?>>Swiss Franc </option>
					<option value="CAD" <?php  if($skill_byid['investment_currency']=='CAD'){ echo "Selected";} ?>>Canadian Dollar </option>
					<option value="AUD" <?php  if($skill_byid['investment_currency']=='AUD'){ echo "Selected";} ?>>Australian </option>
					<option value="ZAR" <?php  if($skill_byid['investment_currency']=='ZAR'){ echo "Selected";} ?>>South African Rand </option>
					
		</select>
		<script>
			$('#investment_currency').selectize();
		</script>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input name="min_invest" class="mdl-textfield__input form-control" value="<?php echo $skill_byid['min_invest']; ?>" type="number" id="min_invest">
						<label class="mdl-textfield__label" for="sample3">Min Invest</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input name="max_invest" class="mdl-textfield__input form-control" value="<?php echo $skill_byid['max_invest']; ?>" type="number" id="max_invest">
						<label class="mdl-textfield__label" for="sample3">Max Invest</label>
						
					</div>
		</li>
		<li><h4>Share</h4>
		
		<select class="medium currencyintitate " name="share_currency" id="share_currency" required>
					<option value="INR" <?php  if($skill_byid['share_currency']=='INR'){ echo "Selected";} ?>>India</option>
					<option value="USD" <?php  if($skill_byid['share_currency']=='USD'){ echo "Selected";} ?>>U.S. Dollar</option>
					<option value="EUR" <?php  if($skill_byid['share_currency']=='EUR'){ echo "Selected";} ?>>European Euro</option>
					<option value="JPY" <?php  if($skill_byid['share_currency']=='JPY'){ echo "Selected";} ?>>Japanese </option>
					<option value="GBP" <?php  if($skill_byid['share_currency']=='GBP'){ echo "Selected";} ?>>British Pound </option>
					<option value="CHF" <?php  if($skill_byid['share_currency']=='CHF'){ echo "Selected";} ?>>Swiss Franc </option>
					<option value="CAD" <?php  if($skill_byid['share_currency']=='CAD'){ echo "Selected";} ?>>Canadian Dollar </option>
					<option value="AUD" <?php  if($skill_byid['share_currency']=='AUD'){ echo "Selected";} ?>>Australian </option>
					<option value="ZAR" <?php  if($skill_byid['share_currency']=='ZAR'){ echo "Selected";} ?>>South African Rand </option>
					
		</select>
		<script>
			$('#share_currency').selectize();
		</script>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input name="min_share" class="mdl-textfield__input form-control" value="<?php echo $skill_byid['min_share']; ?>" type="number" id="min_share">
						<label class="mdl-textfield__label" for="sample3">Min Share</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input name="max_share" class="mdl-textfield__input form-control" value="<?php echo $skill_byid['max_share']; ?>" type="number" id="max_share">
						<label class="mdl-textfield__label" for="sample3">Max Share</label>
						<input name="p_id" type="hidden" value="<?php echo $skill_byid['p_id']; ?>">
					</div>
		</li>
		<li>
		<button id="submit_form" type="button" class="btn btn-primary center"> Save</button>
		</li>
<?php //print_r($skill_byid); ?>
							</ul>
							</form>
					  </div>
					</div>
					<!-- Invester Section End -->
                    <!-- Feedback Section Start -->
					<?php 
						if($feedback){
						$rate='';
						foreach($feedback as $fr){
							$rate = $rate + $fr['rate'];
						}
						$f_rate =  $rate / count($feedback);
						}else{
						$f_rate=0;	
						}

								?>		
                    <div class="panel panel-default earnPanel">
                        <div class="panel-heading">Feedback <span class="pull-right">
                            <span class="stars" data-rating="<?php echo $f_rate; ?>" data-num-stars="5" ></span></span>
                        </div>
                        <div class="panel-body">
   <ul class="list-group scroll-v">
		<?php 
		foreach($feedback as $f){	?>
			 <li class="list-group-item">
				<div class="row earnPanel">
					<div class="col-xs-7">
						<p class="title mb-0"><?php echo $f['name']; ?></p>
	<p class="date mb-0"><?php echo $f['feedback']; ?></p>
												</div>
				<div class="col-xs-5 text-right">
				<span class="stars" data-rating="<?php echo $f['rate']; ?>" data-num-stars="5" ></span>
				</div>
											</div>
										  </li>
								<?php } 
								if(empty($feedback)){?>
								<li> No Feedbacks</li>	
								<?php } ?> 
      </ul>
                            </ul>
                        </div>
                    </div>
                    <!-- Feedback Section End -->
				