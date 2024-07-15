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
                        <button type="button" class="btn btn-primary active">Entrepreneur</button>
                        <a href="<?php echo base_url(); ?>gain/investor">
                            <button type="button" class="btn btn-primary">Investor</button>
                        </a>
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
                                    <h3>Entrepreneur form coins</h3>
                                    <div class="tt-inner">
                                        <div class="tt-left">
                                            <div class="tt-title">Field</div>
                                            <div class="tt-content">
                                                <ul class="br">
                                                    <li>Industry </li>
                                                    <li>Location</li>
                                                    <li>Expertise</li>
                                                    <li>Experience</li>
                                                    <li>Budget</li>
                                                    <li>Preferred business</li>
                                                </ul>
                                            </div>
                                            <div class="tt-ftr">Total Coins</div>
                                        </div>
                                        <div class="tt-right">
                                            <div class="tt-title">Coins</div>
                                            <div class="tt-content">
                                                <ul>
                                                    <li>10</li>
                                                    <li>20</li>
                                                    <li>20</li>
                                                    <li>20</li>
                                                    <li>20</li>
                                                    <li>10</li>
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
                                    <img src="<?php echo base_url(); ?>assets/images/ChooseOpportunity-w.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/UseViewham.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/BuildBusiness.svg">
                                </div>
                                <div class="desc-section">
                                    <ul>
                                        <li>Create Entrepreneur Profile with genuine Information</li>
                                        <li>Choose Opportunity with proper vision & plan</li>
                                        <li>Use VIEWHAM To gather human & financial resources</li>
                                        <li>Build Business with Passion</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12 form-box">
                            <!-- Tabs -->
                            <div class="row">
                                <div class="top-btn">
                                    <a class="active" >Entrepreneur <?php $msgg = $this->session->flashdata('msg'); 
						if($msgg){	?>
						<?php echo $msgg; ?></p><?php } ?></a>
                                </div>
                                <!-- Accordions -->
	<div class="content">
		<form id="earn-profile" action="<?php echo base_url('gain/'); ?>" method="post">
			<label class="lsample" for="sample3">Industry</label>
			<select id="select-industry" data-attr="industry" name="industry" class="input select-industry mb-10" placeholder="Select Industry">
				<option value="">Select a Industry...</option>
				<?php foreach($industries as $p){ ?>
					<option value="<?php echo $p['id']; ?>">
						<?php echo $p['industry']; ?>
					</option>
					<?php } ?>

			</select>
	<span class="error industry"></span>	
			<script>$('.select-industry').selectize();</script>
			<label class="lsample" for="sample3">Expertise</label>
			<select id="select-state" data-attr="roles" name="roles[]" multiple class="input mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Association Role">

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

<label class="lsample" for="sample3">Experience</label>			
<select id="select-experience" data-attr="experience" name="experience" class="input mb-10"  placeholder="Select Experience">
                            
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
						<script>
					$('#select-experience').selectize();
				</script>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
				<input name="nature" onkeypress="return AlphabetsOnly(this, event)" data-attr="nature" class="input mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label" for="sample3">Nature of Business</label>
			<span class="error nature"></span>		
			</div>
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
			<label>Budget <sup class="red">*</sup></label>
			<div class="grey-form-box">
				<div class="day-col">
					
				<select class="input form-control medium currencyintitate " name="currency" id="currency" required>
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
						<input name="min_budget" data-attr="min_budget" class="input mdl-textfield__input" type="text" id="min_budget">
						<label class="mdl-textfield__label" for="sample3">Min Budget</label>
					</div><span>-</span>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
						<input name="max_budget" data-attr="max_budget" class="input mdl-textfield__input" type="text" id="max_budget">
						<label class="mdl-textfield__label" for="sample3">Max Budget</label>
					</div>
				</div><div style="text-align: right">
					<span class="error budget"></span>	
					<span class="error currency"></span>	
					<span class="error min_budget"></span>	
					<span class="error max_budget"></span>						
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
<script src="<?php echo base_url(); ?>assets/js/custom/gain-entrepreneur-form.js"></script>
<style>
    .lsample {
        color: #515151;
        font-weight: normal;
        font-size: 14px;
    }
	.msgs {
    text-align: center;
}
</style>
<?php $this->view('common/common-geo-location') ?>
