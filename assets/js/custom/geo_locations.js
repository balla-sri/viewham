 $('#time_people').on('click', '.delete', function() {
		$(this).parent('div').remove();
		var day = $(this).data('day');
		$("#new-day option[value='"+day+"']").show();
		$('#new-day').append($("<option></option>").attr("value",day).text(day)); 
	 });
	 $(".input-a").bind("keyup change", function(e){ 
		$('#time_error').html('<p></p>');	 
		var fromtime = $('#fromtimenew').val();
		var totime = $('#totimenew').val();
		if(totime && fromtime){
			if(totime<=fromtime){
				$('#time_error').html('<p class="alert-danger text-center">To time should greater than From time</p>');
				return false;
			}else if(totime>=fromtime){
				$('#time_error').html('');
			}
		}else{
				$('#time_error').html('');
			}
	 });
	 
	 var dayarray = [];
  $('.add_day').click(function(event){
		var day = $('#new-day').val();
		
		
		var fromtime = $('#fromtimenew').val();
		var totime = $('#totimenew').val();
		if(!day || !fromtime || !totime ){
			alert('Please enter time');
			return false;
		}else if(totime && fromtime){
			if(totime<=fromtime){
				alert('Please enter valid timings');
				return false;
			}
		}
		var dayswize = $('input[name="dayswize[]"]').val();
		var fromtimess = $('input[name="fromtime[]"]').val();
		var totimess = $('input[name="totime[]"]').val();
		console.log(dayswize);
		

		var html = '<div class="dayslist"><input type="hidden" name="dayswize[]" value="'+day+'"/><input type="hidden" name="fromtime[]" value="'+fromtime+'"/><input type="hidden" name="totime[]" value="'+totime+'" /><div class="day">'+day+'</div><div class="time">'+fromtime+'-'+totime+'</div><div data-day='+day+' class="delete"><a  class="deleteday"  style="color: red;"> Delete </a></div></div>';
		$('#time_people').append(html);	
		$('#fromtimenew').val('');
		$('#totimenew').val('');
		dayarray.push(day);
		//$("#new-day option[value='"+day+"']").each(function() {
//			$(this).remove();
		//});
		$("#new-day option[value='"+day+"']").hide();
		$("#new-day").val('Select');
		
  });

  $(function(){
        $(".geocomplete").geocomplete({
          map: ".map_canvas"
        });
      });
  $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
	   $("#submit_form").click();
      return false;
		}
	});
  });
  $('#geo_locations').on('click', '.closesquare', function() {
		var numItems = $('.geo_locations').length;
		$(this).parent('div').remove(); x--;
	 });
  $('#showsquareee').click(function(event){
		var text = $('.location').val();
		if(!text){
			alert('Please enter location');
			return false;
		}
		var arrText= new Array();
		$('.locdup').each(function(){
			arrText.push($(this).val());
		});
		var loc = text.replace(/<\/?("[^"]*"|'[^']*'|[^>])*(>|$)/g, "");
		$('.location').val('');
		var html = '<div class="geo_locations"><input class="locdup" type="hidden" name="location[]" value="'+ loc +'"/><span>'+loc+'</span><span class="closesquare"><i class="fa fa-times-circle"></i></span><div>';
		if(arrText.length>0){
			if($.inArray(loc, arrText) != -1) {
			} else {
				$('.location-all').append(html);			
			} 
		}else{
				$('.location-all').append(html);			
		}
		


	});
             
