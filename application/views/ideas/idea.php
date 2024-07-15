<div role="tabpanel" class="tab-pane fade in active" id="allIdeas">
    <?php 
        foreach($bussinessIdeas as $o){
    ?>
    <span id="tab<?php echo $o['idea_id']; ?>"></span>
    <div class="panel panel-default ideazone-content" id="allPosted_div_<?php echo $o['idea_id']; ?>">
        <div class="panel-heading">
            <?php $primg = empty($o['profile_picture'])? 'svg.svg': $o['profile_picture']; ?>				
            <div class="row row-eq-height">
                <div class="col-lg-5">
                    <img src="<?php echo base_url(); ?>uploads/images/<?php echo $primg; ?>" class="profile-pic" /> 
                    <span class="white"><?php echo $o['name']; ?></span>
                </div>
                <div class="col-lg-3">
                    <span>&nbsp;</span>
                </div>
                <div class="col-lg-4">
                    <span class="pull-right">
                                <?php $fdb=0; ?>
                        <span class="stars allstars_<?php echo $o['idea_id']; ?>" data-rating="<?php echo $fdb; ?>" data-num-stars="5"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="industryimg hidden-xs hidden-sm">
                <?php 
                    $industry_pic = "assets/images/industries/67.jpg";
                    $filename = "assets/images/industries/".$o['industry_id'].".jpg";
                    if(is_file($filename)){
                        $industry_pic = $filename;
                    }
                ?>
                <img src="<?php echo base_url().$industry_pic;?>" width="200" height="150"/> 
            </div>
            <div class="div2">
                <h6 class="h6class">Idea Title</h6>
                <p class="ideazonedescription"><?php echo $o['idea_title']; ?></p>
                <h6 class="h6class">Industry</h6>
                <p class="ideazonedescription"><?php echo $o['industry']; ?></p>
                <h6 class="h6class">Description</h6>
                <div id="little_desc_<?php echo $o['idea_id'];?>">
                    <p class="ideazonedescription">
                        <?php $big = $o['description'];
                        echo $big?>
                    </p>&nbsp;
                    <button class="btn btn-primary" id="expand_content_<?php echo $o['idea_id'];?>">
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="hide" id="hidden_content_<?php echo $o['idea_id'];?>">
                    <div class="cmore see-more_<?php echo $o['idea_id']; ?>">
                        <p class="ideazonedescription">
                            <?php $big = $o['description'];
                            echo $big;
                            if($this->uri->segment(3)){
                                    $seg = 'page/'.$this->uri->segment(3);
                            }else{
                                    $seg ='';
                            }
                            ?>
                            <?php if(!empty($session_user)){?>
                            <span><a data-seemore="<?php echo $o['ID']; ?>" class="seemore btn btn-xs btn-info">See More</a></span>
                            <?php } else{?>
                            <span><a data-url="<?php echo base_url('ideazoneall/').$seg; ?>#tab<?php echo $o['ID'];?>" class=" checksession" > ..see more</a></span>
                            <?php } ?>
                        </p>
                    </div>
                    <div class="see-les_<?php echo $o['idea_id']; ?>" style="display:none">
                        <p class="ideazonedescription"><?php echo $o['description']; ?></p>
                        <p><a data-seemore="<?php echo $o['idea_id']; ?>" class="see-lesss btn btn-xs btn-info">See Less</a></p>
                    </div>
                    <div class="see-les_<?php echo $o['idea_id']; ?>" style="display:none">
                        <p>&nbsp;</p>
                        <ul class="investment list-unstyled">
                            <li>Approx Investment <br>
                            <span><?php echo $o['CURRENCY']; ?> <?php echo ceil($o['MIN_INVESTMENT']); ?> - <?php echo ceil($o['MAX_INVESTMENT']); ?></span>
                            </li>
                            <li>Approx Returns (<?php echo $o['RETURNS_TYPE']; ?>) <br> <span> <?php echo ceil($o['MIN_RETURNS']); ?> - <?php echo ceil($o['MAX_RETURNS']); ?></span></li>
                            <li>Approx Breakeven <br> <span><?php echo $o['BREAKEVEN_TYPE']; ?> <?php echo $o['MIN_BREAKEVEN']; ?> - <?php echo $o['MAX_BREAKEVEN']; ?></span></li>
                        </ul>
                        <p class="visible-xs visible-sm mb-0">Resources Required</p>
                        <div class="table-responsive">
                            <p class="hidden-xs hidden-sm">Resources Required</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Skill Name </th>
                                        <th>No. People</th>
                                            <!--<th>Contribute</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $b =  $o['resources_qty'];
                                    $catss = explode(",", $b);
                                    foreach($o['SKILLS'] as $key1=>$skill){
                                       if(!(isset($skill[1])) || (isset($skill[1]) && isset($skill[1]) && $skill[1]==2 && $skill[2] == $session_user)
                                               || (isset($skill[1]) && isset($skill[1]) && $skill[1]==1) ){
                                ?>
                                <tr>
                                    <td><?php echo $skill[0];?></td>
                                    <td><?php echo $catss[$key1]; ?></td>
                                </tr>    
                                <?php  } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php if(!empty($session_user)){?>
                    <div class="btn-group polls">
                    <ul class="pull-right list-unstyled">
                        <li><a class="opinion" data-opinion="<?php echo $o['ID']; ?>">Opinion</a></li>
                        <li>
                            <a id="<?php echo $o['ID']; ?>" data-impid="<?php echo $o['ID']; ?>" class="impress impressall star_<?php echo $o['ID']; ?>">Impress</a>
                            <div data-imid="<?php echo $o['ID']; ?>" class="impress-cont impresscount<?php echo $o['ID']; ?>">
                                <input name="input-2" class="rating rating-loading" data-imid="<?php echo $o['ID']; ?>" data-min="0" data-max="5" data-step="0.1" value="0" />
                            </div>
                            <span class="feedbackmsg" id="feedbackmsg<?php echo $o['ID']; ?>"></span>
                        </li>
                        <li>
                            <a class="sharing" data-share="<?php echo $o['ID']; ?>">Share</a>
                            <div class="sharing-cont share_<?php echo $o['ID']; ?>"> 
                                <ul class="share-list ">
                                    <li><a href="https://plus.google.com/share?url=<?php echo base_url('ideazone/idea/').$o['ID']; ?>"><i class="fa fa-google-plus-square" title="Google Plus"></i></a></li>
                                    <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url('ideazone/idea/').$o['ID']; ?>"><i class="fa fa-facebook-square" title="Facebook"></i></a></li>
                                    <li><a href="https://twitter.com/share?url=<?php echo base_url('ideazone/idea/').$o['ID']; ?>&text=<?php echo $o['IDEA_TITLE']; ?>" target="_blank"><i class="fa fa-twitter-square" title="Twitter"></i></a></li>
                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('ideazone/idea/').$o['ID']; ?>" target="_blank"><i class="fa fa-linkedin-square" title="Linkedin"></i></a></li>
                                    <li> <a  data-clipboard-text="<?php echo base_url('ideazone/idea/').$o['ID']; ?>" class="allowCopy"><i class="fa fa-link" title="copy link"></i></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a id="<?php echo $o['ID']; ?>" uid="<?php echo $session_user; ?>" class="save-unsave save-unsave_<?php echo $o['ID'];?>">
                                <?php if(isset($issave) && count($issave)!='0'){ echo "Unsave";}else{ echo "Save"; } ?>
                            </a>
                        </li>
                        <li><a href="#" class="report-model" data-postid="<?php echo $o['ID']; ?>" data-toggle="modal" data-target="#reportModal">Report</a></li>
                    </ul>
                </div>
                    <div class="btn-group polls clearfix">
                        <div class="opinion-cont opinion_<?php echo $o['ID']; ?>">
                            <div class="post-content">
                                <div class="post-container" style="border: ridge 1px #ccc;">
                                    <div class="post-detail">
                                        <div class="post-comment">
                                            <?php if(empty($user['PROFILE_PICTURE'])){
                                                $user['PROFILE_PICTURE']='svg.svg';
                                            }
                                            if(empty($comus['PROFILE_PICTURE'])){
                                                $comus['PROFILE_PICTURE']='svg.svg';
                                            } 
                                            if(empty($scomus['PROFILE_PICTURE'])){
                                                $scomus['PROFILE_PICTURE']='svg.svg';
                                            }
                                            if(empty($fid['PROFILE_PICTURE'])){
                                                $fid['PROFILE_PICTURE']='svg.svg';
                                            }
                                            ?>
                                            <ul class="v-opinion">
                                                <li><img style="width:48px; height: 48px;" src="<?php echo base_url(); ?>uploads/images/<?php echo $user['PROFILE_PICTURE']; ?>" alt="" class="profile-pic"></li>
                                                <li>
                                                    <textarea style="margin-top: 0px; margin-bottom: 3px;height:48px;" rows="3" class="form-control comment_title_<?php echo $o['ID']; ?>" placeholder="Post a comment"></textarea>	
                                                </li>
                                                <li>
                                                    <button data-replayparent="<?php echo $o['ID']; ?>" data-postideaid="<?php echo $o['ID']; ?>" class="csbmt btn-block">send</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="commm_<?php echo $o['ID']; ?>">
                                <?php 
                                    $ind= $o['ID']; 
                                    $CI =& get_instance();
                                    $com = $CI->Comments($ind);
                                    foreach($com as $c){
                                ?>
                                        <div class="post-container">
                                <?php 
                                        $in= $c['comment_byuser']; 
                                        $CI =& get_instance();
                                        $comus = $CI->userdata($in);
                                        if(empty($comus['PROFILE_PICTURE'])){
                                            $comus['PROFILE_PICTURE']='svg.svg';
                                        } 
                                ?>
                                    <div class="post-detail">
                                        <img src="<?php echo base_url(); ?>uploads/images/<?php echo $comus['PROFILE_PICTURE']; ?>" class="profile-photo-md pull-left" alt="">
                                            <div class="user-info">
                                                <h5>
                                                    <a class="profile-link"><?php echo $comus['NAME']; ?></a>
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
                                                <img src="<?php echo base_url(); ?>uploads/images/<?php echo $user['PROFILE_PICTURE']; ?>" alt="" class="profile-pic">
                                                <input type="text" class="replay_comment_name_<?php echo $c['comment_id']; ?> form-control" onKeyPress="return checkSubmit(event)" placeholder="Replay a comment">
                                                <a data-postid="<?php echo $o['ID']; ?>" data-replayid="<?php echo $c['comment_id']; ?>" class="replay stat-item replay_<?php echo $c['comment_id']; ?>">
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
                                                            if(empty($scomus['PROFILE_PICTURE'])){
                                                                $scomus['PROFILE_PICTURE']='svg.svg';
                                                            } 
                                                    ?>
                                                    <div class="post-comment">
                                                        <img src="<?php echo base_url(); ?>uploads/images/<?php echo $scomus['PROFILE_PICTURE']; ?>" alt="" class="profile-pic">
                                                        <p>
                                                            <a  class="profile-link"><?php echo $scomus['NAME']; ?> </a>
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
                <?php } ?>
                </div>
            </div>
        </div> 
        <?php if(!empty($o['TAGS'])){ ?>
        <div class="panel-footer" style="background-color:#f9f9f9;padding:5px 15px; ">
                <p class="ideatags"><?php echo $o['TAGS']; ?></p>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>