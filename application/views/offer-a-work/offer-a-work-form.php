	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Offer a Work</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('jobs/myofferworks'); ?>" class="link mt-10 pull-right">View History</a>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box">						
						<div class="content">
				<form id="post-form" action="<?php echo base_url('jobs'); ?>" method="POST">
				<label>Skill Type <sup class="red">*</sup></label>
				<select style="width:100%" id="skill" name="skill" class="input e2_2ss demo-default" placeholder="Select Industry" required>
					<option value="">Select Skill</option>
					<?php foreach($skills as $p){ ?>
						<option value="<?php echo $p['id']; ?>">
							<?php echo $p['skill']; ?>
						</option>
						<?php } ?>

							</select>
			<span class="error skill"></span>

				<br>          
				<br>          
				<label>Experience <sup class="red">*</sup></label>
			<select style="width:100%" id="experience" name="experience" class="input e2_2ss mb-10"  placeholder="Select Experience">
                            
                            <option value="0">Fresher</option>
                            <option value="1">0-1 Years</option>
                            <option value="2">1-2 Years</option>
                            <option value="3">2-3 Years</option>
                            <option value="4">3-4 Years</option>
                            <option value="5">4-5 Years</option>
                            <option value="6">5-6 Years</option>
                            <option value="7">6-7 Years</option>
                            <option value="8">7-8 Years</option>
                            <option value="9">8-9 Years</option>
                            <option value="10">More then 10 Years</option>
                        </select>
						<span class="error experience"></span>
							<label>Work Type <sup class="red">*</sup></label>
							<select id="work_type" name="work_type" class="input form-control mb-20">
								<option value="">Select Work type</option>
								<option value="1">Part Time</option>
								<option value="2">Full Time</option>
								<option value="3">Work From Home</option>
								<option value="4">Internship</option>
								<option value="5">Fresher</option>
								<option value="6">Contract</option>
								<option value="7">Commission</option>
								<option value="8">Volunteer</option>
							</select>
						<span class="error work_type"></span>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
							<label  for="txarea1">Job Description <sup class="red">*</sup></label>	
								<textarea name="description" class="input mdl-textfield__input form-control" rows="4" type="text" id="description"></textarea>
								
								<span class="error description"></span>
							</div>						
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
							<label for="loc1">Location <sup class="red">*</sup> </label>
								<div class="geo_locations row">	
								<div class="col-md-11"><input id="location" name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
								<div style="display:none" class="map_canvas"></div>
								</div>
								<div class="col-md-1">
								<span id="showsquareee"><i class="fa fa-plus-circle">Add</i></span>
								</div>
								

								</div>
								
								<div id="geo_locations" class="location-all">
								</div>
									<span class="error location"></span>
							</div>
							<label class="mt-20">Salary <sup class="red">*</sup></label>
							<div class="grey-form-box">
								<div class="day-col">
					<select class="input currencyintitate form-control medium" name="currency" id="currency" >
					<option value="INR">India</option>
					<option value="USD">U.S. Dollar</option>
					<option value="EUR">European Euro</option>
					<option value="JPY">Japanese </option>
					<option value="GBP">British Pound </option>
					<option value="CHF">Swiss Franc </option>
					<option value="CAD">Canadian Dollar </option>
					<option value="AUD">Australian </option>
					<option value="ZAR">South African Rand </option>

					</select>								</select>
					<select id="income_type" name="income_type" class="input form-control medium" >
						<option value="1">Daily</option>
						<option value="2">Monthly</option>
						<option value="3">Yearly </option>

						</select>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
								<input id="min_salary" class="input mdl-textfield__input" name="min_salary" type="text" >
										<label class="mdl-textfield__label" for="min1">Min</label>
									<p class="error min_salary"></p>	
									</div><span>-</span>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
										<input id="max_salary" class="input mdl-textfield__input" name="max_salary" type="text">
										<label class="mdl-textfield__label" for="max1">Max</label>
										<p class="error max_salary"></p>
									</div>	
						<span class="error salary" style="margin-left: 52% !important; margin-right: 0% !important;"></span>
						</div>
								<div>
					<span class="error income_type"></span>	
					
					
					
					</div>	
							</div>
							<button type="button" id="submit_form" class="btn btn-primary sub pull-right ">Submit</button>
							

							</form>
						<div class="blue-box2 clearfix" id="payment-info">
								<h3>Payment Information</h3>
							<form id="coins-form" action="<?php echo base_url('Jobs/spendcoinds'); ?>" method="POST">	
								<div class="row">
									<div class="col-md-offset-3 col-md-8">
										<p>
										<input name="coins" type="text" class="coins-spend form-control text-center"  value="50" />
										<input id="postid" name="postid" type="hidden" value="" />
										<input id="skill_id" name="skill_id" type="hidden" value="" />										<span class="text-style1">Coins for "<b><span class="d-hrs">100</span></b>" Hours</span></p>
										<p class="clear text-style1">To display post: "<b>1</b>" Coins per 2 hours</span></p>										
									</div>
									<hr class="divider clearfix" />
									<p class="text-right">
										<button id="coins_form" type="button" class="btn btn-primary sub mb-0 mr-10">Pay</button>
									</p>
								</div></form>
								</div>
							<div class="blue-box2 clearfix" id="payment-update">
							<div class="row">
									<div class="col-md-offset-3 col-md-8">
									<h3> Post published </h3>
									</div>
							</div>
							
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	</div>
</div>
<?php $this->view('common/common-geo-location') ?>
<script src="<?php echo base_url(); ?>assets/js/custom/offer-a-work-form.js"></script> 
<style>
p.error {
    position: absolute;
    font-size: 12px !important;
    display: inline-block;
    left: -14px;
    right: -15px;
    text-align: center;
    bottom: -31px;
    color: red;
}
</style>

