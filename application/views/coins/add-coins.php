<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
		document.getElementById("order_id").value = 'vieham'+d;
	};
</script>
  
	<section class="ideazone" onload="submitPayuForm()"> 
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Get or Add Coins</h4>
				</div>
				<div class="col-md-6">
				<?php if($this->session->flashdata('transaction_msg')){
					echo $this->session->flashdata('transaction_msg');
				} 
				 ?>
				 <span class="mt-10 pull-right"><a href="<?php echo base_url('coins') ?>" class="link">Get Coins</a></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<!-- Left white Panel Start -->
										<!-- Left white Panel Start -->
                        <?php $this->load->view('common/common-left-menu.php');?>
					<!-- Left white Panel End -->
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-5">
							<!-- Middle Panel1 Start -->
							<div class="panel panel-default sidePanel">
							  <div class="panel-heading">Add Coins
							  </div>
							  <div class="panel-body">
								<div class="coins">
									<p><span class="rupee pull-left">&#8377;</span> 
					<form method="post" name="customerData" action="<?php echo base_url('/payment/pay/'); ?>">
		
					<input type="hidden" name="tid" id="tid" readonly />
					<input type="hidden" name="merchant_id" value="<?php echo $merchant_id; ?>"/>
					<input type="hidden" name="order_id" id="order_id" />
					<input type="hidden" name="currency" value="<?php echo $pay_currency_type; ?>"/>
					<input type="hidden" name="redirect_url" value="<?php echo base_url('/Coins/payDone'); ?>"/>
					<input type="hidden" name="cancel_url" value="<?php echo base_url('/Coins/payDone'); ?>"/>
					<input type="hidden" name="language" value="EN"/>
					<input type="hidden" name="billing_name" value="<?php echo $user['name'] ?>"/>
					<input type="hidden" name="billing_address" value="<?php echo $pay_address; ?>"/>
					<input type="hidden" name="billing_city" value="<?php echo $pay_city; ?>"/>
					<input type="hidden" name="billing_state" value="<?php echo $pay_state; ?>"/>
					<input type="hidden" name="billing_zip" value="<?php echo $pay_pincode; ?>"/>
					<input type="hidden" name="billing_country" value="<?php echo $pay_country; ?>"/>
					<input type="hidden" name="billing_tel" value="<?php echo $user['mobile'] ?>"/>
					<input type="hidden" name="billing_email" value="<?php echo $user['email'] ?>"/>
					<input type="hidden" name="integration_type" value="iframe_normal"/>
					<input name="amount" value="" type="text" class="coins-amount form-control" placeholder="Enter Amount" />
						
									
									<span class="glyphicon glyphicon-info-sign info" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="1 Coin = 1 Rupee"></span></p>
									<p>
										<span class="price-value label label-default">100</span>
										<span class="price-value label label-default">500</span>
										<span class="price-value label label-default">1000</span>
										<span class="price-value label label-default">2000</span>
									</p>
								</div>
								<div class="promo">
									<input type="text" class="form-control" placeholder="Enter Promo Code" />
									<button type="button" class="btn btn-primary mb-5">Apply</button>
								</div>
								<p><a  class="link">Select Promo Code</a></p>
								<p class="text-right mb-0">
								<input type="submit" value="Proceed" class="btn btn-purple mb-0" />
								</form>
								</p>
							  </div>
							</div>
							
							<!-- Middle Panel1 End -->
						</div>
						<div class="col-md-7">
							<!-- Right Panel1 Start -->
							<div class="panel panel-default earnPanel">
							  <div class="panel-heading">Get Coins</div>
							  <div class="panel-body">
								<ul>
									<?php foreach($credit as $c){ ?>
									<li>
										<p>You got <b><?php echo $c['credit']; ?> Coins</b> for <b><?php echo $c['source']; ?></b></p>										
									</li>
									<?php } ?>
									<?php if(!$credit){ ?>
									<li>
										<p>No records available</p>										
									</li>
									<?php } ?>
								</ul>
							  </div>
							</div>
							<!-- Right Panel1 End -->
                            <p class="text-right"><a href="#" class="link visible-xs visible-sm mb-20">See More...</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<script>
$(document).ready(function(){
  $(".price-value").click(function(){
	var val = $(this).text();
	$(".coins-amount").val(val);
	 $(':input[type="submit"]').prop('disabled', false);
  });
  
$('.coins-amount').keyup(function(e){
  if (/\D/g.test(this.value))
  {
    this.value = this.value.replace(/\D/g, '');
  }
});
 var amount = $(".coins-amount").val();
 if(amount==0){
 $(':input[type="submit"]').prop('disabled', true);	 
 }

 
     $('.coins-amount').keyup(function() {
		 var amount = $(".coins-amount").val();
        if($(this).val() >0){
		  $(':input[type="submit"]').prop('disabled', false);
        }else if($(this).val() <=0){
		
		$(':input[type="submit"]').prop('disabled', true);	 	
		
		}
  });

  $('.coins-amount').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    $('input[name = amount]').click();
    return false;  
  }
});  
});
</script>