 <link href="<?php echo base_url('/assets/vendor/font-awesome/css/forms_style.css'); ?>" rel="stylesheet" type="text/css">
 <?php $this->load->view('common/nav-gain-earn-idea-lern');?>
	<section id="title-bar" >
		<div class="container">
			<div class="">
				<div class="header-content">
					<div class="header-content-inner">
						<h2>EARN</h2>
						<hr>
						<h3>Earn what skills are worth</h3>
					</div>
					<div class="btn-group col-md-6 col-md-offset-3">
			<a href="<?php echo base_url(); ?>earn/profile">	
			<button type="button" onclick="sadas" class="btn btn-primary">Create My Skill Profiles</button></a>
						<button type="button" class="btn btn-primary active">Add other skill as Mediator</button>
					</div>
					
				</div>
				
			</div>
				<div class="row header-content">
				<h3><?php $msgg = $this->session->flashdata('msg'); 
				if($msgg){	?><br><br>
				<?php echo $msgg; ?></p><?php } ?>
				</h3>
				</div>
		</div>
	</section>
	<section class="form-section"> 
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-4 col-sm-12 col-xs-12 blue-box hidden-xs hidden-sm hidden-md">
							<p>Get upto bonus of 100 coins by<br> creating your  profile <img src="<?php echo base_url(); ?>assets/images/info.svg" id="tt3"></p>
						<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="tt3">
							<div class="tooltip-box">
								<h3>Other Person form coins</h3>
								<div class="tt-inner">
									<div class="tt-left">
										<div class="tt-title">Field</div>
										<div class="tt-content">
											<ul class="br">
												<li>Skill</li>
												<li>Sub-Skill</li>
												<li>Location</li>
												<li>Experience</li>
												<li>Portfolio</li>
												<li>Career Objective</li>
												<li>Language</li>
												<li>Short Term Price</li>
												<li>Long Term Price</li>
												<li>Mediate/ Help</li>
											</ul>
										</div>
										<div class="tt-ftr">Total Coins</div>
									</div>
									<div class="tt-right">
										<div class="tt-title">Coins</div>
										<div class="tt-content">
											<ul>
												<li>05</li>
												<li>10</li>
												<li>10</li>
												<li>10</li>
												<li>15</li>
												<li>10</li>
												<li>10</li>
												<li>10</li>
												<li>10</li>
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
									<img src="<?php echo base_url(); ?>assets/images/MaintainTrustFactor-w.svg"><b></b>
									<img src="<?php echo base_url(); ?>assets/images/Showinterest_getHired.svg"><b></b>
									<img src="<?php echo base_url(); ?>assets/images/MediateHelp.svg">
								</div>
								<div class="desc-section">
									<ul>
										<li>Create Profile with genuine Information</li>
										<li>Maintain Trust Factor More than 4 star</li>
										<li>Show interest & get Hired by buying contacts</li>
										<li>Mediate/Help By taking Responsibility</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-sm-12 col-xs-12 form-box">
							<!-- Tabs -->
							<div class="row">
							<div class="top-btn">
								<a class="active" >Create Other Person Profile</a>
									</div>
							<!-- Accordions -->
							<div class="content">
	<form id="earn-profile" action="<?php echo base_url('earn/'); ?>" method="post" enctype="multipart/form-data">							
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
				
				<label class="lsample" for="sample3">Primary Skills</label>
			<select id="skill" name="skill"  data-attr="skill" class="input mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Primary skill" required>

			<option value="">Select a Role...</option>
			<?php foreach($skills as $p){ ?>
			<option value="<?php echo $p['id']; ?>">
			<?php echo $p['skill']; ?>
			</option>
			<?php } ?>

			</select>
			<span class="error skill"></span>
			<script>
				$('#skill').selectize({	});		</script>
									</div>
		<label class="lsample" for="sample3">Related Skills</label>
		<select id="select-state" name="roles[]" multiple data-attr="roles" class="input mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Related Skills">

		<option value="">Related Skills</option>
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
		<select id="select-experience" name="experience" data-attr="experience" class="input mb-10"  placeholder="Select Experience">         
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
		<script>$('#select-experience').selectize();</script>
		
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

		<label class="lsample" for="sample3">Language</label>
		<select id="select-language" name="language[]" multiple class="mb-10" placeholder="Select language">
		<option value="English">English</option>
		<option value="Hindi">Hindi</option>
		<option value="Telugu">Telugu</option>
		</select>
		
		<script>$('#select-language').selectize();</script>
			<label>My Price <sup class="red">*</sup></label>
			<div class="grey-form-box">
		<div class="short-term">
		<label>Short Term Work</label>
		<select name="currency" id="select-country" data-attr="currency" class="input mb-10 medium" placeholder="Select Currency">
									<option value="">Select a Currency</option>
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
		<span class="error currency"></span>
