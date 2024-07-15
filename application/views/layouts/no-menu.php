<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('common/main_head.php');?>
    <body>
        <?php $this->load->view('common/top_head.php');?>
		<!--Models -->
		<?php $this->load->view('modals/signup_modal');?>
		<?php $this->load->view('modals/signin_modal');?>
		<?php $this->load->view('modals/mobile_otp');?>
		<?php $this->load->view('modals/messages');?>
		<!--main content -->
		<?php echo $contents ?>
  		<!--Footer-->
        <?php $this->load->view('common/resources_footer.php');?>
		<?php $this->load->view('common/main_footer.php');?>
    </body>	
</html>
