<?php 
    if(isset($investsAll) && count($investsAll)>0){
    foreach($investsAll as $o){
?>
    <span id="tab<?php echo $o['idea_id']; ?>"></span>
    <div class="panel panel-default ideazone-content" id="allPosted_div_<?php echo $o['idea_id']; ?>">
        <div class="panel-heading">
            
            <?php if($o['login_type']==1){
                $profile_pic = (isset($o['profile_picture']) && $o['profile_picture']!='')?$o['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
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
                    <span>&nbsp;</span>
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
                  $industry_pic = "assets/images/industries/".$o['industry_id'].".jpg";                ?>
                <img src="<?php echo base_url().$industry_pic;?>" width="200" height="150"/> 
            </div>
            <div class="div2">
                <h6 class="h6class">Idea Title</h6>
                <p class="ideazonedescription"><?php echo $o['idea_title']; ?></p>
                <h6 class="h6class">Industry</h6>
                <p class="ideazonedescription"><?php echo $o['industry']; ?></p>
                <h6 class="h6class">Description</h6>
                <div id="short_desc_<?php echo $o['inv_id'];?>inv<?php echo $o['post_type'];?>">
                    <p class="ideazonedescription">
                        <?php echo $o['shortdescription'];?>
                    </p>&nbsp;
                    <button class="btn btn-primary" id="expand_content_<?php echo $o['inv_id'];?>inv<?php echo $o['post_type'];?>">
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="long_desc_<?php echo $o['inv_id'];?>inv<?php echo $o['post_type'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $o['longdescription'];?>
                    </p>&nbsp;
                    <span><a id="seemorein_<?php echo $o['inv_id'];?>inv<?php echo $o['post_type'];?>" class="btn btn-xs btn-info">See More</a></span>
                </div>
                <div id="full_desc_<?php echo $o['inv_id'];?>inv<?php echo $o['post_type'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $o['description'];?>
                    </p>&nbsp;
                    <!--span><a id="seeless_<?php echo $o['idea_id'];?>" class="btn btn-xs btn-info">See Less</a></span-->
				<?php if(!empty($o['Initiators'])){ ?>
			<h6>Initiators</h6>
			<?php } ?>
				<div class="row p30">
			<?php foreach($o['Initiators'] as $key=>$val){ ?>
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
								<div class="dark-text"><?php $location = json_decode($val['location']); 
								echo $location['0'];?></div>
							</div>
							<div class="mb-10">
								<div class="gray-text">Budget</div>
								<div class="dark-text"><?php echo $val['currency']; ?> <?php echo $val['invest_min']; ?>- <?php echo $val['invest_max']; ?></div>
							</div>
							<div class="mb-10">
								<div class="gray-text">Share</div>
								<div class="dark-text"> <?php echo $val['share_min']; ?>- <?php echo $val['share_max']; ?> (%)</div>
							</div>
							</div>
							<div>
					<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>">View Contact</button>
							<?php 
								$shortlists=$val['shortlist'];
								if(!empty($shortlists)){ ?>
									<button class="btn"><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $o['ini_id'].'_invested_'.$val['id'].'_invest_'.$val['post_type']; ?>" class="btn shortBtn" data-contact="<?php echo $o['ini_id'].'_invested_'.$val['id'].'_invest_'.$val['post_type']; ?>" data-pid="<?php echo $val['id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>"><span class="shortlist_<?php echo $val['id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $o['ini_id'].'_invested_'.$val['id'].'_invest_'.$val['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $o['ini_id'].'_invested_'.$val['id'].'_invest_'.$val['post_type']; ?>">Shortlisted</span></button>
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
						<button data-contact_type="40" data-contact="<?php echo $o['ini_id'].'_ini_'.$val['id'].'_ini_'.$o['post_type']; ?>"  data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['idea_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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
					
							<?php } ?></div> 
					
					
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