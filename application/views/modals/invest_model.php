<div id="investModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Invest Idea</h5>
				</div>
				<div class="modal-body">
					<form id="investIdeaForm" class="form-horizontal" action="/">
					  <div class="form-group">
						<label class="control-label col-sm-5" for="">Association Role:</label>
						<div class="col-sm-5">
							
<select name="role" class="role mb-5 input_inv" style="width:100%" tabindex="-1">
								<option value="1">As a Sleeping Partner</option>
								<option value="2">As a Strategic Partner</option>
								<option value="3">As a Co-Founder</option>
								<option value="4">As a Financier</option>
</select>
<script>
$(".role").select2({placeholder: "Search by Role"});</script>						
						</div>
					  </div>
					  <div class="form-group">
								<label class="control-label col-sm-5" for="">Preferred Location:</label>
								<div class="col-sm-5">
								<label for="loc1">Location <sup class="red">*</sup> </label>
								<div class="geo_locations row">	
								<div class="col-md-11"><input name="location[]" data-attr="location" class="input_inv geocomplete mdl-textfield__input location" type="text" >
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
						<label class="control-label col-sm-5" for="">Approx Investiment Expected:</label>
						<div class="col-sm-7">
						  <div class="row">
							<div class="col-sm-4">
								<select name="currency" class="input_inv currencys">
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
			$(".currencys").select2({placeholder: "Select by currency"});
			 </script>	
							</div>
							<div class="col-sm-4">
							<input type="text" name="invest_min" data-attr="invest_min"  class="form-control input_inv" placeholder="min">
							</div>
							<input type="hidden" name="idea_id"  id="investIdea_id">
							<input type="hidden" name="industry" >
							<div class="col-sm-4">
								<input type="text" name="invest_max" data-attr="invest_max"  class="input_inv form-control" placeholder="max">
							</div>
							<div class="row">
										<span style='text-align:right;margin-top: 2px' class="error invest col-md-12"></span>	
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
								<input type="text" name="share_min" class="form-control input_inv" data-attr="share_min" placeholder="min">
							</div>
							<div class="col-xs-1">
								<span class="percentage">%</span>
							</div>
							<div class="col-xs-5">
								<input type="text" name="share_max" class="form-control input_inv" data-attr="share_max"  placeholder="max">
							</div>
							<div class="col-xs-1">
								<span class="percentage">%</span>
							</div>
								<div class="row">
										<span style='text-align:right;margin-top: 2px' class="error share col-md-12"></span>	
										<span class="error share_min col-md-6"></span>	
										<span class="error share_max col-md-6"></span>
									</div>
						  </div>
						</div>
					  </div>
					</form>
				</div>
				<div class="modal-footer">
					<button id="invest-submit" class="btn btn-initiate btn-ignore">Submit</button>
				</div>
					<div class="row"><div class="msgs col-md-12"></div></div>
			</div>		
		</div>
	</div>
			

	<style>
	div#s2id_currency {
    width: 100%;
}	div#s2id_currencyintitate {
    width: 100%;
}
.pac-container{
    z-index: 99999999999999 !important;
  }
</style>