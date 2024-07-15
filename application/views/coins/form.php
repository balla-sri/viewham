<html>
<head>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
		document.getElementById("order_id").value = 'vieham'+d;
	};
</script>
</head>
<body>
	<form method="post" name="customerData" action="<?php echo base_url('coins/ccavrequesthandler'); ?>">
		
					<input type="hidden" name="tid" id="tid" readonly />
					<input type="hidden" name="merchant_id" value="212370"/>
					<input type="text" name="order_id" id="order_id" />
					<input type="hidden" name="amount" value="1.00"/>
					<input type="hidden" name="currency" value="INR"/><input type="text" name="redirect_url" value="<?php echo base_url('/Coins/payDone'); ?>"/>
					<input type="hidden" name="cancel_url" value="<?php echo base_url('/Coins/payDone'); ?>"/>
					<input type="hidden" name="language" value="EN"/>
					<input type="hidden" name="billing_name" value="Charli"/>
					<input type="hidden" name="billing_address" value="Room no 1101, near Railway station Ambad"/>
					<input type="hidden" name="billing_city" value="Indore"/>
					<input type="hidden" name="billing_state" value="MP"/>
					<input type="hidden" name="billing_zip" value="425001"/>
					<input type="hidden" name="billing_country" value="India"/>
					<input type="hidden" name="billing_tel" value="9876543210"/>
					<input type="hidden" name="billing_email" value="test@test.com"/>
					<input type="hidden" name="integration_type" value="iframe_normal"/>
		       
		        	<INPUT TYPE="submit" value="CheckOut">
	      </form>
	</body>
</html>

