<?php	$session_user = $this->session->userdata('user');?>
<style>
.feedbackmsg {
    position: absolute;
    top: 28px;
    left: -23px;
    right: -40px;
    line-height: 1.2;
    font-size: 14px;
    color: #ffb600;
}
.earnPanel .link {
    color: #fefefe !important;
    font-size: 14px;
}
.post-content .post-container {
    padding: 20px;
    border-bottom: dashed 1px #ccc;
}

.cmore p:nth-last-child(2) {
  
    padding-right: 10px;
}

ul.v-opinion{
	width:100%;
	padding:0;
}
ul.v-opinion li{
	display:inline-block;
	float:left;
	margin-right:5px;
}
ul.v-opinion li:nth-child(1){
	width:10%;
}
ul.v-opinion li:nth-child(2){
	width:69%;
}
ul.v-opinion li:nth-child(3){
	width:18%;
	margin-right:0px;
}
ul.v-opinion li:nth-child(3) button{
	    margin-top: 5px;
}
.geo_location{
position:relative;
margin-bottom:15px;
}
.geo_location .closesquare{
top: 0px;
position: absolute;
right: 0px;
font-size: 12px;
padding: 5px 8px 0 0;
bottom: 0px;
}
</style>		
	
<section class="ideazone gain"> 
  <div class="container">
    <div class="row mb-20">
      <div class="col-md-6">
        <ol class="breadcrumb hidden-xs hidden-sm">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('dashboard/'); ?>">Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('gain/'); ?>">Gain
            </a>
          </li>
          <li class="breadcrumb-item active">Entrepreneur
          </li>
        </ol>
      </div>
      <div class="col-md-6 text-right">
        <a href="<?php
                 echo base_url('ownbusiness/add');
                 ?>" class="btn ownbusiness btn-info mb-0 mblock-btn">Own Business
        </a>
        <a style="display:none" href="<?php
                                      echo base_url('outsource/add');
                                      ?>" class="btn outsrc btn-info mb-0 mblock-btn">Outsource a Project
        </a>
        <a style="display:none" href="<?php
                                      echo base_url('franchise/add');
                                      ?>" class="btn oferfranz btn-info mb-0 mblock-btn">Offer a Franchise
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <!-- Left Menu Start-->
		<?php  $this->load->view('common/common-left-menu'); ?>
		        <!-- Left Menu End-->
        <a href="javascript:void()" class="filter-btn visible-xs visible-sm">
        <img src="<?php echo base_url(); ?>assets/images/filter.png" alt="filter">
        </a>
      <div id="Out_Source_Projects" class="filter-content grey-block mb-20" style="display:none">
						<h4 class="text-center">Search filters</h4>
				<form action="<?php echo base_url('entrepreneur'); ?>">
					<label>Quote
					<select name="currency_type" class="form-control sub-dw pull-right">
					<option value="">Select Currency</option>			
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='INR'){ echo "selected";}} ?>  value="INR">India</option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='USD'){ echo "selected";}} ?> value="USD">U.S. Dollar</option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='EUR'){ echo "selected";}} ?> value="EUR">European Euro</option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='JPY'){ echo "selected";}} ?> value="JPY">Japanese </option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='GBP'){ echo "selected";}} ?> value="GBP">British Pound </option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='CHF'){ echo "selected";}} ?> value="CHF">Swiss Franc </option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='CAD'){ echo "selected";}} ?> value="CAD">Canadian Dollar </option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='AUD'){ echo "selected";}} ?> value="AUD">Australian </option>
					<option <?php if(!empty($_GET['currency_type'])){ 
					if($_GET['currency_type']=='ZAR'){ echo "selected";}} ?> value="ZAR">South African Rand </option>
								</select>
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="min_invest" type="text" class="form-control" value="<?php if(!empty($_GET['min_invest'])){ echo $_GET['min_invest']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="max_invest" type="text" class="form-control" value="<?php if(!empty($_GET['max_invest'])){ echo $_GET['max_invest']; }  ?>" placeholder="max" />
								</div>
							</div>								
						<label>Duration
						<select name="duration_type" class="form-control sub-dw pull-right">
					<option value="">Select </option>
					<option <?php if(!empty($_GET['duration_type'])){ 
					if($_GET['duration_type']=='Days'){ echo "selected";}} ?>value="Days">Days</option>
					<option <?php if(!empty($_GET['duration_type'])){ 
					if($_GET['duration_type']=='Months'){ echo "selected";}} ?> value="Months">Months</option>
					</select>
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="duration_min" type="text" class="form-control" value="<?php if(!empty($_GET['duration_min'])){ echo $_GET['duration_min']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="duration_max" type="text" class="form-control" value="<?php if(!empty($_GET['duration_max'])){ echo $_GET['duration_max']; }  ?>" placeholder="max" />
								</div>
							</div>	
					<input type="hidden" name="tab" value="Out_Source_Projects">
					<p class="mt-20">
					<a href="<?php echo base_url('gain/outsource_offers'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
						</div>
	 	<div id="Franchize_offers" class="filter-content grey-block mb-20" style="display:none">
					<h4 class="text-center">Search filters</h4>
					<form>
					<label>Location</label>
					<input name="location" type="text" class="geocomplete form-control mb-5" value="<?php if(!empty($_GET['location'])){ echo $_GET['location']; }  ?>" placeholder="Search by Location" title="">	
					  <div style="display:none" class="map_canvas"></div>	
					<label>Investment
					<select name="investment_currency" class="form-control sub-dw pull-right">
					<option value="">Select Currency</option>			
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='INR'){ echo "selected";}} ?>  value="INR">India</option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='USD'){ echo "selected";}} ?> value="USD">U.S. Dollar</option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='EUR'){ echo "selected";}} ?> value="EUR">European Euro</option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='JPY'){ echo "selected";}} ?> value="JPY">Japanese </option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='GBP'){ echo "selected";}} ?> value="GBP">British Pound </option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='CHF'){ echo "selected";}} ?> value="CHF">Swiss Franc </option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='CAD'){ echo "selected";}} ?> value="CAD">Canadian Dollar </option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='AUD'){ echo "selected";}} ?> value="AUD">Australian </option>
					<option <?php if(!empty($_GET['investment_currency'])){ 
					if($_GET['investment_currency']=='ZAR'){ echo "selected";}} ?> value="ZAR">South African Rand </option>
								</select>
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="min_invest" type="text" class="form-control" value="<?php if(!empty($_GET['min_invest'])){ echo $_GET['min_invest']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="max_invest" type="text" class="form-control" value="<?php if(!empty($_GET['max_invest'])){ echo $_GET['max_invest']; }  ?>" placeholder="max" />
								</div>
							</div>
							
							<label>Returns
					<select name="income_type" class="form-control sub-dw pull-right">
					<option value="">Select</option>
					<option <?php if(!empty($_GET['income_type'])){ 
					if($_GET['income_type']=='Daily'){ echo "selected";}} ?> value="Daily">Daily</option>
					<option <?php if(!empty($_GET['income_type'])){ 
					if($_GET['income_type']=='Monthly'){ echo "selected";}} ?> value="Monthly">Monthly</option>
					<option <?php if(!empty($_GET['income_type'])){ 
					if($_GET['income_type']=='Yearly'){ echo "selected";}} ?> value="Yearly">Yearly</option>					
								</select>
								
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="income_min" type="text" class="form-control" value="<?php if(!empty($_GET['income_min'])){ echo $_GET['income_min']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="income_max" type="text" class="form-control" value="<?php if(!empty($_GET['income_max'])){ echo $_GET['income_max']; }  ?>" placeholder="max" />
								</div>
							</div>
							
					<label>Break-Even
					<select name="break_even_type" class="form-control sub-dw pull-right">
					<option value="">Select</option>
					<option <?php if(!empty($_GET['break_even_type'])){ 
					if($_GET['break_even_type']=='Daily'){ echo "selected";}} ?> value="Daily">Daily</option>
					<option <?php if(!empty($_GET['break_even_type'])){ 
					if($_GET['break_even_type']=='Monthly'){ echo "selected";}} ?> value="Monthly">Monthly</option>
					<option <?php if(!empty($_GET['break_even_type'])){ 
					if($_GET['break_even_type']=='Yearly'){ echo "selected";}} ?> value="Yearly">Yearly</option>	
								</select>
								
							</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="min_break_even" type="text" class="form-control" value="<?php if(!empty($_GET['min_break_even'])){ echo $_GET['min_break_even']; }  ?>" placeholder="min" />
								</div>
								<div class="col-xs-6">
									<input name="max_break_even" type="text" class="form-control" value="<?php if(!empty($_GET['max_break_even'])){ echo $_GET['max_break_even']; }  ?>" placeholder="max" />
								</div>
							</div>
				<input type="hidden" name="tab" value="Franchize_offers">
					<p class="mt-20">
							<p class="mt-20">
							<a href="<?php echo base_url('entrepreneur'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
					</div>
	</div>
      <div class="col-md-6">
        <div>
          <!-- Nav tabs -->
		  <?php if(!empty($_GET['tab'])){
		  if($_GET['tab']=='Out_Source_Projects'){
			  $tabout="in active";
			  $tabactall='';
			  $tabfrnc='';			 
			}else if($_GET['tab']=='Franchize_offers'){
			 $tabfrnc="in active"; 
			 $tabactall=""; 
			 $tabout=""; 
		  }
		  }else{
			$tabactall="in active";
			$tabfrnc='';			 
			$tabout='';			 
		  }
		  ?>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php echo $tabactall; ?>">
              <a id="allinite" href="#allini" aria-controls="allini" role="tab" data-toggle="tab">All Initiations <span class="badge"><?php echo count($allinitiate); ?></span>
                
              </a>
            </li>
            <li role="presentation" class="<?php echo $tabout; ?>">
              <a id="outsourcea" href="#outsource" aria-controls="outsource" role="tab" data-toggle="tab">Out Source Projects <span class="badge blue"><?php echo count($outsource); ?></span>
               
              </a>
            </li>
            <li role="presentation" class="<?php echo $tabfrnc; ?>">
              <a id="franchizea" href="#franchize" aria-controls="franchize" role="tab" data-toggle="tab">Franchise offers <span class="badge green"><?php echo count($franchise); ?></span>
                
              </a>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade <?php echo $tabactall; ?>" id="allini">
              <!-- Idea Flag Block Start -->
              <?php $this->load->view('entrepreneur/gain-entrepreneurs-all-initiations'); ?>
           
		   </div>
            <div role="tabpanel" class="tab-pane fade <?php echo $tabout; ?>" id="outsource">
			
			<?php $this->load->view('entrepreneur/gain-entrepreneurs-outsource'); ?>            
			
			</div>
            <div role="tabpanel" class="tab-pane fade <?php echo $tabfrnc; ?>" id="franchize">
            <?php $this->load->view('entrepreneur/gain-entrepreneurs-Franchise-offers'); ?>            
			</div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <!-- Proposals Section Start -->
        <div class="panel panel-default earnPanel">
          <div class="panel-heading">Proposals
          </div>
          <div class="panel-body">
            <ul class="scroll-v-big">
			
			<?php
			if(empty($proposals)){ echo "<li>Not Available</li>";}
			foreach($proposals as $key=>$val){
			
			?>	
			
									<?php if($val['notification_type']=='24' && $val['post_id']==$skill_byid['p_id']){
										?>
									<li><div class="row"><div class="col-md-12">	<p><span class="title"><?php echo $val['name']; ?></span></p>
										<p>has Shortlisted your Entrepreneur Profile.</p>
									</div></div></li>
									<?php }else if($val['notification_type']=='26' && $val['post_id']==$skill_byid['p_id']){ ?>	
									<li><div class="row"><div class="col-md-12">	<p><span class="title"><?php echo $val['name']; ?></span></p>
									<p>has given Feedback to your Entrepreneur Profile.</p>								
									</div></div></li>
									<?php }else if($val['notification_type']=='15'){ ?>
									<li><div class="row"><div class="col-md-12">	
									<p><span class="title"><?php echo $val['name']; ?></span></p>
									<p>has posted Outsource project.</p>			
									</div></div></li>
									
									<?php }else if($val['notification_type']=='16'){ ?>
									<li><div class="row"><div class="col-md-12">	
									<p><span class="title"><?php echo $val['name']; ?></span></p>
								<p>has posted Franchise Offer.</p>
									</div></div></li>
								<?php }else if($val['notification_type']=='32' && $val['post_type']=='6'){ ?>
								<li><div class="row"><div class="col-md-12">	
								<p><span class="title"><?php echo $val['name']; ?></span></p>
								<p> initiated Your Outsource Project.</p>
									</div></div></li>
								<?php }else if($val['notification_type']=='42' && $val['post_type']=='7'){ ?>
								<li><div class="row"><div class="col-md-12">	
								<p><span class="title"><?php echo $val['name']; ?></span></p>
								<p> initiated Your Franchise Offer.</p>
									</div></div></li>
								<?php }?>	
										

			
			
			
				<?php } ?>
			  </ul>
          </div>
        </div>
        <!-- Proposals Section End -->
        <!-- Entreprenuer Section Start -->
        <div class="panel panel-default earnPanel">
          <div class="panel-heading">Entrepreneur 
            <a id="editind" class="pull-right link">Edit
            </a>
            <a style="display:none" id="viewind" class="pull-right link">View
            </a>
          </div>
          <div class="panel-body">
            <ul class="noBG noBGview">
              <li>
                <h4>Industry
                </h4>
                <ul class="inline-list">
                  <li>
                    <?php echo $skill_byid['industry_name']; ?>
                  </li>
                </ul>

              </li>
              <li>
                <h4>Association 
                </h4>
                <ul class="inline-list">
                  <?php $roles = json_decode($skill_byid['association']);
						foreach($roles as $cat) { ?>
						<li><?php echo $skills[$cat]['skill']; ?></li>
					<?php } ?>
                  

                </ul>
              </li>
              <li>
                <h4>Experience
                </h4>
                <ul class="inline-list">
                  <li>
                    <?php echo $skill_byid['experience']; ?> Years
                  </li>
                </ul>
              </li>                            
              <li>
                <h4>Preferred Business
                </h4>
                <ul class="inline-list">
                  <li>
                    <?php echo $skill_byid['nature']; ?>
                  </li>
                </ul>                                
              </li>
              <li>
                <h4>Location
                </h4>
                <ul class="inline-list">
     <?php $locations_decode = array_filter(json_decode($skill_byid['location'])); 
	foreach($locations_decode as $key=>$val){ 	echo '<li>'.$val.'</li>'; } ?>
                  
                </ul>                                
              </li>
              <li>
                <h4>Budget
                </h4>
                <p> 
                  <b>Min: 
                  </b>
                  <?php echo $skill_byid['min_budget']; ?> - <b>Max: </b>
                  <?php echo $skill_byid['max_budget']; ?> 
				  <?php echo $skill_byid['currency']; ?>
                </p>
              </li>
            </ul>
            <ul class="noBG noBGedit" style="display:none">
              <form id="gain-entrepreneur" action="<?php echo base_url('entrepreneur/entrepreneureditsubmit'); ?>">
                <li>
                  <h4>Industry
                  </h4>
				
                  <select id="select-industry" name="industry" class="" placeholder="Select Industry">
                    <option value="">Select a Industry...
                    </option>
                    <?php foreach ($industries as $p) { ?>
                    <option value="<?php echo $p['id']; ?>" 
                            <?php
                    if ($skill_byid['industry'] == $p['id']) { echo "Selected"; } ?>>
                    <?php echo $p['industry']; ?>
                    </option>
                  <?php } ?>
                </select>
              <script>
                $('#select-industry').selectize();
              </script>
              </li>
            <li>
              <h4>Association Role
              </h4>    
              <?php
