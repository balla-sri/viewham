<?php 
$session_user = $this->session->userdata('user');

foreach ($allinitiate as $a) {
	
if($a['data']['login_type']==1){
                $profile_pic = (isset($a['data']['profile_picture']) && $a['data']['profile_picture']!='')?$a['data']['profile_picture']:'svg.svg';
                $userpic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $userpic = $a['data']['profile_picture'];
            }
			

$data=$a['data'];	
if ($a['post_type'] == '6') {
?>

              <div class="panel panel-default ideazone-content relative">
			  <div class="panel-heading">
                    <div class="row row-eq-height">
                <div class="col-lg-8">
                    <img src="<?php echo $userpic; ?>" class="profile-pic"> 
                    <span class="white"><?php echo $data['name']; ?></span>
                </div>
                <div class="col-lg-4">
                </div>
				</div>
				</div>
                
                <div class="side-ribbon purple-ribbon">
                  <span>Out Source Work
                  </span>
                </div>
                <h6>Project Description
                </h6>
                <p>
                  <?php echo $data['description']; ?>
                </p>
                <h6>Industry
                </h6>
                <p>
					<?php echo $data['industry']; ?>
                </p>
                <h6>Location</h6>
                <p><?php $flocation = array_filter(json_decode($data['location']));
                foreach($flocation as $key=>$value){
                  echo $value."</br>";
                }
                  ?>
                
                </p>                                
                <ul class="investment list-unstyled">
                  <li>Approx Outsource Project Quote 
                    <br> 
                    <span>
                      <?php echo $data['currency_type']; ?>
                      <?php echo $data['min_invest']; ?> - 
                      <?php echo $data['currency_type']; ?>
                      <?php echo $data['max_invest']; ?>
                    </span>
                  </li>
                  <li>Approx Project Deadline / Duration 
                    <br> 
                    <span>
                      <?php echo $data['duration_min']; ?> - 
                      <?php echo $data['duration_max']; ?> 
                      <?php echo $data['duration_type']; ?>
					  </span>
                  </li>
                </ul>
                <div class="">
                  <h6>Contact Details
                  </h6>
                  <p>
                    <b>Name:
                    </b> 
                    <?php echo $data['name']; ?> 
                    <br>
                    <b>Mobile:
                    </b> 
                    <?php echo $data['mobile']; ?> 
                    <br>
                    <b>E-mail:
                    </b> 
                    <a href="mailto:<?php echo $usr['email']; ?>" class="link">
                      <?php echo $data['email']; ?>  </a>
                  </p>
                </div>
              </div>
 <?php }else if ($a['post_type'] == '7') { ?>
              <!-- Franchize Block Start -->
              
 
               <div class="panel panel-default ideazone-content relative">
			  <div class="panel-heading">
                    <div class="row row-eq-height">
                <div class="col-lg-8">
                    <img src="<?php echo $userpic; ?>" class="profile-pic"> 
                    <span class="white"><?php echo $data['name']; ?></span>
                </div>
                <div class="col-lg-4">
                </div>
				</div>
				</div>
                <div class="side-ribbon grey-ribbon">
                  <span>Franchise Offer
                  </span>
                </div>
                <h6>Project Description
                </h6>
                <p>
                  <?php echo $data['description']; ?></p>
                <h6>Industry</h6>
                <p>
                  <?php echo $data['industry']; ?>
                </p>
                <h6>Franchise Modal</h6>
                <p>
                  <?php echo $data['franchize']; ?>
                </p>
                <h6>Location
                </h6>
                <p>
                  <?php $location = array_filter(json_decode($data['location']));
                foreach($location as $key=>$value){
                  echo $value."</br>";
                }
                  ?>
                </p>                                
                <ul class="investment list-unstyled">
                  <li>Approx Investment 
                    <br> 
                    <span>
                      <?php echo $data['currency_type']; ?>
                      <?php echo $data['min_invest']; ?> - 
                      <?php echo $data['currency_type']; ?> 
                      <?php echo $data['max_invest']; ?>
                    </span>
                  </li>
                  <li>Approx Income 
                    <br> 
                    <span>
                      <?php echo $data['currency_type']; ?>
                      <?php echo $data['income_min']; ?> - 
                      <?php echo $data['currency_type']; ?>
                      <?php echo $data['income_max']; ?> 
                      <?php echo $data['income_type']; ?>
                    </span>
                  </li>
                  <li>Approx Break Even 
                    <br> 
                    <span>
                      <?php echo $data['min_break_even'];?> -  
                      <?php echo $data['max_break_even']; ?> 
                      <?php echo $data['break_even_type']; ?>
					</span>
                  </li>
                </ul>
                <div class="">
                  <h6>Contact Details
                  </h6>
                  <p>
                    <b>Name:	
                    </b> 
                    <?php	echo $data['name'];	?> 
                    <br>
                    <b>Mobile:
                    </b> 
                    <?php echo $data['mobile']; ?> 
                    <br>
                    <b>E-mail:
                    </b> 
                    <a href="mailto:<?php echo $data['email']; ?>" class="link">
                      <?php echo $data['email']; ?>
                    </a>
                  </p>
                </div>
              </div>
              <!-- Franchize Block End -->
              <?php
} 
else if ($a['post_type'] == '11') {
?>
              <!-- Business Flag Block Start -->
              <div class="panel panel-default ideazone-content relative" id="Posted_div_<?php echo $a['id']; ?>">
			  <div class="panel-heading">
                    <div class="row row-eq-height">
                <div class="col-lg-8">
                    <img src="<?php echo $userpic; ?>" class="profile-pic"> 
                    <span class="white"><?php echo $data['name']; ?></span>
                </div>
                <div class="col-lg-4">
				<?php if($data['uid']==$session_user){ ?>
                  <span class="pull-right">
                    <a data-deleteid="<?php echo $a['id']; ?>" data-postid="<?php echo $data['id']; ?>" class="posted-delete-<?php echo $a['id']; ?> posted-delete link2">Delete
                    </a>
                  </span><?php } ?>
                </div>
				</div>
				</div>
			  <div class="side-ribbon blue-ribbon">
                  <span>Own Business
                  </span>
                </div>
                <h6>Idea Title
                </h6>
                <p>
                  <?php echo $data['description']; ?>
                </p>
                <h6>Industry
                </h6>
                <p>
				<?php echo $data['description']; ?>
                </p>
                <h6>Current Status </h6>
                <p>
				<?php $c_status=array("1"=>"Idea Stage", "2"=>"Go to Market Stage", "3"=>"Revenue Stage"); 
				echo $c_status[$data['idea_status']]; ?>
                </p>
                <h6>Location </h6>
                <p>
                  <?php $loc = json_decode($data['location']); 
										echo $loc[0];?>
                </p>
                
				
				
			<div id="more_count_<?php echo $a['post_type'].'_'.$a['id']; ?>" class="more-contt hide">
									<!-- innerTabs1 Start -->
									<div class="innerTabStyle1">
									  <ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#bussResources_<?php echo $a['post_type'].'_idea_resources'.$a['id']; ?>" aria-controls="bussResources_<?php echo $a['post_type'].'_idea_resources'.$a['id']; ?>" role="tab" data-toggle="tab">Resources</a></li>
										<li role="presentation"><a href="#bussInvestors_<?php echo $a['post_type'].'_idea_investors'.$a['id']; ?>" aria-controls="bussInvestors_<?php echo $a['post_type'].'_idea_investors'.$a['id']; ?>" role="tab" data-toggle="tab">Investors</a></li>
									  </ul>
									  <div class="tab-content">
										<div role="tabpanel" class="tab-pane p10 active" id="bussResources_<?php echo $a['post_type'].'_idea_resources'.$a['id']; ?>">
											<!-- innerTabs2 Start -->
											<div class="innerTabStyle2">
			  <ul class="nav nav-tabs" role="tablist">
				<?php $i=0; foreach($a['resources'] as $skill=>$skill_details){ ?>
				<li role="presentation" class="<?php if($i==0){ echo "active";} ?>"><a href="#role<?php echo $skill; ?>" aria-controls="role<?php echo $skill; ?>" role="tab" data-toggle="tab"><?php echo $skill_details['skill'];  ?></a>
				</li>
				<?php $i++; } ?>
			  </ul>
			  <div class="tab-content">
				<?php $i=0; foreach($a['resources'] as $skill=>$skill_details){ ?>
				<div role="tabpanel" class="tab-pane p10 <?php if($i==0){ echo "active";} ?>" id="role<?php echo $skill; ?>">
												
					<?php $profilesByskill=$a['skillProfiles'][$skill]; ?>							
						<p class="text-center qty">Quantity:  <?php echo count($profilesByskill);  ?></p>
							<div class="row">
							<?php 
							foreach($profilesByskill as $key=>$profile){
							?>									
							<div class="col-sm-6">
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
										<button class="btn">View Contact</button>
										<button class="btn">Shortlist</button>
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
										<div role="tabpanel" class="tab-pane p10" id="bussInvestors_<?php echo $a['post_type'].'_idea_investors'.$a['id']; ?>">Investors</div>
									  </div>
								   </div>
								   <!-- innerTabs1 End -->
								</div>
						
				
			 <p class="text-center">
                  <a class="see_more_idea see_more_<?php  echo $a['post_type'].'_'.$a['id']; ?>" data-postid="<?php echo $a['post_type'].'_'.$a['id']; ?>">...See More
                  </a>
				  <a class="hide see_less_<?php  echo $a['post_type'].'_'.$a['id']; ?> see_less_idea" data-postid="<?php echo $a['post_type'].'_'.$a['id']; ?>" >...See Less
                  </a>
                </p>
                
              </div>
              <!-- Business Flag Block End -->
              <?php
} else if ($a['post_type'] == '12' && empty($a['ignore_status'])) { ?>
  <div id="ignoreModal_<?php echo $a['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">        
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;
        </button>
        <h5 class="modal-title">Ignore Idea
        </h5>
      </div>
      <div class="modal-body">
        <p>Ignoring the initiated idea will result in deletion of your proposal !
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-initiate ignor_idea" data-postid="<?php echo $a['id']; ?>" data-typeAction="1">Ignore Completely
        </button>
        <button class="btn btn-initiate btn-ignore ignor_idea" data-postid="<?php echo $a['id']; ?>" data-idea_id="<?php echo $a['post_id']; ?>" data-typeAction="2" >Moved to Saved
        </button>
      </div>
    </div>        
  </div></div>

              
			   <div class="panel panel-default ideazone-content relative" id="row_<?php echo $a['id']; ?>">
			  <div class="panel-heading">
                    <div class="row row-eq-height">
                <div class="col-lg-8">
                    <img src="<?php echo $userpic; ?>" class="profile-pic"> 
                    <span class="white"><?php echo $data['name']; ?></span>
                </div>
                <div class="col-lg-4">
				 <span class="pull-right">
                     <button class="btn btn-initiate btn-ignore" data-toggle="modal" data-target="#ignoreModal_<?php echo $a['id']; ?>">Ignore
                    </button>
                  </span>
                </div>
				</div>
				</div>
			  

                <div class="side-ribbon">
                  <span>idea
                  </span>
                </div>
                <h6>Idea Title</h6>
                <p>
                  <?php echo $data['idea_title']; ?>
                </p>
                <h6>Industry</h6>
                <p>
                  <?php echo $data['industry_name']; ?>
                </p>
                <div id="more_count_<?php echo $a['post_type'].'_'.$a['id']; ?>" class="more-contt hide">
				<h6>Description</h6>
				<div><?php echo $data['description']; ?></div>
                  <ul class="investment list-unstyled">
                    <li>Approx Investment 
                      <br> 
                      <span>
                        <?php echo $data['currency']; ?> 
                        <?php echo $data['min_investment']; ?> - 
                        <?php echo $idea['max_investment']; ?>
                      </span>
                    </li>
                    <li>Approx Returns (<?php echo $data['returns_type']; ?>) 
                      <br> 
                      <span> 
                        <?php echo $data['min_returns']; ?> - 
                        <?php echo $data['max_returns']; ?>
                      </span>
                    </li>
                    <li>Approx Break event 
                      <br> 
                      <span>
                        <?php echo $data['breakeven_type']; ?> 
                        <?php echo $data['min_breakeven']; ?> - 
                        <?php echo $data['max_breakeven']; ?>
                      </span>
                    </li>
                  </ul>
<!-- innerTabs1 Start -->
									<div class="innerTabStyle1">
									  <ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#reqSkills_<?php echo $a['post_type'].'_idea_skills'.$a['id']; ?>" aria-controls="reqSkills_<?php echo $a['post_type'].'_idea_skills'.$a['id']; ?>" role="tab" data-toggle="tab">Required Skills</a></li>
										<li role="presentation"><a href="#investors_<?php echo $a['post_type'].'_idea_investors'.$a['id']; ?>" aria-controls="investors_<?php echo $a['post_type'].'_idea_investors'.$a['id']; ?>" role="tab" data-toggle="tab">Investors</a></li>
										<li role="presentation"><a href="#initiators_<?php echo $a['post_type'].'_idea_initiators'.$a['id']; ?>" aria-controls="initiators_<?php echo $a['post_type'].'_idea_initiators'.$a['id']; ?>" role="tab" data-toggle="tab">Initiators</a></li>
									  </ul>
				<div class="tab-content">
				<div role="tabpanel" class="tab-pane p10 active" id="reqSkills_<?php echo $a['post_type'].'_idea_skills'.$a['id']; ?>">
											<!-- innerTabs2 Start -->
				<div class="innerTabStyle2">
				<ul class="nav nav-tabs" role="tablist">
				<?php $i=0; foreach($a['resources'] as $skill=>$skill_details){ ?>
				<li role="presentation" class="<?php if($i==0){ echo "active";} ?>"><a href="#role_<?php echo $skill.'_'.$a['id']; ?>" aria-controls="role_<?php echo $skill.'_'.$a['id']; ?>" role="tab" data-toggle="tab"><?php echo $skill_details['skill'];  ?></a>
				</li>
				<?php $i++; } ?>
											  </ul>
				<div class="tab-content">
				<?php $i=0; foreach($a['resources'] as $skill=>$skill_details){ ?>
				<div role="tabpanel" class="tab-pane p10 <?php if($i==0){ echo "active";} ?>" id="role_<?php echo $skill.'_'.$a['id']; ?>">
												
					<?php $profilesByskill=$a['skillProfiles'][$skill]; ?>							
						<p class="text-center qty">Quantity:  <?php echo count($profilesByskill);  ?></p>
							<div class="row">
							<?php 
							foreach($profilesByskill as $key=>$profile){
							?>									
							<div class="col-sm-6">
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
					<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $a['id'].$profile['p_id'].'_skill_'.$a['post_type']; ?>">View Contact</button>
							<?php 
								$shortlists=$profile['shortlist'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $profile['p_id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $a['id'].'_'.$profile['post_type'].'_'.$profile['p_id'].'_shortlist_'.$a['post_type']; ?>" class="btn shortBtn"
										data-contact="<?php echo $a['id'].'_'.$profile['post_type'].'_'.$profile['p_id'].'_shortlist_'.$a['post_type']; ?>" 
										data-pid="<?php echo $profile['p_id']; ?>" data-toid="<?php echo $profile['posted_by']; ?>" data-post_type="<?php echo $profile['post_type']; ?>"><span class="shortlist_<?php echo $profile['p_id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $a['id'].'_'.$profile['post_type'].'_'.$profile['p_id'].'_shortlist_'.$a['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $profile['p_id']; ?>">Shortlisted</span></button>
										<?php } ?>	
									</div>
								</div>
														</div>
<div id="viewContact_<?php echo $a['id'].$profile['p_id'].'_skill_'.$a['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($profile['paid'])){ ?>
					<div id="contactDetails_<?php echo $a['id'].$profile['p_id'].'_skill_'.$a['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $profile['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $profile['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $profile['email']; ?>" class="link"><?php echo $profile['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $a['id'].$profile['p_id'].'_skill_'.$a['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="38" data-contact="<?php echo $a['id'].$profile['p_id'].'_skill_'.$a['post_type']; ?>" data-post_by="<?php echo $profile['uid']; ?>" data-postid="<?php echo $profile['p_id']; ?>" data-post_type="<?php echo $profile['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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
														
						<?php }?>							
							</div>
													
												</div>
											 <?php $i++; } ?>							

											  </div>						   
										   </div>
										   <!-- innerTabs2 End -->
										</div>
										<div role="tabpanel" class="tab-pane p10" id="investors_<?php echo $a['post_type'].'_idea_investors'.$a['id']; ?>">
										
							<div class="row">
							<?php foreach($a['iniProfiles'] as $key=>$val){ ?>									
							<div class="col-sm-6">
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
			<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_investor_'.$a['post_type']; ?>">View Contact</button>
							<?php $pid = $val['id'];
								$shortlists=$val['shortlist'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$a['post_type']; ?>" class="btn shortBtn"
										data-contact="<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$a['post_type']; ?>" 
										data-pid="<?php echo $val['id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>"><span class="shortlist_<?php echo $val['id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$a['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
										<?php } ?>	
									</div>
								</div>
														</div>
<div id="viewContact_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_investor_'.$a['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php 
					if(empty($val['paid'])){ ?>
					<div id="contactDetails_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_investor_'.$a['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_investor_'.$a['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="38" data-contact="<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_investor_'.$a['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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
										<div role="tabpanel" class="tab-pane p10" id="initiators_<?php echo $a['post_type'].'_idea_initiators'.$a['id']; ?>">
											<div class="row">
							<?php foreach($a['investProfiles'] as $key=>$val){ ?>									
							<div class="col-sm-6">
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
			<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_inititate_'.$a['post_type']; ?>">View Contact</button>
			<?php $pid = $val['id'];
								$shortlists=$val['shortlist'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$a['post_type']; ?>" class="btn shortBtn"
										data-contact="<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$a['post_type']; ?>" 
										data-pid="<?php echo $val['id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>"><span class="shortlist_<?php echo $val['id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$a['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
										<?php } ?>	
									</div>
								</div>
														</div>
<div id="viewContact_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_inititate_'.$a['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php 
					if(empty($val['paid'])){ ?>
					<div id="contactDetails_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_inititate_'.$a['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_inititate_'.$a['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="38" data-contact="<?php echo $a['id'].'_'.$val['post_type'].'_'.$val['id'].'_inititate_'.$a['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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
								   <!-- innerTabs1 End -->
                </div>
                <p class="text-center">
                  <a class="see_more_idea see_more_<?php  echo $a['post_type'].'_'.$a['id']; ?>" data-postid="<?php echo $a['post_type'].'_'.$a['id']; ?>">...See More
                  </a>
				  <a class="hide see_less_<?php  echo $a['post_type'].'_'.$a['id']; ?> see_less_idea" data-postid="<?php echo $a['post_type'].'_'.$a['id']; ?>" >...See Less
                  </a>
                </p>
                
                    </div>
            



			<?php } } ?>
              <!-- Idea Flag Block End -->
             