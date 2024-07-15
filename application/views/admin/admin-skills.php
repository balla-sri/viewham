<?php $this->load->view('admin/admin-header');?>
<section class="static" style="padding-top: 64px;">
    <div class="header-content">
        <?php $this->load->view('admin/admin-menu');?>
        <div class="content">
            <div class="col-lg-10 ">
                <h3>Skills List</h3>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home" class="green">ALL SKILLS</a></li>
                    <li><a data-toggle="tab" href="#menu1" class="green">PENDING</a></li>
                    <li><a data-toggle="tab" href="#menu2" class="green">APPROVED</a></li>
                    <li><a data-toggle="tab" href="#menu3" class="green">INACTIVE</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>ALL SKILLS</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered blue">
                                <thead>
                                    <tr>
                                        <th>Skill name</th>
                                        <th>Status</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($all_skills as $key1=>$skill1){ ?>
                                        <tr>
                                            <td><?php echo $skill1['skill'];?></td>
                                            <td><?php echo ($skill1['status']==2)?"Active":(($skill1['status']==1)? "Pending":"Inactive");?></td>
                                            <td>
                                                <?php if($skill1['status']==1){ ?>
                                                <a href="<?php echo site_url('admin/approveskills/'.$skill1['id'].'/2');?>">Approve</a>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if($skill1['status']==1){ ?>
                                                <a href="<?php echo site_url('admin/approveskills/'.$skill1['id'].'/3');?>">Reject</a>
                                                <?php }?>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                  </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>PENDING</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered blue">
                                <thead>
                                    <tr>
                                        <th>Skill name</th>
                                        <th>Status</th>
                                        <th colspan="2" class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pending_skills as $key=>$skill){ ?>
                                    <tr>
                                        <td><?php echo $skill['skill'];?></td>
                                        <td><?php echo ($skill['status']==2)?"Active":(($skill['status']==1)? "Pending":"Inactive");?></td>
                                        <td>
                                            <?php if($skill['status']==1){ ?>
                                            <a href="<?php echo site_url('admin/approveskills/'.$skill['id'].'/2');?>">Approve</a>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($skill['status']==1){ ?>
                                            <a href="<?php echo site_url('admin/approveskills/'.$skill['id'].'/3');?>">Reject</a>
                                            <?php } ?>
                                        </td>
                                            
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>APPROVED</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered blue">
                                <thead>
                                    <tr>
                                        <th>Skill name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($active_skills as $akey=>$askill){ ?>
                                    <tr>
                                        <td><?php echo $askill['skill'];?></td>
                                        <td><?php echo ($askill['status']==2)? "Active": (($askill['status']==1)? "Pending":"Inactive");?></td>
                                        <td>
                                            <?php if($askill['status']==1){ ?>
                                            <a href="<?php echo site_url('admin/approveskills/'.$askill['id']);?>">Approve</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                    <h3>INACTIVE</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered blue">
                            <thead>
                                <tr>
                                    <th>Skill name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inactive_skills as $ikey=>$iskill){ ?>
                                <tr>
                                    <td><?php echo $iskill['skill'];?></td>
                                    <td><?php echo ($iskill['status']==2)?"Active":(($iskill['status']==1)? "Pending":"Inactive");?></td>
                                    <td>
                                        <?php if($iskill['status']==1){ ?>
                                        <a href="<?php echo site_url('admin/approveskills/'.$iskill['id']);?>">Approve</a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>  
    </div>
</section>
<?php $this->load->view('admin/admin-footer.php');?>