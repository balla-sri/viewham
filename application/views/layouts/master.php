<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('common/main_head.php');?>
    <body>
        <?php $this->load->view('common/top_head.php');?>
		<?php $this->load->view('modals/initiate_model');?>
		<?php $this->load->view('modals/invest_model');?>
    	<section class="ideazone"> 
                <div class="container">
                    <?php if(isset($landing) && $landing != 'singleidea'){?>
                    <div class="row mb-20">
                        <?php $this->load->view('common/breadcrumb.php');?>    
                        <?php $this->load->view('ideas/ideas_postlink.php');?>    
                    </div>
                    <?php } ?>
                    <?php if(isset($landing) && $landing=='industry'){?>
                    <?php echo $industry_content;?>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?php $this->load->view('common/common-left-menu.php');?>
                            <!-- this search filter should change with page -->
                            <?php if(isset($module) && $module == 'ideazone'){?>
                            <?php $this->load->view('ideas/idea_search.php');?>
                            <?php } ?>
                        </div>
                        <div class="col-md-9">
                            <?php echo $contents ?>
                        </div>
                        <?php if(isset($spark) && $spark==1){?>
                        <?php $this->load->view('ideas/idea-spark');?>
                        <?php } ?>
                    </div>
                </div>
    	</section>
        <?php $this->load->view('common/resources_footer.php');?>
        <?php $this->load->view('common/main_footer.php');?>
		<?php $this->load->view('common/common-geo-location') ?>
    </body>	
</html>
