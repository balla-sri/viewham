<div id="ideadetails_<?php echo $idea_details['idea_id'];?>">
    <p>&nbsp;</p>
    <ul class="investment list-unstyled">
        <li>Approx Investment <br>
        <span>
            <?php echo $idea_details['notation']; ?> 
            <?php echo ceil($idea_details['min_investment']); ?> - <?php echo ceil($idea_details['max_investment']); ?>
        </span>
        </li>
        <?php $type = ($idea_details['returns_type']==1? "Daily":$idea_details['returns_type']==2?"Weekly": $idea_details['returns_type']==3?"Monthly":"Yearly");?>
        <li>Approx Returns (<?php echo $type;?>) <br> <span> <?php echo ceil($idea_details['min_returns']); ?> - <?php echo ceil($idea_details['max_returns']); ?></span></li>
        <?php $breakeven = ($idea_details['breakeven_type']==1? "Days":$idea_details['breakeven_type']==2?"Months": "Weeks");?>
        <li>Approx Breakeven <br> <span><?php echo $breakeven;?> <?php echo $idea_details['min_breakeven']; ?> - <?php echo $idea_details['max_breakeven']; ?></span></li>
    </ul>
    <?php if(isset($resources) && count($resources)>0){?>
    <p class="visible-xs visible-sm mb-0">Resources Required</p>
    <div class="table-responsive">
        <p class="hidden-xs hidden-sm">Resources Required</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Skill Name </th>
                    <th>No. People</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($resources as $key=>$skill){ ?>
            <tr>
                <td><?php echo $skill['skill'];?></td>
                <td><?php echo $skill['quantity']; ?></td>
            </tr>    
            <?php  } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
<?php $this->load->view('ideas/idea_comments');?>