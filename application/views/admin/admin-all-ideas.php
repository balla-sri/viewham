<h3>ALL IDEAS</h3>
<div class="table-responsive">
    <table class="table table-bordered blue">
        <thead>
            <tr>
                <th>Idea</th>
                <th>Industry</th>
                <th>Posted By</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($all_ideas as $allkey=>$allidea){ ?>
                <tr>
                    <td><?php echo $allidea['idea_title'];?></td>
                    <td><?php echo $allidea['industry'];?></td>
                    <td><?php echo $allidea['name'];?></td>
                    <td><?php echo ($allidea['status']==1)?"Pending":(($allidea['status']==2)? "Active":"Inactive");?></td>
                    <td>
                        <?php if($allidea['status']==1){ ?>
                        <a href="<?php echo site_url('admin/approveidea/'.$allidea['idea_id']).'/2';?>">Approve</a>
                        <?php }?>
                    </td>
                    <td>
                        <?php if($allidea['status']==1){ ?>
                        <a href="<?php echo site_url('admin/approveidea/'.$allidea['idea_id'].'/3');?>">Reject</a>
                        <?php }?>
                    </td>
                    <td>
                        <a href="<?php echo site_url('admin/viewidea/'.$allidea['idea_id']);?>">View</a>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>