$cats = json_decode($skill_byid['association']); ?>
              <select id="select-state" name="roles[]" multiple class="mb-10" style="width: 100%;margin-bottom: 10px !important;" placeholder="Association Role">
                <option value="">Select a Role...
                </option>
				
                <?php foreach ($skills as $p) {?>
                <option value="<?php  echo $p['id']; ?>" 
                <?php  if (in_array($p['id'], $cats)) {
                echo 'selected="selected"'; } ?>>
                <?php echo $p['skill']; ?>
                </option>
				<?php } ?>
            </select>
          <script>
            $('#select-state').selectize({
              maxItems: 5
            }
                                        );
          </script>
          </li>
        <li>
          <h4>Experience </h4>    
    <select id="select-experience" name="experience" class="mb-10"  placeholder="Select Experience">
    <option value="0" <?php if ($skill_byid['experience'] == '0') { echo "Selected";} ?>>Fresher</option>
    <option value="1" <?php if ($skill_byid['experience'] == '1') { echo "Selected"; } ?>>0-1 Years   </option>
    <option value="2" <?php if ($skill_byid['experience'] == '2') { echo "Selected"; } ?>>1-2 Years  </option>
    <option value="3" <?php if ($skill_byid['experience'] == '3') {  echo "Selected";} 
    ?>>2-3 Years</option>
    <option value="4" <?php if ($skill_byid['experience'] == '4') {  echo "Selected";} 
    ?>>3-4 Years</option>
    <option value="5" <?php if ($skill_byid['experience'] == '5') {  echo "Selected";} 
    ?>>4-5 Years</option>
    <option value="6" <?php if ($skill_byid['experience'] == '6') {  echo "Selected";} 
    ?>>5-6 Years</option>
    <option value="7" <?php if ($skill_byid['experience'] == '7') {  echo "Selected";} 
    ?>>6-7 Years</option>
    <option value="8" <?php if ($skill_byid['experience'] == '8') {  echo "Selected";} 
    ?>>7-8 Years</option>
    <option value="9" <?php if ($skill_byid['experience'] == '9') {  echo "Selected";} 
    ?>>8-9 Years</option> 
	<option value="10"<?php if ($skill_byid['experience'] == '10') { echo "Selected";}
	?>>More then 10 Years </option>
	</select>
	<script> $('#select-experience').selectize();</script>
	</li>
	<li>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input name="nature" class="mdl-textfield__input" value="<?php echo $skill_byid['nature']; ?>" type="text" id="sample3">
    <label class="mdl-textfield__label" for="sample3">Nature of Business
    </label>
  </div>
