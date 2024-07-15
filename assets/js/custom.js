$(document).ready(function () {
    $('#hidepassword').hide();
    $('#showpassword').click(function() {
          $('input[name="password"]').attr('type', 'text');
          $('#showpassword').hide();
          $('#hidepassword').show();
    });
    $('#hidepassword').click(function() {
          $('input[name="password"]').attr('type', 'password');
          $('#showpassword').show();
          $('#hidepassword').hide();
    });
    });
$("#demo-2 input[type=search]").on("click", function(){
    $(".site_label").addClass("hideLogo");
});


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
$(function () {
	var postActions = $('#list_PostActions');
	var currentAction = $('#list_PostActions li.active');
	if (currentAction.length === 0) {
		postActions.find('li:first').addClass('active');
	}
	
	postActions.find('li').on('click', function (e) {
		e.preventDefault();
		var self = $(this);
		if (self === currentAction) { return; }
		// else
		currentAction.removeClass('active');
		self.addClass('active');
		currentAction = self;
		if( $(this).attr('id') =='feed_post'){
			$('#feed_type').val(2);
			$('#question').attr('placeholder','Write your views..');
			$('.questionclass').hide();
			$('.postclass').show();
		}else{
			$('#feed_type').val(1);
			$('#question').attr('placeholder','Ask your Question..');
			$('.questionclass').show();
			$('.postclass').hide();
		}

	});
});
$(document).ready(function () {
	if ($(window).width() <= 768)
	{
		$(".filter-content").hide();
		$(".filter-btn").on("click", function(){
			$(".filter-content").slideToggle('slow');
		});
	}
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

function showDropdown() {
	document.getElementById("myDropdown").classList.toggle("showDiv");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
	if (!event.target.matches('.dropbtn')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('showDiv')) {
				openDropdown.classList.remove('showDiv');
			}
		}
	}
}

$.fn.stars = function() {
	return $(this).each(function() {
		var rating = $(this).data("rating");
		var numStars = $(this).data("numStars");
		var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
		var halfStar = ((rating%1) !== 0) ? '<i class="fa fa-star-half-empty"></i>': '';
		var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
		$(this).html(fullStar + halfStar + noStar);
	});
}
$('.stars').stars();
$(".save-unsave").click(function() {
	
		var ideaid = $(this).attr('id');
	    var uid    = $(this).attr('uid');
		var saved  = 1;
		var base_url = window.location.origin;
		var urlstats = base_url+"/home/savedidea";	
    	
		$.ajax({
                url : urlstats,
                method : "POST",
				dataType:"json",   
				data : {ideaid: ideaid, uid: uid, saved: saved},
				success: function(data){
				//alert(data.count);
				$(".save-unsave_"+ideaid).text(data.msg);
				$(".badge-blue").text(data.count);
				console.log(data.msg);
				
			},
			error: function(){
				
			console.log("error Order details");
			}
			});
	
	
});

$(".sharing-cont").hide();
$(".sharing").click(function() {
	$(".impress-cont").hide();
	$(".opinion-cont").hide();
	var sharec = $(this).data("share"); 
	//$(".sharing-cont").slideToggle("slow");
	$(".share_"+sharec).slideToggle("slow");
});
$(".impress-cont").hide();
$(".impress").click(function() {
	var postid = $(this).attr("id");
	$(".sharing-cont").hide();
	$(".impresscount"+postid).slideToggle("slow");
});
$(".opinion-cont").hide();
$(".opinion").click(function() {
	$(".impress-cont").hide();
	$(".sharing-cont").hide();
	var opinionc = $(this).data("opinion"); 
	$(".opinion_"+opinionc).slideToggle("slow");
	//$(".opinion-cont").slideToggle("slow");
});
$(".funding").click(function() {
	$(".fundingContent").slideToggle("slow");
});

$(document).ready(function(){
	$('.more-cont').hide();
	$('.see-more').click(function(){
		$(this).hide();
		$('.more-cont').show();
	});
});

$(window).scroll(function(){
  var sticky = $('.dashboard-top'),
	  scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass('header-fixed');
  else sticky.removeClass('header-fixed');
});

$('.chip .close').on('click', function(e){
$(this).parent('div.chip').fadeOut();
});
$("#search-input").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#tag-user li:not(:first)").filter(function() {
  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
$(".notify-content").hide();
$(".notify-btn").on("click", function(){
	$(".notify-content").slideToggle('slow');
});

