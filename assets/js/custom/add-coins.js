window.onload = function() {
	var d = new Date().getTime();
	document.getElementById("tid").value = d;
	document.getElementById("order_id").value = 'vieham'+d;
};
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
