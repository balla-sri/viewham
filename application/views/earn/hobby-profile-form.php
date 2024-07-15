 <link href="<?php echo base_url('/assets/vendor/font-awesome/css/forms_style.css'); ?>" rel="stylesheet" type="text/css">

<?php $this->load->view('common/nav-gain-earn-idea-lern');?>
	<section id="title-bar">
		<div class="container">
			<div class="">
				<div class="header-content">
					<div class="header-content-inner">
						<h2>EARN</h2>
						<hr>
						<h3>Earn what skills are worth</h3>
					</div>
					<div class="btn-group col-md-6 col-md-offset-3">
						<button type="button" class="btn btn-primary active">Create My Skill Profiles</button>
			<a href="<?php echo base_url(); ?>earn/mediator">			
						<button type="button" class="btn btn-primary">Add other skill as Mediator</button></a>
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
				<h3>hobby form coins</h3>
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
								<li>Work Time</li>
								<li>Work Short time</li>
								<li>Work Long time</li>
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
								<li>15</li>
								<li>15</li>
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
					<img src="<?php echo base_url(); ?>assets/images/PerformAndEarn.svg">
				</div>
				<div class="desc-section">
					<ul>
						<li>Create Profile with genuine Information</li>
						<li>Maintain Trust Factor More than 4 star</li>
						<li>Show interest & get Hired by buying contacts</li>
						<li>Perform & Earn by Satisfying Clients</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-sm-12 col-xs-12 form-box">
			<!-- Tabs -->
			<div class="row">
			<div class="top-btn">
				<a class="" href="<?php echo base_url(); ?>earn/profile">Create professional Profile</a>
				<a class="active" href="#">Create hobby Profile</a>
			</div>
			<!-- Accordions -->
			<div class="content">
			<form action="<?php echo base_url('earn/'); ?>" id="earn-profile" method="post" enctype="multipart/form-data">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
						
			<label class="lsample" for="sample3">Hobby Skill</label>
			<select id="skill" name="skill" data-attr="skill" class="input mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Hobby skill" required>

			<option value="">Hobby Skill</option>
			<?php foreach($skills as $p){ ?>
			<option value="<?php echo $p['id']; ?>">
			<?php echo $p['skill']; ?>
			</option>
			<?php } ?>

			</select>
			<span class="error skill"></span>		
			<script>
				$('#skill').selectize({});
			</script>
					</div>
					<label class="lsample" for="sample3">Related Skills</label>
					<select id="select-state" name="roles[]" multiple data-attr="roles" class="input mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Related Skills" required>

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
						<script>
					$('#select-experience').selectize();
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
		<label>Work Timings</label>
		<div class="grey-form-box">
		<div class="day-col">
		<label>Select Day</label>
	
	
	<div class="update-day" style="display:none">
	<select class="form-control medium" name="day" id="edit-day">
	
	
	</select>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
							<input class="input-a mdl-textfield__input" value="" type="text" id="fromtime" data-default="12:00">
							
						</div><span>-</span>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
							<input class="input-a mdl-textfield__input" value=""  type="text" id="totime" data-default="20:30">
							<input value="update"  type="hidden" id="updates">
							<input value=""  type="hidden" id="idd">
							
						</div>
	<button  type="button" class="addday btn btn-primary small">Update</button>
	</div>
	<div class="new-day">	
<select class="form-control medium" name="day" id="new-day">
<option value="Select">Select</option>
	<option value="Monday">Monday</option>
	<option value="Tuesday">Tuesday</option>
	<option value="Wednesday">Wednesday</option>
	<option value="Thursday">Thursday</option>
	<option value="Friday">Friday</option>
	<option value="Saturday">Saturday</option>									
	<option value="Sunday">Sunday</option>
	</select>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
							<input data-default="12:30" placeholder="12:00" class="input-a mdl-textfield__input" type="text" id="fromtimenew">
						</div><span>-</span>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
							<input data-default="20:30" class="input-a mdl-textfield__input"  type="text" placeholder="20:30" id="totimenew">
							
						</div>
	<button type="button"  class="add_day btn btn-primary small">Add</button>


</div>
</div>
	<div id="time_error"></div>
	<div id="time_people"></div>
	
	
</div>
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
		<div class="row">
		<span class="error currency"></span>
		</div>
<script>
$('#select-country').selectize();
</script>		
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
			<input data-attr="price" class="input mdl-textfield__input" type="text" name="price" id="price" required>
			<label class="mdl-textfield__label" for="sample3">Price</label>
						</div>
		<select name="price_per" class="form-control small" required>
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
									<input data-attr="min_as_employee" class="input  mdl-textfield__input" type="number" name="min_as_employee" id="min_as_employee">
									<label class="mdl-textfield__label" for="sample3">Min</label>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input data-attr="max_as_employee" class="input  mdl-textfield__input" name="max_as_employee" type="number" id="max_as_employee">
									<label class="mdl-textfield__label" for="sample3">Max</label>
								</div>
				</div>
				<div class="as-emp">		<span class="error min_as_employee"></span>			
					<span class="error max_as_employee"></span>			
					<span class="error employee"></span>	</div>	
				<div class="as-part">As Partner
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input onkeyup="handleChange(this);" data-attr="min_as_partner" class="input mdl-textfield__input" name="min_as_partner" type="number" id="min_as_partner">
									<label class="mdl-textfield__label" for="sample3">Min %</label>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box small">
									<input onkeyup="handleChange(this);" data-attr="max_as_partner" class="input mdl-textfield__input" name="max_as_partner" type="number" id="max_as_partner">
									<label class="mdl-textfield__label" for="sample3">Max %</label>
								</div>
								
				</div>
				<div class="as-part">
								<span class="error share"></span>	
								<span class="error min_as_partner"></span>	
								<span class="error max_as_partner"></span>	
								</div>
				
				</div>
									</div>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
					<input data-attr="competitive" class="input mdl-textfield__input" name="competitive" type="text" id="competitive">
										<label class="mdl-textfield__label" for="sample3">Competitive Advantage</label>
									</div>
								<div class="fileup-btn"><div class="attach">Attach your Portfolio <img src="<?php echo base_url(); ?>assets/images/attach.svg">
       
       <input type="file" accept="application/pdf,application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document" id="files" name="avatar[]" multiple></div>
    </div>

    

        
								<div class="attach-list mb-20">
								<div id="selectedFiles"></div>
								</div>
								
			
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
<script src="<?php echo base_url(); ?>assets/js/custom/hobby-profile-form.js"></script>
		

<script type="text/javascript" src="https://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>
<link href="https://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet" type="text/css">
<?php $this->view('common/common-geo-location') ?>