</li>
<li>
	<h4>Location </h4>
	<div class="geo_locations row">	
					<div class="col-md-9"><input name="location[]" data-attr="location" class="input geocomplete mdl-textfield__input location" type="text" >
					<div style="display:none" class="map_canvas"></div>
					</div>
					<div class="col-md-1">
					<span id="showsquareee"><i class="fa fa-plus-circle">Add</i></span>
					</div></div>
<div id="geo_locations" class="location-all">
	<?php $locations_decode = json_decode($skill_byid['location']); 
	foreach($locations_decode as $key=>$val){ ?>
	<div class="geo_locations">		
	<div><input class="geocomplete form-control" value="<?php echo $val; ?>" name="location[]" type="hidden" placeholder="Type in an address" size="90" />
	<div style="display:none" class="map_canvas"></div>
	</div>
		<span><?php echo $val; ?></span>
	<span class="closesquare"><i class="fa fa-times-circle"></i></span>
	</div>	
	<?php } ?>	
</div>
</li>
<li>
  <h4>Budget
  </h4>
  <select class="medium currencyintitate " name="currency" id="currency" required>
<option value="INR" <?php if ($skill_byid['location'] == 'INR') { echo "Selected";    }  ?>>India </option>
<option value="USD" <?php if ($skill_byid['location'] == 'USD') { echo "Selected"; } 
  ?>>U.S. Dollar </option>
