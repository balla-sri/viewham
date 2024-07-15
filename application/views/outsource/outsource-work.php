	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Out Source your Work</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('outsource/projects'); ?>" class="link mt-10 pull-right">View history</a>
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
					<form id="post-form" action="<?php echo base_url('outsource'); ?>" method="POST">
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
					<br><label class="" for="description">Project Description</label>
				<div class="" style="margin-bottom:10px;">
					<textarea data-attr="description" name="description" class="mdl-textfield__input form-control input" rows="4" type="text" id="description" ></textarea>

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
						
					<label class="mt-20">Approx Outsource Project Quote  <sup class="red">*</sup></label>
					
						
				<div class="grey-form-box">
								<div class="day-col">
					<select class="currencyintitate form-control medium" name="currency_type" id="currency_type" >
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
						<input class="mdl-textfield__input input" data-attr="min_invest" type="number" name="min_invest" id="min1" >
						<label class="mdl-textfield__label" for="min1">Min</label>
					<p class="error min_invest"></p>	
					</div><span>-</span>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input class="mdl-textfield__input input" data-attr="max_invest" type="number" name="max_invest" id="max12" >
						<label class="mdl-textfield__label" for="max1">Max</label>
					<p class="error max_invest"></p>						
					</div>		
					<div>
					<span class="error quote" style="margin-left: 25%;"></span>	
					<span class="error currency_type"></span>	
				</div>
				</div>
					</div>
					<label class="mt-20">Approx Project Deadline/Duration  <sup class="red">*</sup></label>
					<div class="grey-form-box">
					<div class="day-col">
						<select name="duration_type"  class="form-control medium" >
						<option value="Days">Days</option>
						<option value="Months">Months</option>
						</select>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
							<input class="mdl-textfield__input input" data-attr="duration_min" name="duration_min" type="text" id="min12" >
							<label class="mdl-textfield__label" for="min1">Min</label>
						<p class="error duration_min"></p>	
						</div><span>-</span>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
							<input class="mdl-textfield__input input" data-attr="duration_max" name="duration_max" type="text" id="max1" >
							<label class="mdl-textfield__label" for="max1">Max</label>
								<p class="error duration_max"></p>
						</div>	
					
					<div>
					<span class="error duration" style="margin-left: 25%;"></span>	
					<span class="error duration_type"></span>	
				</div>
					
					</div>
							</div>
							
					<button id="submit_form" type="button" class="btn btn-primary sub pull-right ">Submit</button>
					<?php foreach($error as $key=>$val){
						echo $val."<br>";
					} ?>		
						</form>
					<div class="blue-box2 clearfix" id="payment-info">
								<h3>Payment Information</h3>
							<form id="coins-form" action="<?php echo base_url('outsource'); ?>" method="POST">	
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
										<button id="coins_form" type="button" class="btn btn-primary sub mb-0 mr-10">Pay</button>
									</p>
								</div></form>
							</div>
							<div class="blue-box2 clearfix" id="payment-update">
							<div class="row">
									<div class=" col-md-12 text-center">
									<h3> Post published </h3>
									</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script src="<?php echo base_url(); ?>assets/js/custom/outsource-work-form.js"></script>
<?php $this->view('common/common-geo-location'); ?>
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