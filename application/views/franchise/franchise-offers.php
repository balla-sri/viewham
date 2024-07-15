	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Franchise Offers</h4>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('franchise/add'); ?>" class="btn btn-info mb-0 mblock-btn">Offer a Franchise</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<a href="javascript:void()" class="filter-btn visible-xs visible-sm"><img src="<?php base_url('assets/images/filter.png'); ?>" alt="filter"/></a>
					<div class="filter-content grey-block mb-20">
						<h4 class="text-center">Search filters</h4>
					<form>
							<label>Industry</label>
							<?php
							if(!empty($_GET['industry']))
							?>
							<select name="industry[]" id="e2_2" multiple="multiple" class="e2_2aaa mb-5" style="width:100%" tabindex="-1">
							<?php
							foreach($industries as $ind){ ?>
							<option  value="<?php echo $ind['id']; ?>" <?php if(!empty($_GET['industry'])){$marks = $_GET['industry'];
							if (in_array($ind['id'], $marks)){  echo "selected";  } }?>><?php echo $ind['industry']; ?></option>
							<?php } ?>
							</select>
							<script>
							$(document).ready(function() { 
							$(".e2_2aaa").select2({
							placeholder: "Search by Industry"
							});});
							</script>


<label>Model</label>
							
							<select name="model" class="form-control mb-5"  tabindex="-1">
							<option value="">All</option>
							<?php
							foreach($model as $ind){ ?>
							<option  value="<?php echo $ind['franchize']; ?>" <?php if($ind['franchize'] == $_GET['model']) echo "selected";?> ><?php echo $ind['franchize']; ?></option>
							<?php }
							?>
							</select>							
						</label>	
							
						<label>Location</label>
					<input name="location" type="text" class="geocomplete form-control mb-5" placeholder="Search by Location" title="" value="<?php echo $_GET["location"]?>">	
					  <div style="display:none" class="map_canvas"></div>	
							<label>Investment
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
							
							<p class="mt-20">
							<a href="<?php echo base_url('franchise/index'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
							<button class="btn btn-primary mb-0">Apply</button>
							</p>
						</form>
					</div>
						
				</div>
				<div class="col-md-9">
					<div class="ideazone-content">
						<div class="row">
							
							<?php 
	//						echo "<pre>";print_r($franchise); 
							if(empty($franchise)){ echo "<p class='text-center'><br>No records available</p>"; }
							foreach($franchise as $f) { 
							?>
							<div class="col-sm-6 col-md-4">
								<div class="profile-box pointer" >
									<div class="p10" onclick="location.href='<?php echo base_url('franchise/detail/').$f['id']; ?>';">
									<div class="mb-10" >
										<span><?php echo $f['name']; ?></span>
										<span class="pull-right"></span>
									</div>
									<div class="mb-10">
										<div class="gray-text">Industry</div>
										<div class="dark-text"><?php 							
									echo $f['industry_name']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Location</div>
										<div class="dark-text">
							<?php $locations_decode = json_decode($f['location']); 
							echo $locations_decode[0];
	//foreach($locations_decode as $key=>$val){ 	echo $val.'<br>'; } ?>
	</div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Approx Investment</div>
										<div class="dark-text"><?php echo $f['currency_type']; ?>  <?php echo $f['min_invest']; ?> - <?php echo $f['max_invest']; ?></div>
									</div>
									<div class="mb-10">
										<div class="gray-text">Approx Income </div>
										<div class="dark-text"><?php echo $f['income_type']; ?> <?php echo $f['income_min']; ?> - <?php echo $f['income_max']; ?></div>
									</div>
									</div>
									<div>
	<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $f['id']; ?>">View Contact</button>
	<?php 
	$initiate = $f['initiate']['post_id']; 
	if($initiate==$f['id']){ ?>
	<button class="btn" >Initiated</button>	
	<?php }else{ ?>
	<button class="btn" data-toggle="modal" data-target="#franchizeInitiate_<?php echo $f['id']; ?>">Initiate</button>
	<?php } ?>
									</div>
								</div>
							</div>
							
							
							<div id="franchizeInitiate_<?php
    echo $f['id'];
?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">        
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Franchise Project</h5>
                    </div>
                    <div class="modal-body">
                        <h6>Project Description</h6>

                       <p><?php    echo $f['description']; ?></p>
                        <h6>Industry</h6>
                        <p><?php echo $f['industry_name']; ?></p>
                        <h6>Franchize Modal</h6>
                        <p><?php   echo $f['franchize']; ?></p>
                        <h6>Location</h6>
                        <p>	<?php $locations_decode = json_decode($f['location']); 
							foreach($locations_decode as $key=>$val){ 	echo $val.'<br>'; } ?></p>
                        <ul class="investment list-unstyled">
                            <li>Approx Invest <br> <span><?php    echo $f['currency_type'];?>  <?php    echo $f['min_invest'];?> - <?php echo $f['max_invest'];?></span></li>
                            <li>Returns <br> <span><?php    echo $f['income_type'];?>
							<?php    echo $f['income_min'];?> - <?php echo $f['income_max'];?></span></li>
                            <li>Break Even <br> <span><?php echo $f['break_even_type']; ?>
						<?php echo $f['min_break_even'];?> - <?php echo $f['max_break_even']; ?></span></li>
                        </ul>
                           
														<hr class="divider">
                        <p class="text-right">
                            <button data-postid="<?php  echo $f['id']; ?>" data-industry="<?php  echo $f['industry']; ?>" data-post_by="<?php  echo $f['posted_by']; ?>" data-post_type="<?php echo $f['post_type'] ?>"  class="btn btn-initiate initiate-store">Initiate</button>
                        </p>
                    </div>
                </div>        
            </div>
        </div>
							
							<div id="viewContact_<?php echo $f['id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($f['paid'])){ ?>
					<div id="contactDetails_<?php echo $f['id']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $f['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $f['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $f['email']; ?>" class="link"><?php echo $f['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $f['id']; ?>">
					<h6>Contact Price: <span class="coins"><i class="fa fa-coins"></i>50 Coins</span></h6>
					<hr class="divider" />
					<p class="text-right">
						<button data-post_by="<?php echo $f['posted_by']; ?>" data-postid="<?php echo $f['id']; ?>" data-post_type="<?php echo $f['post_type']; ?>" class="buy_contact btn btn-initiate">Proceed</button>
					</p>
					</div>
					
					<?php }else{ ?>
					<div id="contactDetails">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $f['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $f['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $f['email']; ?>" class="link"><?php echo $f['email']; ?></a></p>
					</div>
					<?php } ?>
				
				</div>
				<!--
				<div class="modal-footer fl-right">
					<button class="btn btn-initiate">Initiate</button>
				</div> -->
			</div>		
		</div>
	</div>

							<?php } ?>
							
							
									
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	

<!-- Signin Modal -->

<div id="MsgModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
            
                <!-- Modal content-->
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                    
                        <div class="msgs"></div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            
                </div>
            </div>

<script>
$(".initiate-store").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var industry = $(this).data('industry');
    var n_type = 33;
    var url = "<?php echo base_url('contact/initiate'); ?>";
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, industry: industry, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
		   console.log(data);
			if(data.emptySession==1){
				$('#franchizeInitiate_'+ post_id).modal('toggle'); 
				$('#signinModal').modal('toggle');	
			}else{
            if(data.status==1){
               $('#franchizeInitiate_'+ post_id).modal('toggle'); 
               $(".modal-backdrop.fade.in").css("display","none");
               $('.msgs').html('<p class="">Successfully Initiateed</p>')
               $('#MsgModal').modal('toggle');
			   setTimeout(function () {
                    window.location.reload();
                 }, 1500);
			 }else{
				$('#franchizeInitiate_'+ post_id).modal('toggle'); 
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
				$('#viewContact_'+post_id).modal('toggle'); 
				$('#signinModal').modal('toggle');	
			}else{	
			if(data.status==1){
				$('.pay_'+post_id).addClass('hide');
				$('#contactDetails_'+post_id).removeClass('hide');
			 }else{
				$('#viewContact_'+post_id).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
			} 
		}
         });
});

</script>			
<style>
.col-sm-6.col-md-4 {
    min-height: 360px;
}</style>
<?php $this->view('common/common-geo-location') ?>
