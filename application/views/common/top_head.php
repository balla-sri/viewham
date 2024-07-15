<?php 	$notifictionsCount = NotificationsCount(); 
	$CoinsTotal = TotalCoins(); ?>
	<section id="topbar" class="dashboard-top">
    <div class="container">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header col-sm-12 col-lg-4">
                <a class="page-scroll" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.svg" class="logo"/></a>
                <div class="mobile-menu">
                    <a href="#" class="bars"><i class="fa fa-bars"></i></a>
                    <!--span><img src="<?php echo base_url();?>assets/images/notifications.svg"><div class="redbox">29</div></span-->
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="signup-nav pull-right col-lg-8">
            <div class="col-md-5 col-lg-5 col-sm-12">
            <div class="search-box relative hidden-xs">
			<div action="<?php echo base_url(); ?>" id="header_search_form">
              <div class="input-box ">
                <input autocomplete="off" type="text" class="form-control" placeholder="Search by Skill Name" name="key" id="headerSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <div class="notify-nav headerSearch">
                  <ul class="dropdown-menu animation slideDownIn" aria-labelledby="headerSearch">
                    <li><a id="header_search_skill">Search by Skill Name &amp; Industry Name</a></li>
                    <li><a id="header_search_investor">Search by Investor Profiles</a></li>
                    <li><a id="header_search_entrepreneur">Search by Entrepreneur Profiles</a></li>
                    <li><a id="header_search_ideas">Search by Business Ideas</a></li>
                  </ul>
                </div>
              </div>
              <div class="mag-box "><a id="global_header_search_ideas"><i class="fa fa-search"></i></a> </div>
			  </div>
            </div>
          </div>
                
                <div class="side-menu col-md-7 col-lg-7 col-sm-12 <?php if($session_exist){ ?> show <?php } else {?> hide <?php } ?>" id="after_signin_block" >
                    <ul class="nav nav-pills notify-nav" role="tablist">
                        <li role="presentation" >
                            <a href="<?php echo base_url('Coins');?>" class="" ><img src="<?php echo base_url();?>assets/images/coins.svg" width="38px" />
							<div class="notify"><?php echo $CoinsTotal['totalCoins']; ?></div>
                        </a>
						</li>
                        <li role="presentation" >
                            <a href="<?php echo base_url('proposals');?>" class="" ><img src="<?php echo base_url();?>assets/images/notifications.svg" width="38px" />
                            <div class="notify notify_notification"><?php echo $notifictionsCount['totalCount']; ?></div>
                            </a>
						</li>
						<li role="presentation" class="dropdown" id='regular_login'>
                            <a href="#" title="<?php if($session_exist){ echo  $user['name']; } ?>" class="dropdown-toggle" id="n4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php if($session_exist){ echo $user['profile_picture']; } ?>" class="profile-pic" id="profile_picture" />
                                <span id="profile_name" style="color:white"><?php if($session_exist){ echo $user['name']; } ?></span>

                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n4">
                                <li><a href="<?php echo base_url();?>user/editprofile"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Profile</a></li>
                                <!--li><a href="#"><i class="glyphicon glyphicon-cog"></i>&nbsp; Settings</a></li-->
                                <li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url('skill/shortlists'); ?>"><i class="glyphicon glyphicon-tags"></i>&nbsp; shortlists & Contacts</a></li>
								<li><a href="<?php echo base_url('quick-links'); ?>"><i class="glyphicon glyphicon-link"></i>&nbsp; Quicklinks</a></li>
                                <li><a href="<?php echo base_url();?>user/logout"><i class="glyphicon glyphicon-off"></i>&nbsp; Logout</a></li>
                            </ul>
                            
                        </li>
                        <li role="presentation" class="dropdown hide" id='ajax_login'>
                            <a href="#" class="dropdown-toggle" id="n4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="" class="profile-pic" id="profile_picture_ajax" />
                                <span id="profile_name_ajax"></span>
                                <i class="fa fa-angle-down"></i>
                            </a><ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n4">
                                <li><a href="#"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Profile</a></li>
                                <!--li><a href="#"><i class="glyphicon glyphicon-cog"></i>&nbsp; Settings</a></li-->
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url();?>user/logout"><i class="glyphicon glyphicon-off"></i>&nbsp; Logout</a></li>
                            </ul>
                            
                        </li>
                    </ul>	
                </div>
                
                <div class="side-menu pull-right col-md-6 col-lg-5 col-sm-12 <?php if($session_exist){ ?> hide <?php } else {?> show <?php } ?>" id="before_signin_block">
                    <div class="row">
                        <a href="<?php echo base_url();?>user/signup" class="">Sign Up </a>
                        <a href="<?php echo base_url();?>user/signin" class="">Sign In</a>
                        <!--	<a href="#" class="bars"><i class="fa fa-bars"></i></a>-->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>	