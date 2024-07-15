	<?php	if(!empty($_GET['tab'])){
				if($_GET['tab']=='Funding_Requests'){
					  $tabfund="in active";
					  $tabactall='';
				}else{
					$tabactall="in active";
					$tabfund='';			 
				}
			}else{
				$tabactall="in active";
				$tabfund='';			 
			}
			 ?>
					<div>
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="<?php echo $tabactall; ?>"><a class="allinvestbles" href="#allinvestbles" aria-controls="allinvestbles" role="tab" data-toggle="tab">All Investables <span class="badge"><?php echo count($allinvest); ?></span></a></li>
						<li role="presentation" class="<?php echo $tabfund; ?>"><a class="fundingRequests" href="#fundingRequests" aria-controls="fundingRequests" role="tab" data-toggle="tab">Funding Requests <span class="badge blue"><?php echo count($fundings); ?></span></a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane fade <?php echo $tabactall; ?>" id="allinvestbles">
							<!-- Idea Flag Block Start -->
							<?php 
							foreach($allinvest as $aInvest){
							$al = $aInvest['data'];
							$Initiators = $aInvest['Profiles'];
							
							
							if($al['login_type']==1){
								$profile_pic = (isset($al['profile_picture']) && $al['profile_picture']!='')?$al['profile_picture']:'svg.svg';
								$uPic = base_url()."assets/images/uploads/".$profile_pic;
							}else{
								$uPic = $al['profile_picture'];
							}
							
							if($aInvest['post_type']=='12' && empty($aInvest['ignore_status'])){ ?>
					<!-- Idea Flag Block Start -->
			   <div class="panel panel-default ideazone-content relative row_<?php echo $aInvest['id']; ?>" >
			  <div class="panel-heading">
                    <div class="row row-eq-height">
                <div class="col-lg-8">
                    <img src="<?php echo $uPic; ?>" class="profile-pic"> 
                    <span class="white"><?php echo $al['name']; ?></span>
                </div>
                <div class="col-lg-4">
				 <span class="pull-right">
                     <button class="btn btn-initiate btn-ignore" data-toggle="modal" data-target="#ignoreModal_<?php echo $aInvest['id']; ?>">Ignore
                    </button>
                  </span>				
                </div>
				</div>
				</div>
								
								<div class="side-ribbon">
									<span>idea</span>
								</div>								
								<h6>Idea Title</h6>
								<p><?php echo $al['idea_title'] ?></p>
								<h6>Industry</h6>
									<p><?php echo $al['industry_name'] ?></p>
					<div id="more_count_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>" class="more-contt hide">
									<h6>Description</h6>
									<?php echo $al['description'] ?>
			
				<h6>Initiators</h6>
				<div class="row p30">
			<?php foreach($Initiators as $key=>$val){ ?>
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
						<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>">View Contact</button>
								<?php 
								$shortlists=$val['shortlist'];
								if(!empty($shortlists)){ ?>
						
										<button class="btn" ><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
									<?php }else{ ?>										
										<button id="shortlist_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$aInvest['post_type']; ?>" class="btn shortBtn"
										data-contact="<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$aInvest['post_type']; ?>" 
										data-pid="<?php echo $val['id']; ?>" data-toid="<?php echo $val['posted_by']; ?>" data-post_type="<?php echo $val['post_type']; ?>"><span class="shortlist_<?php echo $val['id']; ?>">Shortlist</span></button>
										
										<button id="shortlisted_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_shortlist_'.$aInvest['post_type']; ?>" class="btn " style="display:none"><span class="shortlist_<?php echo $val['id']; ?>">Shortlisted</span></button>
										<?php } ?>	
							</div>
						</div>
					</div>


<div id="viewContact_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>" class="modal fade" role="dialog">
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
					<div id="contactDetails_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $val['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $val['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $val['email']; ?>" class="link"><?php echo $val['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-contact_type="38" data-contact="<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
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
								
							<p class="text-center">
                  <a class="see_more_idea see_more_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>" data-postid="<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>">...See More
                  </a>
				  <a class="hide see_less_<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?> see_less_idea" data-postid="<?php echo $aInvest['id'].'_'.$val['post_type'].'_'.$val['id'].'_initiators_'.$aInvest['post_type']; ?>" >...See Less
                  </a>
                </p>	
							</div>
							
<div id="ignoreModal_<?php echo $aInvest['id']; ?>" class="modal fade" role="dialog">
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
        <button class="btn btn-initiate ignor_idea" data-postid="<?php echo $aInvest['id']; ?>" data-typeAction="1">Ignore Completely
        </button>
        <button class="btn btn-initiate btn-ignore ignor_idea" data-postid="<?php echo $aInvest['id']; ?>" data-idea_id="<?php echo $aInvest['post_id']; ?>" data-typeAction="2">Moved to Saved
        </button>
      </div>
    </div>        
  </div></div>
							
							
							
							<!-- Idea Flag Block End -->		
							
							<?php }
							else if($aInvest['post_type']=='8'){
								
							?>
			<div class="panel panel-default ideazone-content relative" >
			  <div class="panel-heading">
                    <div class="row row-eq-height">
                <div class="col-lg-8">
                    <img src="<?php echo $uPic; ?>" class="profile-pic"> 
                    <span class="white"><?php echo $al['name']; ?></span>
                </div>
                <div class="col-lg-4">
				 				
                </div>
				</div>
				</div>
								
								<div class="side-ribbon purple-ribbon">
									<span>Request for Funding</span>
								</div>								
								<h6>Project Description</h6>
								<p><?php echo $al['description']; ?></p>
                                <h6>Industry</h6>
                                <p><?php echo $al['industry_name'];
								?></p>
								<h6>Current Status</h6>
                                <p><?php  
								if($al['current_status']==1){
								echo "Idea Stage";
								} else if($al['current_status']==2){
								echo "Go to Market Stage";
								}else if($al['current_status']==3){
								echo "Revenue Stage";
								}?>
								</p>
								<h6>Location</h6>
                                <p><?php $location = json_decode($al['location']);
								foreach($location as $key=>$val){
									echo $val."<br>";
								}	?></p>
								<ul class="investment list-unstyled">
									<li>Approx Investment Expected <br> <span><?php echo $al['currency']; ?><?php echo $al['min_amount']; ?> - <?php echo $al['currency']; ?><?php echo $FundDetails['max_amount']; ?></span></li>
									<li>Approx Share Offered <br> <span><?php echo $al['share_min']; ?>% - <?php echo $al['share_max']; ?>%</span></li>
								</ul>
								<h6>Role Expected from Investor</h6>
                               <p><?php $role = $al['expected_role'];
								$roleExpect =array('','As a Sleeping Partner','As a Strategic Partner','As a Co-Founder','As a Financier','As a Mentor','Other');
							echo $roleExpect[$role];
						?></p>
								<?php 
								if($aInvest['paid']['post_id']==$aInvest['post_id']){ ?>
								<div class="">
									<h6>Contact Details</h6>
									<p><b>Name:</b> <?php echo $al['name'];  ?> <br>
									   <b>Mobile:</b> <?php echo $al['mobile'];  ?> <br>
									   <b>E-mail:</b> <a href="mailto:<?php echo $al['email'];  ?>" class="link"><?php echo $al['email'];  ?></a></p>
								</div>
								<?php } ?>
								
								
							</div>
							<?php }

							} ?>
							<!-- Idea Flag Block End -->
							
							
							<!-- Outsource Flag Block Start -->
							<!-- Outsource Flag Block End -->
							
						</div>
						<div role="tabpanel" class="tab-pane fade <?php echo $tabfund; ?>" id="fundingRequests">
							<div class="ideazone-content">
								<div class="row">
		<?php 
			foreach($fundings as $f){?>
			<div class="col-sm-6">
				<div class="profile-box">
					<div class="p10">
					<div class="mb-10">
						<span><?php echo $f['name']; ?></span>
						<span class="pull-right"></span>
					</div>
				<div class="mb-10">
					<div class="gray-text">Industry</div>
					<div class="dark-text"><?php echo $f['industry_name']; ?></div>
				</div>
				<div class="mb-10">
					<div class="gray-text">Location</div>
					<div class="dark-text">
					<?php $location = json_decode($f['location']); 
					foreach($location as $key=>$val){
									echo $val."<br>";
								}?>
					
					</div>
				</div>
				<div class="mb-10">
					<div class="gray-text">Approx Investment</div>
					<div class="dark-text"><?php echo $f['currency']; ?>  <?php echo $f['min_amount']; ?> - <?php echo $f['max_amount']; ?></div>
				</div>
				<div class="mb-10">
					<div class="gray-text">Approx Share</div>
					<div class="dark-text"> <?php echo $f['share_min']; ?>% - <?php echo $f['share_max']; ?>%</div>
				</div>
				</div>
				<div>
					<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $f['id'].'_'.$f['post_type']; ?>">View Contact</button>
					<button class="btn" data-toggle="modal" data-target="#fundingInvest_<?php echo $f['id']; ?>">Invest</button>
				</div>
			</div>
		</div>
									
									<!-- Modal fundingInvest -->
		<div id="fundingInvest_<?php echo $f['id']; ?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">		
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Funding Invest Project</h5>
					</div>
					<div class="modal-body">
					<h6>Description</h6>
						<p><?php echo $f['description']; ?></p>
						<h6>Industry</h6>
						<p><?php echo $f['industry_name']; ?></p>
						<h6>Current Status</h6>
						<p><?php if($f['current_status']==1){
							echo "Idea Stage";
						} else if($f['current_status']==2){
							echo "Go to Market Stage";
						}else if($f['current_status']==3){
							echo "Revenue Stage";
						} ?></p>
						<h6>Location</h6>
						<p><?php $location = $f['location']; 
							foreach($location as $key=>$val){
								echo $val;
							}?></p>
						<ul class="investment list-unstyled">
							<li>Approx Investment Expected <br> <span><?php echo $f['currency']; ?>  <?php echo $f['min_amount']; ?> - <?php echo $f['currency']; ?> <?php echo $f['max_amount']; ?></span></li>
							<li>Approx Share Offered <br> <span><?php echo $f['share_min']; ?>% - <?php echo $f['share_max']; ?>%</span></li>
						</ul>
						<h6>Role Expected from Investor</h6>
						<p><?php $role = $f['expected_role'];
								$roleExpect =array('','As a Sleeping Partner','As a Strategic Partner','As a Co-Founder','As a Financier','As a Mentor','Other');
							echo $roleExpect[$role];
						?></p>
					
					</div>
		<hr class="divider">
                                  <p class="text-right">
		<?php  if(empty($f['initiate'])){ ?>
       <button type="button" data-industry="<?php echo $f['industry']; ?>" data-post_by="<?php echo $f['posted_by']; ?>" data-postid="<?php echo $f['id']; ?>" data-n_type="41" data-post_type="<?php echo $f['post_type']; ?>"  class="btn btn-initiate initiate-store">Invest</button>
		<?php }else{ ?>
		<button type="button"  class="btn btn-initiate">Invested</button>
		<?php }?>
                          </p>                  
				</div>		
			</div>
		</div>

 <div id="viewContact_<?php echo $f['id'].'_'.$f['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($f['paid'])){ ?>
					<div id="contactDetails_<?php echo $f['id'].'_'.$f['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $f['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $f['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $f['email']; ?>" class="link"><?php echo $f['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $f['id'].'_'.$f['post_type']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-post_by="<?php echo $f['posted_by']; ?>" data-postid="<?php echo $f['id']; ?>" data-post_type="<?php echo $f['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $f['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $f['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $f['email']; ?>" class="link"><?php echo $f['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
				
			</div>		
		</div>
	</div>
         

		<?php } ?>
									
								
									
								</div>
							</div>
						</div>
						 </div>
					</div>
				