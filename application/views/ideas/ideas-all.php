<?php 
    
    if(isset($bussinessIdeas) && count($bussinessIdeas)>0){
    foreach($bussinessIdeas as $o){
?>
    <span id="tab<?php echo $o['idea_id']; ?>"></span>
    <div class="panel panel-default ideazone-content" id="allPosted_div_<?php echo $o['idea_id']; ?>">
        <div class="panel-heading">
            
            <?php if($o['login_type']==1){
                $profile_pic = (isset($o['profile_picture']) && $o['profile_picture']!='')?$o['profile_picture']:'svg.svg';
                $prof_pic = base_url()."assets/images/uploads/".$profile_pic;
            }else{
                $prof_pic = $o['profile_picture'];
            }
            ?>
            <div class="row row-eq-height">
                <div class="col-lg-5">
                    <img src="<?php echo $prof_pic; ?>" class="profile-pic" /> 
                    <span class="white"><?php echo $o['name']; ?></span>
                </div>
                <div class="col-lg-3">
                    <span>&nbsp;</span>
                </div>
                <div class="col-lg-4">
                    <span class="pull-right">
                        <span class="stars allstars_<?php echo $o['idea_id']; ?>" data-rating="<?php echo $o['rating']; ?>" data-num-stars="5"></span>
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
                <div id="short_desc_<?php echo $o['idea_id'];?>">
                    <p class="ideazonedescription">
                        <?php echo $o['shortdescription'];?>
                    </p>&nbsp;
                    <button class="btn btn-primary" id="expand_content_<?php echo $o['idea_id'];?>">
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="long_desc_<?php echo $o['idea_id'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $o['longdescription'];?>
                    </p>&nbsp;
                    <span><a id="seemore_<?php echo $o['idea_id'];?>" class="btn btn-xs btn-info">See More</a></span>
                </div>
                <div id="full_desc_<?php echo $o['idea_id'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $o['description'];?>
                    </p>&nbsp;
                    <!--span><a id="seeless_<?php echo $o['idea_id'];?>" class="btn btn-xs btn-info">See Less</a></span-->
                </div>
                <input type="hidden" id="ideacontent_<?php echo $o['idea_id'];?>" value="0">
                <div id="resource_details_<?php echo $o['idea_id'];?>">
                    
                </div>
                <?php //$this->load->view('ideas/idea_comments_copy');?>
            </div>
        </div> 
        <?php if(!empty($o['tag_name'])){ ?>
        <div class="panel-footer" style="background-color:#f9f9f9;padding:5px 15px; ">
            <p class="ideatags">
              <?php 
                $tags = explode(',', $o['tag_name']);
                //$slug = explode(',', $o['slug']);
                foreach ($tags as $k=>$tag){?>
                <a href="/tag/<?php echo $o['slug'][$k];?>"><?php echo $tag." ";?></a>
            <?php } ?>
            </p>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if(isset($links)){?>
    <div class="pagination pagination_edit">			
        <?php
            foreach ($links as $link) {
                echo $link;
            }	
        ?>
    </div>
    <?php } ?>
        <?php }else{ ?>
    <div class="panel panel-default ideazone-content" id="allPosted_div_0">
        <div class="panel-heading">&nbsp;</div>
        <div class="panel-body">No ideas listed</div>
        <div class="panel-footer">&nbsp;</div>
    </div>
    <?php } ?>