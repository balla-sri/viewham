<section id="title-bar" class="static" >
    <div class="container">
        <div class="header-content">
            <div class="header-content-inner">
                <h2><?php echo $title;?></h2>
                <hr>
                <h3><?php echo $sub_title;?></h3>
            </div>
            <?php 
				 $action = 	$this->uri->segment(2);	

			if((isset($landing) && $landing=='index') || ($action=='postidea')){?>
            <div class="btn-group col-md-6 col-md-offset-3">
                <button onclick="window.location.href='<?php echo base_url('businessideas/'); ?>'" type="button" class="btn btn-primary">View Business Ideas</button>
                <button onclick="window.location.href='<?php echo base_url('businessideas/postidea'); ?>'" type="button" class="btn btn-primary" <?php if($action=='postidea'){echo "style='background:#222;color:#fff'";}?>>Post a Business Idea</button>
            </div>
            <?php } ?>
        </div>
    </div>
</section>