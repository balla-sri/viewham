$(document).ready(function(){
    $(document).on("click", "button[id^='expand_content']", function(event){
        var id = $(this).attr('id');
        var ee = id.split('_');  
        $("#short_desc_"+ee[2]).css("display","none");
        $("#long_desc_"+ee[2]).css("display","block");
    });
    
    $(document).on("click", "a[id^='seemorein_']", function(event){
        var id = $(this).attr('id');
        var ee = id.split('_');  
        $("#short_desc_"+ee[1]).css("display","none");
        $("#long_desc_"+ee[1]).css("display","none");
        $("#full_desc_"+ee[1]).css("display","block");
    });
    $(document).on("click", "a[id^='seemore_']", function(event){
        var id = $(this).attr('id');
        var ee = id.split('_');
        var ideaid;
        if(ee[1][0]== 's' || ee[1][0]== 'p' ){
            ideaid = parseInt(ee[1].substring(1));
            var char = ee[1][0];
            
        }else{
            ideaid = parseInt(ee[1]);
            var char = '';
        }
        checkSession(ideaid,char);
        
    });
    
    $(document).on("click", ".opinion", function(event){
       var opinionc = $(this).data("opinion"); 
       //$('#opinion_comments_'+opinionc).removeClass("hide");
       //$('#opinion_comments_'+opinionc).addClass("show");
       $('#opinion_comments_'+opinionc).slideToggle("slow");
    });
   
    $(document).on("click", ".csbmt", function(event){
        var postidd = $(this).data("postideaid");
    	var parent_id = $(this).data("postparent");
    	var postcomment = $('.comment_title_'+postidd).val();
    	var url = "/businessideas/savecomments";
    	if(postcomment==''){
                return false;
    	}
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data : {ideaid: postidd, parent_id: parent_id, postcomment: postcomment},
            success: function(data)
            {
                
                $('.comment_title_'+postidd).val('');
                $('.commm_'+postidd).prepend(data.view); 
	       }
        });
        e.preventDefault(); 
    });

    $(document).on('click', '.replay', function(){ 	
        var replayid = $(this).data("replayid");
        var postid = $(this).data("postid");
        var replaycomment= $('.replay_comment_name_'+replayid).val();  
        if(replaycomment==''){
            return false;
        }
        var url = "/businessideas/commentsadd";

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data : {ideaid: postid, parent_id: replayid, postcomment: replaycomment},
            success: function(data)
            {
                $('.replay_comment_name_'+replayid).val('');  
                $('.subcommm_'+replayid).append(data.view);
            }
        });

    });

    $(document).on('click', '.commentlike', function(){ 
        var comment_id = $(this).data("commentid");
        var textstatus = $('.like_class_'+comment_id).text();
        var url = "/businessideas/commentlike";

        $.ajax({
            type: "POST",
            url: url,
            data : {comment_id: comment_id, textstatus: textstatus},
            success: function(data)
            {
                if(data==1){
                    $('.like_class_'+comment_id).text('Liked');
                }else{
                    $('.like_class_'+comment_id).text('Like');
                }

            }
        });
    });
   
    $(document).on("click", ".sharing", function(event){   
        
        $(".impress-cont").hide();
	$(".opinion-cont").hide();
	var sharec = $(this).data("share"); 
        
	//$(".sharing-cont").slideToggle("slow");
	$(".share_"+sharec).removeClass("hide");
        
        $(".share_"+sharec).slideToggle("slow");
    });
    
    $(".impress-cont").hide();
    $(document).on("click", ".impress", function(event){   
        var postid = $(this).attr("id");
	$(".sharing-cont").hide();
	$(".impresscount"+postid).slideToggle("slow");
        
    });
    
    var clipboard = new ClipboardJS('.allowCopy');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
    
    $(document).on("click", ".save-unsave", function(event){   
        var ideaid = $(this).attr('id');
        var uid    = $(this).attr('uid');
        var saved    = $(this).attr('saved');
        var url = "/businessideas/saveidea";

        $.ajax({
            type: "POST",
            url: url,
            data : {ideaid: ideaid, uid: uid,saved:saved },
            dataType : 'json',
            success: function(data)
            {
                $('.save-unsave_'+ideaid).attr('saved',data.val);
                if(data.val==1){
                    $('.save-unsave_'+ideaid).html('UnSave');
                }else{
                    $('.save-unsave_'+ideaid).html('save');
                }
            }
        });
	
	
});


$(document).on("click", "#report-report", function(event){
    var url = "/businessideas/reportidea";
    $.ajax({
        type: "POST",
        url: url,
        data: $('#report-submit').serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
            $('#report-submit').trigger("reset");
            $('.radio-grp').hide();
            $('#report-report').hide();
            $('.msgs').html('<h3>Thanks for reporting Will get back to you.</h3>');
            setTimeout(function() {
                $('#reportModal').modal('toggle');
            }, 1500);
        }
    });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
    
    
});
function checkSession(id,char){
    var sess = $('#session_exist').val();
    if(sess == 0){
        $('#trigger_idea').val(char+'_'+id);
        $('#signinModal').modal('toggle');
    }else{
        $("#long_desc_"+char+id).css("display","none");
        $("#full_desc_"+char+id).css("display","block");
        showContent(id,char);
    }
}

