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
									<li role="presentation" class="active"><a href="#fromYou" aria-controls="fromYou" role="tab" data-toggle="tab" aria-expanded="true">From You(<span class="notify_fromYou"><?php echo $notifictionsCount['fromYou'];?></span>)</a></li>
									<li role="presentation" class=""><a href="#toYou" aria-controls="toYou" role="tab" data-toggle="tab" aria-expanded="false">To You(<span class="notify_toYou"><?php echo $notifictionsCount['toYou']; ?></span>)</a></li>
									<li role="presentation" class=""><a href="#fromViewham" aria-controls="fromViewham" role="tab" data-toggle="tab" aria-expanded="false">From Viewham</a></li>
								</ul>
							</div>
							
							
							<div class="ideazone-content earnPanel notifyTabs proposalCont p-0">
					<?php $notificationsFromYouDisplay=array(
							'2'=>'You Credit coins',
							'4'=>'Your business idea has been posted',
							'9'=>'Your Entrepreneur profile created',
							'10'=>'Your Investor profile created',
							'12'=>'Your Professional profile created',
							'13'=>'Your Hobby profile created',
							'14'=>'Your Mediator profile created',
							'15'=>'Your Outsource project published',
							'16'=>'Your Franchise Offer published',
							'17'=>'Your Request for Funding published',
							'18'=>'Your Offer a Work published',
							'19'=>'Your Request a Work published',
							'20'=>'Your Own business published',
							'21'=>'You sent requirement for Skill',
							'22'=>'You sent requirement for Consultant',
							'23'=>'You sent requirement for Mentor',
							'24'=>'You Shortlisted Profile',
							'25'=>'You Shortlisted Profile',
							'27'=>'You posted Feedback',
							'28'=>'You Viewed Skill Profile Contact',
							'29'=>'You Applied Job',
							'31'=>'You Viewed Outsource Contact',
							'32'=>'You initiated Outsource Project ',
							'33'=>'You viewed Job Contact',
							'34'=>'You initiated idea',
							'36'=>'You invested idea',
							'38'=>'You Viewed skill Contact',
							'39'=>'You viewed idea invest Contact',
							'40'=>'You viewed idea initiate Contact',
							); 
							$notificationsDisplayToyou=array(
							'15'=>'has posted Outsource Project',
							'17'=>'has Requested For Funding',
							'18'=>'has created Offer a post',
							'21'=>'has Required your Skill',
							'22'=>'has Required for Consultant',
							'23'=>'has Required for Mentor',
							'24'=>'has shortlist your profile',
							'26'=>'has Given feedback',
							'29'=>'has applied job',
							'31'=>'viewed outsource project contact',
							'32'=>'has initiate outsource project',
							'33'=>'viewed Your Job Contact',
							'35'=>'Initiated your idea',
							'36'=>'Initiated your idea',
							'37'=>'Invested your idea',
							'38'=>'Viewed initiate Contact',
							); 
							?>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="fromYou">
										<ul>
									<?php 
									foreach($proposals['fromYou'] as $key=>$val){ 
									$ntype = $val['notification_type']; ?>	

									<li id="n_<?php echo $val['id']; ?>" 				
									<?php if($val['status']==1){ ?>
									class="no_read" <?php }?>  ><?php echo $notificationsFromYouDisplay[$ntype]; ?>  <p class="pull-right-mark pointer">
									<?php if($val['status']==1){ ?><span class="mark-as-read mark-as-read_<?php echo $val['id']; ?>" data-status="2" data-nid="<?php echo $val['id']; ?>"> Mark as read </span> <?php } ?><span class="alert-danger n_delete" data-status="3" data-nid="<?php echo $val['id']; ?>">X</span></p></li>
									
								
									<?php } ?>
									</ul>
										<p class="text-right"><a href="#" class="link visible-xs visible-sm mb-20">See More...</a></p>
									</div>
									<div role="tabpanel" class="tab-pane" id="toYou">
										<ul>
									<?php foreach($proposals['toYou'] as $key=>$val){
											$ntypes = $val['notification_type'];
											?>			
									
									<li id="n_<?php echo $val['id']; ?>" 
									<?php if($val['status']==1){ ?>
									class="no_read" <?php }?>  ><?php echo $val['name'].'&nbsp'.$notificationsDisplayToyou[$ntypes]; ?>  <p class="pull-right-mark pointer">
									<?php if($val['status']==1){ ?><span class="mark-as-read mark-as-read_<?php echo $val['id']; ?>" data-status="2" data-nid="<?php echo $val['id']; ?>"> Mark as read </span> <?php } ?><span class="alert-danger n_delete" data-status="3" data-nid="<?php echo $val['id']; ?>">X</span></p></li>
									
									

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
$(".n_delete, .mark-as-read").click(function() {
var Nid = $(this).data('nid');	
var status = $(this).data('status');	
var url = '<?php echo base_url('proposals/notificationupdate'); ?>';
$.ajax({
	type: "POST",
	url: url,
    data: {"nid":Nid,"status":status},
	dataType: 'json',
	success: function(data) {
		if(data.isSuccess==1){
			$('.notify_notification').text(data.totalCount);
			$('.notify_fromYou').text(data.fromYou);
			$('.notify_toYou').text(data.toYou);
		}
		if(status==2){
			$('#n_'+Nid).removeClass('no_read');
			$('.mark-as-read_'+Nid).hide();
		}else if(status==3){
			$('#n_'+Nid).hide();
		}

	 }
});
});

</script>