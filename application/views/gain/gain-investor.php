 <link href="<?php echo base_url('/assets/vendor/font-awesome/css/forms_style.css'); ?>" rel="stylesheet" type="text/css">
 <?php $this->load->view('common/nav-gain-earn-idea-lern');?>
    <section id="title-bar">
        <div class="container">
            <div class="">
                <div class="header-content">
                    <div class="header-content-inner">
                        <h2>GAIN</h2>
                        <hr>
                        <h3>Only Profits Gain, Not Wages</h3>
                    </div>
                    <div class="btn-group col-md-6 col-md-offset-3">
                        <a href="<?php echo base_url(); ?>gain/entrepreneur">
                            <button type="button" class="btn btn-primary">Entrepreneur</button>
                        </a>
                        <button type="button" class="btn btn-primary active">Investor</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 blue-box">
                            <p>Get upto bonus of 100 coins by
                                <br> creating your profile <img src="<?php echo base_url(); ?>assets/images/info.svg" id="tt3"></p>
                            <div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="tt3">
                                <div class="tooltip-box">
                                    <h3>Investor form coins</h3>
                                    <div class="tt-inner">
                                        <div class="tt-left">
                                            <div class="tt-title">Field</div>
                                            <div class="tt-content">
                                                <ul class="br">
                                                    <li>Industry </li>
                                                    <li>Location</li>
                                                    <li>Approx. investment offered</li>
                                                    <li>Approx. share offered </li>
                                                    <li>Association role</li>
                                                </ul>
                                            </div>
                                            <div class="tt-ftr">Total Coins</div>
                                        </div>
                                        <div class="tt-right">
                                            <div class="tt-title">Coins</div>
                                            <div class="tt-content">
                                                <ul>
                                                    <li>20</li>
                                                    <li>20</li>
                                                    <li>20</li>
                                                    <li>20</li>
                                                    <li>20</li>
                                                </ul>
                                            </div>
                                            <div class="tt-ftr">100</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flow-section">
                                <h3>How it Works</h3>
                                <hr>
                                <div class="img-section">
                                    <img src="<?php echo base_url(); ?>assets/images/CreateProfile-w.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/ShortlistfundTakers.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/ValidateEntrepreneurs.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/MakeSmartInvestment.svg">
                                </div>
                                <div class="desc-section">
                                    <ul>
                                        <li>Create Investor Profile with genuine Information</li>
                                        <li>Shortlist Fund Takers Those who can grow business</li>
                                        <li>Validate Entrepreneur's Vision & Background</li>
                                        <li>Make Smart Investment Where you can be an Asset</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12 form-box">
                            <!-- Tabs -->
                            <div class="row">
                                <div class="top-btn">
                                    <a class="active">Investor <?php $msgg = $this->session->flashdata('msg'); 
						if($msgg){	?>
						<?php echo $msgg; ?></p><?php } ?></a>
                                </div>
                                <!-- Accordions -->
                                <div class="content">
                    <form id="earn-profile" action="<?php echo base_url('gain/'); ?>" method="post">

					
					<label class="lsample" for="sample3">Industry</label>
					<select id="select-country" multiple  name="industry[]" data-attr="industry" class="input demo-default" placeholder="Select Industry">
						<option value="">Select a Industry...</option>
						<?php foreach($industries as $p){ ?>
							<option value="<?php echo $p['id']; ?>">
								<?php echo $p['industry']; ?>
							</option>
							<?php } ?>
					</select>
					<script>
						$('#select-country').selectize({
							maxItems: 5
						});
					</script>
					<span class="error industry"></span>
					<script>
						$('#select-country').selectize();
					</script>
					<label class="lsample" for="sample3">Association Role</label>
					<select id="select-state" name="roles[]" multiple data-attr="roles" class="input mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Association Role">
						<option value="">Select a Role...</option>
						<?php foreach($skills as $p){ ?>
						<option value="<?php echo $p['id']; ?>">
						<?php echo $p['skill']; ?>
						</option>
						<?php } ?>

					</select>
					<span class="error roles"></span>
					<script>
						$('#select-state').selectize({
							maxItems: 5
						});
					</script>


	
	<label for="loc1">Location <sup class="red">*</sup> </label>
	<div class="geo_locations row">	
		<div class="col-md-11"><input name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
		<div style="display:none" class="map_canvas"></div>
		</div>
		<div class="col-md-1">
		<span id="showsquareee"><i class="fa fa-plus-circle">Add</i></span>
		</div>
	</div>

	<div id="geo_locations" class="location-all"></div>
	<span class="error location"></span>
							
			

                                        <label>Investment <sup class="red">*</sup></label>
			<div class="grey-form-box">
				<div class="day-col">
				
				<select data-attr="investment_currency" class="input form-control medium currencyintitate " name="investment_currency" id="currency" required>
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
						<input data-attr="min_invest" class="input mdl-textfield__input" type="number" name="min_invest" id="min_invest">
						<label class="mdl-textfield__label" for="min_invest">Min Investment</label>
					</div><span>-</span>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input data-attr="max_invest" class="input mdl-textfield__input" type="number" name="max_invest" id="max_invest">
						<label class="mdl-textfield__label" for="max_invest">Max Investment</label>
					</div>
				</div>
				<div style="text-align:right">
					<span class="error invest"></span>	
					<span class="error investment_currency"></span>	
					<span class="error min_invest"></span>	
					<span class="error max_invest"></span>						
				</div>
			</div>
			<label>Share <sup class="red">*</sup></label>
			<div class="grey-form-box">
				<div class="day-col">
					
				<select data-attr="share_currency" class="input form-control medium currencyintitate " name="share_currency" id="share_currency" required>
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
						<input data-attr="min_share" class="input mdl-textfield__input" name="min_share" type="number" id="min_share">
						<label class="mdl-textfield__label" for="sample3">Min Share</label>
					</div><span>-</span>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input data-attr="max_share" class="input mdl-textfield__input" name="max_share" type="number" id="max_share">
						<label class="mdl-textfield__label" for="sample3">Max Share</label>
					</div>
				</div><div style="text-align: right">
					<span class="error share"></span>	
					<span class="error share_currency"></span>	
					<span class="error min_share"></span>	
					<span class="error max_share"></span>						
				</div>
			</div>
						<div class="clear"></div>
						
					<button type="button" class="submit_form btn btn-primary sub pull-right">Submit</button>
					<div class="send-info"></div>
					</form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="<?php echo base_url(); ?>assets/js/custom/gain-investor-form.js"></script>
<?php $this->view('common/common-geo-location') ?>
