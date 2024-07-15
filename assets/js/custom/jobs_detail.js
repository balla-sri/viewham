$(document).ready(function(){
		$('#more-cont').hide();
		$('.see-more').click(function(){
			$(this).hide();
			$('#more-cont').show();
		});
	});
$(".initiate-store").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var posted_by = $(this).data('posted_by');
    var p_id = $(this).data('p_id');
    var profile_type = $(this).data('profile_type');
    var url = '/contact/interest';
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: posted_by, p_id: p_id, profile_type: profile_type},
           dataType: 'json',
           success: function(data)
           {
            console.log(data);
			if(data.session==1){			
				$('#viewContact_'+post_id).modal('toggle');
				$('#signinModal').modal('toggle');
			}
            if(data.insert==1){
                $('#shortlist_'+post_id).hide();
			 	$('#shortlisted_'+post_id).show();
             }else if(data.insert==2){
                $('.msgs').html('<p class="">Oops Wrong Please try again later</p>')
                $('#MsgModal').modal('toggle');
             }
           }
         });
});
$(".e2_2aaa").selectize({	placeholder: "Search by Skills"	});

$(document).ready(function() {
$('.contact-details').hide();	
$('.pay-contact-view').hide();	
$(".view-contact").click(function() {
var btn_id = $(this).data('postid'); 
$('.vc_'+btn_id).hide();		
$('.pcv_'+btn_id).show('slow');		
});
$(".buy_contact").click(function(){
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var pid = $(this).data('pid');
    var n_type = 31;
    var url = '/contact/buycontact';
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
			   console.log(data);
			if(data.emptySession==1){
				$('#viewContact_'+pid).modal('toggle'); 
				$('#signinModal').modal('toggle');	
			}else{	
			if(data.status==1){
				$('.pay_'+pid).addClass('hide');
				$('#contactDetails_'+pid).removeClass('hide');
			 }else{
				$('#viewContact_'+pid).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
			} 
		}
         });
});


});