<option value="EUR" <?php if ($skill_byid['location'] == 'EUR') { echo "Selected"; } 
?>>European Euro</option>
<option value="JPY" <?php if ($skill_byid['location'] == 'JPY') { echo "Selected"; } 
?>>Japanese </option>
<option value="GBP" <?php if ($skill_byid['location'] == 'GBP') { echo "Selected"; }?>>British Pound </option>
<option value="CHF" <?php if ($skill_byid['location'] == 'CHF') { echo "Selected";}
?>>Swiss Franc </option>
<option value="CAD" <?php if ($skill_byid['location'] == 'CAD') { echo "Selected"; } 
?>>Canadian Dollar </option>
<option value="AUD" <?php if ($skill_byid['location'] == 'AUD') { echo "Selected"; } ?>>Australian </option>
<option value="ZAR" <?php if ($skill_byid['location'] == 'ZAR') { echo "Selected"; } ?>>South African Rand </option>
</select>
<script> $('#currency').selectize(); </script>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
  <input name="min_budget" class="mdl-textfield__input" value="<?php echo $skill_byid['min_budget']; ?>" type="number" id="min_budget">
  <label class="mdl-textfield__label" for="sample3">Min Budget
  </label>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
  <input name="max_budget" class="mdl-textfield__input" value="<?php echo $skill_byid['max_budget']; ?>" type="number" id="max_budget">
  <label class="mdl-textfield__label" for="sample3">Max Budget
  </label>
  <input name="p_id" type="hidden" value="<?php echo $skill_byid['p_id']; ?>">
