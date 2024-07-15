<?php 
    if(isset($initiates) && count($initiates)>0){
    foreach($initiates as $o){
?>
    <span id="tab<?php echo $o['idea_id']; ?>"></span>
    <div class="panel panel-default ideazone-content" id="allPosted_div_<?php echo $o['idea_id']; ?>">
        <div class="panel-heading">
            
            <?php if($o['login_type']==1){
                $profile_pic = (isset($o['profile_picture']) && $o['profile_picture']!='')?$o['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            } else if(!isset($o['login_type'])) {
                $prof_pic = $prof_pic = base_url()."assets/images/uploads/svg.svg";;
            }else{
            	$prof_pic = $o['profile_picture'];
            }

            ?>
            <div class="row row-eq-height">
                <div class="col-lg-5">
                    <img src="<?php echo $prof_pic; ?>" class="profile-pic" /> 
                    <span class="white"><?php echo $o['name']; ?></span>
                </div>
                <div class="col-lg-3">
<!--<span class="pull-right"><button class="btn btn-initiate" data-toggle="modal" data-target="#editInitiateModal<?php echo $o['ini_id']; ?>">Initiate <i class="glyphicon glyphicon-pencil"></i></button> &nbsp;<button class="btn btn-initiate btn-ignore" data-toggle="modal" data-target="#ignoreModal">Ignore</button></span>-->
                </div>
                <div class="col-lg-4">
                    <span class="pull-right">
                        <span class="stars allstars_<?php echo $o['idea_id']; ?>" data-rating="<?php echo $o['rating']; ?>" data-num-stars="5"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="industryimg hidden-xs hidden-sm">
                <?php 
                    $industry_pic = "assets/images/industries/".$o['industry_id'].".jpg";
                ?>
                <img src="<?php echo base_url().$industry_pic;?>" width="200" height="150"/> 
            </div>
            <div class="div2">
                <h6 class="h6class">Idea Title</h6>
                <p class="ideazonedescription"><?php echo $o['idea_title']; //print_r($o); ?></p>
                <h6 class="h6class">Industry</h6>
                <p class="ideazonedescription"><?php echo $o['industry']; ?></p>
                <h6 class="h6class">Description</h6>
                <div id="short_desc_<?php echo $o['ini_id'];?>ini<?php echo $o['post_type'];?>">
                    <p class="ideazonedescription">
                        <?php echo $o['shortdescription'];?>
                    </p>&nbsp;
                    <button class="btn btn-primary" id="expand_content_<?php echo $o['ini_id'];?>ini<?php echo $o['post_type'];?>">
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="long_desc_<?php echo $o['ini_id'];?>ini<?php echo $o['post_type'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $o['longdescription'];?>
                    </p>&nbsp;
                    <span><a id="seemorein_<?php echo $o['ini_id'];?>ini<?php echo $o['post_type'];?>" class="btn btn-xs btn-info">See More</a></span>
                </div>
                <div id="full_desc_<?php echo $o['ini_id'];?>ini<?php echo $o['post_type'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $o['description'];?>
                    </p>&nbsp;
                    <!--span><a id="seeless_<?php echo $o['idea_id'];?>" class="btn btn-xs btn-info">See Less</a></span-->
					<div class="innerTabStyle1">
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#reqSkills_<?php echo $o['ini_id'].$o['id']; ?>" aria-controls="reqSkills_<?php echo $o['ini_id'].$o['id']; ?>" role="tab" data-toggle="tab">Required Skills</a></li>
				<li role="presentation"><a href="#investors_<?php echo $o['ini_id'].$o['id']; ?>" aria-controls="investors_<?php echo $o['ini_id'].$o['id']; ?>" role="tab" data-toggle="tab">Investors</a></li>
				<li role="presentation"><a href="#initiators_<?php echo $o['ini_id'].$o['id']; ?>" aria-controls="initiators_<?php echo $o['ini_id'].$o['id']; ?>" role="tab" data-toggle="tab">Initiators</a></li>
			  </ul>
				<div class="tab-content">
				<div role="tabpanel" class="tab-pane p10 active" id="reqSkills_<?php echo $o['ini_id'].$o['id']; ?>">
											<!-- innerTabs2 Start -->
				<div class="innerTabStyle2">
				<ul class="nav nav-tabs" role="tablist">
				<?php $i=0; foreach($o['resources'] as $skill=>$skill_details){ ?>
				<li role="presentation" class="<?php if($i==0){ echo "active";} ?>"><a href="#role_<?php echo $skill.$o['ini_id']; ?>" aria-controls="role_<?php echo $skill.$o['ini_id']; ?>" role="tab" data-toggle="tab"><?php echo $skill_details['skill'];  ?></a>
				</li>
				<?php $i++; } ?>
											  </ul>
				<div class="tab-content">
				<?php $i=0; foreach($o['resources'] as $skill=>$skill_details){ ?>
				<div role="tabpanel" class="tab-pane p10 <?php if($i==0){ echo "active";} ?>" id="role_<?php echo $skill.$o['ini_id']; ?>">
												
					<?php $profilesByskill=$o['skillProfiles'][$skill]; ?>							
						<p class="text-center qty">Quantity:  <?php echo count($profilesByskill);  ?></p>
							<div class="row">
							<?php 
							foreach($profilesByskill as $key=>$profile){
							?>									
							<div class="col-sm-4">
								<div class="profile-box">
									<div class="p10">
									<div class="mb-10">
										<span><?php echo $profile['name']; ?></span>
										<span class="pull-right"><span class="stars" data-rating="3" data-num-stars="5" ></span></span>
									</div>
									<div class="mb-10">
										<div class="gray-text">Skill Name</div>
										<div class="dark-text"><?php echo $profile['skill_name']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Location</div>
										<div class="dark-text"><?php $loc = json_decode($profile['location']); 
										echo $loc[0];?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Experience</div>
										<div class="dark-text"><?php echo $profile['experience']; ?> Years</div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Price</div>
										<div class="dark-text"><?php echo $profile['currency']; ?> <?php echo $profile['price']; ?>/<?php echo $profile['price_per']; ?></div>
									</div>
									</div>
									<div>
					<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $o['ini_id'].$profile['p_id'].'_skill_'.$o['post_type']; ?>">View Contact</button>
								<?php 
								$shortlists=$profile['shortlist'];
								if(!empty($shortlists)){ ?>
										<button class="btn"><span class="shortlist_<?php echo $profile['p_id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $o['ini_id'].'_ini_'.$profile['p_id'].'_ini_'.$profile['post_type']; ?>" class="btn shortBtn" data-contact="<?php echo $o['ini_id'].'_ini_'.$profile['p_id'].'_ini_'.$profile['post_type']; ?>" data-pid="<?php echo $profile['p_id']; ?>" data-toid="<?php echo $profile['posted_by']; ?>" data-post_type="<?php echo $profile['post_type']; ?>"><span class="shortlist_<?php echo $profile['p_id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $o['ini_id'].'_ini_'.$profile['p_id'].'_ini_'.$profile['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $o['ini_id'].'_ini_'.$profile['p_id'].'_ini_'.$profile['post_type']; ?>">Shortlisted</span></button>
										<?php } ?>
									</div>
								</div>
														</div>
<div id="viewContact_<?php echo $o['ini_id'].$profile['p_id'].'_skill_'.$o['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($profile['paid'])){ ?>
					<div id="contactDetails_<?php echo $o['ini_id'].$profile['p_id'].'_skill_'.$o['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $profile['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $profile['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $profile['email']; ?>" class="link"><?php echo $profile['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $o['ini_id'].$profile['p_id'].'_skill_'.$o['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="38" data-contact="<?php echo $o['ini_id'].$profile['p_id'].'_skill_'.$o['post_type']; ?>" data-post_by="<?php echo $profile['uid']; ?>" data-postid="<?php echo $profile['p_id']; ?>" data-post_type="<?php echo $profile['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $profile['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $profile['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $profile['email']; ?>" class="link"><?php echo $profile['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
			
			</div>		
		</div>
	</div>
																					
	<div id="editInitiateModal<?php echo $o['ini_id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit Initiate Idea</h5>

				</div>
				<form class="form-horizontal"  id="update-initiate-form" >
				<div class="modal-body">
					<h5>Offer:</h5>
					<div>
						<div class="md-checkbox md-checkbox-inline">
							<input name="Employee"  id="i1" type="checkbox" >
							<label for="i1">Employee</label>
						</div>
						<div class="md-checkbox md-checkbox-inline">
							<input name="Partner"  id="i2" type="checkbox" >
							<label for="i2">Partner</label>
						</div>
					</div>
					<h5>Request:</h5>
					<div>
						<div class="md-checkbox">
							<input id="i3" type="checkbox" checked>
							<label for="i3" class="funding">Funding</label>
						</div>
						<div class="fundingContent">
							<form class="form-horizontal" action="/">
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Role Expected from Investor:</label>
								<div class="col-sm-5">
									<select name="Role"  class="mb-5" style="width:100%" tabindex="-1">
</select>
<script>
        $(document).ready(function() { 
		$("#editRoleintiate").select2({    placeholder: "Search by Role"});});
    </script>	
								</div>
							  </div>
  <div class="form-group">
		<label class="control-label col-sm-5" for="">Preferred Location:</label>
		<div class="col-sm-5">
<select name="Location" id="editLocationintiate"  class="mb-5" style="width:100%" tabindex="-1">

</select>
	<script>
        $(document).ready(function() { 
		$("#editLocationintiate").select2({    placeholder: "Search by Location" });});
    </script>		
								</div>
							  </div>
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Approx Investment Expected:</label>
								<div class="col-sm-7">
								  <div class="row">
									<div class="col-sm-4">
										<select name="currency" id="editcurrencyintitate" width="100%" class="">
								</select>
								<script>
        $(document).ready(function() { 
		$("#editcurrencyintitate").select2({
    placeholder: "Select by currency"
});});
    </script>
									</div>
		<div class="col-sm-4">
			<input type="number" name="initiate_min" value="<?php  ?>" class="form-control" placeholder="min">
		</div>
		<div class="col-sm-4">
			<input type="number" name="initiate_max" value="<?php ?>" class="form-control" placeholder="max">
			<input type="hidden" name="post_id" value="<?php  ?>" class="form-control" placeholder="Postid">
			<input type="hidden" name="ideapost_id" value="<?php  ?>" class="form-control" placeholder="Postid">
		</div>
								  </div>
								</div>
							  </div>
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Approx Share Offered:</label>
								<div class="col-sm-7">
								  <div class="row">
									<div class="col-xs-5">
										<input value="<?php  ?>" name="share_offered_min" type="number" class="form-control" placeholder="min">
									</div>
									<div class="col-xs-1">
										<span class="percentage">%</span>
									</div>
									<div class="col-xs-5">
										<input value="<?php  ?>" name="share_offered_max" type="text" class="form-control" placeholder="max">
									</div>
									<div class="col-xs-1">
										<span class="percentage">%</span>
									</div>
								  </div>
								</div>
							  </div>
							</form>
						</div>
						<div class="md-checkbox">
							<input name="consultant"  id="i4" type="checkbox" >
							<label for="i4">Consultant</label>
						</div>
						<div class="md-checkbox">
							<input name="mentorship"  id="i5" type="checkbox" >
							<label for="i5">Mentorship</label>
						</div>
					</div>
				</div>
				<div class="modal-footer"><div class="inismsg"></div>
					<button id="update-initiate-submit" data-postinid="<?php  ?>" class="btn btn-initiate btn-ignore">Submit</button>
				</div>
				</form>
				
			</div>		
		</div>
	</div>
																													
						<?php }?>							
							</div>
							</div>
							<?php $i++; } ?>							
							 </div>						   
						</div>
			   <!-- innerTabs2 End -->
					</div>
				<div role="tabpanel" class="tab-pane p10" id="investors_<?php echo $o['ini_id'].$o['id']; ?>">
							<div class="row">
							<?php foreach($o['iniProfiles'] as $key=>$val){ ?>
							<div class="col-sm-4">
								<div class="profile-box">
									<div class="p10">
									<div class="mb-10">
										<span><?php echo $val['name']; ?></span>
										<span class="pull-right"><span class="stars" data-rating="3" data-num-stars="5"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span></span>
									</div>
									<div class="mb-10">
										<div class="gray-text">Skill Name</div>
										<div class="dark-text"><?php echo $val['skill_name']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Location</div>
										<div class="dark-text">
										<?php $location = json_decode($val['location']); echo $location['0']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Budget</div>
										<div class="dark-text"><?php echo $val['currency']; ?> <?php echo $val['invest_min']; ?>-<?php echo $val['invest_max']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Share</div>
										<div class="dark-text"><?php echo $val['share_min']; ?>-<?php echo $val['share_max']; ?> (%)</div>
									</div>
									</div>
									<div>
					<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $o['ini_id'].'_inv_'.$val['id'].'_inv_'.$o['post_type']; ?>">View Contact</button>
								<?php 
								$shortlists=$val['shortlist'];
								if(!empty($shortlists)){ ?>
										<button class="btn"><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>" class="btn shortBtn" data-contact="<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>" data-pid="<?php echo $val['id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>"><span class="shortlist_<?php echo $val['id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>">Shortlisted</span></button>
										<?php } ?>	
									</div>
								</div>
														</div>
<div id="viewContact_<?php echo $o['ini_id'].'_inv_'.$val['id'].'_inv_'.$o['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($val['paid'])){ ?>
					<div id="contactDetails_<?php echo $o['ini_id'].'_inv_'.$val['id'].'_inv_'.$o['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $o['ini_id'].'_inv_'.$val['id'].'_inv_'.$o['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="39" data-contact="<?php echo $o['ini_id'].'_inv_'.$val['id'].'_inv_'.$o['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
			
			</div>		
		</div>
	</div>
																					
							
							<?php }?>	
							</div>
										
										
										</div>
				<div role="tabpanel" class="tab-pane p10" id="initiators_<?php echo $o['ini_id'].$o['id']; ?>">
					<div class="row">
							<?php foreach($o['investProfiles'] as $key=>$val){ ?>									
							<div class="col-sm-4">
								<div class="profile-box">
									<div class="p10">
									<div class="mb-10">
										<span><?php echo $val['name']; ?></span>
										<span class="pull-right"><span class="stars" data-rating="3" data-num-stars="5"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span></span>
									</div>
									<div class="mb-10">
										<div class="gray-text">Skill Name</div>
										<div class="dark-text"><?php echo $val['skill_name']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Location</div>
										<div class="dark-text">
										<?php $location = json_decode($val['location']); echo $location['0']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Budget</div>
										<div class="dark-text"><?php echo $val['currency']; ?> <?php echo $val['invest_min']; ?>-<?php echo $val['invest_max']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Share</div>
										<div class="dark-text"><?php echo $val['share_min']; ?>-<?php echo $val['share_max']; ?> (%)</div>
									</div>
									</div>
									<div>
			<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>">View Contact</button>
								<?php 
								$shortlists=$val['shortlist'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn"><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>" class="btn shortBtn" data-contact="<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>" data-pid="<?php echo $val['id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>"><span class="shortlist_<?php echo $val['id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$val['post_type']; ?>">Shortlisted</span></button>
										<?php } ?>	
									</div>
								</div>
														</div>
				<div id="viewContact_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($val['paid'])){ ?>
					<div id="contactDetails_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="40" data-contact="<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>"  data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
			
			</div>		
		</div>
	</div>
				
							<?php }?>	
							</div>
						
										</div>
									  </div>
								   </div>
			
					
                </div>
                <input type="hidden" id="ideacontent_<?php echo $o['idea_id'];?>" value="0">
                <div id="resource_details_<?php echo $o['idea_id'];?>">
                    
                </div>
                <?php //$this->load->view('ideas/idea_comments_copy');?>
            </div>
			
		
        </div> 
        <?php if(!empty($o['tag_name'])){ ?>
        <div class="panel-footer" style="background-color:#f9f9f9;padding:5px 15px; ">
            <p class="ideatags">
              <?php 
                $tags = explode(',', $o['tag_name']);
                $slug = explode(',', $o['slug']);
                foreach ($tags as $k=>$tag){?>
                <a href="/tag/<?php echo $slug[$k];?>"><?php echo $tag." ";?></a>
            <?php } ?>
            </p>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

        <?php }else{ ?>
    <div class="panel panel-default ideazone-content" id="allPosted_div_0">
        <div class="panel-heading">&nbsp;</div>
        <div class="panel-body">No ideas listed</div>
        <div class="panel-footer">&nbsp;</div>
    </div>
    <?php } ?>
	