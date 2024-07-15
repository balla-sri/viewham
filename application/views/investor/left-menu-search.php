			<a href="javascript:void()" class="filter-btn visible-xs visible-sm"><img src="<?php echo base_url(); ?>assets/images/filter.png" alt="filter"></a>
		
		
		<div id="Funding_Requests" class="filter-content grey-block mb-20" style="display:none">
					<h4 class="text-center">Search filters</h4>
						<form>
		<label>Expected Role</label>
		<?php $erole =array('1'=>'As a Sleeping Partner','2'=>'As a Strategic Partner','3'=>'As a Co-Founder','4'=>'As a Financier','5'=>'As a Mentor','6'=>'Other')  ?>
		<select name="expected_role[]" multiple="multiple" class="Role mb-5" style="width:100%" tabindex="-1">	

								
			<?php 
			foreach($erole as $key=>$val){ ?>
			<option  value="<?php echo $key; ?>" <?php if(!empty($_GET['expected_role'])){$marks = $_GET['expected_role']; if (in_array($key, $marks)){  echo "selected";  } }?>><?php echo $val; ?></option>
			<?php } ?>
		</select>
<script>
$(document).ready(function() { $(".Role").select2({ placeholder: "Search by Role" });});
</script>		
					<label>Location</label>
					<input name="location" type="text" class="geocomplete form-control mb-5" placeholder="Search by Location" title="">	
					  <div style="display:none" class="map_canvas"></div>
					<label>Investment
					<select name="currency" class="form-control sub-dw pull-right">
					<option value="">Select Currency</option>			
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='INR'){ echo "selected";}} ?>  value="INR">India</option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='USD'){ echo "selected";}} ?> value="USD">U.S. Dollar</option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='EUR'){ echo "selected";}} ?> value="EUR">European Euro</option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='JPY'){ echo "selected";}} ?> value="JPY">Japanese </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='GBP'){ echo "selected";}} ?> value="GBP">British Pound </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='CHF'){ echo "selected";}} ?> value="CHF">Swiss Franc </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='CAD'){ echo "selected";}} ?> value="CAD">Canadian Dollar </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='AUD'){ echo "selected";}} ?> value="AUD">Australian </option>
					<option <?php if(!empty($_GET['currency'])){ 
					if($_GET['currency']=='ZAR'){ echo "selected";}} ?> value="ZAR">South African Rand </option>
								</select>
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="min_amount" type="text" class="form-control" value="<?php if(!empty($_GET['min_amount'])){ echo $_GET['min_amount']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="max_amount" type="text" class="form-control" value="<?php if(!empty($_GET['max_amount'])){ echo $_GET['max_amount']; }  ?>" placeholder="max" />
								</div>
							</div>	
							
							<label>Share
					
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="share_min" type="text" class="form-control" value="<?php if(!empty($_GET['share_min'])){ echo $_GET['share_min']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="share_max" type="text" class="form-control" value="<?php if(!empty($_GET['share_max'])){ echo $_GET['share_max']; }  ?>" placeholder="max" />
								</div>
							</div>						
							<input type="hidden" name="tab" value="Funding_Requests">
							<p class="mt-20">
							<a href="<?php echo base_url('Investor?tab=Funding_Requests'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
						</div>
		
			