</div>
</li>
<li>
  <button id="submit_form" type="button" class="btn btn-primary center"> Save
  </button>
</li>

</ul>
</form>
</div>
</div>
<!-- Feedback Section Start -->
<?php 
								
								if($feedback){
									$rate='';
									foreach($feedback as $fr){
											$rate = $rate + $fr['rate'];
									}
									$f_rate =  $rate / count($feedback);
								}else{
									$f_rate=0;	
								}

								?>	
<div class="panel panel-default earnPanel">
  <div class="panel-heading">Feedback 
    <span class="pull-right">
      <span class="stars" data-rating="<?php echo $f_rate; ?>" data-num-stars="5" >
      </span>
    </span>
  </div>
  <div class="panel-body">
  
   <ul class="list-group scroll-v">
		<?php 
		foreach($feedback as $f){	?>
			 <li class="list-group-item">
				<div class="row earnPanel">
					<div class="col-xs-7">
						<p class="title mb-0"><?php echo $f['name']?></p>
	<p class="date mb-0"><?php echo $f['feedback']; ?></p>
												</div>
				<div class="col-xs-5 text-right">
				<span class="stars" data-rating="<?php echo $f['rate']; ?>" data-num-stars="5" ></span>
				</div>
											</div>
										  </li>
								<?php } 
								if(empty($feedback)){?>
								<li> No Feedbacks</li>	
								<?php } ?> 
      </ul>
  </div>
