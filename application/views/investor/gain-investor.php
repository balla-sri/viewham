<style>
.ideazone-content.relative {
    padding: 15px;
}
a#editind {
    color: #fff !important;
}</style>
<?php 
  $session_user = $this->session->userdata('user');	?>
  <script src="<?php echo base_url(); ?>assets/js/standalone/selectize.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/index.js"></script>
	<section class="ideazone gain"> 
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<ol class="breadcrumb hidden-xs hidden-sm">
					  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/'); ?>">Dashboard</a></li>
					  <li class="breadcrumb-item"><a href="<?php echo base_url('gain/'); ?>">Gain</a></li>
					  <li class="breadcrumb-item active">Investor</li>
					</ol>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('ownbusiness/add'); ?>" class="post_own btn btn-info mb-0 mblock-btn">Post Own Business</a>
					<a href="<?php echo base_url('funding/add'); ?>"style="display:none" class="fund_request btn btn-info mb-0 mblock-btn">Fund Request</a>
				</div>
			</div>
			<div class="row">
			<div class="col-md-3">
				<!-- Left Menu Start-->
					<?php $this->load->view('common/common-left-menu'); ?>
		        <!-- Left Menu End-->					
					<?php $this->load->view('investor/left-menu-search'); ?>
			</div>
			<div class="col-md-6">
				<?php $this->load->view('investor/all-investables-funding-requests'); ?>
			</div>
			<div class="col-md-3">
				<?php $this->load->view('investor/proposals-investor-view-edit'); ?>
			</div>

			</div>
	</section>
	
	
			<!-- View Contact Modal -->

<?php 
if(!empty($_GET['tab'])){ 
if($_GET['tab']=='Funding_Requests'){ ?>
<script>			  
  $(document).ready(function(){
    $('#Funding_Requests').show();
  });
</script>			  
<?php } } ?>		

<script>
$(".fundingRequests").click(function(){
	$('.fund_request').show();
	$('.post_own').hide();
	$('#Funding_Requests').show();
	$('#allinvSerch').hide();
   
});
$(".allinvestbles").click(function(){
	$('.fund_request').hide();
	$('.post_own').show();
	$('#Funding_Requests').hide();
	$('#allinvSerch').show();
   
});


$("#editind").click(function(){
  $('.noBGedit').show();
  $('.noBGview').hide();
  $('#editind').hide();
  $('#viewind').show();
});
$("#viewind").click(function(){
  $('.noBGedit').hide();
  $('.noBGview').show();
  $('#viewind').hide();
  $('#editind').show();
});

$(document).ready(function(){
 $('#editind').show();
 
});


$("#submit_form").click(function(){
	var url = $('#edit-gain-investor').attr('action');
	var formm = $('#edit-gain-investor')[0];
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
				location.reload();
					//setTimeout(function() {  location.reload();	}, 2000);
			   	}else{
			 
			  		$('.msgs').html('<p class="">Updated failed try again.</p>')
			  		$('#MsgModal').modal('toggle');
			   }
           }
         });
});
</script>			

<?php $this->view('common/common-geo-location') ?>
 
<script>
$(document).ready(function() {
$('.contact-details').hide();	
$('.pay-contact-view').hide();	
$(".view-contact").click(function() {
var btn_id = $(this).data('postid'); 
$('.vc_'+btn_id).hide();		
$('.pcv_'+btn_id).show('slow');		
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
               console.log(data);
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

$(".buy_contact").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var contact = $(this).data('contact');
    var n_type = 31;
    var contact_type = $(this).data('contact_type');
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
$(".initiate-store").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var industry = $(this).data('industry');
    var n_type = $(this).data('n_type');
    var url = "<?php echo base_url('contact/invest'); ?>";
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
