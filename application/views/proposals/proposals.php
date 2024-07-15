<?php 	$notifictionsCount = NotificationsCount();  ?>
	<section class="ideazone gain"> 
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Proposals</h4>
				</div>
				<div class="col-md-6">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<!-- Left white Panel Start -->
				<?php $this->load->view('common/common-left-menu'); ?>	<!-- Left white Panel End -->
				</div>
				<div class="col-md-9">
					<div class="row ">
						<div class="col-md-8 ">
							<!-- Middle Panel1 Start -->
							<div class="">
							

								<ul class="nav nav-tabs drp-tabs nav-justified" role="tablist">
									<li role="presentation" class="active"><a href="#fromYou" aria-controls="fromYou" role="tab" data-toggle="tab" aria-expanded="true">From You</a></li>
									<li role="presentation" class=""><a href="#toYou" aria-controls="toYou" role="tab" data-toggle="tab" aria-expanded="false">To You</a></li>
									<li role="presentation" class=""><a href="#fromViewham" aria-controls="fromViewham" role="tab" data-toggle="tab" aria-expanded="false">From Viewham</a></li>
								</ul>
							</div>
							
							
							<div class="ideazone-content earnPanel notifyTabs proposalCont p-0">
					
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="fromYou">
								<ul>
								<?php foreach($proposals['shortlist_skill'] as $key=>$val){ ?>
								<li>You Shortlisted <?php echo count($val); ?> Contacts for <?php $ss = $key-1; echo $skills[$ss]['skill']; 
//								echo $key."<pre>";print_r($val);	?><br />
								
								<?php foreach($val as $k=>$value){ ?>
								
								<?php foreach($value['shortlist'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has shown Interest for "<?php echo $skills[$ss]['skill']; ?>" </span>
					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
										
											<br>
								<?php } ?>
								<?php foreach($value['otherviewed'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has viewed contact for "<?php echo $skills[$ss]['skill']; ?>" </span>
		<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
		<br>
								<?php } ?>
				<?php foreach($value['noValid'] as $kval=>$vss){ ?>
				<span><i class="fa fa-chevron-down"></i>
					No more valid this Profile  </span>
				<br>
				<?php } ?>													
								<?php } ?>
								
								
								
								
								</li>
								<?php } ?>

								<?php foreach($proposals['viewedContacts_skill'] as $key=>$val){ ?>
								<li>You Viewed <?php echo count($val); ?> Contacts for <?php $ss = $key-1; echo $skills[$ss]['skill'];	?><br />
											<?php foreach($val as $k=>$value){ ?>
								
								<?php foreach($value['shortlist'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has shown Interest for "<?php echo $skills[$ss]['skill']; ?>" </span>
		<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button><br>
								<?php } ?>
								<?php foreach($value['otherviewed'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has viewed contact for "<?php echo $skills[$ss]['skill']; ?>" </span>
		<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
											<br>
								<?php } ?>
								
								<?php } ?>
								</li>
								<?php } ?>
								
								
								<?php foreach($proposals['shortlist_entreprenuer'] as $key=>$val){ ?>
								<li>You Shortlisted <?php echo count($val); ?> Contacts of Entrepreneur - "<?php $ss = $key-1; echo $industries[$ss]['industry'];	?>"<br />
								<?php foreach($val as $k=>$value){ ?>
								
								<?php foreach($value['shortlist'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has shown Interest for "<?php echo $industries[$ss]['industry']; ?>" </span>
								<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								<?php foreach($value['otherviewed'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has viewed contact for "<?php echo $industries[$ss]['industry']; ?>" </span>
		<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
		<br>
								<?php } ?>
			<?php foreach($value['noValid'] as $kval=>$vss){ ?>
				<span><i class="fa fa-chevron-down"></i>
					No more valid this Profile  </span>
			<?php } ?>
		<br>
								
								
								<?php } ?>
								</li>
								<?php } ?>

								<?php foreach($proposals['shortlist_investor'] as $key=>$val){ ?>
								<li>You Shortlisted <?php echo count($val); ?> Contacts of Investor - "<?php $ss = $key-1; echo $industries[$ss]['industry'];	?>"<br />
								<?php foreach($val as $k=>$value){ ?>
								
								<?php foreach($value['shortlist'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has shown Interest for "<?php echo $industries[$ss]['industry']; ?>" </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								<?php foreach($value['otherviewed'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has viewed contact for "<?php echo $industries[$ss]['industry']; ?>" </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
				<?php foreach($value['noValid'] as $kval=>$vss){ ?>
				<span><i class="fa fa-chevron-down"></i>
					No more valid this Profile  </span>
				<br>
				<?php } ?>					
								<?php } ?>
								</li>
								<?php } ?>
								<?php foreach($proposals['viewcontacts_entreprenuer'] as $key=>$val){ ?>
								<li>You Viewed <?php echo count($val); ?> Contacts of Entrepreneurs - "<?php $ss = $key-1; echo $industries[$ss]['industry'];	?>"<br />
											<?php foreach($val as $k=>$value){ ?>
								<?php foreach($value['shortlist'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has shown Interest for "<?php echo $industries[$ss]['industry']; ?>" </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>								
								<?php foreach($value['otherviewed'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has viewed contact for "<?php echo $industries[$ss]['industry']; ?>" </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								
								<?php } ?>
								</li>
								<?php } ?>
								<?php foreach($proposals['viewcontacts_investor'] as $key=>$val){ ?>
								<li>You Viewed <?php echo count($val); ?> Contacts of Investors - "<?php $ss = $key-1; echo $industries[$ss]['industry'];	?>"<br />
								<?php foreach($val as $k=>$value){ ?>
								
								<?php foreach($value['shortlist'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has shown Interest for "<?php echo $industries[$ss]['industry']; ?>" </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								<?php foreach($value['otherviewed'] as $kval=>$v){ ?>
											<span><i class="fa fa-chevron-down"></i>
											<?php echo truncate($v['name'],2,25); ?>
											has viewed contact for "<?php echo $industries[$ss]['industry']; ?>" </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								
								<?php } ?>			
								</li>
								<?php } ?>
								<?php foreach($proposals['requirementForSkillName'] as $key=>$val){ ?>
								<li>Your requirement for “<?php echo $val['skill_name']; ?>” had posted.<br />
								<?php foreach($val['interest'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>" has shown Interest for "<?php echo $val['skill_name']; ?>". </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>

								
								<?php } ?>
								<?php foreach($val['otherviewed'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>" has shown Interest for "<?php echo $val['skill_name']; ?>".</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>

								</li>
								<?php } ?>
								<?php foreach($proposals['requestForInvestmentFund'] as $key=>$val){ ?>
								<li>Your request for Investment in “<?php echo $val['industry_name']; ?>” had posted.<br />
	
									<?php foreach($val['invest'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>" has an offer to Invest. </span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>

								
								<?php } ?>
								<?php foreach($val['otherviewed'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>"  has viewed contact as Investor.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>								<?php } ?>
								</li>
								
								<?php } ?>
								<?php foreach($proposals['requireForOwnBusiness'] as $key=>$val){ ?>
								<li>Your requirement for Establish Own Business in “<?php echo $val['industry_name']; ?>” had posted.<br />
									
								</li>
								<?php } ?>
								<?php foreach($proposals['requestOutsourceWork'] as $key=>$val){ ?>
								<li>Your requirement for Outsource a Work in “<?php echo $val['industry_name']; ?>” had posted.<br />
										<?php foreach($val['invest'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>" wants to Initiate as Entrepreneur.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								
								<?php } ?>
								<?php foreach($val['otherviewed'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>"  has viewed contact as Entrepreneur.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>								<?php } ?>
								</li>
								<?php } ?>
								<?php foreach($proposals['requestOfferaFranchise'] as $key=>$val){ ?>
								<li>Your requirement for Offer a Franchise in “<?php echo $val['industry_name']; ?>” had posted<br />
								<?php foreach($val['invest'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>" wants to Initiate as Entrepreneur.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								
								<?php } ?>
								<?php foreach($val['otherviewed'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>"  has viewed contact as Entrepreneur.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>								<?php } ?>
								</li>
								<?php } ?>
								<?php foreach($proposals['YourBusinessIdea'] as $key=>$val){ ?>
								<li>Your Business Idea in "<?php echo $val['industry_name']; ?>" had posted<br />
								
								<?php foreach($val['invest_idea'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>"  has Initiated your Business Idea.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								
								<?php } ?>
								<?php foreach($val['initiate_idea'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>"  has an offer to Invest in your Business Idea.</span> 
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br><?php } ?>
								</li>
								<?php } ?>
								<?php foreach($proposals['YouInitiatedaBusiness'] as $key=>$val){ ?>
								<li>You have Initiated a Business Idea in “<?php echo $val['industry_name']; ?>”<br />
								<?php foreach($val['invest_idea'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>"  has Initiated your Business Idea.</span>
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>

								
								<?php } ?>
								<?php foreach($val['initiate_idea'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>"  has an offer to Invest in your Business Idea.</span> 
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								
								
								<?php foreach($val['othershort'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>"  has shortlisted you as Investor.</span>
	<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>

								
								<?php } ?>
								<?php foreach($val['otherviewed'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>"  has viewed contact as Investor.</span> 
<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>								<?php } ?>
								
								
								</li>
								<?php } ?>
								<?php foreach($proposals['YouInvestedaBusinessideas'] as $key=>$val){ ?>
								<li>Your offer for Investment to a Business Idea in “<?php echo $val['industry_name']; ?>” had posted.<br />
								
								<?php foreach($val['othershort'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i>
								"<?php echo truncate($v['name'],2,25); ?>" has shortlisted contact as Investor.</span>
	<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>

								
								<?php } ?>
								<?php foreach($val['otherviewed'] as $k=>$v){ ?>
								<span><i class="fa fa-chevron-down"></i> "<?php echo truncate($v['name'],2,25); ?>" has viewed contact as Investor.</span> 
								<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $v['id']; ?>" data-post_by="<?php echo $v['uid']; ?>" data-post_type="<?php echo $v['post_type']; ?>">View Contact</button>
								<br>
								<?php } ?>
								</li>
								<?php } ?>
								</ul>
									</div>
									<div role="tabpanel" class="tab-pane" id="toYou">
										<ul>
				<?php 
				foreach($proposals['requirementForSkillNameToYo'] as $key=>$value){
					foreach($value['othersjobs'] as $k=>$val){
					$work_type=array(
								'1'=>'Part Time',
								'2'=>'Full Time',
								'3'=>'Work From Home',
								'4'=>'Internship',
								'5'=>'Fresher',
								'6'=>'Contract',
								'7'=>'Commission',
								'8'=>'Volunteer'
								);				
							?>			
									
								<li><?php echo $val['name']; ?> has "<?php $wt= $val['work_type']; echo $work_type[$wt]; ?>" requirement for 	"<?php echo $val['skill_name'];  ?>"  
									<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
									<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
									
									<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass; ?>">Interest</button>
									<?php }?>
									<br />
								</li>
								<li><?php echo $val['name']; ?> has requirement for 	<?php echo $val['skill_name']; ?>  
									<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass; ?>">Interest</button>
									<?php }?>
									<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
									<br />
								</li>
									
									

									<?php } ?>
							
							<?php	foreach($value['skill_shortlist'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> had shortlisted contact for	"<?php echo $value['skill_name'];  ?>"  
							<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass; ?>" data-postid="<?php echo $val['pid']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass; ?>">Interest </button>
									<?php }?>
							
							
							
							<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>		
									<br />
								</li>
							<?php } ?>

							<?php	foreach($value['skill_viewedContacts'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> had viewed contact for "<?php echo $value['skill_name'];  ?>"  

							<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass; ?>" data-postid="<?php echo $val['post_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass; ?>">Interest </button>
									<?php }?>
									
								<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-postid="<?php echo $val['id']; ?>" data-post_by="<?php echo $val['uid']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>

								<br />
								</li>
							<?php } ?>

							<?php	foreach($value['skill_Feedbacks'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> had given Feedback for  "<?php echo $value['skill_name'];  ?>"  
									<br />
								</li>
							<?php } ?>
						

									<?php } ?>
					
					<?php foreach($proposals['gainEntrepreneurToYo'] as $key=>$value){ ?>

							<?php	foreach($value['businessIdeas'] as $k=>$val){ ?>
							
							<li><?php echo $val['name']; ?> A Business Idea has been posted in "<?php echo $value['industry_name'];  ?>"  
									<br />
								</li>
							<?php } ?>
							
							<li><?php echo count($value['businessIdeas']); ?> Business Ideas has posted in  "<?php echo $value['industry_name'];  ?>"  <br />
							</li>
							
							<?php	foreach($value['gain_viewedContacts'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has viewed your contact."<?php echo $value['industry_name'];  ?>"
								<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['post_id']; ?>" data-postid="<?php echo $val['post_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['post_id']; ?>">Interest </button>
									<?php }?>
							<button class="btn btn-primary btn-sm">View Contact</button><br />
							</li>
							<?php } ?>

							<?php	foreach($value['gain_shortlist'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has shortlisted your contact. "<?php echo $value['industry_name'];  ?>"	
								<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['pid']; ?>" data-postid="<?php echo $val['pid']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['pid']; ?>">Interest </button>
									<?php }?>
					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
					<br />
							</li>
							<?php } ?>

							<?php	foreach($value['gain_outsource'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has requirement to "Outsource a Work" in  "<?php echo $value['industry_name'];  ?>"
								<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['id']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['id']; ?>">Interest </button>
									<?php }?>
					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
					<br />
							</li>
							<?php } ?>

							<?php	foreach($value['gain_franchise'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has requirement to "Offer a Franchise" in  "<?php echo $value['industry_name'];  ?>"
								<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['id']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['id']; ?>">Interest </button>
									<?php }?>
					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
					<br />
							</li>
							<?php } ?>
							
					<?php } ?>
					<?php foreach($proposals['gainInvestorToYo'] as $key=>$value){ ?>

							<?php	foreach($value['businessIdeas'] as $k=>$val){ ?>
							
							<li><?php echo $val['name']; ?> A Business Idea has been posted in "<?php echo $value['industry_name'];  ?>"  
									<br />
								</li>
							<?php } ?>
							
							<li><?php echo count($value['businessIdeas']); ?> Business Ideas has posted in  "<?php echo $value['industry_name'];  ?>"  <br />
							</li>
							
							<?php	foreach($value['gain_inv_viewedContacts'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has viewed your contact."<?php echo $value['industry_name'];  ?>"

							<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['post_id']; ?>" data-postid="<?php echo $val['post_id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['post_id']; ?>">Interest </button>
									<?php }?>


					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
					<br />
							</li>
							<?php } ?>

							<?php	foreach($value['gain_inv_shortlist'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has shortlisted your contact. "<?php echo $value['industry_name'];  ?>"	

								<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['pid']; ?>" data-postid="<?php echo $val['pid']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['pid']; ?>">Interest </button>
									<?php }?>
									
					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
					<br />
							</li>
							<?php } ?>

							<?php	foreach($value['gain_fund'] as $k=>$val){ ?>
							<li><?php echo $val['name']; ?> has requirement for Investor in "<?php echo $value['industry_name'];  ?>"
								<?php  $cdtae=$val['create_date']; 
									 $stripped = str_replace(' ', '_', $cdtae);
									 $iclass = str_replace(':', '_', $stripped);
									?>
							<?php if(!empty($val['interest'])){  ?>
									<button class="btn btn-gray disabled btn-sm" disabled>Interested </button>
									<?php }else{ 
									echo $cdtae=$val['interest']['create_date'];
									?>
									<button class="interestpost btn btn-gray btn-sm <?php echo 'skil_by'.$iclass.$val['id']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>" data-post_by="<?php echo $val['uid']; ?>"data-class_name="<?php echo 'skil_by'.$iclass.$val['id']; ?>">Interest </button>
									<?php }?>
					<button data-toggle="modal" data-target="#viewContact_model" class="btn btn-primary pull-right viewContact_model" data-post_by="<?php echo $val['uid']; ?>" data-postid="<?php echo $val['id']; ?>" data-post_type="<?php echo $val['post_type']; ?>">View Contact</button>
					<br />
							</li>
							<?php } ?>

						
							
					<?php } ?>
										</ul>
									</div>
									<div role="tabpanel" class="tab-pane" id="fromViewham">
										<ul>
											<li class="text-center"><b>Welcome to Viewham a platform of opportunity for all</b></li>
											
<li>Get <b>50 Coins  </b> for New User on your Invitation. &nbsp;Get Coins</li>
<li>Get <b>25 Coins  </b> for your Feedback. &nbsp;Get Coins</li>
<li>Get <b>50 Coins  </b> for Post in Learn. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Post in Idea Zone. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Profession Profile. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Hobby Profile. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Other Persons Profile. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Entrepreneur. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Investor. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Recognition. “ i “</li>
<li>Get <b>100 Coins  </b> for Profile Information. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Opinion / Comment / Answer / Appreciate. &nbsp;Get Coins</li>
<li>Get <b>100 Coins  </b> for Share. &nbsp;“ i “</strong></li>											
										</ul>
									</div>
								</div>
							</div>							
							<!-- Middle Panel1 End -->
						</div>
						<div class="col-md-4">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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
	<div id="viewContact_model" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					<div class="pay">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button id="buy_contact" data-post_by="" data-postid="" data-post_type="" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
				</div>
			</div>		
		</div>
	</div>
<script>
   $(document).on("click", ".buy_contact", function(event){
	 var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
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
			if(data.status==1){
			$('.pay').html(data.html);
		}
		}
         });
});
$(".viewContact_model").click(function() {
var post_by = $(this).data('post_by');	
var postid = $(this).data('postid');	
var post_type = $(this).data('post_type');	
$('#buy_contact').attr('data-postid', postid);
$('#buy_contact').attr('data-post_type', post_type);
var url = '<?php echo base_url('proposals/paidcontactornot'); ?>';
$.ajax({
	type: "POST",
	url: url,
    data: {"postid":postid,"post_type":post_type},
	dataType: 'json',
	success: function(data) {
		console.log(data);
		if(data.isSuccess==1){
			$('.pay').html(data.html);
		}

	 }
});
});
</script>		
<style>
p.pull-right-mark {
    margin-right: 0 !important;
    float: right;
}
.no_read {
    background: #bcb4b4 !important;
}
</style>
<script>
$(".interestpost").click(function() {
var post_id = $(this).data('postid');	
var post_type = $(this).data('post_type');	
var posted_by = $(this).data('posted_by');	
var class_name = $(this).data('class_name');	
var url = '/viewham/contact/interest';
$.ajax({
	type: "POST",
	url: url,
    data: {"post_id":post_id,"post_type":post_type,"posted_by":posted_by},
	dataType: 'json',
	success: function(data) {
            if(data.insert==1){
                $('.'+class_name).addClass('disabled');
			 	$('.'+class_name).html('interested');
             }else if(data.insert==2){
                $('.msgs').html('<p class="">Oops Wrong Please try again later</p>')
                $('#MsgModal').modal('toggle');
             }
	 }
});
});

</script>