//$(".signup-nav").hide();
$(".bars").on("click", function(){
	$(".signup-nav").slideToggle('slow');
});

$("#payment-info").hide();
$(".sumbit-btn").on("click", function(){
	$("#payment-info").slideToggle('slow');
});

$('.notifyTabs').on('click', '.nav-tabs a', function(){
    $(this).closest('.dropdown').addClass('dontClose');
});
$('.notifyDropdown').on('hide.bs.dropdown', function(e) {
    if ( $(this).hasClass('dontClose') ){
        e.preventDefault();
    }
    $(this).removeClass('dontClose');
});

$(".upload-link").hide();
$('.upload-pic').hover(function () {
    $('.upload-link').show('slow');
}, function () {
    $('.upload-link').hide('slow');
});

$(".click-blk1").on("change", function(e){
	$(".hide-show-blk1").slideToggle("slow");
	e.preventDefault();
});
$(".hide-show-blk2").hide();
$(".click-blk2").on("change", function(e){
	$(".hide-show-blk2").slideToggle("slow");
	e.preventDefault();
});

window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("gotoTop").style.display = "block";
    } else {
        document.getElementById("gotoTop").style.display = "none";
    }
}
function topFunction() {
     $('html, body').animate({scrollTop:0}, 'slow');
}
$('input[name="currency_min"], input[name="currency_max"], input[name="min_offer"], input[name="max_offer"], input[name="initiate_min"],input[name="initiate_max"], input[name="share_offered_max"], input[name="share_offered_min"], input[name="approx_share_offered_max"], input[name="approx_share_offered_min"], input[name="min_invest"], input[name="max_invest"], input[name="min_share"], input[name="max_share"], input[name="duration_min"], input[name="duration_max"], input[name="coins"], input[name="min_break_even"], input[name="max_break_even"], input[name="income_max"], input[name="income_min"], input[name="share_max"], input[name="share_min"], input[name="min_amount"], input[name="max_amount"], input[name="min_salary"], input[name="max_salary"], input[name="min_budget"], input[name="max_budget"], input[name="min_investment"], input[name="max_investment"], input[name="min_returns"], input[name="max_returns"], input[name="min_breakeven"], input[name="max_breakeven"], input[name="invest_min"], input[name="invest_max"], input[name="mobile"], input[name="price"], input[name="min_return"], input[name="max_return"], input[name="breakeven_min"], input[name="breakeven_max"]').keypress(validateNumber);

function validateNumber(event) {
	var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 ) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
};		
function AlphabetsOnly(txt, e) {
            var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
            var code;
            if (window.event)
                code = e.keyCode;
            else
                code = e.which;
            var char = keychar = String.fromCharCode(code);
            if (arr.indexOf(char) == -1)
                return false;
            
}
function handleChange(input) {
    if (input.value < 0) input.value = 0;
    if (input.value > 100) input.value = 100;
}
$(function($) {
  var input = $('.input-a');
	input.clockpicker({
    autoclose: true
});
});
  $("#header_search_skill").click(function(){
	  var key = $('#headerSearch').val();
		if(!key){return false;}
		var base_url= $('#header_search_form').attr('action');
	  window.location.replace(base_url+"skill/?key="+key);
  });
  $("#header_search_investor").click(function(){
	  var key = $('#headerSearch').val();
		if(!key){return false;}
	  var base_url= $('#header_search_form').attr('action');
		  window.location.replace(base_url+"investor/profiles/?key="+key);
  });
  $("#header_search_entrepreneur").click(function(){
	  var key = $('#headerSearch').val();
		if(!key){return false;}
	  var base_url= $('#header_search_form').attr('action');
		  window.location.replace(base_url+"Entrepreneur/profiles/?key="+key);
  });
  $("#header_search_ideas").click(function(){
	  var key = $('#headerSearch').val();
		if(!key){return false;}
	  var base_url= $('#header_search_form').attr('action');
		  window.location.replace(base_url+"businessideas/?key="+key);
  });
  $("#global_header_search_ideas").click(function(){
	  var key = $('#headerSearch').val();
		if(!key){return false;}
	  var base_url= $('#header_search_form').attr('action');
		  window.location.replace(base_url+"skill/search/?key="+key);
  });
$('#headerSearch').keypress(function(e) {
	if(e.which == 13) {
//		alert('sss');
	}
});