<div class="btn-group polls">
<?php if(empty($idea_details['is_initiate'])){ ?>

<button class="InitiateModel initiateIdea_id<?php echo $idea_details['idea_id']; ?>" data-postid="<?php echo $idea_details['idea_id']; ?>"data-industry="<?php echo $idea_details['industry']; ?>" data-toggle="modal" data-target="#initiatePopup">Initiate</button>
<?php } ?>

<?php if(empty($idea_details['is_invest'])){ ?>
<button class="InvestModel" data-toggle="modal" data-postid="<?php echo $idea_details['idea_id']; ?>" data-industry="<?php echo $idea_details['industry']; ?>" data-target="#investModal" id="invest_button">Invest </button>
<?php } ?>
    <ul class="pull-right list-unstyled">
    <li><a class="opinion" data-opinion="<?php echo $idea_details['idea_id']; ?>">Opinion</a></li>
    <li>
        <a id="<?php echo $idea_details['idea_id']; ?>" data-impid="<?php echo $idea_details['idea_id']; ?>" class="impress impressall star_<?php echo $idea_details['idea_id']; ?>">Impress</a>
        <div data-imid="<?php echo $idea_details['idea_id']; ?>" class="impress-cont impresscount<?php echo $idea_details['idea_id']; ?>">
            <input name="input-2" class="rating rating-loading" data-imid="<?php echo $idea_details['idea_id']; ?>" data-min="0" data-max="5" data-step="0.1" value="0" />
        </div>
        <span class="feedbackmsg" id="feedbackmsg<?php echo $idea_details['idea_id']; ?>"></span>
    </li>
    <li>
        <a class="sharing" data-share="<?php echo $idea_details['idea_id']; ?>">Share</a>
        <div class="sharing-cont share_<?php echo $idea_details['idea_id']; ?>" style="display:none;"> 
            <ul class="share-list ">
                <!--li><a href="https://plus.google.com/share?url=<?php echo base_url('businessideas/idea/').$idea_details['idea_id']; ?>"><i class="fa fa-google-plus-square" title="Google Plus"></i></a></li-->
                <li><a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo base_url('businessideas/idea/').$idea_details['idea_id']; ?>"><i class="fa fa-whatsapp" title="WhatsApp"></i></a></li>
                <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url('businessideas/idea/').$idea_details['idea_id']; ?>"><i class="fa fa-facebook-square" title="Facebook"></i></a></li>
                <li><a href="https://twitter.com/share?url=<?php echo base_url('businessideas/idea/').$idea_details['idea_id']; ?>&text=<?php echo $idea_details['idea_title']; ?>" target="_blank"><i class="fa fa-twitter-square" title="Twitter"></i></a></li>
                <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('businessideas/idea/').$idea_details['idea_id']; ?>" target="_blank"><i class="fa fa-linkedin-square" title="Linkedin"></i></a></li>
                <li> <a  data-clipboard-text="<?php echo base_url('businessideas/idea/').$idea_details['idea_id']; ?>" class="allowCopy"><i class="fa fa-link" title="copy link"></i></a></li>
            </ul>
        </div>
    </li>
    <li>
        <a saved="<?php echo $issaved;?>" id="<?php echo $idea_details['idea_id']; ?>" uid="<?php echo $user['id']; ?>" class="save-unsave save-unsave_<?php echo $idea_details['idea_id'];?>">
            <?php if(isset($issaved) && $issaved == 1){ echo "Unsave"; }else{ echo "Save"; } ?>
        </a>
    </li>
    <li><a href="#" class="report-model" data-postid="<?php echo $idea_details['idea_id']; ?>" data-toggle="modal" data-target="#reportModal<?php echo $idea_details['idea_id']; ?>">Report</a></li>
