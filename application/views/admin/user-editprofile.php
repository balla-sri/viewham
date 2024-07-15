	<?php $this->view('admin/user-header') ?>

		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/croppie.css" />
	<section class="ideazone">
		<div class="container">
			<div class="row mb-20">
				<div class="col-md-6">
					<h4 class="mt-0 mb-0">Your Profile</h4>
				</div>
				<div class="col-md-6">
					<?php if(!empty($this->session->flashdata('success'))){?>
					<div class="alert alert-success"><b>Congratulations!!</b> Your  profile has been Updated</div>
					<?php } ?>
				</div>
			</div>
			<?php if($user['PROFILE_PICTURE']){
				$pimg = $user['PROFILE_PICTURE'];
			}else{
				$pimg = 'svg.svg';
			} ?>
			<div class="row">
				<div class="col-md-12">
					<div class="ideazone-content form-box">						
						<div class="row mt-20">
						<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
							  <!-- left column -->
							  <div class="col-md-3">
								<div class="text-center">
								<span id="remove-pic" >X</span>
								  <div class="upload-pic">
								  <div id="uploaded_image">
									<img id="blah" src="<?php echo base_url('uploads/images/').$pimg; ?>" class="avatar" alt="avatar" />
												</div>									
							<input name="imageprofile" id="imageprofile" value="<?php echo $pimg; ?>" type="hidden" >
									<div class="upload-link">
					<input name="upload_image" id="upload_image" type="file" class="form-control">
			</div> 
								  </div>
								  
								</div>
							  </div>
							  <?php //print_r($user); ?>
							  <!-- edit form column -->
							  <div class="col-md-8 col-md-offset-1 personal-info">
								<h2>Personal info</h2>								
								
								  <div class="">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
										<input class="mdl-textfield__input" name="name" value="<?php echo $user['NAME']; ?>" type="text" id="n1">
										<label class="mdl-textfield__label"  for="n1">Name</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
										<input class="mdl-textfield__input" name="age" value="<?php echo $user['DOB']; ?>" type="text" id="a1">
										<label class="mdl-textfield__label" for="a1">Age</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
										<input class="mdl-textfield__input" name="mobile" value="<?php echo $user['MOBILENO']; ?>" type="text" id="m1">
										<label class="mdl-textfield__label" for="m1">Mobile</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
										<input class="mdl-textfield__input" name="email" value="<?php echo $user['EMAIL']; ?>" type="text" id="e1">
										<label class="mdl-textfield__label" for="e1">Email</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
										<input class="mdl-textfield__input" name="Linkedin" value="<?php echo $user['LINKEDIN_ID']; ?>" type="text" id="li1">
										<label class="mdl-textfield__label" for="li1">Linkedin</label>
									</div>
									<label class="mt-20">Gender</label>
									<div class="radio-grp">
										<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="male">
											<input type="radio" id="male" class="mdl-radio__button" name="GENDER" value="1" <?php if($user['GENDER'] == 1){ ?>checked<?php }?>>
											<span class="mdl-radio__label">Male</span>
										</label>
										<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="female">
											<input type="radio" id="female" class="mdl-radio__button" name="GENDER"  value="2" <?php if($user['GENDER'] == 2){ ?>checked<?php }?>>
											<span class="mdl-radio__label">Female</span>
										</label>
									</div>
									<button class="btn btn-primary sub mt-20">Save</button>
									<br /><br />
								  </div>
								
								<br />
							  </div>
							  </form>
						  </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
		<?php $this->view('home-footer') ?>
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<div id="uploadimageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Upload & Crop Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 text-center">
						  <div id="image_demo" ></div>
						  <button class="btn btn-success crop_image">Crop Image</button>
  					</div>
  					 
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>


<script>  
$(document).ready(function(){

$("#remove-pic").click(function(){
var dataimg = 'svg.svg'; 	
$('#uploaded_image').html('<img src="<?php echo base_url('uploads/images/'); ?>'+dataimg+'" />');	

var url = "<?php echo base_url('user/removeprofilepic'); ?>";
    $.ajax({
           type: "POST",
           url: url,
		   timeout: 600000,
           success: function(data)
           {
               $('#remove-pic').hide();
			   $('#imageprofile').val('');
           }
         });

});	

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
	  
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
   // $('#signinModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"<?php echo base_url('uploads/images/'); ?>upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#blah').hide();
          $('#imageprofile').val(data);
          $('#remove-pic').show();
          $('#uploaded_image').html('<img src="<?php echo base_url('uploads/images/'); ?>'+data+'" />');
        }
      });
    })
  });

});  
</script>

  <script src="<?php echo base_url(); ?>assets/js/croppie.js"></script>
	