<script>
$('#select-country').selectize();
</script>		
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
			<input data-attr="price" class="input mdl-textfield__input" type="text" name="price" id="price" required>
			<label class="mdl-textfield__label" for="sample3">Price</label>
		</div>
		<select name="price_per" class="form-control small">
		<option value="Hour">Hour</option>
		<option value="Day">Day</option>
		
		</select>
		<span class="error price"></span>
	</div>
	<div class="long-term">
		<label>Long Term Work</label>
		<div class="radio-grp">
		 <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
      <input type="radio" id="option-1" class="mdl-radio__button" name="l_term_work_option" value="1" checked>
      <span class="mdl-radio__label">Negotiable</span>
    </label>
    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
      <input type="radio" id="option-2" class="mdl-radio__button" name="l_term_work_option" value="2" >
      <span class="mdl-radio__label">Non-Negotiable</span>
    </label>
										</div>
				<div class="asempss" style="display:none"><div class="as-emp">As Employee
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input data-attr="min_as_employee" class="input mdl-textfield__input" type="number" name="min_as_employee" id="min_as_employee">
									<label class="mdl-textfield__label" for="sample3">Min</label>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input data-attr="max_as_employee" class="input mdl-textfield__input" name="max_as_employee" type="number" id="max_as_employee">
									<label class="mdl-textfield__label" for="sample3">Max</label>
								</div>
				<span class="error min_as_employee"></span>
				<span class="error max_as_employee"></span>
				<span class="error employee"></span>
				</div>
				<div class="as-part">As Partner
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input onkeyup="handleChange(this);" data-attr="min_as_partner" class="input mdl-textfield__input" name="min_as_partner" type="number" id="min_as_partner">
									<label class="mdl-textfield__label" for="sample3">Min %</label>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input onkeyup="handleChange(this);" data-attr="max_as_partner" class="input mdl-textfield__input" name="max_as_partner" type="number" id="max_as_partner">
									<label class="mdl-textfield__label" for="sample3">Max %</label>
								</div>
				<span class="error min_as_partner"></span>
				<span class="error max_as_partner"></span>
				<span class="error share"></span>	
				</div>
				</div>
									</div>
								</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
					<input data-attr="competitive" class="input mdl-textfield__input" type="text" name="competitive" id="competitive">
						<label class="mdl-textfield__label" for="sample3">Competitive Advantage</label>
									</div>
							<div class="fileup-btn"><div class="attach">Attach your Portfolio <img src="<?php echo base_url(); ?>assets/images/attach.svg"></div>

							<input type="file" id="files" accept="application/pdf,application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="avatar[]" multiple>
							</div>
							<div class="attach-list mb-20">
							<div id="selectedFiles"></div>
							</div>
								
								<div class="radio-grp">
	<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
      <input type="radio" id="option-3" class="mdl-radio__button" name="Mediate_type" value="Mediate" checked>
      <span class="mdl-radio__label">Mediate<sup class="red">*</sup></span>
    </label>
    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
      <input type="radio" id="option-4" class="mdl-radio__button" name="Mediate_type" value="Help" >
      <span class="mdl-radio__label">Help<sup class="red">*</sup></span>
    </label>
										</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box large">
		<input data-attr="candidate" class="input mdl-textfield__input" type="text" name="candidate" id="candidate" onkeypress="return AlphabetsOnly(this, event)" maxlength="30">
		<label class="mdl-textfield__label" for="sample3">Name of Candidate</label>
	</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box large">
		<input data-attr="mobile" class="input mdl-textfield__input" type="text" maxlength="11" name="mobile" id="mobile" >
		<label class="mdl-textfield__label" for="sample3">Mobile Number</label>
	</div>
	<div class="row">
	<span class="error candidate col-md-5"></span>
	<span class="error mobile col-md-6"></span>
	</div>
										<div class="clear"></div>
				
			<button  type="button" class="submit_form btn btn-primary sub pull-right">Submit</button>
					
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
<script src="<?php echo base_url(); ?>assets/js/custom/mediator-profile-form.js"></script>

<?php $this->view('common/common-geo-location') ?>
