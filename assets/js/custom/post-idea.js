$(document).ready(function() {
	base_url = $("#base_url").val();
    $('.e2_2ss').selectize({});
    $(".e2_2aaa").select2({
        placeholder: "Search Tags"
    });
    
    $('#addd').on('click', function() {
        $('.combobox').each(function() {
            if ($(this)[0].selectize) {
                var value = $(this).val();
                $(this)[0].selectize.destroy();
                $(this).val(value);
            }
        });
        $('.skillsadds:first')
            .clone()
            .insertAfter('.skillsadds:last');
        selectizeme();
        $('.skillsadds:last .skillsadd .combobox').val('');
        $('.skillsadds:last .skillsadd .mdl-textfield__input').val('');
    });
    $(function() {
        selectizeme();
    });
    
    $("#field0qq").on('click', '.glyphicon-remove', function() {
        var numItems = $('.skillsadds').length;
        if (numItems > 1) {
                $(this).closest(".skillsadds").remove();
        } else {
                alert('Last Item Not Possible to remove ');
        }
    });
    
    $("#submit_idea").click(function() {
        if(validatePostIdea() == true){
           checkSession();
        }
    });
    

});
function checkSession(){
    var sess = $('#session_exist').val();
    if(sess == 0){
        $('#signinModal').modal('toggle');
    }else{
        showContent();
    }
}

function showContent(){
    for (instance in CKEDITOR.instances) {
	CKEDITOR.instances[instance].updateElement();
    }
    var url = base_url+'businessideas/submitpost';
    phoneNumberC();
    var data = $("#post-idea").serialize();
    $.ajax({
        enctype: 'multipart/form-data',
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function(data) {
            if(data.issuccess == 1){
			$('#post-idea')[0].reset();	
			$("#submit_idea").attr('disabled','disabled');
                $('#error_message').modal('toggle');
                $('#message_box').text(data.success_message);
                setTimeout(function() {
                    window.location.href = base_url+"businessideas"
                }, 2000);
            }else{
                $('#error_message').modal('toggle');
                $('#message_box').text(data.error_message);
            }
        }
    }); 
}

function phoneNumberC() {
    var phoneNumberRegex = /\d{10}/g;
    var questionText = document.getElementById("editor1").value;
    var phoneNumberDetected = questionText.match(phoneNumberRegex);
    if (phoneNumberDetected != null) {
      phoneNumberDetected = String(phoneNumberDetected);
      var formattedPhone = "";
      var formattedSubject = questionText.replace(phoneNumberDetected, formattedPhone);
      $("#editor1").val(formattedSubject);
    }
}


function validatePostIdea(){
    var hoby = $('#title').val();
    if (!hoby) {
        alert('Please Enter Title');
	return false;
    }
    
    var industry = $('#select-industry').val();
    if (!industry) {
	alert('Please Select Industry');
	return false;
    }
    
    var currency = $('#currency').val();
    var min_invest = $('#min_invest').val();
    var max_invest = $('#max_invest').val();
    if (!currency) {
	alert('Please Select currency  for Approx Investment');
	return false;
    }
    
    if (!min_invest || !max_invest) {
	alert('Please Enter Min Invest, max Invest');
	return false;
    }
    if (parseInt($("#min_invest").val()) > parseInt($("#max_invest").val())) {
	alert('Min Invest is larger than Max Invest');
	return false;
    }
    
    var min_return = $('#min_return').val();
    var max_return = $('#max_return').val();
    var returns_type = $('#returns_type').val();
    if (!returns_type) {
            alert('Please Select Returns Type');
            return false;
    }
    if (!min_return || !max_return) {
            alert('Please Enter Min Returns, Max Returns');
            return false;
    }
    if (parseInt($("#min_return").val()) > parseInt($("#max_return").val())) {
	alert('Min Returns is larger than Max Returns');
	return false;
    }
    var breakeven_min = $('#breakeven_min').val();
    var breakeven_max = $('#breakeven_max').val();
    var breakeven = $('#breakeven_type').val();
    if (!breakeven) {
            alert('Please Select Breakeven Type');
            return false;
    }
    if (!breakeven_min || !breakeven_max) {
            alert('Please Enter Min Returns, Max Returns');
            return false;
    }
    if (parseInt($("#breakeven_min").val()) > parseInt($("#breakeven_max").val())) {
            alert('Breakeven min is larger than Breakeven Max');
            return false;
    }
    return true;

}

function selectizeme() {
    $('.combobox').selectize({
        create: true,
    });
}
