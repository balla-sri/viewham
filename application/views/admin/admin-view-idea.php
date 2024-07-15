<?php $this->load->view('admin/admin-header');?>
<section class="static" style="padding-top: 64px;">
    <div class="header-content">
        <?php $this->load->view('admin/admin-menu');?>
        <div class="content">
            <div class="col-lg-10 ">
                <h3>View Idea</h3>
                <h5><?php echo $idea[0]['idea_title'];?></h5>
                <p>Industry: <?php echo $idea[0]['industry'];?></p>
                <p>Posted By: <?php echo $idea[0]['name'];?></p>
                <p>Status: <?php echo ($idea[0]['status']==1)?"Pending":(($idea[0]['status']==2)? "Active":"Inactive");?></p>
                <p>Description: <?php echo $idea[0]['description']; ?></p>
                <?php if($idea[0]['status'] == 1){?>
                <div class="col-lg-12">
                    <a href="<?php echo site_url('admin/approveidea/'.$idea[0]['idea_id'].'/2');?>" class="btn btn-success">Approve</a>
                    <a href="<?php echo site_url('admin/approveidea/'.$idea[0]['idea_id'].'/3');?>" class="btn btn-success">Reject</a>
                </div>
                <?php } ?>
            </div>  
        </div>
    </div>
</section>
<?php $this->load->view('admin/admin-footer.php');?>