<div class='post-container'>
    <div class='post-detail'>
        <img src='<?php echo $user["profile_picture"]?>' class='profile-photo-md pull-left' alt=''>
        <div class='user-info'>
            <h5><a class='profile-link'><?php echo $user['name'];?></a></h5>
            <p class='text-muted'><?php echo $comments['comment_name'];?></p>
        </div>
        <div class='reaction'>
            <a class='btn text-green'></a>
        </div>
        <div class='reaction'>
            <a class='btn text-green'></a>
        </div>
        <div class='post-text'>
            <p>
                <i class='em em-anguished'></i> 
                <i class='em em-anguished'></i> 
                <i class='em em-anguished'></i>
                <a data-commentid='<?php echo $comments['comment_id'];?>' data-status='1'  class='stat-item commentlike commentlike_<?php echo $comments['comment_id'];?>'>
                    <i class='fa fa-thumbs-up'></i>
                    <span class='like_class_<?php echo $comments['comment_id'];?>'>Like</span>
                </a>
            </p>
        </div>
        <div class='subcommm_<?php echo $comments['comment_id'];?>'>
            <div class='sub-post'>
                <div class='replay_input_<?php echo $comments['comment_id'];?> post-comment'>
                    <img src='<?php echo $user["profile_picture"]?>' alt='' class='profile-pic'>
                    <input type='text' class='replay_comment_name_<?php echo $comments['comment_id'];?> form-control' placeholder='Post a comment' onKeyPress='return checkSubmit(event)'>
                    <a data-postid='<?php echo $comments['post_id'];?>' data-replayid='<?php echo $comments['comment_id'];?>' class='replay stat-item replay_<?php echo $comments['comment_id'];?>'>
                        <i class='fa fa-reply'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>