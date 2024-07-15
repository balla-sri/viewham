 <section class="dashboard-box search-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-3 pd-5">
          <div class="grey-box single profile">
            <div class="center-block">
              <img src="<?php echo base_url('assets/images/idea-d.svg'); ?>" class="img-responsive center-block">
              <div class="title center-block text-center">Profiles</div>
            </div>
          </div>
        </div>
        <!-- Profiles -->
        <div class="col-md-9 pd-5">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default blck_one">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#profilesOne"
                    aria-expanded="true" aria-controls="collapseOne"><?php echo count($results['skill']); ?> Profiles found for "<?php echo $params['key']; ?> " </a>
                  <a target="_blank" href="<?php echo base_url('skill/index/?key=').$params['key']; ?>" class="pull-right">View All</a>
                </h4>
              </div>
              <div id="profilesOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="owl-carousel threecolsrow">
					<?php
					foreach($results['skill'] as $key=>$val){ ?>
					<?php if(!empty($val['paid'])){  
						$paidurl = base_url('skill/candidateprofile/').$val['p_id'];
					}else{
						$paidurl = base_url('skill/details/').$val['p_id'];
					}
					?>
                    <div>
                      <div class="profile-box">
                        <div class="p10"  onclick="window.location.href='<?php echo $paidurl; ?>'" >
                          <div class="mb-10"> <span><?php echo truncate($val['name'],2,25); ?></span> <span class="pull-right"><span class="stars"
                                data-rating="3" data-num-stars="5"><i class="fa fa-star"></i><i
                                  class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i
                                  class="fa fa-star-o"></i></span></span> </div>
                          <div class="mb-10">
                            <div class="gray-text">Skill Name</div>
                            <div class="dark-text"><?php echo $val['skill_name']; ?></div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Location</div>
                            <div class="dark-text"><?php $location = json_decode($val['location']); if(!empty($location)){
								echo $location['0'];
							}
							
							
							?> </div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Experience</div>
                            <div class="dark-text"><?php echo $val['experience']; ?> Years</div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Price</div>
                            <div class="dark-text"><?php echo $val['currency']; ?> <?php echo $val['price']; ?>/<?php echo $val['price_per']; ?></div>
                          </div>
                        </div>
                        <div>
			<button data-toggle="modal" data-target="#viewContact_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>" class="btn">View Contact</button>
            
								<?php 
								$shortlists=$val['shortlists'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $val['p_id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>" class="btn shortBtn" data-pid="<?php echo $val['p_id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-postdisplay="<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>"><span class="shortlist_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>" class="btn"  style="display:none"><span class="shortlist_<?php echo $val['p_id']; ?>">Shortlisted</span></button>
										<?php } ?>	
			
                        </div>
                      </div>
                    </div>
			<?php }?>
				</div>
                </div>
              </div>
            
		
			
			</div>
          </div>
        </div>
        <!-- Ideas -->
        <div class="col-md-3 pd-5">
          <div class="grey-box single ideas">
            <div class="center-block">
              <img src="<?php echo base_url('assets/images/idea-d.svg'); ?>" class="img-responsive center-block">
              <div class="title center-block text-center">Ideas</div>
            </div>
          </div>
        </div>
        <div class="col-md-9 pd-5">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default blck_one">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ideasOne" aria-expanded="true"
                    aria-controls="collapseOne"><?php echo count($results['ideas']); ?> Ideas found for " <?php echo $params['key']; ?> " </a>
                  <a href="#ideasOne" class="pull-right">View All</a>
                </h4>
              </div>
              <div id="ideasOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="owl-carousel onecolsrow">
					<?php foreach($results['ideas'] as $key=>$val){
					if($val['login_type']==1){
						if(empty($val['profile_picture'])){
							$pimg = base_url('/assets/images/uploads/svg.svg');
						}else{
							$pimg = base_url('/assets/images/uploads/').$val['profile_picture'];
						}

					}else{
						$pimg = $val['profile_picture'];
					}		?>	
                        <div class="panel panel-default ideazone-content" id="allPosted_div_63">
        <div class="panel-heading">
            
                        <div class="row row-eq-height">
                <div class="col-lg-1">
                    <img src="<?php echo $pimg; ?>" class="profile-pic"> 
                    <span class="white"></span>
                </div>
                <div class="col-lg-5">
                    <span class="span-mt"><?php echo $val['name']; ?></span>
                </div>
                <div class="col-lg-6">
                    <span class="pull-right">
                        <span class="span-mt stars allstars_<?php echo $val['id']; ?>" data-rating="3" data-num-stars="5"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="industryimg hidden-xs hidden-sm">
              <img src="<?php echo base_url('/assets/images/industries/').$val['industry']; ?>.jpg" width="200" height="150"> 
            </div>
            <div class="div2">
                <h6 class="h6class">Idea Title</h6>
                <p class="ideazonedescription"><?php echo $val['idea_title']; ?></p>
                <h6 class="h6class">Industry</h6>
                <p class="ideazonedescription"><?php echo $val['industry_name']; ?></p>
                <h6 class="h6class">Description</h6>
                <div id="short_desc_<?php echo $val['id']; ?>">
                    <p class="ideazonedescription">
						<?php 
						echo truncate($val['description'],50,300);
                       ?>
					   </p>
                    <button class="btn btn-primary see_expand" data-postid="<?php echo $val['id']; ?>" id="expand_content_<?php echo $val['id']; ?>">
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </button>
                </div>
				<div id="long_desc_<?php echo $val['id']; ?>" style="display: none;">
                    <p class="ideazonedescription">
                        <?php 
						echo truncate($val['description'],100,300);
                       ?>
						</p> 
                    <span><a data-postid="<?php echo $val['id']; ?>" id="seemore_<?php echo $val['id']; ?>" class="btn btn-xs btn-info seeMoreNext">See More</a></span>
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
        </div>
        <!--Investors -->
        <div class="col-md-3 pd-5">
          <div class="grey-box single investor">
            <div class="center-block">
              <img src="<?php echo base_url('assets/images/idea-d.svg'); ?>" class="img-responsive center-block">
              <div class="title center-block text-center">Investors</div>
            </div>
          </div>
        </div>
        <div class="col-md-9 pd-5">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default blck_one">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#investorsOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <?php echo count($results['investors']['profiles']); ?> Investors found for " <?php echo $params['key']; ?> " </a>
                  <a target="_blank" href="<?php echo base_url('investor/profiles/?key=').$params['key']; ?>" class="pull-right">View All</a>
                </h4>
              </div>
              <div id="investorsOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="owl-carousel threecolsrow">
					<?php foreach($results['investors']['profiles'] as $key=>$val){ ?>
                    <?php if(!empty($val['paid'])){  
						$paidurl = base_url('skill/candidateprofile/').$val['p_id'];
					}else{
						$paidurl = base_url('skill/details/').$val['p_id'];
					}
					?><div>
                      <div class="profile-box">
                        <div class="p10" onclick="window.location.href='<?php echo $paidurl; ?>'">
                          <div class="mb-10"> <span><?php echo truncate($val['name'],2,25); ?></span> <span class="pull-right"><span class="stars"
                                data-rating="3" data-num-stars="5"><i class="fa fa-star"></i><i
                                  class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i
                                  class="fa fa-star-o"></i></span></span> </div>
                          <div class="mb-10">
                            <div class="gray-text">Industry</div>
                            <div class="dark-text"><?php echo $val['industry_name']; ?></div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Location</div>
                            <div class="dark-text"><?php $location = json_decode($val['location']);
							if(!empty($location)){
								echo $location['0'];
							}?></div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Approx Investment</div>
                            <div class="dark-text"><?php echo $val['investment_currency']; ?> <?php echo $val['min_invest']; ?> - <?php echo $val['max_invest']; ?></div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Approx Share</div>
                            <div class="dark-text"><?php echo $val['share_currency']; ?> <?php echo $val['min_share']; ?> - <?php echo $val['max_share']; ?></div>
                          </div>
                        </div>
                        <div>
			<button data-toggle="modal" data-target="#viewContact_<?php echo $val['p_id'].'_investor_'.$val['post_type']; ?>" class="btn">View Contact</button>
			
								<?php 
								$shortlists=$val['shortlists'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $val['p_id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $val['p_id'].'_investor_'.$val['post_type']; ?>" class="btn shortBtn" data-pid="<?php echo $val['p_id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-postdisplay="<?php echo $val['p_id'].'_investor_'.$val['post_type']; ?>"><span class="shortlist_<?php echo $val['p_id'].'_investor_'.$val['post_type']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $val['p_id'].'_investor_'.$val['post_type']; ?>" class="btn"  style="display:none"><span class="shortlist_<?php echo $val['p_id']; ?>">Shortlisted</span></button>
										<?php } ?>	
                        </div>
                      </div>
                    </div>
					<?php } ?>
				 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Enterprise Profiles -->
        <div class="col-md-3 pd-5">
          <div class="grey-box single entpro">
            <div class="center-block">
              <img src="<?php echo base_url('assets/images/idea-d.svg'); ?>" class="img-responsive center-block">
              <div class="title center-block text-center">Entrepreneur Profiles</div>
            </div>
          </div>
        </div>
        <div class="col-md-9 pd-5">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default blck_one">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#enterpriseprofilesOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <?php echo count($results['entrepreneurs']['profiles']); ?> Entrepreneur Profiles found for " <?php echo $params['key']; ?> " </a>
                  <a target="_blank" href="<?php echo base_url('entrepreneur/profiles/?key=').$params['key']; ?>" class="pull-right">View All</a>
                </h4>
              </div>
              <div id="enterpriseprofilesOne" class="panel-collapse collapse in" role="tabpanel"
                aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="owl-carousel threecolsrow">
					<?php foreach($results['entrepreneurs']['profiles'] as $key=>$val){ ?>
					<?php
					if(!empty($val['paid'])){  
						$paidurl = base_url('skill/candidateprofile/').$val['p_id'];
					}else{
						$paidurl = base_url('skill/details/').$val['p_id'];
					}
					?>
                    <div>
                      <div class="profile-box">
                        <div class="p10" onclick="window.location.href='<?php echo $paidurl; ?>'">
                          <div class="mb-10"> <span><?php echo truncate($val['name'],2,25); ?></span> <span class="pull-right"><span class="stars"
                                data-rating="3" data-num-stars="5"><i class="fa fa-star"></i><i
                                  class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i
                                  class="fa fa-star-o"></i></span></span> </div>
                          <div class="mb-10">
                            <div class="gray-text">Industry</div>
                            <div class="dark-text"><?php echo $val['industry_name']; ?></div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Location</div>
                            <div class="dark-text"><?php 
							$location = json_decode($val['location']);
							if(!empty($location)){
								echo $location['0'];
							};
							
							?></div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text"> Experience </div>
                            <div class="dark-text"><?php echo $val['experience']; ?> Years</div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Budget</div>
                            <div class="dark-text"><?php echo $val['currency']; ?> <?php echo $val['min_budget']; ?> - <?php echo $val['max_budget']; ?></div>
                          </div>
                        </div>
                        <div>
			<button data-toggle="modal" data-target="#viewContact_<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>" class="btn">View Contact</button>
			
								<?php 
								$shortlists=$val['shortlists'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $val['p_id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>" class="btn shortBtn" data-pid="<?php echo $val['p_id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-postdisplay="<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>"><span class="shortlist_<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>" class="btn"  style="display:none"><span class="shortlisted_<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>">Shortlisted</span></button>
										<?php } ?>
                        </div>
                      </div>
                    </div>
					<?php } ?>

					</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Updates & QA's -->
        <div class="col-md-3 pd-5">
          <div class="grey-box single ideas">
            <div class="center-block">
              <img src="<?php echo base_url('assets/images/idea-d.svg'); ?>" class="img-responsive center-block">
              <div class="title center-block text-center">Updates & QA's</div>
            </div>
          </div>
        </div>
        <div class="col-md-9 pd-5">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default blck_one">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#updateqaOne"
                    aria-expanded="true" aria-controls="collapseOne">10 Updates & QA's found for " %S " </a>
                  <a href="#updateqaOne" class="pull-right">View All</a>
                </h4>
              </div>
              <div id="updateqaOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="owl-carousel onecolsrow">

                    <div>

                      <div class="profile-box">
                        <div class="p10">
                          <div class="mb-10">
                            <div class="col-sm-12 col-md-6"> <span>Title </span></div>
                            <div class="col-sm-12 col-md-6">
                              <div class="gray-text pull-left">Posted : </div>
                              <div class="dark-text pull-left">Just now - Hyderabad</div>
                            </div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                              perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore
                              provident quo veritatis iste eos. Saepe molestias sed tempore.Lorem ipsum dolor sit
                              amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla
                              qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe
                              molestias sed tempore.
                            </div>
                          </div>
                          <div class="mb-10">
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Description</div>
                            <div class="dark-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                              perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore
                              provident quo veritatis iste eos. Saepe molestias sed tempore.Lorem ipsum dolor sit
                              amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla
                              qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe
                              molestias sed tempore.</div>
                          </div>
                        </div>
                        <div>
                          <button class="btn">View Idea</button>
                          <button class="btn">Shortlist</button>
                        </div>
                      </div>
                    </div>

                    <div>

                      <div class="profile-box">
                        <div class="p10">
                          <div class="mb-10">
                            <div class="col-sm-12 col-md-6"> <span>Idea Title </span></div>
                            <div class="col-sm-12 col-md-6">
                              <div class="gray-text pull-left">Industry : </div>
                              <div class="dark-text pull-left">Information Technology</div>
                            </div>
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                              perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore
                              provident quo veritatis iste eos. Saepe molestias sed tempore.Lorem ipsum dolor sit
                              amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla
                              qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe
                              molestias sed tempore.
                            </div>
                          </div>
                          <div class="mb-10">
                          </div>
                          <div class="mb-10">
                            <div class="gray-text">Description</div>
                            <div class="dark-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                              perferendis labore nemo quis saepe nulla qui nesciunt et voluptatum sequi, dolore
                              provident quo veritatis iste eos. Saepe molestias sed tempore.Lorem ipsum dolor sit
                              amet consectetur adipisicing elit. Aliquam perferendis labore nemo quis saepe nulla
                              qui nesciunt et voluptatum sequi, dolore provident quo veritatis iste eos. Saepe
                              molestias sed tempore.</div>
                          </div>
                        </div>
                        <div>
                          <button class="btn">View</button>
                          <button class="btn">Shortlist</button>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
<?php foreach($results['skill'] as $key=>$val){ ?>

<div id="viewContact_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">		
<!-- Modal content-->
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h5 class="modal-title">View Contact Details</h5>
	</div>
	<div class="modal-body">
		
		<?php if(empty($val['paid'])){ ?>
		<div id="contactDetails_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>" class="hide">
			<h6>Contact Details:</h6>
			<p><b>Name:</b> <?php echo $val['name']; ?> <br />
			   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
			   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
		</div>
		<div class="pay_<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>">
		<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
		<hr class="divider" />
		<p class="text-right">
			<button data-post_by="<?php echo $val['posted_by']; ?>" data-postid="<?php echo $val['p_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>"data-postday="<?php echo $val['p_id'].'_skill_'.$val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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

	<?php foreach($results['entrepreneurs']['profiles'] as $key=>$val){ ?>

<div id="viewContact_<?php echo $val['p_id'].'_entrepreneurs_'.$val['post_type']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">		
<!-- Modal content-->
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h5 class="modal-title">View Contact Details</h5>
	</div>
	<div class="modal-body">
		
		<?php if(empty($val['paid'])){ ?>
		<div id="contactDetails_<?php echo $val['p_id']; ?>" class="hide">
			<h6>Contact Details:</h6>
			<p><b>Name:</b> <?php echo $val['name']; ?> <br />
			   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
			   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
		</div>
		<div class="pay_<?php echo $val['p_id']; ?>">
		<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
		<hr class="divider" />
		<p class="text-right">
			<button data-post_by="<?php echo $val['posted_by']; ?>" data-postid="<?php echo $val['p_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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

	<?php foreach($results['investors']['profiles'] as $key=>$val){ ?>
			
		<div id="viewContact_<?php echo $val['p_id'].'_investor_'.$val['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($val['paid'])){ ?>
					<div id="contactDetails_<?php echo $val['p_id']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $val['p_id']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-post_by="<?php echo $val['posted_by']; ?>" data-postid="<?php echo $val['p_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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
<script>
$(".shortBtn").click(function(){
	var pid = $(this).data('pid');
	var post_type = $(this).data('post_type');
	var toid = $(this).data('toid');
	var url = "<?php echo base_url('skill/shortlistadd'); ?>";
    var postdisplay = $(this).data('postdisplay');
	        
    $.ajax({
           type: "POST",
           url: url,
		   enctype: 'multipart/form-data',
		   data: {pid: pid, post_type: post_type, toid: toid},
		   dataType: 'json',
           success: function(data)
           {
            console.log(data);
			if(data.session==3){
				$('#signinModal').modal('toggle');
			}
			if(data.insert==1){
				console.log(postdisplay);
				$('#shortlist_'+postdisplay).hide();
				$('.shortlist_'+postdisplay).html('shortlisted');
				$('#shortlisted_'+postdisplay).show();
			}
           }
         });
});
</script>
<script>
$(document).ready(function() {
$(".seeMoreNext").click(function() {
	var postid = $(this).data('postid');
	    var url = "<?php echo base_url('skill/checksession'); ?>";
	    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           dataType: 'json',
           success: function(data)
           {
 		   console.log(data);
			if(data.session_exist==0){
				$('#signinModal').modal('toggle');	
			}else{
				window.location.href = "<?php echo base_url('businessideas/idea/'); ?>"+postid;
			} 
		}
         });

});
$(".see_expand").click(function() {
var postid = $(this).data('postid');
$('#expand_content_'+postid).hide();	
$('#long_desc_'+postid).show();	
});	
$('.contact-details').hide();	
$('.pay-contact-view').hide();	
$(".view-contact").click(function() {
var btn_id = $(this).data('postid'); 
$('.vc_'+btn_id).hide();		
$('.pcv_'+btn_id).show('slow');		
});
$(".buy_contact").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var postdisplay = $(this).data('postdisplay');
    var n_type = 31;
    var url = "<?php echo base_url('contact/buycontact'); ?>";
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
 		   console.log(data);
			if(data.emptySession==1){
				$('#viewContact_'+postdisplay).modal('toggle'); 
				$('#signinModal').modal('toggle');	
			}else{	
			if(data.status==1){
				$('.pay_'+postdisplay).addClass('hide');
				$('#contactDetails_'+postdisplay).removeClass('hide');
			 }else{
				$('#viewContact_'+postdisplay).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
			} 
		}
         });
});
});
</script>
<script>
    $('.onecolsrow').owlCarousel({
      items: 1,
      loop: true,
      margin: 10,
        stagePadding:5,
      autoplay: false,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      responsiveClass: true,
      nav: true,
      rewindNav: true,
      navText: ["<img src='/assets/images/leftarrow.svg'>","<img src='/assets/images/rightarrow.svg'>"]
    });


    $(document).ready(function () {
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        stagePadding:20,
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsiveClass: true,
      
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: true
          },
          1000: {
            items: 3,
            nav: true,
            margin: 20
          }
        },
      navText: ["<img src='/assets/images/leftarrow.svg'>","<img src='/assets/images/rightarrow.svg'>"],
        rewindNav: true

      });
      $('.play').on('click', function () {
        owl.trigger('play.owl.autoplay', [1000])
      })
      $('.stop').on('click', function () {
        owl.trigger('stop.owl.autoplay')
      })
    })

    $(document).ready(function () {
      $('.down-title-1').hide();
      $('.up-title-2').hide();
      $('.up-title-3').hide();
      $('.up-title-4').hide();
      if ($(window).width() > 1000) {
        $('.panel2').show();
        $('.panel3').show();
        $('.panel4').show();
      }
      if ($(window).width() <= 1000) {
        $('.panel2').hide();
        $('.panel3').hide();
        $('.panel4').hide();
        $('.up-title-1').click(function () {
          $('.down-title-1').show();
          $('.up-title-1').hide();
          $('.panel1').hide('slow');
        });
        $('.down-title-1').click(function () {
          $('.up-title-1').show();
          $('.down-title-1').hide();
          $('.panel1').show('slow');
        });
        $('.down-title-2').click(function () {
          $('.down-title-2').hide();
          $('.up-title-2').show();
          $('.panel2').show('slow');
        });
        $('.up-title-2').click(function () {
          $('.up-title-2').hide();
          $('.down-title-2').show();
          $('.panel2').hide('slow');
        });
        $('.down-title-3').click(function () {
          $('.down-title-3').hide();
          $('.up-title-3').show();
          $('.panel3').show('slow');
        });
        $('.up-title-3').click(function () {
          $('.up-title-3').hide();
          $('.down-title-3').show();
          $('.panel3').hide('slow');
        });
        $('.down-title-4').click(function () {
          $('.down-title-4').hide();
          $('.up-title-4').show();
          $('.panel4').show('slow');
        });
        $('.up-title-4').click(function () {
          $('.up-title-4').hide();
          $('.down-title-4').show();
          $('.panel4').hide('slow');
        });
      }
    });
  </script>
  <script>
    $.fn.stars = function () {
      return $(this).each(function () {
        var rating = $(this).data("rating");
        var numStars = $(this).data("numStars");
        var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
        var halfStar = ((rating % 1) !== 0) ? '<i class="fa fa-star-half-empty"></i>' : '';
        var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
        $(this).html(fullStar + halfStar + noStar);
      });
    }
    $('.stars').stars();
  </script>
