<div class="ideazone-content">
                <div class="row">
                  <?php
			foreach ($outsource as $f) { ?>
                  <div class="col-sm-6">
                    <div class="profile-box">
                      <div class="p10" >
                        <div class="mb-10">
                          <span>
                            <?php echo $f['name'];?>
                          </span>
                          <span class="pull-right">
                          </span>
                        </div>
                        <div class="mb-10">
                          <div class="gray-text">Industry
                          </div>
                          <div class="dark-text">
							<?php echo $f['industry_name']
							?>
                          </div>
                        </div>
                        <div class="mb-10">
                          <div class="gray-text">Location
                          </div>
                          <div class="dark-text">
                            <?php
							$location = json_decode($f['location']);
							echo $location['0'];
							 
							?>
                          </div>
                        </div>
                        <div class="mb-10">
                          <div class="gray-text">Quote
                          </div>
                          <div class="dark-text">
							<?php
							echo $f['currency_type'];
							?>  
							<?php
							echo $f['min_invest'];
							?> - 
							<?php
							echo $f['min_invest'];
							?>
                          </div>
                        </div>
                        <div class="mb-10">
                          <div class="gray-text">Duration 
                          </div>
                          <div class="dark-text">
							<?php
							echo $f['duration_type'];
							?> 
							<?php
							echo $f['duration_min'];
							?> - 
							<?php
							echo $f['duration_max'];
							?>
                          </div>
                        </div>
                      </div>
                      <div>
						<button class="btn" data-toggle="modal" data-target="#viewContact_<?php echo $f['id'].'_'.$f['post_type']; ?>">View Contact</button>
                        <button class="btn" data-toggle="modal" data-target="#outsoureInitiate_<?php echo $f['id']; ?>">Initiate
                        </button>
                      </div>
                    </div>
                  </div>
                  <div id="outsoureInitiate_<?php
                           echo $f['id'];
                           ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">        
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;
                          </button>
                          <h5 class="modal-title">Out Source Project
                          </h5>
                        </div>
                        <div class="modal-body">
                          <h6>Project Description
                          </h6>
                          <p>
							<?php
							echo $f['description'];
							?>
                          </p>
                          <h6>Industry
                          </h6>
                          <p>
								<?php echo $f['industry_name']?>
                          </p>
                          <h6>Location
                          </h6>
                          <p>
                             <?php
							$location = json_decode($f['location']);
							foreach($location as $key=>$val){
							echo $val."<br>";
							} 
							?>
                          </p>
                          <ul class="investment list-unstyled">
                            <li>Quote 
                              <br> 
                              <span>
								<?php
								echo $f['currency_type'];
								?>  
								<?php
								echo $f['min_invest'];
								?> - 
								<?php
								echo $f['min_invest'];
								?>
                              </span>
                            </li>
                            <li>Duration 
                              <br> 
                              <span>
								<?php
								echo $f['duration_type'];
								?> 
								<?php
								echo $f['duration_min'];
								?> - 
								<?php
								echo $f['duration_max'];
								?>
                              </span>
                            </li>
                          </ul>
						   <hr class="divider">
                          <p class="text-right">
<?php  if(empty($f['initiate'])){ ?>
       <button type="button" data-industry="<?php echo $f['industry']; ?>" data-post_by="<?php echo $f['posted_by']; ?>" data-postid="<?php echo $f['id']; ?>" data-n_type="32" data-post_type="<?php echo $f['post_type']; ?>"  class="btn btn-initiate initiate-store">Initiate</button>
		<?php }else{ ?>
		 <button type="button"  class="btn btn-initiate">Initiated</button>
		 <?php }?>
                          </p>
                        </div>
                      </div>        
                    </div>
                  </div>
				<div id="viewContact_<?php echo $f['id'].'_'.$f['post_type']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title">View Contact Details</h5>
				</div>
				<div class="modal-body">
					
					<?php if(empty($f['paid'])){ ?>
					<div id="contactDetails_<?php echo $f['id'].'_'.$f['post_type']; ?>" class="hide">
						<h6>Contact Details:</h6>
						<p><b>Name:</b> <?php echo $f['name']; ?> <br />
						   <b>Mobile:</b> <?php echo $f['mobile']; ?> <br />
						   <b>E-mail:</b> <a href="mailto:<?php echo $f['email']; ?>" class="link"><?php echo $f['email']; ?></a></p>
					</div>
					<div class="pay_<?php echo $f['id'].'_'.$f['post_type']; ?>">
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
   
					<?php
					} 
					?>
                </div>
              </div>
<script>
$(document).ready(function() {
$('.contact-details').hide();	
$('.pay-contact-view').hide();	
});
</script>