</ul>
</div>
<div class="opinion-cont btn-group polls clearfix" id="opinion_comments_<?php echo $idea_details['idea_id']; ?>">
    <div class="opinion_<?php echo $idea_details['idea_id']; ?>">
        <div class="post-content">
            <div class="post-container" style="border: ridge 1px #ccc;">
                <div class="post-detail">
                    <div class="post-comment">
                        <ul class="v-opinion">
                            <li>
                                <img style="width:48px; height: 48px;" src="<?php echo $user['profile_picture'];?>" alt="" class="profile-pic">
                            </li>
                            <li>
                                <textarea style="margin-top: 0px; margin-bottom: 3px;height:48px;" rows="3" class="form-control comment_title_<?php echo $idea_details['idea_id']; ?>" placeholder="Post a comment"></textarea>	
                            </li>
                            <li>
                                <button data-replayparent="<?php echo $idea_details['idea_id']; ?>" data-postideaid="<?php echo $idea_details['idea_id']; ?>" class="csbmt btn-block">send</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="commm_<?php echo $idea_details['idea_id']; ?>">
            <?php 
                $ind= $idea_details['idea_id']; 
                $CI =& get_instance();
                $com = $CI->Comments($ind);
                foreach($com as $c){
            ?>
                    <div class="post-container">
            <?php 
                    $in= $c['comment_byuser']; 
                    $CI =& get_instance();
                    $comus = $CI->userdata($in);
                    if($comus['login_type']==1){
                        $profile_pic = (isset($comus['profile_picture']))?$comus['profile_picture']:'svg.svg';
                        $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
                    }else{
                        $prof_pic = $comus['profile_picture'];
                    }
            ?>
                <div class="post-detail">
                    <img src="<?php echo $prof_pic; ?>" class="profile-photo-md pull-left" alt="">
                        <div class="user-info">
                            <h5>
                                <a class="profile-link"><?php echo $comus['name']; ?></a>
                                <span class="text-muted"><?php //echo time_elapsed_string(strtotime($c['comment_created'])); ?></span>
                            </h5>
                        </div>
                        <div class="reaction">
                            <a class="btn text-green"></a>
                        </div>
                        <div class="reaction">
                            <a class="btn text-green"></a>
                        </div>
                        <div class="post-text">
                            <p>
                                <?php echo $c['comment_name']; ?><i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i><br>
                                <a data-commentid="<?php echo $c['comment_id']; ?>" data-status="1"  class="stat-item commentlike commentlike_<?php echo $c['comment_id']; ?>">
                                    <i class="fa fa-thumbs-up"></i> 
                                    <span class="like_class_<?php echo $c['comment_id']; ?>">
                                    <?php 
                                        $in= $c['comment_id']; 
                                        $CI =& get_instance();
                                        $clike = $CI->comment_ById($in);
                                        if(!empty($clike)){
                                            if($clike['status']='1'){echo "Liked";}else{ echo "Like";}}else{echo "Like";}
                                    ?>
                                    </span>
                                </a>
                            </p>
                        </div>
                        <div class="replay_input_<?php echo $c['comment_id']; ?> post-comment" >
                            <img src="<?php echo $user['profile_picture']; ?>" alt="" class="profile-pic">
                            <input type="text" class="replay_comment_name_<?php echo $c['comment_id']; ?> form-control" onKeyPress="return checkSubmit(event)" placeholder="Reply a comment">
                            <a data-postid="<?php echo $idea_details['idea_id']; ?>" data-replayid="<?php echo $c['comment_id']; ?>" class="replay stat-item replay_<?php echo $c['comment_id']; ?>">
                                <i class="fa fa-reply"></i> 
                            </a>
                        </div>
                        <div class="subcommm_<?php echo $c['comment_id']; ?>">
                            <div class="sub-post">
                                <?php 
                                    $ind= $c['comment_id']; 
                                    $CI =& get_instance();
                                    $scom = $CI->SubComments($ind);
                                    foreach($scom as $sc){
                                        $in= $sc['comment_byuser']; 
                                        $CI =& get_instance();
                                        $scomus = $CI->userdata($in);
                                        if($comus['login_type']==1){
                                        $profile_pic = (isset($comus['profile_picture']))?$comus['profile_picture']:'svg.svg';
                                            $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
                                        }else{
                                            $prof_pic = $comus['profile_picture'];
                                        } 
                                ?>
                                <div class="post-comment">
                                    <img src="<?php echo $prof_pic; ?>" alt="" class="profile-pic">
                                    <p>
                                        <a  class="profile-link"><?php echo $scomus['name']; ?> </a>
                                        <i class="em em-laughing"></i><br>
                                        <?php echo $sc['comment_name']; ?><br>
                                        <a data-commentid="<?php echo $sc['comment_id']; ?>" data-status="1"  class="stat-item commentlike commentlike_<?php echo $sc['comment_id']; ?>">
                                            <i class="fa fa-thumbs-up"></i> 
                                            <span class="like_class_<?php echo $sc['comment_id']; ?>">
                                                <?php $in= $sc['comment_id']; 
                                                $CI =& get_instance();
                                                $clike = $CI->comment_ById($in);
                                                if(!empty($clike)){
                                                    if($clike['status']='1'){echo "Liked";}else{ echo "Like";}}else{echo "Like";}
                                                ?>
                                            </span>
                                        </a>
                                    </p>
                                </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div id="reportModal<?php echo $idea_details['idea_id']; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">

                <!-- Modal content-->
        <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title">Report Idea</h5>
                        </div>
                        <div class="modal-body">
                        <form id="report-submit">
                                <div class="radio-grp">
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                                <input type="radio" id="option-1" class="mdl-radio__button" name="optionsreport" value="1" checked>
                                                <span class="mdl-radio__label">Spam</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                                <input type="radio" id="option-2" class="mdl-radio__button" name="optionsreport" value="2">
                                                <span class="mdl-radio__label">Duplicate Idea</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
                                                <input type="radio" id="option-3" class="mdl-radio__button" name="optionsreport" value="3">
                                                <span class="mdl-radio__label">Factually Incorrect</span>
                                        </label>
                                    <input type="hidden" name="postidreport" id="postidreport" value="<?php echo $idea_details['idea_id']; ?>"> 
                                </div>
                                </form>
                                <div class="msgs"></div>
                        </div>
                        <div class="modal-footer">
                                <button id="report-report" class="btn btn-initiate btn-ignore">Submit</button>
                        </div>
                </div>

                </div>
        </div>