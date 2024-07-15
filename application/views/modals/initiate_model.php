	<div id="initiatePopup" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Initiate Idea</h5>
				</div>
				<form class="form-horizontal"  id="initiateIdeaForm" >
				<div class="modal-body">
					<h5>Offer:</h5>
					<div>
						<div class="md-checkbox md-checkbox-inline">
							<input name="employee" value="1" id="i1" type="checkbox">
							<label for="i1">Employee</label>
						</div>
						<div class="md-checkbox md-checkbox-inline">
							<input name="partner" value="1" id="i2" type="checkbox">
							<label for="i2">Partner</label>
						</div>
					</div>
					<h5>Request:</h5>
					<div>
						<div class="md-checkbox">
						<input name="funding" id="i3" type="checkbox" value="1">
						<label for="i3" class="funding">Funding</label>
						</div>
<div class="fundingContent" style="display:none">
							<form class="form-horizontal" action="/">
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Role Expected from Investor:</label>
								<div class="col-sm-5">
<select name="role" class="roleintiate mb-5" style="width:100%" tabindex="-1">
<?php foreach($industries as $ind){ ?>
<option  value="<?php echo $ind['id']; ?>"><?php echo $ind['industry']; ?></option>
<?php } ?>
</select>
<script>
$(".roleintiate").select2({placeholder: "Search by Role"});</script>	
								</div>
							  </div>
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Preferred Location:</label>
								<div class="col-sm-5">
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
							  </div>
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Approx Investment Expected:</label>
						<div class="col-sm-7">
						  <div class="row">
							<div class="col-sm-4">
							<select name="currency" width="100%" class="currency">
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
						<script>
		$(".currency").select2({    placeholder: "Select by currency"});</script>
						</div>
					<div class="col-sm-4">
						<input type="text" name="invest_min" data-attr="invest_min"  class="form-control input" placeholder="min">
					</div>
					<div class="col-sm-4">
					<input type="text" name="invest_max" data-attr="invest_max"  class="form-control input" placeholder="max">
					<input type="hidden" name="idea_id" id="initiateIdea_id" >
					<input type="hidden" name="industry" >
									</div>
									<div class="row">
										<span style="text-align:right;margin-top:2px" class="error invest col-md-12"></span>	
										<span class="error invest_min col-md-6"></span>	
										<span class="error invest_max col-md-6"></span>
									</div>
								  </div>
								</div>
							  </div>
							  <div class="form-group">
								<label class="control-label col-sm-5" for="">Approx Share Offered:</label>
								<div class="col-sm-7">
								  <div class="row">
									<div class="col-xs-5">
										<input name="share_min" data-attr="share_min"  type="text" class="form-control input" placeholder="min">
									</div>
									<div class="col-xs-1">
										<span class="percentage">%</span>
									</div>
									<div class="col-xs-5">
										<input name="share_max" type="text" data-attr="share_max" class="form-control input" placeholder="max">
									</div>
									<div class="col-xs-1">
										<span class="percentage">%</span>
									</div>
									<div class="row">
										<span style="text-align:right;margin-top:2px" class="error share col-md-12"></span>	
										<span class="error share_min col-md-6"></span>	
										<span class="error share_max col-md-6"></span>
									</div>
								  </div>
								</div>
							  </div>
							</form>
						</div>
						<div class="md-checkbox">
							<input name="consultant" value="1" id="i4" type="checkbox">
							<label for="i4">Consultant</label>
						</div>
						<div class="md-checkbox">
							<input name="mentorship" value="1" id="i5" type="checkbox">
							<label for="i5">Mentor ship</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="initiate-submit" class="btn btn-initiate btn-ignore">Submit</button>
					
				</div>
				<div class="row"><div class="msgs col-md-12"></div></div>
				</form>
				
			</div>		
		</div>
	</div>
<style type="text/css">
  .pac-container{
    z-index: 99999999999999 !important;
  }
</style>