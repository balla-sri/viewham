<?php 	$notifictionsCount = NotificationsCount(); 
	$CoinsTotal = TotalCoins();?>
<div id="topbar" class="dashboard-top">
    <div class="container">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header col-md-6 col-sm-6">
                <a class="page-scroll" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.svg" class="logo"/></a>
                <div class="mobile-menu col-md-6">
                    <a href="#" class="bars"><i class="fa fa-bars"></i></a>
                    <a href="#" class="signup">Sign Up </a>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="signup-nav pull-right col-md-6  col-sm-6">
                <div class="col-md-3 col-lg-3 col-sm-12">
                    <div class="search-box">
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Search by Skill Name">
                        </div>
                        <div class="mag-box">
                            <img src="http://local.devviewham.com/assets/images/search.svg">
                        </div>
                    </div>
                </div>
                <div class="side-menu pull-right col-md-9 col-lg-9 col-sm-12">
                    <ul class="nav nav-pills notify-nav <?php if($session_exist){ ?> show <?php } else {?> hide <?php } ?>" role="tablist">
					      <li role="presentation" >
                            <a href="<?php echo base_url('Coins');?>" class="" ><img src="<?php echo base_url();?>assets/images/coins.svg" width="38px" />
                            <div class="notify"><?php echo $CoinsTotal['totalCoins']; ?></div></a>
						</li>
						<li role="presentation" >
                            <a href="<?php echo base_url('proposals');?>" class="" ><img src="<?php echo base_url();?>assets/images/notifications.svg" width="38px" />
							 <div class="notify notify_notification"><?php echo $notifictionsCount['totalCount']; ?></div>
                            </a>
						</li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="n4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php if(isset($user['profile_picture'])){?>
                                    <img src="<?php echo $user['profile_picture'];?>" class="profile-pic" />
                                <?php } else{ ?>
                                    <img src="<?php echo base_url();?>assets/images/uploads/svg.svg" class="profile-pic" />
                                <?php } ?>
                                    <span id="profile_name"><?php echo $user['name'];?></span>
                                    <i class="fa fa-angle-down"></i>
                                
                            </a>
                            
                            <ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n4">
                                <li><a href="#"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Profile</a></li>
                                <li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url('skill/shortlists'); ?>"><i class="glyphicon glyphicon-tags"></i>&nbsp; shortlists & Contacts</a></li>
								<li><a href="<?php echo base_url('quick-links'); ?>"><i class="glyphicon glyphicon-link"></i>&nbsp; Quicklinks</a></li>
								<li><a href="<?php echo base_url();?>user/logout"><i class="glyphicon glyphicon-off"></i>&nbsp; Logout</a></li>
                            </ul>
                            
                        </li>
                    </ul>
                    <div class="row <?php if($session_exist){ ?> hide <?php } else {?> show <?php } ?>">
                        <a href="<?php echo base_url();?>user/signup" class="">Sign Up </a>
                        <a href="<?php echo base_url();?>user/signin" class="">Sign In</a>
                        <!--	<a href="#" class="bars"><i class="fa fa-bars"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>