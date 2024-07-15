<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>. . : : Viewham : : . .</title>
		<link rel="icon" href="<?php echo base_url()?>favicon.png" type="image/gif">
		<!-- Bootstrap Core CSS -->
		<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
		<link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/star-rating.min.js"></script>
		<!-- Custom Fonts -->
		<link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Plugin CSS -->
		<link href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
		<!-- Theme CSS -->
		<link href="<?php echo base_url(); ?>assets/css/creative.min.css" rel="stylesheet">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<!-- Select2 Design Lite -->
		<link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet"/>
		<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
		<!-- Material Design Lite -->
		
		<script src="<?php echo base_url(); ?>assets/material/material.min.js"></script>
		<script src="<?php echo base_url(); ?>assets//material/magicsuggest.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/material/material.indigo-pink.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/star-rating.min.css">
		<!-- Material Design Lite -->
		<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/selectize.default.css" rel="stylesheet">
	</head>
	<body>
	<?php $session_user = $this->session->userdata('user');  
	if($session_user){?>
		<section id="topbar" class="dashboard-top">
			<div class="container">
				<div class="row">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header col-md-4">
						<a class="page-scroll" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.svg" class="logo"/></a>
						<div class="mobile-menu col-md-6">
						<a href="#" class="bars"><i class="fa fa-bars"></i></a>
							 <!--<span><img src="<?php echo base_url(); ?>assets/images/notifications.svg"><div class="redbox">29</div></span>-->
						</div>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="signup-nav pull-right col-md-8">
						<div class="col-md-6 col-lg-6 col-sm-5">
								<div class="search-box relative hidden-xs">
								<div class="input-box">
									<input type="text" class="searchtxt form-control" placeholder="Search by Skill Name" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="notify-nav headerSearch">
										<ul class="dropdown-menu animation slideDownIn" aria-labelledby="headerSearch">
											<li onclick="window.location.href='<?php echo base_url('gain/allprofiles'); ?>'"  data-skill="1" class="searchbtn"><a >Search by Skill Name & Industry Name</a></li>
											<li onclick="window.location.href='<?php echo base_url('gain/allinvesters'); ?>'" data-skill="2" class="searchbtn"><a >Search by Investor Profiles</a></li>
											<li onclick="window.location.href='<?php echo base_url('gain/allentrepreneurs'); ?>'" data-skill="3" class="searchbtn"><a >Search by Entrepreneur Profiles</a></li>
											<li onclick="window.location.href='<?php echo base_url('business-ideas'); ?>'" data-skill="4" class="searchbtn"><a >Search by Business Ideas</a></li>
										</ul>
									</div>
								</div>
								<div class="mag-box">
									<i class="fa fa-search"></i> 
								</div>
																
							</div>
							</div>
						<div class="side-menu col-md-6 col-lg-6 col-sm-7">
							<ul class="nav nav-pills notify-nav" role="tablist">
								<?php if(empty($user['PROFILE_PICTURE'])){
									$prf = 'svg.svg';
								}else{
									$prf =$user['PROFILE_PICTURE'];
								} ?>
								  <li role="presentation" class="dropdown"> <a href="#" class="dropdown-toggle" id="n4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>uploads/images/<?php echo $prf; ?>" class="profile-pic" /></span>
								<?php echo $user['name']; ?> <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n4">
						<li><a href="<?php echo base_url('user/editprofile'); ?>"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Profile</a></li>
						<li><a href="<?php echo base_url('shortlists-contacts'); ?>"><i class="glyphicon glyphicon-tags"></i>&nbsp; shortlists & Contacts</a></li>
						<li><a href="<?php echo base_url('quick-links'); ?>"><i class="glyphicon glyphicon-link"></i>&nbsp; Quicklinks</a></li>
										
										
										<li role="separator" class="divider"></li>
										<li><a href="<?php echo base_url('user/logout'); ?>"><i class="glyphicon glyphicon-off"></i>&nbsp; Logout</a></li>
									</ul>
						
								</li>
							</ul>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<?php }else{ ?>
	<div id="topbar" class="dashboard-top">
			<div class="container">
				<div class="row">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header col-md-6 col-sm-6">
						<a class="page-scroll" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.svg" class="logo"/></a>
						<div class="mobile-menu col-md-6">
							<a href="#" class="bars"><i class="fa fa-bars"></i></a>
						    <a href="#" class="signup">Sign Up </a>
						</div>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="signup-nav pull-right col-md-6  col-sm-6">
						<div class="col-md-6 col-lg-7 col-sm-12">
							<!--<div class="search-box">
								<div class="input-box">
									<input type="text" class="form-control" placeholder="Search by Skill Name">
								</div>
								<div class="mag-box">
									<img src="<?php echo base_url(); ?>assets/images/search.svg">
								</div>
							</div>-->
						</div>
						<div class="signinheader side-menu pull-right col-md-6 col-lg-5 col-sm-12">
							<div class="row">
				<a href="<?php echo base_url(); ?>user/signup" class="">Sign Up </a>
				<a href="<?php echo base_url(); ?>user/signin" class="">Sign In</a>
							<!--	<a href="#" class="bars"><i class="fa fa-bars"></i></a>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>