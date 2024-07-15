<?php $this->load->view('admin/admin-header');?>
<section class="static" style="padding-top: 64px;">
    <div class="header-content">
        <?php $this->load->view('admin/admin-menu');?>
        <div class="content">
            <div class="col-lg-10 ">
                <h3>IDEAS List</h3>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home" class="green">ALL IDEAS</a></li>
                    <li><a data-toggle="tab" href="#menu1" class="green">PENDING</a></li>
                    <li><a data-toggle="tab" href="#menu2" class="green">APPROVED</a></li>
                    <li><a data-toggle="tab" href="#menu3" class="green">INACTIVE</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <?php $this->load->view('admin/admin-all-ideas');?>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <?php $this->load->view('admin/admin-pending-ideas');?>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <?php $this->load->view('admin/admin-approved-ideas');?>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <?php $this->load->view('admin/admin-inactive-ideas');?>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('admin/admin-footer.php');?>