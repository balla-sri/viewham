<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('common/main_head.php');?>
    <body>
    <?php $this->load->view('common/nav-gain-earn-idea-lern');?>
	<?php //$this->load->view('common/main_header.php');?>

        <?php $this->load->view('common/top_head.php');?>
        <?php $this->load->view('common/special_title.php');?>
	<?php echo $contents ?>
        <?php $this->load->view('common/resources_footer.php');?>
        <?php $this->load->view('common/main_footer.php');?>
    </body>	
</html>
