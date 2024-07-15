	<section class="ideazone"> 
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0"><?php echo $page_name; ?> Jobs</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('Jobs/offerwork'); ?>" class="btn btn-info mb-0 mblock-btn">Offer a Work</a>
				</div>
			</div>
			<div class="row relative">
				<div class="col-md-3">
					<a href="javascript:void()" class="filter-btn visible-xs visible-sm"><img src="images/filter.png" alt="filter"/></a>
					<div class="grey-block filter-content mb-20">
						<h4 class="text-center">Search filters</h4>
						<form>
                            <label>Skill Name</label>
							<select name="skill[]" id="e2_2" multiple="multiple" class="e2_2aaa mb-5" style="width:100%" tabindex="-1">
							<?php
							
							foreach($skills as $ind){ ?>
							<option  value="<?php echo $ind['id']; ?>" <?php if(!empty($_GET['skill'])){$marks = $_GET['skill'];
							if (in_array($ind['id'], $marks)){  echo "selected";  } }?>><?php echo $ind['skill']; ?></option>
							<?php } ?>
							</select>
													
							<label>Experience</label>
							<div class="row">
							<div class="col-xs-12">
							<select name="experience" class="form-control">
								<option value="" >Select Years</option>
								<option value="1" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '1'){ echo "selected";} } ?> >1 Years +</option>
								<option value="2" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '2'){ echo "selected";} } ?>>2 Years +</option>
								<option value="3" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '3'){ echo "selected";} } ?>>3 Years +</option>
								<option value="4" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '4'){ echo "selected";} } ?> >4 Years +</option>
								<option value="5" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '5'){ echo "selected";} } ?>>5 Years +</option>
								<option value="6" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '6'){ echo "selected";} } ?>>6 Years +</option>
								<option value="7" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '7'){ echo "selected";} } ?> >7 Years +</option>
								<option value="8" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '8'){ echo "selected";} } ?>>8 Years +</option>
								<option value="9" <?php if(!empty($_GET['experience'])){ if($_GET['experience'] == '9'){ echo "selected";} } ?>>9 Years +</option>
							</select>
							</div>
							</div>
							<label>Work Type
							<select name="currency" class="sub-dw pull-right">
									<option value="">select currency</option>
									<option value="INR" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'INR'){ echo "selected";} } ?>>India</option>
					                <option value="USD" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'USD'){ echo "selected";} } ?>>U.S. Dollar</option>
					                <option value="EUR" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'EUR'){ echo "selected";} } ?>>European Euro</option>
					                <option value="JPY" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'JPY'){ echo "selected";} } ?>>Japanese </option>
					                <option value="GBP" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'GBP'){ echo "selected";} } ?>>British Pound </option>
					                <option value="CHF" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'CHF'){ echo "selected";} } ?>>Swiss Franc </option>
					                <option value="CAD" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'CAD'){ echo "selected";} } ?>>Canadian Dollar </option>
					                <option value="AUD" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'AUD'){ echo "selected";} } ?>>Australian </option>
					                <option value="ZAR" <?php if(!empty($_GET['currency'])){ if($_GET['currency'] == 'ZAR'){ echo "selected";} } ?>>South African Rand </option>
								</select></label>
						<div class="row">
						<div class="col-xs-12">
						<select name="work_type" class="form-control">
							    <option value="" >Select </option>
								<option value="1" <?php if(!empty($_GET['work_type'])){ if($_GET['work_type'] == '1'){ echo "selected";} } ?>>Design</option>
								<option value="2" <?php if(!empty($_GET['work_type'])){ if($_GET['work_type'] == '2'){ echo "selected";} } ?>>Development</option>
								<option value="3" <?php if(!empty($_GET['work_type'])){ if($_GET['work_type'] == '3'){ echo "selected";} } ?>>Testing</option>
							</select>							
                           </div> 
                           </div> 
							<label>Salary
							
								<select name="income_type" class="form-control sub-dw pull-right">
								    <option value="" >Select</option>
									<option value="1" <?php if(!empty($_GET['income_type'])){ if($_GET['income_type'] == '1'){ echo "selected";} } ?>  >Daily</option>
									<option value="2" <?php if(!empty($_GET['income_type'])){ if($_GET['income_type'] == '2'){ echo "selected";} } ?>  >Monthly</option>
								    <option value="3" <?php if(!empty($_GET['income_type'])){ if($_GET['income_type'] == '3'){ echo "selected";} } ?> >Yearly</option>
								</select>
								</label>
							<div class="row">
								<div class="col-xs-6">
									<input type="text" name="min_salary" value="<?php if(!empty($_GET['min_salary'])){echo $_GET['min_salary']; }?>" class="form-control" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input type="text" name="max_salary" value="<?php if(!empty($_GET['max_salary'])){echo $_GET['max_salary']; }?>" class="form-control" placeholder="max" />
								</div>
							</div>
							
							<p class="mt-20">
							<a href="<?php echo base_url('jobs/index'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
					</div>
				</div>
				<div class="col-md-9">
				<?php
					$jobs=$alljobs['job'];
					if(empty($jobs)){
						echo '<div class="ideazone-content"><div class=" text-center p10"> No Jobs Available right now. </div></div>';
					}
						foreach($jobs as $j){?>
					<div class="panel panel-default sidePanel no-radius jobs">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<h3><?php echo $j['skill_name'];?></h3>
									<p class="estimate font15"><?php $loc = json_decode($j['location']);
									foreach($loc as $key=>$val){ echo '<i class="fa fa-map-marker"></i> '.$val."<br>";}
									?></p>
								</div>
								<div class="col-md-6 text-right">
								<?php $sal=array('1'=>'Daily','2'=>'Monthly','3'=>'Yearly'); ?>
									<p class="estimate"><span><i class="fa fa-suitcase"></i> <?php echo $j['experience'];?> Years</span><em class="line-seperator">|</em><span> <?php echo $j['currency'];?> <?php echo $j['min_salary'];?> to <?php echo $j['max_salary'];?> <?php $sal_type = $j['income_type'];
									echo $sal[$sal_type]; ?></span></p>
								</div>
							</div>
							<h6>Job Description</h6>
							<p><?php 
							echo $string = substr($j['description'],0,50);
							?><a href="<?php echo base_url('jobs/details/').$j['id'];?>" class="link font-bold"> ..See More</a></p>
							<hr class="line-divider" />
							<div class="row">
								<div class="col-md-6">
									<p class="estimate font15 mb-0 mt-5"><span>Posted by <b class="font16"><i class="fa fa-user"></i> 
									<span title="<?php echo $j['name']; ?>"><?php echo truncate($j['name'],2,10); ?></span>
									
									</b><em class="line-seperator">|</em><?php echo $j['create_date'];?></span></p>
								</div>
								<div class="col-md-6 promo flex-right">
							<?php  
							$jid = $j['id'];
							$found='';	
							foreach($profiles as $key=>$val){
							if($val['skill']){
								if(in_array($j['skill'], $val)){
									$found .=1;
									$p_id=$val['p_id'];
									$p_type=$val['post_type'];
								}
							}
							if($val['association']){
								$association=json_decode($val['association']);
								if(in_array($j['skill'], $association)) {
									$found .=1;
									$p_id=$val['p_id'];
									$p_type=$val['post_type'];
								}							
							}
							
							
							}
								
							if($found){
								
								$shortlist=$alljobs['intrest'][$jid]['posted_by'];
								if($shortlist==$session_userid){ ?>
									<button type="button" class="btn btn-primary mt-5 mb-0 mr-10 applied">Applied</button>
									<?php }else{ ?>	
									<button type="button" id="shortlist_<?php echo $j['id']; ?>"  data-url="<?php echo base_url('jobs/interest'); ?>" data-postid="<?php echo $j['id']; ?>" data-post_type="10" data-profile_type="<?php echo $p_type; ?>" data-posted_by="<?php echo $j['posted_by']; ?>" data-p_id="<?php echo $p_id; ?>"  class="btn btn-primary mt-5 mb-0 mr-10 initiate-store">Apply </button>
									<button style="display:none" type="button" id="shortlisted_<?php echo $j['id']; ?>" class="btn btn-primary applied mt-5 mb-0 mr-10 ">Applied</button>
									<?php } }else{ ?>
									<a href="<?php echo base_url('earn/profile/').$j['skills']; ?>" class="btn btn-primary mt-5 mb-0 mr-10 applied">Create Profile & Apply</a>
									<?php } ?>
						   	<button data-toggle="modal" data-target="#viewContact_<?php echo $j['id']; ?>" class="btn btn-primary mt-5 mb-0">View Contact</button>		
								</div>
							</div>
						</div>
					</div>
		<div id="viewContact_<?php echo $j['id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($j['paid'])){ ?>
					<div id="contactDetails_<?php echo $j['id']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $j['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $j['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $j['email']; ?>" class="link"><?php echo $j['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $j['id']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-post_by="<?php echo $j['posted_by']; ?>" data-postid="<?php echo $j['id']; ?>" data-post_type="<?php echo $j['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $j['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $j['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $j['email']; ?>" class="link"><?php echo $j['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
				
			</div>		
		</div>
	</div>

			
					
					<?php }
					 ?>
					
					
				</div>
			</div>
		</div>
		<!-- Modal -->
		
		
		
	</section>
		<!-- initiate Modal -->
<div id="MsgModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
            
                <!-- Modal content-->
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                    
                        <div class="msgs"></div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            
                </div>
            </div>	
	
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
	
<style>
.applied {
    color: #ffffff !important;
    background: #675ade !important;
}
</style>
<script src="<?php echo base_url(); ?>assets/js/custom/jobs_list.js"></script>