</div>
<!-- Feedback Section End -->
</div>
</div>
</div>
<!-- Modal outsoureInitiate -->
<!-- Modal franchizeInitiate -->
<!-- Modal ignoreModal -->
<div id="ignoreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">        
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;
        </button>
        <h5 class="modal-title">Ignore Idea
        </h5>
      </div>
      <div class="modal-body">
        <p>Ignoring the initiated idea will result in deletion of your proposal !
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-initiate">Ignore Completely 
        </button>
        <button class="btn btn-initiate btn-ignore" data-toggle="modal" data-target="#shortlistModal">Moved to Saved
        </button>
      </div>
    </div>        
  </div>
</div>
<div id="shortlistModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>The Idea has been moved to saved items
        </p>
      </div>
    </div>
  </div>
</div>
<div id="reportModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;
        </button>
        <h5 class="modal-title">Report Idea
        </h5>
      </div>
      <div class="modal-body">
        <form id="report-submit">
          <div class="radio-grp">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
              <input type="radio" id="option-1" class="mdl-radio__button" name="optionsreport" value="1" checked>
              <span class="mdl-radio__label">Spam
              </span>
            </label>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
              <input type="radio" id="option-2" class="mdl-radio__button" name="optionsreport" value="2">
              <span class="mdl-radio__label">Duplicate Idea
              </span>
            </label>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
              <input type="radio" id="option-3" class="mdl-radio__button" name="optionsreport" value="3">
              <span class="mdl-radio__label">Factually Incorrect
              </span>
            </label>
            <input type="hidden" name="postidreport" id="postidreport"> 
          </div>
        </form>
        <div class="msgs">
        </div>
      </div>
      <div class="modal-footer">
        <button id="report-report" class="btn btn-initiate btn-ignore">Submit
        </button>
      </div>
    </div>
  </div>
</div>
</section>
<!-- initiate Modal -->

 
</div>
<!-- Edit Initiate Modal -->

 
<!-- Edit Invest Modal -->

  

<div id="MsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;
        </button>
      </div>
      <div class="modal-body">
        <div class="msgs">
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<?php

