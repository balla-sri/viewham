<div class="col-md-4">
<!-- Right Panel Start -->
<div class="panel panel-default earnPanel hidden-xs hidden-sm">
<div class="panel-heading">Notifications</div>
<div class="panel-body">
<ul>
<li class="noBG">
<p class="title mb-0">Today</p>

<ul class="notifications">

<p>Lorem Ipsum is simply dummy text of the printing
<span class="date">5 minutes ago</span>
</p>
</li>
</ul>
</li>

</ul>
<p class="text-right"></p>
</div>
</div>
<!-- Right Panel End -->
</div>

<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"<?php echo base_url(); ?>learn/fetch_notifications",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.notifications').html(data.notification);

   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#question').val() != '')
  {
   var form_data = $(this).serialize();
   alert(form_data);
   $.ajax({
    url:"<?php echo base_url(); ?>learn/new_post",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Field is Required");
  }
 });
 

 
 setInterval(function(){ 
 load_unseen_notification('yes');
 }, 5000);
 
});
</script>