<script type="text/javascript" src="<?php echo base_url();?>assets/js/ideas.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/clipboard.min.js"></script>

<input type="hidden" id="session_exist" value="<?php echo $session_exist; ?>">
<?php if(isset($session_exist) && ($session_exist == 1) && isset($landing) && $landing == 'ideaslist'){
    $this->load->view('ideas/ideas-menu');
 } ?>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="allIdeas">
        <?php $this->load->view('ideas/ideas-all');?>
    </div>
    <?php if(isset($session_exist) && ($session_exist == 1) && isset($landing) && $landing == 'ideaslist'){?>
    <div role="tabpanel" class="tab-pane fade" id="saved">
        
    </div>
    <div role="tabpanel" class="tab-pane fade" id="initiated">
        <?php //$this->load->view('ideas/ideas-initiates');?>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="investable">
        <?php // $this->load->view('ideas/ideas-invested');?>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="posted">
        <?php $this->load->view('ideas/ideas-posted');?>
    </div>
<?php } ?>
</div>
<input type="hidden" name="page_name" id="page_name" value="<?php echo $this->uri->uri_string();?>">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
<?php $this->load->view('modals/signup_modal');?>
<?php $this->load->view('modals/signin_modal');?>
<?php $this->load->view('modals/forgot_password');?>
<?php $this->load->view('modals/mobile_otp');?>
<?php $this->load->view('modals/messages');?>
<script src="<?php echo base_url(); ?>assets/js/custom/ideas-list.js"></script>