if(!empty($_GET['tab'])){ 
if($_GET['tab']=='Out_Source_Projects'){ ?>
<script>			  
  $(document).ready(function(){
    $('#Out_Source_Projects').show();
	$('#Franchize_offers').hide();
  });
</script>			  
<?php }else if($_GET['tab']=='Franchize_offers'){ ?>
<script>			  
  $(document).ready(function(){
    $('#Out_Source_Projects').hide();
	$('#Franchize_offers').show();
  });
</script>
<?php } } ?>
<script>
  $(".tab-panee").click(function(){
    var id=$(this).attr('href');
    $(".tab-panea").removeClass("active");
    $(""+id).addClass("active");
  }
                       );
  $("#outsourcea").click(function(){
    $('.outsrc').show();
    $('#Out_Source_Projects').show();
    $('#Franchize_offers').hide();
    $('.oferfranz').hide();
    $('.ownbusiness').hide();
  }
                        );
  $("#franchizea").click(function(){
    $('.oferfranz').show();
	$('#Franchize_offers').show();
	$('#Out_Source_Projects').hide();
    $('.outsrc').hide();
    $('.ownbusiness').hide();
  }
                        );
  $("#allinite").click(function(){
    $('.oferfranz').hide();
    $('.outsrc').hide();
    $('.ownbusiness').show();
	$('#Franchize_offers').hide();
	$('#Out_Source_Projects').hide();
  }
                      );
  $("#editind").click(function(){
    $('.noBGedit').show();
    $('.noBGview').hide();
    $('#editind').hide();
    $('#viewind').show();
  }
                     );
  $("#viewind").click(function(){
    $('.noBGedit').hide();
    $('.noBGview').show();
    $('#viewind').hide();
    $('#editind').show();
  }
                     );
  $(document).ready(function(){
    $('#editind').show();
  }
                   );
  $("#submit_form").click(function(){
	var url = $('#gain-entrepreneur').attr('action');
    var formm = $('#gain-entrepreneur')[0];
    var data = new FormData(formm);
    $.ajax({
      type: "POST",
      url: url,
      enctype: 'multipart/form-data',
      data: data,
      dataType: 'json',
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function(data)
      {
        console.log(data);
        if(data.update_status=='1'){
          $('.msgs').html('<p class="">Successfully Updated</p>')
          $('#MsgModal').modal('toggle');
          setTimeout(function() { location.reload();}, 2000);
        }
        else{
          $('.msgs').html('<p class="">Please fill all required fields.</p>')
          $('#MsgModal').modal('toggle');
        }
      }
    }
          );
  }
                         );
</script>            
<style>        
  .mdl-textfield {
    padding: 20px 0;
    margin-bottom: 0px;
    width: 500px;
  }
  input#sample3 {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
  }
  input#min_budget {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
  }
  input#max_budget {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
  }
  .ideazone-content.relative {
    padding: 7px;
}
</style>        

<div id="consultantModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p class="sentmsg">
        </p>
      </div>
    </div>
  </div>
</div>
<script>
   
  $("#report-report").click(function(e) {
    var url = "<?php echo base_url('ideazone/reportidea'); ?>";
    $.ajax({
      type: "POST",
      url: url,
      data: $('#report-submit').serialize(), // serializes the form's elements.
      success: function(data)
      {
        console.log(data);
        $('#report-submit').trigger("reset");
        $('.radio-grp').hide();
        $('.msgs').html('<h3>Thanks for reporting Will get back to you.</h3>');
        $('#reportModal').modal('hide');
        // show response from the php script.
      }
    }
          );
    e.preventDefault();
    // avoid to execute the actual submit of the form.
  }
                           );
