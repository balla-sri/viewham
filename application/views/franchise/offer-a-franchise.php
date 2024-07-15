	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Offer a Franchise</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('franchise/Projects'); ?>" class="link mt-10 pull-right">View History</a>
				</div>
				<?php $msgg = $this->session->flashdata('msg'); 
				if($msgg){	?>
				<div class="col-md-12  text-center alert alert-success">
				<p><?php echo $msgg; ?></p>
				</div><?php } ?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box">						
					<div class="content">
					<form action="<?php echo base_url('franchise'); ?>" method="POST" id="post-form">
					<label class="lsample" for="title">Industry <sup class="red">*</sup></label>
			<select style="width:100%" id="select-industry" name="industry" data-attr="industry" class="input e2_2ss demo-default" placeholder="Select Industry" >
							<option value="">Select Industry</option>
							<?php foreach($industries as $p){ ?>
							<option value="<?php echo $p['id']; ?>">
							<?php echo $p['industry']; ?>
							</option>
							<?php } ?>

					</select>

					<span class="error industry"></span>

	
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
				<label class="" for="txarea1">Project Description <sup class="red">*</sup></label>
				<textarea data-attr="description" name="description" class="mdl-textfield__input input form-control" rows="4" type="text" id="editor1" ></textarea>
				<span class="error description"></span>
				</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
							<label for="loc1">Location <sup class="red">*</sup> </label>
								<div class="geo_locations row">	
								<div class="col-md-11"><input name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
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
									
				
				
				
				<label class="mt-20">Franchise Model <sup class="red">*</sup></label>
				<select data-attr="franchize" name="franchize" class="form-control mb-10"  >
					<option value="1">Company Owned Company Operated</option>
					<option value="2">Franchisee Owned Company Operated</option>
					<option value="3">Franchisee Owned Franchisee Operated</option>
				</select>							
				<span class="error franchize"></span>	
				<label class="mt-20">Approx Investment <sup class="red">*</sup></label>
				<div class="grey-form-box">
								<div class="day-col">
					<select  class="form-control medium" name="currency_type" id="currency"  >
					<option value="INR">India</option>
					<option value="USD">U.S. Dollar</option>
					<option value="EUR">European Euro</option>
					<option value="JPY">Japanese </option>
					<option value="GBP">British Pound </option>
					<option value="CHF">Swiss Franc </option>
					<option value="CAD">Canadian Dollar </option>
					<option value="AUD">Australian </option>
					<option value="ZAR">South African Rand </option>

					</select>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input data-attr="min_invest" class="mdl-textfield__input input" type="text" name="min_invest"   >
						<label class="mdl-textfield__label" for="min1">Min</label>
					<p class="error min_invest"></p>	
					</div><span>-</span>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input data-attr="max_invest" class="mdl-textfield__input input" type="text" name="max_invest"   >
						<label class="mdl-textfield__label" for="max1">Max</label>
					<p class="error max_invest"></p>
					
					</div>
					<div><span class="error income_type"></span>	
					<span class="error invest" style="margin-left: 23%;"></span>	
					</div>
					
				</div>
							</div>
							<label class="mt-20">Approx Income <sup class="red">*</sup></label>
							<div class="grey-form-box">
					<div class="day-col">
						<select data-attr="income_type" name="income_type" class="form-control medium"  >
						<option value="Daily">Daily</option>
						<option value="Monthly">Monthly</option>
						<option value="Yearly">Yearly </option>

						</select>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
							<input data-attr="income_min" class="mdl-textfield__input input" name="income_min" type="text"   >
							<label class="mdl-textfield__label" for="min1">Min</label>
					<p class="error income_min"></p>	
						</div><span>-</span>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
							<input data-attr="income_max" class="mdl-textfield__input input" name="income_max" type="text"   >
							<label class="mdl-textfield__label" for="max1">Max</label>
					<p class="error income_max"></p>
					</div>									
						<div class="row">									
					<span class="error income" style="margin-left: 25%;"></span>		
					<span class="error currency_type"></span>	
					</div>
					</div>
					</div>
					<label class="mt-20">Break Even <sup class="red">*</sup></label>
							<div class="grey-form-box">
					<div class="day-col">
						<select data-attr="break_even_type" name="break_even_type" class="form-control medium"  >
						<option value="Daily">Daily</option>
						<option value="Monthly">Monthly</option>
						<option value="Yearly">Yearly </option>

						</select>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
							<input data-attr="min_break_even" class="mdl-textfield__input input" name="min_break_even" type="text"   >
							<label class="mdl-textfield__label" for="min1">Min</label>
					<p class="error min_break_even"></p>	
						</div><span>-</span>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
							<input data-attr="max_break_even" class="mdl-textfield__input input" name="max_break_even" type="text"   >
							<label class="mdl-textfield__label" for="max1">Max</label>
					<p class="error max_break_even"></p>
						</div>
					<div class="row">
					<span class="error break_even" style="margin-left: 25%;"></span>	
					<span class="error break_even_type"></span>	
					</div>
					</div>
							</div>
							
							<button id="submit_form" type="button" class="btn btn-primary sub pull-right ">Submit</button>
						
							
							</form>
					<div class="blue-box2 clearfix" id="payment-info">
								<h3>Payment Information</h3>
							<form id="coins-form" action="<?php echo base_url('franchise'); ?>" method="POST">	
								<div class="row">
									<div class="col-md-offset-3 col-md-8">
										<p>
										<input name="coins" type="text" class="coins-spend form-control text-center"  value="50" />
										<input id="postid" name="postid" type="hidden" class="form-control text-center" value="" />
										<span class="text-style1">Coins for "<b><span class="d-hrs">100</span></b>" Hours</span></p>
										<p class="clear text-style1">To display post: "<b>1</b>" Coins per 2 hours</span></p>										
									</div>
									<hr class="divider clearfix" />
									<p class="text-right">
										<button id="coins_form" type="button" class="btn btn-primary sub mb-0 mr-10">Done</button>
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
<script src="<?php echo base_url(); ?>assets/js/custom/offer-a-franchise-form.js"></script>
<?php $this->view('common/common-geo-location') ?>
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