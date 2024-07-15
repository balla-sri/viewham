base_url  =$('#base_url').val();
$(document).on("click", ".buy_contact", function(event){   	
    var post_id = $(this).data('postid');
    var post_type = $(this).data('post_type');
    var post_by = $(this).data('post_by');
    var n_type = $(this).data('contact_type');
    var contact = $(this).data('contact');
    var url = base_url+"contact/buycontact";
            
    $.ajax({
           type: "POST",
           url: url,
           enctype: 'multipart/form-data',
           data: {post_id: post_id, post_type: post_type, posted_by: post_by, n_type: n_type},
           dataType: 'json',
           success: function(data)
           {
			if(data.status==1){
				$('.pay_'+contact).addClass('hide');
				$('#contactDetails_'+contact).removeClass('hide');
			 }else{
				$('#viewContact_'+contact).modal('toggle'); 
                $('.msgs').html('<p class="">Oops Wrong.. Please try again later</p>')
				$('#MsgModal').modal('toggle');
			 }
			} 
		
         });
});

$(".shortBtn").click(function(){
	var pid = $(this).data('pid');
	var post_type = $(this).data('post_type');
	var toid = $(this).data('toid');
    var contact = $(this).data('contact');
	var url = base_url+"skill/shortlistadd";
	        
    $.ajax({
           type: "POST",
           url: url,
		   enctype: 'multipart/form-data',
		   data: {pid: pid, post_type: post_type, toid: toid},
		   dataType: 'json',
           success: function(data)
           {
            console.log(data);
			if(data.insert==1){
				$('#shortlist_'+contact).hide();
				$('#shortlisted_'+contact).show();
			}
           }
         });
});

$('#saved_dets').click(function(){
  var url = base_url+'businessideas/savedideas';
  $.ajax({
    type: "POST",
    url: url,
    enctype: 'multipart/form-data',
    dataType: 'json',
    success: function(data)
    {
        $('#saved').html(data.view);
    } 
    
  });
});

$('#initiated_dets').click(function(){
  var url = base_url+'businessideas/initiateideas';
  $.ajax({
    type: "POST",
    url: url,
    enctype: 'multipart/form-data',
    dataType: 'json',
    success: function(data)
    {
        $('#initiated').html(data.view);
    } 
    
  });
});

$('#invested_dets').click(function(){
  var url = base_url+'businessideas/investideas';
  $.ajax({
    type: "POST",
    url: url,
    enctype: 'multipart/form-data',
    dataType: 'json',
    success: function(data)
    {
        $('#investable').html(data.view);
    } 
    
  });
});