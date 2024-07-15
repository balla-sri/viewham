<h3>PENDING</h3>
<div class="table-responsive">
    <table class="table table-bordered blue">
        <thead>
            <tr>
                <th>Idea</th>
                <th>Industry</th>
                <th>Posted By</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pending_ideas as $key=>$idea){ ?>
                <tr>
                    <td><?php echo $idea['idea_title'];?></td>
                    <td><?php echo $idea['industry'];?></td>
                    <td><?php echo $idea['name'];?></td>
                    <td><?php echo ($idea['status']==1)?"Pending":(($idea['status']==2)? "Active":"Inactive");?></td>
                    <td>
                        <?php if($idea['status']==1){ ?>
                        <a href="<?php echo site_url('admin/approveidea/'.$idea['idea_id']).'/2';?>">Approve</a>
                        <?php }?>
                    </td>
                    <td>
                        <?php if($idea['status']==1){ ?>
                        <a href="<?php echo site_url('admin/approveidea/'.$idea['idea_id'].'/3');?>">Reject</a>
                        <?php }?>
                    </td>
                    <td>
                        <a href="<?php echo site_url('admin/viewidea/'.$idea['idea_id']);?>">View</a>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>
