		<section class="ideazone"> 
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Coins</h4>
				</div>
				<div class="col-md-6 text-right">
					<span class="mt-10 pull-right"><a href="<?php echo base_url('coins/add'); ?>" class="link pr-0">Add Coins</a></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<!-- Left white Panel Start -->
					 <?php $this->load->view('common/common-left-menu.php');?>
					<!-- Left white Panel End -->
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<!-- Middle Panel1 Start -->
							<div class="panel panel-default earnPanel">
							  <div class="panel-heading">Available Coins (<?php echo $total['totalCoins']; ?>)</div>
							  <div class="panel-body">
								<ul class="noBG" id="postList">
				    <?php if(!empty($credit)){ foreach($credit as $c){ ?>
									<li>
										<p>You got <b><?php echo $c['credit']; ?> Coins</b> for <b><?php echo $c['source']; ?></b></p>										
									</li>
										<?php } ?>
									
        <div class="load-more_credit" lastID="<?php echo $c['id']; ?>" style="display: none;">
			Loading more ...
        </div>
		<a class="see_more_credit link" >See More.. </a>	
    <?php }else{ ?>
        <li>Not available.</li>
    <?php } ?>
	</ul>
	
							  </div>
							</div>
							
							<!-- Middle Panel1 End -->
						</div>
						<div class="col-md-6">
							<!-- Right Panel1 Start -->
							<div class="panel panel-default earnPanel">
							  <div class="panel-heading">Spendings (<?php echo $total['totalDebit']; ?>)</div>
							  <div class="panel-body">
								<ul class="noBG" id="postListDebit">
							<?php if(!empty($credit)){ foreach($debit as $c){ ?>
									<li>
										<p>You Spent <b><?php echo $c['debit']; ?> Coins</b> to <!--view--> <b><?php echo $c['source']; ?></b> <!--contact--></p>										
									</li>
									<?php } ?>
        <div class="load-more_debit" lastID="<?php echo $c['id']; ?>" style="display: none;">
			Loading more ...
        </div>
		<?php
		if(count($debit) < 1 )
		{
			?>
		<a class="see_more_debit link" >See More.. </a>	
		<?php }
		else {
			
		?><li>No spendings started</li>
		<?php }
		?>
    <?php }else{ ?>
        <li>Not available.</li>
    <?php } ?>
								</ul>
	
							  </div>
							</div>
							<!-- Right Panel1 End -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script type="text/javascript">
$(document).ready(function(){
   $(document).on("click", ".see_more_credit", function(event){	
        var lastID = $('.load-more_credit').attr('lastID');
           $.ajax({
                type:'POST',
                url:'<?php echo base_url().'coins/loadmorecredicoins/'; ?>',
                data:'id='+lastID,
                beforeSend:function(){
                    $('.load-more_credit').show();
                 
                },
                success:function(html){
					$('.see_more_credit').hide();
                    $('.load-more_credit').remove();
                    $('#postList').append(html);
                }
            });
        
    });
});
</script>	
<script type="text/javascript">
$(document).ready(function(){
   $(document).on("click", ".see_more_debit", function(event){	
        var lastID = $('.load-more_debit').attr('lastID');
           $.ajax({
                type:'POST',
                url:'<?php echo base_url().'coins/loadmoredebiticoins/'; ?>',
                data:'id='+lastID,
                beforeSend:function(){
                    $('.load-more_debit').show();
                },
                success:function(html){
					
                    $('.see_more_debit').hide();
                    $('.load-more_debit').remove();
                    $('#postListDebit').append(html);
                }
            });
        
    });
});
</script>	