function showContent(ideaid,char){
    var base_url = window.location.origin;
    var ideacontent = $('#ideacontent_'+ideaid).val();
    
    $('#resource_details_'+ideaid).show();
    if(ideacontent==0){
        var url = base_url +'/businessideas/ideadetails';
        $.ajax({
            type: "POST",
            url: url,
            data: {ideaid:ideaid},
            dataType: "json",
            success: function(data)
            {
               $('#resource_details_'+char+ideaid).html(data.view);
               $(".opinion-cont").hide();
               $('.rating').rating();
               $(".impress-cont").hide();
               //starsContent()
            }
        }); 
    }
}

function starsContent(){
    
    $.fn.stars = function () {
	return $(this).each(function () {
		var rating = $(this).data("rating");
		var numStars = $(this).data("numStars");
		var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
		var halfStar = ((rating % 1) !== 0) ? '<i class="fa fa-star-half-empty"></i>' : '';
		var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
		$(this).html(fullStar + halfStar + noStar);
	});
    }
    $('.stars').stars();
}
$(document).on("click", "#invest-submit", function(event){
    var url = "/businessideas/postinvestidea";
    
    $.ajax({
        type: "POST",
        url: url,
        data: $('#investIdeaForm').serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
            if(data.is_success==1){
                $('#investIdeaForm').trigger("reset");
                $('#investModal').modal('toggle');
				$('#error_message').modal('toggle');
				$('#message_box').text('Thanks for Invest..! Will get back to you.');
                setTimeout(function() {
                    $('#message_box').modal('toggle');
                }, 1500);
                $('#invest_button').hide();
            }else if(data.is_success==2){
				$.each(data.error, function(key, item) {
					$("."+key).html(item);  
					console.log(key+'-eeeee-'+item);
				});			
			}else{
                console.log(data);
            }
        }
    });
    event.preventDefault(); // avoid to execute the actual submit of the form.
});
$(document).on("keyup change", ".input_inv", function(event){
	var keyfield = $(this).data('attr');
	if(keyfield=='invest_min' || keyfield=='invest_max'){
		$(".invest").html('');  
	}else if(keyfield=='share_min' || keyfield=='share_max'){
		$(".share").html('');  
	}
	$("."+keyfield).html('');  
    var url = "/businessideas/postIniateideaajaxvalidate";
    $.ajax({
        type: "POST",
        url: url,
        data: $('#investIdeaForm').serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
           if(data.is_success==2){
				$.each(data.error, function(key, item) {
					if(key==keyfield || key=='invest' || key=='share'){
						$("."+key).html(item); 
					}
				});			
			}else{
                console.log(data);
            }

        }
    });
});
$(document).on("click", "#initiate-submit", function(event){
    var url = "/businessideas/postiniateidea";
	var initiateIdea_id = $("#initiateIdea_id").val();
    $.ajax({
        type: "POST",
        url: url,
        data: $('#initiateIdeaForm').serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
            if(data.is_success==1){
                $('#initiateIdeaForm').trigger("reset");
                $('#initiatePopup').modal('toggle');
				$('#error_message').modal('toggle');
				$(".initiateIdea_id"+initiateIdea_id).text('Initiated').css('color', 'green'); //on14042019ndt
				$('#message_box').text('Thanks for Initiate Will get back to you.');
            }else if(data.is_success==2){
				$.each(data.error, function(key, item) {
					$("."+key).html(item);  
				});			
			}else{
                console.log(data.message);
            }

        }
    });
});
$(document).on("keyup change", ".input", function(event){
	var keyfield = $(this).data('attr');
	if(keyfield=='invest_min' || keyfield=='invest_max'){
		$(".invest").html('');  
	}else if(keyfield=='share_min' || keyfield=='share_max'){
		$(".share").html('');  
	}
	$("."+keyfield).html('');  
	
    var url = "/businessideas/postiniateideaajaxvalidate";
    $.ajax({
        type: "POST",
        url: url,
        data: $('#initiateIdeaForm').serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data)
        {
			if(data.is_success==2){
                console.log(data.message);
				$.each(data.error, function(key, item) {
					if(key==keyfield || key=='invest' || key=='share'){
						$("."+key).html(item); 
					}
				});			
			}else{
                console.log(data.message);
            }

        }
    });
}); 
$(document).on("click", ".InitiateModel", function(event){    
    var idea_id = $(this).data('postid');
    var industry = $(this).data('industry');
    $('#initiateIdea_id').val(idea_id);
    $('.location').html('');
    $('.invest').html('');
    $('.invest_min').html('');
    $('.invest_max').html('');
    $('.share').html('');
    $('.share_min').html('');
    $('.share_max').html('');
    $('input[name="industry"]').val(industry);
     event.preventDefault(); // avoid to execute the actual submit of the form.
});
$(document).on("click", ".InvestModel", function(event){    
    $('.location').html('');
    $('.invest').html('');
    $('.invest_min').html('');
    $('.invest_max').html('');
    $('.share').html('');
    $('.share_min').html('');
    $('.share_max').html('');
    var idea_id = $(this).data('postid');
    var industry = $(this).data('industry');
    $('#investIdea_id').val(idea_id);
    $('input[name="industry"]').val(industry);
    event.preventDefault(); // avoid to execute the actual submit of the form.
});