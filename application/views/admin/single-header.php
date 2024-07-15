<!DOCTYPE html>
<html lang="en">
	<head>
	<?php $redirecturl= 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	$o=$bussinessIdeas;
	$uid= $o['POSTED_BY'];
					$CI =& get_instance();
					$fid = $CI->usersby($uid);?>
					<?php ?>
								<?php if(empty($user['PROFILE_PICTURE'])){
									$user['PROFILE_PICTURE'] = 'svg.svg';
								}?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?php echo base_url()?>favicon.png" type="image/gif">
			<!-- Facebook Core meta -->
		<meta property="og:url" content="<?php echo $redirecturl; ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $o['IDEA_TITLE']; ?>" />
<meta property="og:description" content="<?php //echo $o['DESCRIPTION']; ?>" />
<meta property="og:image" content="<?php echo base_url(); ?>uploads/images/<?php echo $fid['PROFILE_PICTURE']; ?>" />
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="<?php echo $o['IDEA_TITLE']; ?>- Viewham"/>
<meta name="twitter:description" content="<?php //echo $o['DESCRIPTION']; ?>"/>
<meta name="twitter:image" content="<?php echo base_url(); ?>uploads/images/<?php echo $fid['PROFILE_PICTURE']; ?>"/>		
		<title><?php echo $o['IDEA_TITLE']; ?></title>
		<!-- Bootstrap Core CSS -->
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
		<script src="<?php echo base_url(); ?>assets/material/magicsuggest.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/material/material.indigo-pink.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/star-rating.min.css">
		<!-- Material Design Lite -->
		<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
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
						</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="signup-nav pull-right col-md-8">
						<div class="col-md-6 col-lg-6 col-sm-5">
						</div>
						<div class="side-menu col-md-6 col-lg-6 col-sm-7">
							<ul class="nav nav-pills notify-nav" role="tablist">
								
								
							      
								<li role="presentation" class="dropdown"> <a href="#" class="dropdown-toggle" id="n4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>uploads/images/<?php echo $user['PROFILE_PICTURE']; ?>" class="profile-pic" /></span>
								<?php echo $user['NAME']; ?> <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n4">
										<li><a href="<?php echo base_url('user/editprofile'); ?>"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Profile</a></li>
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
	<div id="topbar">
			<div class="container">
				<div class="row">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header col-md-6 col-sm-6">
						<a class="page-scroll" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.svg" class="logo"/></a>
						<div class="mobile-menu col-md-6">
						
						    <a href="#" class="signup">Sign Up </a>
						</div>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="signup-nav pull-right col-md-6  col-sm-6">
						<div class="col-md-6 col-lg-7 col-sm-12">
							
						</div>
						<div class="side-menu pull-right col-md-6 col-lg-5 col-sm-12">
							<div class="row">
				<a href="<?php echo base_url(); ?>user/signup" class="">Sign Up </a>
				<a href="<?php echo base_url(); ?>user/signin" class="">Sign In</a>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>