</script>
<script src="<?php echo base_url(); ?>assets/js/clipboard.min.js">	</script>
<script>
  
  
    var clipboard = new ClipboardJS('.allowCopy');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
	
	
	function checkSubmit(e) {
   if(e && e.keyCode == 13) {
      $('.replay').click();
   }
}
$(".update-initiate-submit").click(function(e) {
var postinid = $(this).data("postinid");
var postinidno = $(this).data("postinidno");
  var url = "<?php echo base_url('ideazone/updateinitiateidea'); ?>";
    $.ajax({
           type: "POST",
           url: url,
           data: $('#update-initiate-form_'+postinidno+'_'+postinid).serialize(), // serializes the form's elements.
           success: function(data)
           {
               console.log(data);
			  $('#update-initiate-form_'+postinidno+'_'+postinid).trigger("reset");
			  $('#update-initiate-form_'+postinidno+'_'+postinid).hide();
			  $('#update-initiate-form_'+postinidno+'_'+postinid).hide();
			  $('.modal-title').html('<h4>Successfully Updeted</h4>'); 			
setTimeout(function() {
$('#editInitiateModal'+postinid).modal('toggle');
	$('.inismsg').html(''); 
	location.reload();
	}, 2000);
			   
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});  
$(".posted-delete").click(function() {
    if (!confirm("Do you want to delete?")){
      return false;
    }	
var deleteid = $(this).data("deleteid");
var postid = $(this).data("postid");
var url = "<?php echo base_url('ownbusiness/deleteownbusinessidea/'); ?>"+deleteid+'/'+postid;
 $.ajax({
           type: "POST",
           url: url,
		   success: function(data)
           {
               console.log(data);
			  
			  $('#Posted_div_'+deleteid).slideToggle("slow");
           }
         });
});
$(".ignor_idea").click(function() {
    if (!confirm("Do you want to Ignore?")){
      return false;
    }	
var typeaction = $(this).data("typeaction");
var postid = $(this).data("postid");

var idea_id = $(this).data("idea_id");
var url = "<?php echo base_url('businessideas/ignore'); ?>";
 $.ajax({
           type: "POST",
	       data: {'typeaction':typeaction,'ideaid':postid,'idea_id':idea_id},
    	   dataType: 'json',
           url: url,
		   success: function(data)
           {
            $('.row_'+postid).slideToggle("slow"); 
			$('#ignoreModal_'+postid).modal('toggle');
			 
           }
         });
});

$(".see_more_idea").click(function(e) {
var postid = $(this).data("postid");
$('#more_count_'+postid).removeClass('hide');	
$('.see_less_'+postid).removeClass('hide');	
$('.see_more_'+postid).addClass('hide');	
});
$(".see_less_idea").click(function(e) {
var postid = $(this).data("postid");
$('#more_count_'+postid).addClass('hide');	
$('.see_more_'+postid).removeClass('hide');	
$('.see_less_'+postid).addClass('hide');	
});
</script>
<script>
$(".initiate-store").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var industry = $(this).data('industry');
    var n_type = $(this).data('n_type');
    var url = "<?php echo base_url('contact/initiate'); ?>";
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, industry: industry, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
			if(data.emptySession==1){
				if(post_type==6){
					$('#outsoureInitiate_'+ post_id).modal('toggle'); 
				}else if(post_type==7){
					$('#franchizeInitiate_'+ post_id).modal('toggle'); 
				}
				$('#signinModal').modal('toggle');	
			}else{
            if(data.status==1){
				if(post_type==6){
					$('#outsoureInitiate_'+ post_id).modal('toggle'); 
				}else if(post_type==7){
					$('#franchizeInitiate_'+ post_id).modal('toggle'); 
				}
				$(".modal-backdrop.fade.in").css("display","none");
               $('.msgs').html('<p class="">Successfully Initiateed</p>')
               $('#MsgModal').modal('toggle');
			   setTimeout(function () {
                    window.location.reload();
                 }, 1500);
			 }else{
				if(post_type==6){
					$('#outsoureInitiate_'+ post_id).modal('toggle'); 
				}else if(post_type==7){
					$('#franchizeInitiate_'+ post_id).modal('toggle'); 
				}
				$(".modal-backdrop.fade.in").css("display","none");
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			}}
              
             
           }
         });
});
$(".buy_contact").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var contact_type = $(this).data('contact_type');
    var contact = $(this).data('contact');
    var post_by = $(this).data('post_by');
    var n_type = 31;
    var url = "<?php echo base_url('contact/buycontact'); ?>";
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
			if(data.emptySession==1){
				$('#viewContact_'+post_id+'_'+post_type).modal('toggle'); 
				$('#signinModal').modal('toggle');	
			}else{	
			if(data.status==1){
				if(contact_type==38){
					$('.pay_'+contact).addClass('hide');
					$('#contactDetails_'+contact).removeClass('hide');
				}else{
					$('.pay_'+post_id+'_'+post_type).addClass('hide');
					$('#contactDetails_'+post_id+'_'+post_type).removeClass('hide');
				}	

			 }else{
				$('#viewContact_'+post_id+'_'+post_type).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
			} 
		}
         });
});
$(".shortBtn").click(function(){
	var pid = $(this).data('pid');
	var post_type = $(this).data('post_type');
	var toid = $(this).data('toid');
	var contact = $(this).data('contact');
	var url = "<?php echo base_url('skill/shortlistadd'); ?>";
	        
    $.ajax({
           type: "POST",
           url: url,
		   enctype: 'multipart/form-data',
		   data: {pid: pid, post_type: post_type, toid: toid},
		   dataType: 'json',
           success: function(data)
           {
            console.log(data);
			if(data.session==3){
				$('#signinModal').modal('toggle');
			}
			if(data.insert==1){
				
				$('#shortlist_'+contact).hide();
				$('#shortlisted_'+contact).show();
			}
           }
         });
});

</script>
<?php $this->view('common/common-geo-location') ?>

 