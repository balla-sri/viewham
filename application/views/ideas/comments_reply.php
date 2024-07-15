<div class='sub-post'>
    <div class='post-comment'>
        <img src='<?php echo $user["profile_picture"];?>' alt='' class='profile-pic'>
        <p>
            <a  class='profile-link'><?php echo $user["name"];?></a>
            <i class='em em-laughing'></i><?php echo $comment["comment_name"];?>
            <a data-commentid='<?php echo $comment["comment_id"];?>' data-status='1'  class='stat-item commentlike commentlike_<?php echo $comment["comment_id"];?>'>
                <i class='fa fa-thumbs-up'></i>
                <span class='like_class_<?php echo $comment["comment_id"];?>'>Like</span>
            </a>
        </p>
    </div>
</div>